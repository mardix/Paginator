#Paginator

---

### What is Paginator?

Paginator is a PHP class that allows you create pagination for your web application. 

It doesn't require any database and can be used with your current application, as long as you pass the basic arguments.


#### And who created it?
Me. Mardix. You can follow me  [@mardix](http://twitter.com/mardix), or check out my github: [mardix.github.com](http://mardix.github.com/) to check out some of my other code that you may want to fork.

So Holla!

---

## Example

`
< ? php

include("./Paginator.php");


 $queryUrl = "http://www.givemebeats.net/buy-beats/Hip-Hop-Rap/page/4/";
 
 $pagePattern = "/page/(:num)";
 
 $Paginator = new Paginator($queryUrl,$pagePattern);
 
 $Paginator->setTotalItems(225) 

           ->setItemsPerPage(10)

           ->setNavigationSize(10);

 
 
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

print($Pagination);

`
[1] [2] [3] [4] [5]  [Next]
---


Please refer to the example directory for examples



 [@mardix](http://twitter.com/mardix)













