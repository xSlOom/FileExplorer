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
        <div class="page-header">
			<h1 class="text-center">XPlorator<small> Made by Clément & Cédric</small></h1>
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
                elseif ((strpos($file->Rpath, "pdf")) || (strpos($file->Rpath, "ttf")) || (strpos($file->Rpath, "exe"))):
                    echo "Coming soon";
                else:
                    echo str_replace('1', '', htmlentities(highlight_string(file_get_contents($file->Rpath))));
                endif;
            else:
                for ($i = 0; $i < sizeof($file->scan); $i++):
                    if (!in_array($file->scan[$i], ["..", "."])):
                        $image = "";
                        $ext = pathinfo($file->scan[$i]);
                        if (is_file($file->path.$file->scan[$i])):
                            $image  		= @$file->getExtensions(strtolower($ext["extension"]));
							$file->files[]	= ["ext" => $image, "path" => $file->path . $file->scan[$i], "name" => $file->scan[$i]];
                        else:
                            $scand 			= @scandir($file->path . $file->scan[$i]);
                            $image 			= sizeof($scand) > 2 ? "images/full.png" : "images/empty.png";
							$file->folder[]	= ["ext" => $image, "path" => $file->path . $file->scan[$i], "name" => $file->scan[$i]];
                        endif;
					endif;
				endfor;
				
				for ($y = 0; $y < sizeof($file->folder); $y++):
				?>
				<div class="col-md-4">
					<div class="thumbnail">
						<img src="<?php echo $file->folder[$y]["ext"]; ?>" style="width:64px; height: 64px;">
						<div class="caption">
							<h3 class="text-center"><?php echo $file->folder[$y]["name"]; ?></h3>
							<p style="text-align:center"><a href="?path=<?php echo $file->folder[$y]["path"]; ?>" class="btn btn-primary" role="button">View</a></p>
						</div>
					</div>
				</div>
			<?php endfor; ?>
			<?php
			for ($y = 0; $y < sizeof($file->files); $y++):
				?>
				<div class="col-md-4">
					<div class="thumbnail">
						<img src="<?php echo $file->files[$y]["ext"]; ?>" style="width:64px; height: 64px;">
						<div class="caption">
							<h3 class="text-center"><?php echo $file->files[$y]["name"]; ?></h3>
							<p style="text-align:center"><a href="?path=<?php echo $file->files[$y]["path"]; ?>" class="btn btn-primary" role="button">View</a> <?php echo '<a href="#" class="btn btn-default text-center" role="button">Size: ' . $file->sizeconvert(filesize($file->files[$y]["path"])); ?></a></p>
						</div>
					</div>
				</div>
			<?php endfor; ?>
			<?php endif; ?>
        </div>
    </body>
</html>
