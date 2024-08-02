<style>
    .breadcrumb-nav {
        position: absolute;
        top: 20px;
        left: 20px;
        z-index: 10;
    }

    .breadcrumb {
        padding: 10px;
        border-radius: 5px;
        background-color: rgba(0, 0, 0, 0.5);
        margin-bottom: 20px;
    }

    .breadcrumb-item a {
        color: white;
        text-decoration: none;
    }

    .breadcrumb-item a:hover {
        text-decoration: underline;
    }

    .breadcrumb>li+li::before {
        padding: 0 5px;
        color: #ccc;
        content: "|";
    }
</style>

<section class="about_header about-banner-section" id="banner-section">
    <div class="container">
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <ol class="breadcrumb" id="breadcrumb-list">
            </ol>
        </nav>
        <h1 class="m-0" id="page-title">Corporate Profile</h1>
    </div>
</section>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function setBreadcrumbAndBackground(imagePath, headText) {
        var breadcrumbList = document.getElementById('breadcrumb-list');
        var pageTitle = document.getElementById('page-title');
        var bannerSection = document.getElementById('banner-section');

        var urlPath = window.location.pathname;
        var pathParts = urlPath.split('/').filter(function (part) {
            return part.length > 0 && isNaN(part);
        });

        var breadcrumbItems = [
            { text: 'Home', url: '/' }
        ];

        for (var i = 0; i < pathParts.length; i++) {
            var url = breadcrumbItems[breadcrumbItems.length - 1].url + pathParts[i] + '/';
            var text = pathParts[i].replace(/-/g, ' ').replace(/_/g, ' ').replace(/\b\w/g, function (char) {
                return char.toUpperCase();
            });
            breadcrumbItems.push({ text: text, url: url });
        }

        breadcrumbItems.push({
            text: 'Support',
            url: '<?php echo base_url(); ?>contact-us/inquiry'
        });

        breadcrumbList.innerHTML = '';
        breadcrumbItems.forEach(function (item, index) {
            var listItem = document.createElement('li');
            listItem.className = 'breadcrumb-item';
            if (index < breadcrumbItems.length) {
                var link = document.createElement('a');
                link.href = item.url;
                link.textContent = item.text;
                listItem.appendChild(link);
            }
            breadcrumbList.appendChild(listItem);
        });

        if (pathParts.length > 0) {
            pageTitle.textContent = headText;
        }

        bannerSection.style.backgroundImage = `url(${imagePath})`;
    }

</script>