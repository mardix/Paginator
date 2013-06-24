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

### How it works?

Paginator requires the total of items in the results, then it reads the URL (i.e: http://xyz.x/page/253 )  provided and based on the regexp pattern (ie: /page/(:num)) it extracts the page number and build the pagination for all the page numbers. Just like that.


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
	        <?= $paginator; ?>
	    </body>
	</html>

Will  render something like this:

	[First] [<< Prev] [1] [2] [3] [4] [5] [6] [Next >>] [Last]

---

## About the regexp pattern: **(:num)**


***(:num)*** is our regex pattern to capture the page number and pass it to generate the pagination. It is require to catch the page number properly
 
**/page/(:num)** : will capture page in this pattern http://xyz.com/page/252
 
**page=(:num)** : will capture the pattern http://xyz.com/?page=252

Any other regexp pattern will work also, as long it contains **(:num)**

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



