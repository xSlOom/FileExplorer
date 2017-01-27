<html>
    <head>
        <meta charset="UTF-8" />
        <title>File explorer</title>
    </head>
    <body>
        <div>
            <p>File explorer made by Clément and Cédric.</p>
        </div>
        <?php
            // chemin actuel : getcwd();
            $path   = "../";
            $scan   = scandir($path);
            for ($i = 0; $i < sizeof($scan); $i++) {
                if (!in_array($scan[$i], ["..", "."])) {
                    $image  = "";
                    $ext    = pathinfo($scan[$i]);
                    if (!empty($ext["extension"])) {
                        switch(strtolower($ext["extension"])) {
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
                                $image  = "images/js.png";
                                break;
                            default:
                                $image  = "images/file.png";
                                break;
                        }
                    } else {
                        $scand  = scandir("../" . $scan[$i]);
                        $image  = sizeof($scand) > 2 ? "images/full.png" : "images/empty.png";
                    }
                    print '<img src="' . $image . '" /><a href="' . $path . $scan[$i] . '">' . $scan[$i] . '</a> <br />';
                }
            }
        ?>
    </body>
</html>
