<?php
$path   = ((isset($_GET["path"])) && (substr(strtolower($_GET["path"]), 0, 16) == "c:/xampp/htdocs/")) ? $_GET["path"] . "/" : "c:/xampp/htdocs/";
$scan   = @scandir($path);
$prev   = str_replace(realpath(dirname($path) . '/..'), '', realpath(dirname($path)));
?>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>File explorer</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="container">
            <div class="entete">
            <h2 id="title">La spéléo du fichier made by Clément and Cédric.</h2>
        </div>
            <a href="?path=<?php echo $prev; ?>"><img src="images/more.png"></a> <br />
            <?php
                // chemin actuel : getcwd();
                if (strpos($path, ".") !== false):
                    if (strpos(mime_content_type(substr($path, 0, -1)), "image") !== false):
                        header('Content-type: image/png');
                        echo readfile(substr($path, 0, -1));
                    else:
                        echo htmlentities(highlight_string(file_get_contents(substr($path, 0, -1))));
                    endif;
                else:
                    for ($i = 0; $i < sizeof($scan); $i++):
                        if (!in_array($scan[$i], ["..", "."])):
                            $image = "";
                            $ext = pathinfo($scan[$i]);
                            if (is_file($path.$scan[$i])):
                                switch (@strtolower($ext["extension"])):
                                    case "html":
                                        $image  = "images/html.png";
                                        break;
                                    case "php":
                                        $image  = "images/php.png";
                                        break;
                                    case "txt":
                                        $image  = "images/txt.png";
                                        break;
                                    case "exe":
                                        $image  = "images/exe.png";
                                        break;
                                    case "zip":
                                        $image  = "images/zip.png";
                                        break;
                                    case "css":
                                        $image  = "images/css.png";
                                        break;
                                    case "js":
                                        $image  = "images/javascript.png";
                                        break;
                                    case "avi":
                                        $image  = "images/avi.png";
                                        break;
                                    case "csv":
                                        $image  = "images/csv.png";
                                        break;
                                    case "dbf":
                                        $image  = "images/dbf.png";
                                        break;
                                    case "ai":
                                        $image  = "images/ai.png";
                                        break;
                                    case "doc":
                                    case "docx":
                                        $image  = "images/doc.png";
                                        break;
                                    case "dwg":
                                        $image  = "images/dwg.png";
                                        break;
                                    case "fla":
                                        $image  = "images/fla.png";
                                        break;
                                    case "jpg":
                                    case "jpeg":
                                        $image  = "images/jpg.png";
                                        break;
                                    case "iso":
                                        $image  = "images/iso.png";
                                        break;
                                    case "json":
                                        $image  = "images/json-file.png";
                                        break;
                                    case "mp3":
                                    case "mpeg3":
                                        $image  = "images/mp3.png";
                                        break;
                                    case "mp4":
                                    case "mpeg4":
                                        $image  = "images/mp4.png";
                                        break;
                                    case "pdf":
                                        $image  = "images/pdf.png";
                                        break;
                                    case "png":
                                        $image  = "images/png.png";
                                        break;
                                    case "ppt":
                                    case "pptx":
                                        $image  = "images/ppt.png";
                                        break;
                                    case "psd":
                                        $image  = "images/psd.png";
                                        break;
                                    case "rtf":
                                        $image  = "images/rtf.png";
                                        break;
                                    case "svg":
                                        $image  = "images/svg.png";
                                        break;
                                     case "xls":
                                     case "xlsx":
                                        $image  = "images/xls.png";
                                        break;
                                    case "xml":
                                        $image  = "images/xml.png";
                                        break;
                                    case "rar":
                                        $image  = "images/zip-1.png";
                                        break;
                                    default:
                                        $image  = "images/file.png";
                                        break;
                                endswitch;
                            else:
                                $scand = @scandir($path . $scan[$i]);
                                $image = sizeof($scand) > 2 ? "images/full.png" : "images/empty.png";
                            endif;
            ?>
            <div class="col-md-4">
                <a href="?path=<?php echo $path . $scan[$i]; ?>">
                    <img src="<?php echo $image; ?>" style="width:64px; height: 64px;" /><?php echo $scan[$i]; ?>
                </a>
            </div>
            <?php endif; ?>
            <?php endfor; ?>
            <?php endif; ?>
        </div>
    </body>
</html>
