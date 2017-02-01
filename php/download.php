<?php
if (isset($_GET["download"])) {
    $download   = explode("|", $_GET["download"]);
    if ((!isset($download[1])) || (!strpos($download[1], "."))) {
        print "Wrong file!";
    } else {
        header('Content-Type: application/download');
        header('Content-Disposition: attachment; filename="' . $download[1] . '"');
        header("Content-Length: " . filesize("{$download[0]}"));
        readfile($download[0]);
    }
}
?>