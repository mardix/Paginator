# Paginator 2.x.x

#### A paginator that makes it easy and simple

---
 
Name: [Paginator](http://github.com/mardix/Paginator)

License: MIT

Author: [Mardix](http://github.com/mardix)

Version : 2.x.x

Requirements: PHP >= 5.4

---


## About Paginator

Paginator is a simple class that allows you to create pagination for your application. 
It doesn't require any database connection. It only requires the total of items found 
and from there it will create a pagination that can be export to HTML or Array. 
It is also compatible with Twitter's Bootstrap Framework.

---

## Install Paginator

You can just download Paginator as is, or with Composer. 

To install with composer, add the following in the require key in your **composer.json** file

	"voodoophp/paginator": "2.*"

composer.json

	{
	    "name": "voodoophp/myapp",
	    "description": "My awesome Voodoo App",
	    "require": {
	        "voodoophp/paginator": "2.*"
	    }
	}


---

### Create a Pagination

Paginator makes it easy to create pagination. It only requires the URL that contains the page number pattern, the total items, and the total of items per page. 

	http://site.com/search?q=flower&page=15

or

	http://site.com/genres/pop/page/15
	
	
Paginator will automatically match the page number with the url above, and create pagination for the rest of the pages based on the total items and items per page provided.


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

Any variation of the page number pattern is OK, as long as it includes **(:num)** 



### A Simple Example


	<?php
	
	include "src/Voodoo/Paginator.php";

	// Pretending the the request url is: 
	// http://mysite.com.com/hip-hop/page/5
	
	// to catch the page number pattern in the request url
	$pagePattern = "/page/(:num)"; 

	// Some pre-calculated number
	$totalItems = 150; 

	// Total items to show per page
	$totalPerPage = 10; 
	
	$paginator = (new Voodoo\Paginator($pagePattern))
	                ->setItems($totalItems, $totalPerPage);
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

Will  render something like this:

	[First] [<< Prev] [1] [2] [3] [4] [5] [6] [Next >>] [Last]
	
With links that look like: 

	<a href='http://mysite.com/hip-hop/page/6'>6</a>


---
### Methods 

---



####Voodoo\Paginator::__construct()
	<?php
	
	include "src/Voodoo/Paginator.php";
	
	$paginator = new Voodoo\Paginator;
	

---
####Voodoo\Paginator::setUrl()
To set the url and the  page number pattern

	<?php
	
	include "src/Voodoo/Paginator.php";
	
	$url = "http://mysite.com";
	$pagePattern = "/page/(:num)";
	
	$paginator = (new Voodoo\Paginator)
	                ->setUrl($url, $pagePattern);


##### Alternative with the URL being set automatically

Paginator will set the URL automatically based on the request URI if setUrl() is not called. All the paginations will be based on the current url. 

In the example below, the __construct() accepts the pagePattern and  create the pagination url from the getUri();

	<?php
	
	include "src/Voodoo/Paginator.php";
	
	$pagePattern = "/page/(:num)";

	$paginator = (new Voodoo\Paginator($pagePattern));
	
---
	                
####Voodoo\Paginator::setItems()
To set the items, total items per page, and the pagination navigation size

	<?php
	
	include "src/Voodoo/Paginator.php";
	
	$url = "http://mysite.com";
	$pagePattern = "/page/(:num)";
	$totalItems = 150;
	$totalPerPage = 10;
	
	$paginator = (new Voodoo\Paginator)
	                ->setUrl($url, $pagePattern)
	                ->setItems($totalItems, $totalPerPage);
	 
---

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
	                
---	

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
	 
---

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
	                
---
	                
####Array Voodoo\Paginator::toArray()

Will return the pagination data as an array which be used to create the pagination.

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


toArray() will return an array similar to this:


	[
		[
			"page_number" => 1,
			"label" => "First",
			"url" => "http://mysite.com/pop/page/1",
			"is_current" => false,
			"is_first" => true,                
		],
		[
			"page_number" => 1,
			"label" => "Prev",
			"url" => "http://mysite.com/pop/page/1",
			"is_current" => false,
			"is_prev" => true,                   
		],	
		[
			"page_number" => 1,
			"label" => 1,
			"url" => "http://mysite.com/pop/page/1",
			"is_current" => true                   
		],
		[
			"page_number" => 2,
			"label" => 2,
			"url" => "http://mysite.com/pop/page/2",
			"is_current" => false                   
		],
		...
		[
			"page_number" => "10",
			"label" => "Next",
			"url" => "http://mysite.com/pop/page/10",
			"is_current" => false,
			"is_next" => true,                     
		],	
		[
			"page_number" => 15,
			"label" => "Last",
			"url" => "http://mysite.com/pop/page/15",
			"is_current" => false,
			"is_last" => true,                  
		]	
	]
	
### Manually create the pagination with toArray()

	<ul>
		<?php foreach($paginator->toArray() as $page) : ?>
			<li class='<?= ($page["is_current"]) ? "active" : ""; ?>'>
				<a href='<?= $page["url"]; ?>'><?= $page["label"]; ?></a>
			</li>
		<?php endforeach; ?>
	</ul>

---

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


---	
### Getters

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

---

####Voodoo\Paginator::getPage()

Get the current page number

	<?php
	
	include "src/Voodoo/Paginator.php";
	
	$url = "http://mysite.com/pop/page/4";
	$pagePattern = "/page/(:num)";
	$totalItems = 150;
	$totalPerPage = 10;
	
	$paginator = (new Voodoo\Paginator)
	                ->setUrl($url, $pagePattern)
	                ->setItems($totalItems, $totalPerPage)
	                ->setPrevNextTitle("Prev",	"Next")
	                ->setFirstLastTitle("First", "Last");
	                
	 echo $paginator->getPage(); // -> 4

---

####Voodoo\Paginator::count()

Get the total pages 

	<?php
	
	include "src/Voodoo/Paginator.php";
	
	$url = "http://mysite.com/pop/page/4";
	$pagePattern = "/page/(:num)";
	$totalItems = 150;
	$totalPerPage = 10;
	
	$paginator = (new Voodoo\Paginator)
	                ->setUrl($url, $pagePattern)
	                ->setItems($totalItems, $totalPerPage)
	                ->setPrevNextTitle("Prev",	"Next")
	                ->setFirstLastTitle("First", "Last");
	                
	 echo $paginator->count(); // 15

---

####Voodoo\Paginator::getPerPage()

Get total items per page

	<?php
	
	include "src/Voodoo/Paginator.php";
	
	$url = "http://mysite.com/pop/page/4";
	$pagePattern = "/page/(:num)";
	$totalItems = 150;
	$totalPerPage = 10;
	
	$paginator = (new Voodoo\Paginator)
	                ->setUrl($url, $pagePattern)
	                ->setItems($totalItems, $totalPerPage)
	                ->setPrevNextTitle("Prev",	"Next")
	                ->setFirstLastTitle("First", "Last");
	                
	 echo $paginator->getPerPage(); // 10

---

####Voodoo\Paginator::getStart()

Get the start of the count for the pagination set

	<?php
	
	include "src/Voodoo/Paginator.php";
	
	$url = "http://mysite.com/pop/page/4";
	$pagePattern = "/page/(:num)";
	$totalItems = 150;
	$totalPerPage = 10;
	
	$paginator = (new Voodoo\Paginator)
	                ->setUrl($url, $pagePattern)
	                ->setItems($totalItems, $totalPerPage)
	                ->setPrevNextTitle("Prev",	"Next")
	                ->setFirstLastTitle("First", "Last");
	                
	 echo $paginator->getStart(); // 30

---

####Voodoo\Paginator::getEnd()

Get the end of the count for the pagination set

	<?php
	
	include "src/Voodoo/Paginator.php";
	
	$url = "http://mysite.com/pop/page/4";
	$pagePattern = "/page/(:num)";
	$totalItems = 150;
	$totalPerPage = 10;
	
	$paginator = (new Voodoo\Paginator)
	                ->setUrl($url, $pagePattern)
	                ->setItems($totalItems, $totalPerPage)
	                ->setPrevNextTitle("Prev",	"Next")
	                ->setFirstLastTitle("First", "Last");
	                
	 echo $paginator->getEnd(); // 39

---

####Voodoo\Paginator::getPageUrl()

Return the page url based on the url provided 

	<?php
	
	include "src/Voodoo/Paginator.php";
	
	$url = "http://mysite.com/pop/page/4";
	$pagePattern = "/page/(:num)";
	$totalItems = 150;
	$totalPerPage = 10;
	
	$paginator = (new Voodoo\Paginator)
	                ->setUrl($url, $pagePattern)
	                ->setItems($totalItems, $totalPerPage)
	                ->setPrevNextTitle("Prev",	"Next")
	                ->setFirstLastTitle("First", "Last");
	                
	 echo $paginator->getPageUrl(); // http://mysite.com/pop/page/4
	 
Also it can be used to get the url of any other pages

	$page6 = $paginator->getPageUrl(6); // http://mysite.com/pop/page/6
	
---

####Voodoo\Paginator::getNextPageUrl()

Return the next page url

	<?php
	
	include "src/Voodoo/Paginator.php";
	
	$url = "http://mysite.com/pop/page/4";
	$pagePattern = "/page/(:num)";
	$totalItems = 150;
	$totalPerPage = 10;
	
	$paginator = (new Voodoo\Paginator)
	                ->setUrl($url, $pagePattern)
	                ->setItems($totalItems, $totalPerPage)
	                ->setPrevNextTitle("Prev",	"Next")
	                ->setFirstLastTitle("First", "Last");
	                
	 echo $paginator->getNextPageUrl(); // http://mysite.com/pop/page/5

---

####Voodoo\Paginator::getPrevPageUrl()

Return the previous page url

	<?php
	
	include "src/Voodoo/Paginator.php";
	
	$url = "http://mysite.com/pop/page/4";
	$pagePattern = "/page/(:num)";
	$totalItems = 150;
	$totalPerPage = 10;
	
	$paginator = (new Voodoo\Paginator)
	                ->setUrl($url, $pagePattern)
	                ->setItems($totalItems, $totalPerPage)
	                ->setPrevNextTitle("Prev",	"Next")
	                ->setFirstLastTitle("First", "Last");
	                
	 echo $paginator->getPrevPageUrl(); // http://mysite.com/pop/page/3

---

### Using Paginator with SQL Query

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



Please refer to the example directory for examples

---

(c) This Year Mardix :)


