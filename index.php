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
            <p>File explorer made by Clément and Cédric.</p>
            <?php
                // chemin actuel : getcwd();
                $path   = isset($_GET["path"]) ? $_GET["path"] ."/" : "c:/xampp/htdocs/";
                $scan   = @scandir($path);
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
                            $scand  = @scandir($path.$scan[$i]);
                            $image  = sizeof($scand) > 2 ? "images/full.png" : "images/empty.png";
                        }
                        print '<div><img src="' . $image . '" style="width:64px; height: 64px;" /><a href="?path=' . $path . $scan[$i].'">' . $scan[$i] . '</a></div>';
                    }
                }
            ?>
        </div>
    </body>
</html>
