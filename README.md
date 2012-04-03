#Paginator

---

### What is Paginator?

Paginator is a simple class that allows you to create pagination for your application.

It doesn't require any database connection. It is compatible with Twitter's Bootstrap Framework, by using the CSS class pagination.

So it can be implemented quickly in your existing settings.




#### And who created it?
Me. Mardix. You can follow me  [@mardix](http://twitter.com/mardix), or check out my github: [mardix.github.com](http://mardix.github.com/) to check out some of my other code that you may want to fork.

So Holla!




### How it works?

It reads the $queryUrl ( http://xyz.x/page/253 ) that was provided and based on the regexp pattern (ie: /page/(:num)) it extract the page number and build the pagination for all the page numbers.




### About the regexp pattern: **** (:num)****


*** (:num)*** is our regex pattern to capture the page number and pass it to generate the pagination. It is require to catch the page number properly
 
**/page/(:num)** : will capture page in this pattern http://xyz.com/page/252
 
**page=(:num)** : will capture the pattern http://xyz.com/?page=252

Any other regexp pattern will work also

---

## Example

```php
<?php
include("./Paginator.php");

$queryUrl = "http://www.givemebeats.net/buy-beats/Hip-Hop-Rap/page/4/";
$pagePattern = "/page/(:num)";
$Paginator = new Paginator($queryUrl,$pagePattern);
$Paginator
    ->setTotalItems(225) 
    ->setItemsPerPage(10)
    ->setNavigationSize(10);

//Use the getSQLOffset() to create a SQL offset limit 
$SQLOffset = $Paginator->getSQLOffset();
$SQL = "SELECT * FROM my_table WHERE X=Y LIMIT {$SQLOffset}";
         
$Pagination = $Paginator->render();

print($Pagination);

```

[1] [2] [3] [4] [5]  [Next]
---


Please refer to the example directory for examples



 [@mardix](http://twitter.com/mardix)



