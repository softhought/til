import asyncio
import aiohttp
import re
import json
import sys
from bs4 import BeautifulSoup

async def fetch_html_content(session, url):
    try:
        async with session.get(url) as response:
            if response.status == 200:
                return await response.text()
            else:
                print(f"Failed to fetch HTML content from {url}. Status code: {response.status}")
                return None
    except aiohttp.ClientError as e:
        print(f"Failed to fetch HTML content from {url}. Error: {e}")
        return None

async def extract_context(session, url, keyword):
    html_content = await fetch_html_content(session, url)
    if html_content:
        html_content = re.sub(r'[\n\t\r]+', ' ', html_content)
        html_content = html_content.replace('\u2019s', "'")
        
        html_content = re.findall(r'(?s)<html.*?</html>', html_content)
        context_data = ""
        for html in html_content:
            soup = BeautifulSoup(html, 'html.parser')
            title = soup.title.string.strip() if soup.title else ""
            valid_tags = soup.find_all(['p', 'td', 'tr'])
            text = ' '.join(tag.get_text(separator=' ') for tag in valid_tags)
                        
            sentences = [sentence.strip() for sentence in re.split(r'(?<!\w\.\w.)(?<![A-Z][a-z]\.)(?<=\.|\?)\s', text) if sentence.strip()]
            keyword_lower = keyword.lower()
            keyword_indices = [i for i, sentence in enumerate(sentences) if keyword_lower in sentence.lower()]
            for index in keyword_indices:
                start_index = index
                end_index = min(len(sentences), index + 1)
                context = ' '.join(sentences[start_index:end_index]).strip()
                if context_data:
                    context_data += " " + context
                else:
                    context_data = context

        return {"url": url, "title": title, "content": context_data.strip()}
    else:
        return None

async def main():
    if len(sys.argv) != 2:
        print("Usage: python script.py <keyword>")
        sys.exit(1)
    
    keyword = sys.argv[1]

    with open("urls.json", "r") as f:
        urls = json.load(f)

    async with aiohttp.ClientSession() as session:
        tasks = []
        for url in urls:
            task = extract_context(session, url, keyword)
            tasks.append(task)
        
        results = await asyncio.gather(*tasks)

    response_data = [data for data in results if data and data['content']]

    print(json.dumps(response_data, indent=4))

if __name__ == "__main__":
    asyncio.run(main())
