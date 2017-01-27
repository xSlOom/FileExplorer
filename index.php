<html>
    <head>
        <meta charset="UTF-8" />
        <title>File explorer</title>
    </head>
    <body>
        <p>File explorer made by Clément and Cédric.</p>
        <?php
            $scan   = scandir("../");
            for ($i = 0; $i < sizeof($scan); $i++) {
                if (!in_array($scan[$i], ["..", "."])) {
                    $ext = pathinfo($scan[$i]);
                    print $scan[$i] . " (" . (!empty($ext["extension"]) ? "C'est un fichier" : "C'est un dossier") . ") <br />";
                }
            }
        ?>
    </body>
</html>