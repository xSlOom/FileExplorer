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
            <h2 id="title">La spéléo du fichier made by Clément and Cédric.</h2>
        </div>
        <div class="container">
            <p><strong>Current directory:</strong> <?php echo str_replace("/", " > ", $file->Rpath); ?></p>
           <!-- <a href="?path=<?php echo $file->prev; ?>"><img src="images/more.png"></a> <br />-->
            <?php
            if (strpos($file->path, ".") !== false):
                if (strpos(mime_content_type(substr($file->path, 0, -1)), "image") !== false):
                    echo "Coming soon";
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
