<?php
/**
 * Using Paginator with SQL query
 * 
 * We will execute two queries, one to count all entries, 
 * the second one to get all the data with LIMIT and OFFSET
 */

include(dirname(__DIR__)."/src/Voodoo/Paginator.php");

$pdo = new PDO ("mysql:host=$hostname;dbname=$dbname", "$username", "$pw");
$tableName = "myTable";

/**
 * To count all the entries based on the criteria provided
 */
$sth = $pdo->query("SELECT COUNT(id) AS count FROM {$tableName}");
$countResult = $sth->fetch(PDO::FETCH_ASSOC);

$totalItems = $countResult["count"];
$totalPerPage = 10;

/**
 * Paginator will allow us to get the LIMIT and OFFSET for the query
 */
$url = "http://mysite.com/pop/page/4";
$pagePattern = "/page/(:num)";
$paginator = (new Voodoo\Paginator)
                ->setUrl($url, $pagePattern)
                ->setItems($totalItems, $totalPerPage);

$limit = $paginator->getPerPage();
$offset = $paginator->getStart();
$results = $pdo->query("SELECT * FROM {$tableName} LIMIT {$limit} OFFSET {$offset}");

?>

<html>
    <head>
        <link rel="stylesheet" href="./assets/paginator.css">
        <title>Paginator SQL Example</title>
    </head>

    <body>
        <?= $paginator; ?>
    </body>
</html>