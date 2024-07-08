<?php (defined('BASEPATH')) or exit('No direct script access allowed');

class Media extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('commondatamodel', 'commondatamodel', TRUE);
        $this->load->model('ProductsMenu', 'productsmenu', TRUE);

    }

    public function index()
    {
        $page = "web_view/media/media.php";
        $result["active"] = "media-menu";
        webbody_helper($result, $page);
    }

    public function videos()
    {
        $page = "web_view/media/videos.php";
        $result["video"] = $this->productsmenu->getAllRecordWhereOrderBy("fuel_videos", ["is_disabled" => 0], "precedence", "ASC");
        $result["active"] = "media-menu";
        webbody_helper($result, $page);
    }

    public function news()
    {
        $page = "web_view/media/news.php";
        $mediaMaster = $this->commondatamodel->getSingleRowByWhereCls("media_master", ["menu_tag" => "NEWS"]);
        $orderBy="precedence";
        $result["news"] = $this->commondatamodel->getAllRecordWhereOrderBy("document_details", ["ref_id" => $mediaMaster->media_master_id, "table_name" => "media_master", "is_disabled" => 0],$orderBy);
        $result["active"] = "media-menu";
        webbody_helper($result, $page);
    }

    public function events_happenings()
    {
        $page = "web_view/media/events_happenings.php";
        $result["active"] = "media-menu";
        $mediaGallery = $this->commondatamodel->getAllRecordWhereOrderByCol("happenings", ["published" => 1], "precedence", "ASC");
        foreach ($mediaGallery as $key => $value) {
            $value->gallery = json_decode($value->images, true);
        }
        $result["mediaGallery"] = $mediaGallery;
        webbody_helper($result, $page);
    }

    public function newsletter()
    {
        $page = "web_view/media/newsletter.php";
        $result["active"] = "media-menu";
        webbody_helper($result, $page);
    }

    public function newsletter_til_talk()
    {
        $page = "web_view/media/newsletter/til_talk.php";
        $mediaMaster = $this->commondatamodel->getSingleRowByWhereCls("media_master", ["menu_tag" => "TIL_TALK"]);
        $orderBy="precedence";
        $result["til_talk"] = $this->commondatamodel->getAllRecordWhereOrderBy("document_details", ["ref_id" => $mediaMaster->media_master_id, "table_name" => "media_master", "is_disabled" => 0],$orderBy);
        $result["active"] = "media-menu";
        webbody_helper($result, $page);
    }

    public function newsletter_til_touch()
    {
        $page = "web_view/media/newsletter/til_touch.php";
        $mediaMaster = $this->commondatamodel->getSingleRowByWhereCls("media_master", ["menu_tag" => "TIL_TOUCH"]);
        $orderBy="precedence";
        $result["til_touch"] = $this->commondatamodel->getAllRecordWhereOrderBy("document_details", ["ref_id" => $mediaMaster->media_master_id, "table_name" => "media_master", "is_disabled" => 0],$orderBy);
        $result["active"] = "media-menu";
        webbody_helper($result, $page);
    }
}