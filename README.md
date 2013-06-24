# Paginator 2.x.x

#### A paginator that makes it easy and simple

---
 
Name: [Paginator](http://github.com/mardix/Paginator)

License: MIT

Author: [Mardix](http://github.com/mardix)

Version : 2.x.x

Requirements: PHP >= 5.4

---


### About Paginator

Paginator is a simple class that allows you to create pagination for your application. 
It doesn't require any database connection. It only requires the total of items found 
and from there it will create a pagination that can be export to HTML or Array. 
It is also compatible with Twitter's Bootstrap Framework.


---

### Create a Pagination

Paginator makes it easy to create pagination. It only requires the URL that contains the page number pattern, the total items, and the total of items per page. 

	http://site.com/search?q=flower&page=15

or

	http://site.com/genres/pop/page/15
	
	
Paginator will automatically match the page number with the url above, and create pagination for the rest of the pages based on the total items and items per page provided.

	<?php
	
	include "./src/Voodoo/Paginator.php";
	
	$url = "http://mysite.com";
	$pagePattern = "/page/(:num)";
	$totalItems = 150;
	$totalPerPage = 10;
	
	$paginator = (new Voodoo\Paginator)
	                ->setUrl($url, $pagePattern)
	                ->setItems($totalItems, $totalPerPage);
	?>
 

### Catching the page number
 
Paginator requires the keyword **(:num)** in the page number pattern to match the page number in the URL. 

Page number pattern are set in the following format

For friendly URL, it will capture http://site.com/page/25

	/page/(:num)


For normal URL, it will capture http://site.com/?page=25

	page=(:num)
	

Page number pattern is set in 
	
	Voodoo\Paginator::setUrl($url, $pagePattern);


	
On both examples it will catch the page number [**25**] and create from there the start and the end of the pagination.

Any variation of the pagination is OK, as long as it includes **(:num)** 


---

### Example


	<?php
	
	include "src/Voodoo/Paginator.php";
	
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
	        <?= $paginator; ?>
	    </body>
	</html>

Will  render something like this:

	[First] [<< Prev] [1] [2] [3] [4] [5] [6] [Next >>] [Last]
	
With links that look like: 

	<a href='http://mysite.com/page/6'>6</a>


---
### To get data and render 




### Setters

####Voodoo\Paginator::__construct()
	<?php
	
	include "src/Voodoo/Paginator.php";
	
	$paginator = new Voodoo\Paginator;
	


####Voodoo\Paginator::setUrl()
To set the url and the  page number pattern

	<?php
	
	include "src/Voodoo/Paginator.php";
	
	$url = "http://mysite.com";
	$pagePattern = "/page/(:num)";
	
	$paginator = (new Voodoo\Paginator)
	                ->setUrl($url, $pagePattern);


######Alternative with the URL being set automatically

Paginator will set the URL automatically based on the request URI if setUrl() is not called. All the paginations will be based on the current url. 

In the example below, the __construct() accepts the pagePattern and  create the pagination url from the getUri();

	<?php
	
	include "src/Voodoo/Paginator.php";
	
	$pagePattern = "/page/(:num)";

	$paginator = (new Voodoo\Paginator($pagePattern));
	
	                
####Voodoo\Paginator::setItems()
To set the items, total items per page

	<?php
	
	include "src/Voodoo/Paginator.php";
	
	$url = "http://mysite.com";
	$pagePattern = "/page/(:num)";
	$totalItems = 150;
	$totalPerPage = 10;
	
	$paginator = (new Voodoo\Paginator)
	                ->setUrl($url, $pagePattern)
	                ->setItems($totalItems, $totalPerPage);
	 
####Voodoo\Paginator::setPage()

By default, Paginator will catch the page number from the URL, but if you want to set the current page manually, setPage let you do so

	<?php
	
	include "src/Voodoo/Paginator.php";
	
	$url = "http://mysite.com";
	$pagePattern = "/page/(:num)";
	$totalItems = 150;
	$totalPerPage = 10;
	
	$paginator = (new Voodoo\Paginator)
	                ->setUrl($url, $pagePattern)
	                ->setItems($totalItems, $totalPerPage)
	                ->setPage(4);
	                
	

####Voodoo\Paginator::setPrevNextTitle()

To set the Prev and Next title when the pagination is long.
By default it is set to **Prev** and **Next**

	<?php
	
	include "src/Voodoo/Paginator.php";
	
	$url = "http://mysite.com";
	$pagePattern = "/page/(:num)";
	$totalItems = 150;
	$totalPerPage = 10;
	
	$paginator = (new Voodoo\Paginator)
	                ->setUrl($url, $pagePattern)
	                ->setItems($totalItems, $totalPerPage)
	                ->setPage(4)
	                ->setPrevNextTitle("Prev",	"Next");
	 

####Voodoo\Paginator::setFirstLastTitle()

To set the First and Last title when the pagination is long.
By default it is set to **First** and **Last**

	<?php
	
	include "src/Voodoo/Paginator.php";
	
	$url = "http://mysite.com";
	$pagePattern = "/page/(:num)";
	$totalItems = 150;
	$totalPerPage = 10;
	
	$paginator = (new Voodoo\Paginator)
	                ->setUrl($url, $pagePattern)
	                ->setItems($totalItems, $totalPerPage)
	                ->setPage(4)
	                ->setPrevNextTitle("Prev",	"Next")
	                ->setFirstLastTitle("First", "Last");
	                
	                
####Array Voodoo\Paginator::toArray()

Will return the pagination data as an array with the following params:

	<?php
	
	include "src/Voodoo/Paginator.php";
	
	$url = "http://mysite.com";
	$pagePattern = "/page/(:num)";
	$totalItems = 150;
	$totalPerPage = 10;
	
	$paginator = (new Voodoo\Paginator)
	                ->setUrl($url, $pagePattern)
	                ->setItems($totalItems, $totalPerPage)
	                ->setPage(4)
	                ->setPrevNextTitle("Prev",	"Next")
	                ->setFirstLastTitle("First", "Last");
	                
	 $pagination = $paginator->toArray();

	

####String Voodoo\Paginator::toHtml()

Will return a formatted HTML, compatible with Bootstrap framework

	<?php
	
	include "src/Voodoo/Paginator.php";
	
	$url = "http://mysite.com";
	$pagePattern = "/page/(:num)";
	$totalItems = 150;
	$totalPerPage = 10;
	
	$paginator = (new Voodoo\Paginator)
	                ->setUrl($url, $pagePattern)
	                ->setItems($totalItems, $totalPerPage)
	                ->setPage(4)
	                ->setPrevNextTitle("Prev",	"Next")
	                ->setFirstLastTitle("First", "Last");
	                
	 $cssClassName = "pagination";
	 
	 echo $paginator->toHtml($cssClassName);


####String Voodoo\Paginator::__toString()

Same as toHtml(), except it's when someone is echoing the paginator object

	<?php
	
	include "src/Voodoo/Paginator.php";
	
	$url = "http://mysite.com";
	$pagePattern = "/page/(:num)";
	$totalItems = 150;
	$totalPerPage = 10;
	
	$paginator = (new Voodoo\Paginator)
	                ->setUrl($url, $pagePattern)
	                ->setItems($totalItems, $totalPerPage)
	                ->setPage(4)
	                ->setPrevNextTitle("Prev",	"Next")
	                ->setFirstLastTitle("First", "Last");
	                
	 echo $paginator;
	 
	 
### Getters

Using the settings above

####Voodoo\Paginator::getUri()

Return the URI of the request (the url in the address bar).
It can be used to automatically set the url based on the request uri.

In the example below, the __construct() accepts the pagePattern and  create the pagination url from the getUri();

	<?php
	
	include "src/Voodoo/Paginator.php";
	
	$pagePattern = "/page/(:num)";
	$totalItems = 150;
	$totalPerPage = 10;
	
	$paginator = (new Voodoo\Paginator);
	
	$uri = $paginator->getUri();


####Voodoo\Paginator::getPage()

Get the current page number

	<?php
	
	include "src/Voodoo/Paginator.php";
	
	$url = "http://mysite.com";
	$pagePattern = "/page/(:num)";
	$totalItems = 150;
	$totalPerPage = 10;
	
	$paginator = (new Voodoo\Paginator)
	                ->setUrl($url, $pagePattern)
	                ->setItems($totalItems, $totalPerPage)
	                ->setPage(4)
	                ->setPrevNextTitle("Prev",	"Next")
	                ->setFirstLastTitle("First", "Last");
	                
	 echo $paginator->getPage(); // -> 4

####Voodoo\Paginator::count()

Get the total pages 

	<?php
	
	include "src/Voodoo/Paginator.php";
	
	$url = "http://mysite.com";
	$pagePattern = "/page/(:num)";
	$totalItems = 150;
	$totalPerPage = 10;
	
	$paginator = (new Voodoo\Paginator)
	                ->setUrl($url, $pagePattern)
	                ->setItems($totalItems, $totalPerPage)
	                ->setPage(4)
	                ->setPrevNextTitle("Prev",	"Next")
	                ->setFirstLastTitle("First", "Last");
	                
	 echo $paginator->count(); // 15

####Voodoo\Paginator::getPerPage()

Get total items per page

	<?php
	
	include "src/Voodoo/Paginator.php";
	
	$url = "http://mysite.com";
	$pagePattern = "/page/(:num)";
	$totalItems = 150;
	$totalPerPage = 10;
	
	$paginator = (new Voodoo\Paginator)
	                ->setUrl($url, $pagePattern)
	                ->setItems($totalItems, $totalPerPage)
	                ->setPage(4)
	                ->setPrevNextTitle("Prev",	"Next")
	                ->setFirstLastTitle("First", "Last");
	                
	 echo $paginator->perPage(); // 10

####Voodoo\Paginator::getStart()

Get the start of the count for the pagination set

	<?php
	
	include "src/Voodoo/Paginator.php";
	
	$url = "http://mysite.com";
	$pagePattern = "/page/(:num)";
	$totalItems = 150;
	$totalPerPage = 10;
	
	$paginator = (new Voodoo\Paginator)
	                ->setUrl($url, $pagePattern)
	                ->setItems($totalItems, $totalPerPage)
	                ->setPage(4)
	                ->setPrevNextTitle("Prev",	"Next")
	                ->setFirstLastTitle("First", "Last");
	                
	 echo $paginator->getStart(); // 30

####Voodoo\Paginator::getEnd()

Get the end of the count for the pagination set

	<?php
	
	include "src/Voodoo/Paginator.php";
	
	$url = "http://mysite.com";
	$pagePattern = "/page/(:num)";
	$totalItems = 150;
	$totalPerPage = 10;
	
	$paginator = (new Voodoo\Paginator)
	                ->setUrl($url, $pagePattern)
	                ->setItems($totalItems, $totalPerPage)
	                ->setPage(4)
	                ->setPrevNextTitle("Prev",	"Next")
	                ->setFirstLastTitle("First", "Last");
	                
	 echo $paginator->getEnd(); // 39

####Voodoo\Paginator::getPageUrl()

Return the page url based on the url provided 

	<?php
	
	include "src/Voodoo/Paginator.php";
	
	$url = "http://mysite.com";
	$pagePattern = "/page/(:num)";
	$totalItems = 150;
	$totalPerPage = 10;
	
	$paginator = (new Voodoo\Paginator)
	                ->setUrl($url, $pagePattern)
	                ->setItems($totalItems, $totalPerPage)
	                ->setPage(4)
	                ->setPrevNextTitle("Prev",	"Next")
	                ->setFirstLastTitle("First", "Last");
	                
	 echo $paginator->getPageUrl(); // http://mysite.com/page/4
	 
Also it can be used to get the url of any other pages

	$page6 = $paginator->getPageUrl(6); // http://mysite.com/page/6
	

####Voodoo\Paginator::getNextPageUrl()

Return the next page url

	<?php
	
	include "src/Voodoo/Paginator.php";
	
	$url = "http://mysite.com";
	$pagePattern = "/page/(:num)";
	$totalItems = 150;
	$totalPerPage = 10;
	
	$paginator = (new Voodoo\Paginator)
	                ->setUrl($url, $pagePattern)
	                ->setItems($totalItems, $totalPerPage)
	                ->setPage(4)
	                ->setPrevNextTitle("Prev",	"Next")
	                ->setFirstLastTitle("First", "Last");
	                
	 echo $paginator->getPageUrl(); // http://mysite.com/page/5

####Voodoo\Paginator::getPrevUrl()

Return the previous page url

	<?php
	
	include "src/Voodoo/Paginator.php";
	
	$url = "http://mysite.com";
	$pagePattern = "/page/(:num)";
	$totalItems = 150;
	$totalPerPage = 10;
	
	$paginator = (new Voodoo\Paginator)
	                ->setUrl($url, $pagePattern)
	                ->setItems($totalItems, $totalPerPage)
	                ->setPage(4)
	                ->setPrevNextTitle("Prev",	"Next")
	                ->setFirstLastTitle("First", "Last");
	                
	 echo $paginator->getPageUrl(); // http://mysite.com/page/3

---

## Using with SQL

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



Please refer to the example directory for examples



 [@mardix](http://twitter.com/mardix)


