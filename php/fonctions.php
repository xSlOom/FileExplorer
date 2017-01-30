<?php

class file {

    public $path;
    public $scan;
    public $prev;
    public $Rpath;

    function __construct() {
        $this->path     = ((isset($_GET["path"])) && (substr($_GET["path"], 0, 16) == "c:/xampp/htdocs/")) ? $_GET["path"] . "/" : "c:/xampp/htdocs/";
        $this->scan     = @scandir($this->path);
        $this->Rpath    = substr($this->path, 0, -1);
        $this->prev     = str_replace(realpath(dirname($this->path) . '/..'), '', realpath(dirname($this->path)));
    }

    function getExtensions($ext)  {
        switch ($ext) {
            case "html":
                $image = "images/html.png";
                break;
            case "php":
                $image = "images/php.png";
                break;
            case "txt":
                $image = "images/txt.png";
                break;
            case "exe":
                $image = "images/exe.png";
                break;
            case "zip":
                $image = "images/zip.png";
                break;
            case "css":
                $image = "images/css.png";
                break;
            case "js":
                $image = "images/javascript.png";
                break;
            case "avi":
                $image = "images/avi.png";
                break;
            case "csv":
                $image = "images/csv.png";
                break;
            case "dbf":
                $image = "images/dbf.png";
                break;
            case "ai":
                $image = "images/ai.png";
                break;
            case "doc":
            case "docx":
                $image = "images/doc.png";
                break;
            case "dwg":
                $image = "images/dwg.png";
                break;
            case "fla":
                $image = "images/fla.png";
                break;
            case "jpg":
            case "jpeg":
                $image = "images/jpg.png";
                break;
            case "iso":
                $image = "images/iso.png";
                break;
            case "json":
                $image = "images/json-file.png";
                break;
            case "mp3":
            case "mpeg3":
                $image = "images/mp3.png";
                break;
            case "mp4":
            case "mpeg4":
                $image = "images/mp4.png";
                break;
            case "pdf":
                $image = "images/pdf.png";
                break;
            case "png":
                $image = "images/png.png";
                break;
            case "ppt":
            case "pptx":
                $image = "images/ppt.png";
                break;
            case "psd":
                $image = "images/psd.png";
                break;
            case "rtf":
                $image = "images/rtf.png";
                break;
            case "svg":
                $image = "images/svg.png";
                break;
            case "xls":
            case "xlsx":
                $image = "images/xls.png";
                break;
            case "xml":
                $image = "images/xml.png";
                break;
            case "rar":
                $image = "images/zip-1.png";
                break;
            default:
                $image = "images/file.png";
                break;
        }
        return $image;
    }
}
?>