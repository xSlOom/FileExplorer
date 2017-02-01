<?php
include("php/file.class.php");
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
        <link rel="stylesheet" href="//cdn.jsdelivr.net/highlight.js/9.9.0/styles/default.min.css">
        <script src="//cdn.jsdelivr.net/highlight.js/9.9.0/highlight.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.9.0/styles/default.min.css">
        <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.9.0/highlight.min.js"></script>
        <script>hljs.initHighlightingOnLoad();</script>
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
                           $file->folder[]	= ["ext" => $image, "p" => $file->path, "path" => $file->path . $file->scan[$i], "name" => $file->scan[$i]];
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
           <?php for ($y = 0; $y < sizeof($file->files); $y++): ?>
           <div class="col-md-4">
               <div class="thumbnail">
                   <img src="<?php echo $file->files[$y]["ext"]; ?>" style="width:64px; height: 64px;">
                   <div class="caption">
                       <h3 class="text-center"><?php echo $file->files[$y]["name"]; ?> </h3><p class="text-center">Size: <?php echo $file->sizeconvert(filesize($file->files[$y]["path"])); ?></p>
                       <p style="text-align:center"><a href="php/download.php?download=<?php echo $file->files[$y]["path"] . "|" .$file->files[$y]["name"]; ?>" class="btn btn-success" role="button">Download</a> <a href="#" class="btn btn-info" data-toggle="modal" data-target="#<?php echo $y; ?>" value="Preview">Preview</a>
                       </p>
                       <div class="modal fade" id="<?php echo $y ; ?>" role="dialog">
                           <div class="modal-dialog">
                               <div class="modal-content">
                                   <div class="modal-header">
                                       <button type="button" class="close" data-dismiss="modal">&times;</button>
                                       <h4 class="modal-title">Preview for : <?php echo $file->files[$y]["path"]; ?></h4>
                                   </div>
                                   <div class="modal-body container">
                                       <div class="col-md-8">
                                           <p>
                                               <?php
                                               if (strpos(mime_content_type($file->files[$y]["path"]), "image") !== false):
                                                   print '<img src="' . str_replace(substr($file->main, 0, -1), '', $file->files[$y]["path"]) . '" />';
                                               else:
                                                   print '<pre><code class="' . explode(".", $file->files[$y]["path"])[1] . '">' . htmlentities(file_get_contents($file->files[$y]["path"])) . '</code></pre>';
                                               endif;
                                               ?>
                                           </p>
                                       </div>
                                   </div>
                                   <div class="modal-footer">
                                       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
			<?php endfor; ?>
        </div>
    </body>
</html>
