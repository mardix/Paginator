<?php

include "../src/Voodoo/Paginator.php";

$url = "http://mysite.com";
$pagePattern = "/page/(:num)";
$totalItems = 150;
$totalPerPage = 10;

$paginator = (new Voodoo\Paginator)
                ->setUrl($url, $pagePattern)
                ->setItems($totalItems, $totalPerPage);
?>

<html>
    <head>
        <link rel="stylesheet" href="./examples/paginator.css">
        <title>Paginator Example</title>
    </head>
    
    <body>
        <h2>Pages</h2>
        <?= $paginator; ?>
    </body>
</html>