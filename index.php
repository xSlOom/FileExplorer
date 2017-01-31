<?php
include ("php/fonctions.php");
$file   = new file();
?>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>File explorer</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="entete">
            <img id="image" src="images/entete.gif">
        </div>
        <div class="container">
           <a href="?path=<?php echo $file->prev; ?>"><img src="images/more.png"></a> <br />
            <ol class="breadcrumb">
                <?php
                    $directory = explode("/", $file->Rpath);
                    for ($i = 0; $i < sizeof($directory); $i++):
                        if (in_array($directory[$i], ["opt", "lampp"])) continue;
                ?>
                    <li><a href="?path=<?php echo $file->getDir($directory[$i]); ?>"><?php echo $directory[$i]; ?></a></li>
                <?php endfor; ?>
            </ol>
           <?php
            if ((strpos($file->path, ".") !== false) || (!@opendir($file->path))):
                if (strpos(mime_content_type(substr($file->path, 0, -1)), "image") !== false):
                    print '<img src="' . str_replace(substr($file->main, 0, -1), '', $file->Rpath) . '" />';
                elseif (strpos($file->Rpath, "pdf")):
                    echo "Coming soon";
                elseif (strpos($file->Rpath, "ttf")):
                    print "Unable to show that file!";
                else:
                    echo htmlentities(highlight_string(file_get_contents($file->Rpath)));
                endif;
            else:
                for ($i = 0; $i < sizeof($file->scan); $i++):
                    if (!in_array($file->scan[$i], ["..", "."])):
                        $image = "";
                        $ext = pathinfo($file->scan[$i]);
                        if (is_file($file->path.$file->scan[$i])):
                            $image  = @$file->getExtensions(strtolower($ext["extension"]));
                        else:
                            $scand = @scandir($file->path . $file->scan[$i]);
                            $image = sizeof($scand) > 2 ? "images/full.png" : "images/empty.png";
                        endif;
                        ?>
                        <div class="col-md-4">
                            <a href="?path=<?php echo $file->path . $file->scan[$i]; ?>">
                                <img src="<?php echo $image; ?>" style="width:64px; height: 64px;" /><?php echo $file->scan[$i]; ?>
                            </a>
                        </div>
                    <?php endif; ?>
                <?php endfor; ?>
            <?php endif; ?>
        </div>
    </body>
</html>
