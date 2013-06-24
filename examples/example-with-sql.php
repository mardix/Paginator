<?php
/**
 * A simple example
 */
include(dirname(__DIR__)."/src/Voodoo/Paginator.php");

$tableName = "myTable";
$queryCount = "SELECT COUNT(id) AS count FROM {$tableName}";

$totalItems = $result["count"];
$totalPerPage = 10;

$url = "http://mysite.com";
$pagePattern = "/page/(:num)";
$paginator = (new Voodoo\Paginator)
                ->setUrl($url, $pagePattern)
                ->setItems($totalItems, $totalPerPage);

$limit = $paginator->getPerPage();
$offset = $paginator->getStart();
$query = "SELECT * FROM {$tableName} LIMIT {$limit} OFFSET {$offset}";
?>

<html>
    <head>
        <link rel="stylesheet" href="./paginator.css">
        <title>Mardix's Paginator Example</title>
    </head>
    
    <body>
        <h2>Paginator Example</h2>
        <?php
           echo $paginator;
        ?>
        
    </body>
</html>