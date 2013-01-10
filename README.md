#Paginator

---

### What is Paginator?

Paginator is a simple class that allows you to create pagination for your application.

It doesn't require any database connection. It is compatible with Twitter's Bootstrap Framework, by using the CSS class pagination.

So it can be implemented quickly in your existing settings.




#### And who created it?
Me. Mardix. You can follow me  [@mardix](http://twitter.com/mardix), or check out my github: [github.com/mardix](https://github.com/mardix) to check out some of my other library that you may want to fork.

So Holla!


---

### How it works?

It reads the $queryUrl ( http://xyz.x/page/253 ) that was provided and based on the regexp pattern (ie: /page/(:num)) it extract the page number and build the pagination for all the page numbers.



### About the regexp pattern: **(:num)**


***(:num)*** is our regex pattern to capture the page number and pass it to generate the pagination. It is require to catch the page number properly
 
**/page/(:num)** : will capture page in this pattern http://xyz.com/page/252
 
**page=(:num)** : will capture the pattern http://xyz.com/?page=252

Any other regexp pattern will work also

---
### Public Methods


**render**($totalItems)                  : Return the pagination in HTML format

**toArray**($totalItems)                 : Return the pagination in array. Use it if you want to use your own template to generate the pagination in HTML
  

#### Setters

**setQueryUrl**($queryUrl,$pagePattern)  : To set the url that will be used to create the pagination. $pagePattern is a regex to catch the page number in the queryUrl
  
**setTotalItems**($totalItems)         : Set the total items. It is required so it create the proper page count etc
  
**setItemsPerPage**($ipp)                : Total items to display in your results page. This count will allow it to properly count pages
  
**setNavigationSize**($nav)              : Crete the size of the pagination like [1][2][3][4][next]
  
**setPrevNextTitle**(Prev,Next)         : To set the action next and previous


#### Getters

***getCurrentPage()***                  : Return the current page number

***getTotalPages()***                   : Return the total pages

***getStartCount()***                   : Return the start count. 

***getEndCount()***                      : Return the end count 

***getSQLOffest()***                     : When using SQL query, you can use this method to give you the limit count like: 119,10 which will be used in "LIMIT 119,10"

***getItemsPerPage()***                  : Return the total items per page


---

## Example

```php
<?php
include(dirname(__DIR__)."/src/Voodoo/Paginator.php");

$queryUrl = "http://www.givemebeats.net/buy-beats/Hip-Hop-Rap/page/4/";
$pagePattern = "/page/(:num)";
$Paginator = new Voodoo\Paginator($queryUrl,$pagePattern);
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



