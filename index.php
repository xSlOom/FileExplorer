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
            $path   = "../";
            $scan   = scandir($path);
            for ($i = 0; $i < sizeof($scan); $i++) {
                if (!in_array($scan[$i], ["..", "."])) {
                    $ext    = pathinfo($scan[$i]);
                    $inf    = !empty($ext["extension"]) ? "C'est un fichier" : "C'est un dossier";
                    print '<a href="' . $path . $scan[$i] . '">' . $scan[$i] . ' (' . $inf . ') </a><br />';
                }
            }
        ?>
    </body>
</html>
