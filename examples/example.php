<?php

include "../src/Voodoo/Paginator.php";

$url = "http://mysite.com/hello-world/page/10";
$pagePattern = "/page/(:num)";
$totalItems = 150;
$totalPerPage = 10;

$paginator = (new Voodoo\Paginator)
                ->setUrl($url, $pagePattern)
                ->setItems($totalItems, $totalPerPage);

print_r($paginator->toArray());
?>

<html>
    <head>
        <link rel="stylesheet" href="./assets/paginator.css">
        <title>Paginator Example</title>
    </head>
    
    <body>
        <?= $paginator; ?>
    </body>
</html>