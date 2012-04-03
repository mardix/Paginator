<?php
/**
 * -----------------------------------------------------------------------------
 * Paginator
 * -----------------------------------------------------------------------------
 * @author      Mardix
 * @github      http://github.com/mardix/Paginator
 * @package     Soup Framework
 * 
 * @copyright   (c) 2012 Mardix -> http://github.com/mardix :)
 * @license     MIT
 * -----------------------------------------------------------------------------
 * 
 * @name        Paginator
 * @since       Apr 3, 2012
 * @desc        A simple pagination class.
 * @version     1.0
 * 
 * 
 * ABOUT
 * -----
 * Paginator is a simple class that allows you to create pagination for your application.
 * When rendered it will display the pagination properly and uses the CSS class .pagination which is based on Twitter's Bootstrap framework.
 * So it can be implemented quickly in your existing settings.
 * 
 * 
 * How it works
 * -----------
 * It read the $queryUrl that was provided and based on the $pagePattern it extract the page number 
 * and build the pagination for all the page number.
 * 
 * About $pagePattern (:num)
 * -----------
 * (:num) is our regex pattern to capture the page number and pass it to generate the pagination.
 * It is require to catch the page number properly
 * 
 *  /page/(:num) , will capture page in this pattern http://xyz.com/page/252
 *  
 *  page=(:num) , will capture the pattern http://xyz.com/?page=252
 *  
 *  Any other regexp pattern will work also
 * 
 * Example
 * With friendly url:
 * ------------------
 *      $siteUrl = "http://www.givemebeats.net/buy-beats/Hip-Hop-Rap/page/4/";
 *      $pagePattern = "/page/(:num)";
 *      $totalItems = 225;
 *      $Paginator = new Paginator($siteUrl,$pagePattern);
 *      $Pagination = $Paginator($totalItems);
 *      print($Pagination);
 * 
 * 
 * With non friendly url:
 * ------------------
 *      $siteUrl = "http://www.givemebeats.net/buy-beats/?genre=Hip-Hop-Rap&page=4";
 *      $pagePattern = "page=(:num)";
 *      $totalItems = 225;
 *      $Paginator = new Paginator($siteUrl,$pagePattern);
 *      $Pagination = $Paginator($totalItems);
 *      print($Pagination);
 * 
 * 
 * Quick way:
 * ---------
 *      Paginator::CreateWithUri($pagePattern,$totalItems);
 * 
 *
 */


class Paginator {
   
    /**
     * Holds params 
     * @var array 
     */
    protected $params  = array();
    
    /**
     * Holds the template url
     * @var string 
     */
    protected $templateUrl = "";


    /**
     * Create the Paginator with the REQUEST_URI. It's a shortcut to quickly build it with the request URI
     * @param regex $pagePattern - a regex pattern that will match the url and extract the page number
     * @param int $totalItems - Total items found 
     * @param int $itemPerPage - Total items per page
     * @param int $navigationSize - The naviagation set size
     * @return Paginator
     */
    public static function CreateWithUri($pagePattern="/page/(:num)",$totalItems = 0,$itemPerPage = 10,$navigationSize = 10){
        return
            new self($_SERVER["REQUEST_URI"],$pagePattern,$totalItems,$itemPerPage,$navigationSize);
    }
    
    
    
    /**
     * Constructor
     * @param string $queryUrl - The url of the pagination
     * @param regex $pagePattern - a regex pattern that will match the url and extract the page number
     * @param int $totalItems - Total items found 
     * @param int $itemPerPage - Total items per page
     * @param int $navigationSize - The naviagation set size
     */
    public function __construct($queryUrl="",$pagePattern="/page/(:num)",$totalItems = 0,$itemPerPage = 10,$navigationSize = 10){
        
        if($queryUrl)
            $this->setQueryUrl($queryUrl,$pagePattern);
        
        $this->setTotalItems($totalItems);
        
        $this->setItemsPerPage($itemPerPage);
        
        $this->setNavigationSize($navigationSize);
        
        $this->setPrevNextTitle();
        
    }

    /**
     * Set the URL, automatically it will parse every thing to it
     * @param type $url
     * @return Paginator 
     */
    public function setQueryUrl($url,$pagePattern="/page/(:num)"){

        $pattern = str_replace("(:num)","([0-9]+)",$pagePattern);
       
        preg_match("~$pattern~i",$url,$m);
        
        $match = current($m);
        $last = end($m);
        $page = $last ? $last : 1;
        
        /**
         * TemplateUrl will be used to create all the page numbers 
         */
        $this->templateUrl = str_replace($match,preg_replace("/[0-9]+/","(#pageNumber)",$match),$url);
        
        $this->setCurrentPage($page);
        
        return
            $this;
    }
    
    
     /**
     * To set the previous and next title
     * @param type $prev : Prev | &laquo; | &larr;
     * @param type $next : Next | &raquo; | &rarr;
     * @return Paginator 
     */
    public function setPrevNextTitle($prev = "Prev",$next = "Next"){
        $this->params["prevTitle"] = $prev;
        $this->params["nextTitle"] = $next;
        
        return
            $this;
    }
    
    /**
     * Set the total items. It will be used to determined the size of the pagination set
     * @param int $items
     * @return Paginator 
     */
    public function setTotalItems($items = 0){
        $this->params["totalItems"] = $items;
        return
            $this;
    }
    
    /**
     * Get the total items 
     * @return int
     */
    public function getTotalItems(){
        return
            $this->params["totalItems"];
    }
    
    /**
     * Set the items per page
     * @param type $ipp
     * @return Paginator 
     */
    public function setItemsPerPage($ipp = 10){
        $this->params["itemsPerPage"] = $ipp;
        return
            $this;
    }
    
    /**
     * Retrieve the items per page
     * @return int
     */
    public function getItemsPerPage(){
        return
            $this->params["itemsPerPage"];
    }

    /**
     * Set the current page
     * @param int $page
     * @return Paginator 
     */
    public function setCurrentPage($page = 1){
        $this->params["currentPage"] = $page;
        return
            $this;
    }
    
    /**
     * Get the current page
     * @return type 
     */
    public function getCurrentPage(){
        return
            $this->params["currentPage"];
    }
    
    /**
     * Get the pagination start count
     * @return int 
     */
    public function getStartCount(){
      return
           (int) ($this->getItemsPerPage() * ($this->getCurrentPage() - 1));
    }
    
    /**
     * Get the pagination end count
     * @return int 
     */
    public function getEndCount(){
        return
            (int) ((($this->getItemsPerPage() - 1) * $this->getCurrentPage()) + $this->getCurrentPage() );           
    }
    
    /**
     * Return the offset for sql queries, specially
     * @return START,LIMIT 
     * 
     * @tip: SQL tip. It's best to do two queries one with SELECT COUNT(*) FROM tableName WHERE X
     *       set the setTotalItems()
     */
    public function getSQLOffset(){
       return
            $this->getStartCount().",".$this->getItemsPerPage();
    }

    /**
     * Get the total pages
     * @return int 
     */
    public function getTotalPages(){
         return
            @ceil($this->getTotalItems()/$this->getItemsPerPage());
    }
    
    /**
     * Set the navigation size
     * @param int $set
     * @return Paginator 
     */
    public function setNavigationSize($set = 10){
        
        $this->params["navSize"] = $set;
        
        return
            $this;
    }
    
    /**
     * Get the navigation size
     * @return int 
     */
    public function getNavigationSize(){
        return
            $this->params["navSize"];
    }
/*******************************************************************************/
// RENDER
    /**
     * Render the paginator
     * @param int $totalItems - The total Items
     * @param string $paginationClsName - The class name of the pagination
     * @param string $wrapTag
     * @param string $listTag
     * @return string
     */
    public function render($totalItems = 0,$paginationClsName="pagination",$wrapTag = "ul",$listTag = "li"){
        
        $this->listTag = $listTag;
        
        $this->wrapTag = $wrapTag;
        
        $Pages = "";
        
        if($totalItems)
            $this->setTotalItems($totalItems);
        
        $totalPages = $this->getTotalPages();
        $navSize = $this->getNavigationSize();
        $currentPage = $this->getCurrentPage();
        
        if($totalPages){
            
            $halfSet = @ceil($navSize/2);
            $start = 1;
            $end = ($totalPages<$navSize) ? $totalPages : $navSize;
            
            if($currentPage >= $navSize){
               $start = $currentPage - $navSize + $halfSet +1;
               $end = $currentPage + $halfSet -1;
            }
            
            if($end > $totalPages){
                $start = $totalPages - $navSize;
                $end = $totalPages;
            }
            
            $next = $end;
            $prev = $start -1;
            

            $NextButton = ($next < $totalPages) 
                                        ? $this->wrapList($this->makeLink($next+1,$this->nextTitle)) 
                                        : (
                                           ($next >= $totalPages) ? "" : $this->wrapList($this->nextTitle,false,true)
                                          );

            $PrevButton = ($prev > 0) 
                                ? $this->wrapList($this->makeLink($prev,$this->prevTitle)) 
                                : (
                                   ($currentPage <= $navSize) ? "" : $this->wrapList($this->prevTitle,false,true)
                                  );
            
            for($i=$start; $i<$end+1; $i++)
                $Pages .= ($i == $currentPage) ? $this->wrapList($i,true,false): $this->wrapList($this->makeLink($i,$i));         
            
            
            return 
                "<div class=\"{$paginationClsName}\">
                    <{$this->wrapTag}>$PrevButton $Pages $NextButton</{$this->wrapTag}>
                 </div>";
        }

    }     
    
/*******************************************************************************/

    /**
     * Parse a page number in the template url
     * @param int $pageNumber
     * @return string 
     */
    protected function parseTplUrl($pageNumber){
        return
            str_replace("(#pageNumber)",$pageNumber,$this->templateUrl);
    }
    
    /**
     * To create an <a> link
     * @param int $pageNumber
     * @param string $txt
     * @return string 
     */
    protected function makeLink($pageNumber,$txt){
        return
            "<a href=\"".$this->parseTplUrl($pageNumber)."\">{$txt}</a>";
    }

    /**
     * Create a wrap list, <li></li>
     * @param string $html
     * @param bool $isActive - To set the active class in this element
     * @param bool $isDisabled - To set the disabled class in this element
     * @return string 
     */
    protected function wrapList($html,$isActive = false, $isDisabled = false){
        $activeCls = $isActive ? " active " : "";
        $disableCls = $isDisabled ? " disabled " : "";
        
        if($isActive)
            $html = "<a>{$html}</a>";
            
        return
            "<{$this->listTag} class=\"$activeCls $disableCls\">$html</{$this->listTag}>\n";
    }
    
    
/*******************************************************************************/

    /** MAGIC METHODS TAAADDAAAAA!!!! **/
    public function __set($key,$value){
        $this->params[$key] = $value;
    }
    
    public function __get($key){
        return
            $this->params[$key];
    }
    
    public function __toString() {
        return
            $this->render($this->getTotalItems());
    }    
    
    
}

