<?php

include("./Paginator.php");


 $queryUrl = "http://www.givemebeats.net/buy-beats/Hip-Hop-Rap/page/12/";
 
 $pagePattern = "/page/(:num)";
 
 $Paginator = new Paginator($queryUrl,$pagePattern);
 
 /**
 
 $pagePattern = "page=(:num)";
 
 $Paginator = Paginator::CreateWithUri($pagePattern);
   
  */
 
 $Paginator->setTotalItems(225) // Total items found. This can be calculated previously
           ->setItemsPerPage(10) // Total items to display per page
           ->setNavigationSize(10); // The pagination navigation size.
 
 
 /**
  * Use the getSQLOffset() to create a SQL offset limit 
  */
 $SQLOffset = $Paginator->getSQLOffset();
 $SQL = "
     SELECT 
            *
     FROM
            my_table
     WHERE
            X=Y
     LIMIT
           {$SQLOffset}
";
         
$Pagination = $Paginator->render();

?>

<html>
    <head>
        <link rel="stylesheet" href="./paginator.css">
        <title>Mardix's Paginator Example</title>
    </head>
    
    <body>
        <h2>Paginator Example</h2>
        <?php
           print $Pagination;
        ?>
        
    </body>
</html>