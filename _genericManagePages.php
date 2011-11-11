
<?php
    include(getenv('DOCUMENT_ROOT'). "/_generic/includeOnce.inc.php");

    global $DEBUGMODE;
    
    if($DEBUGMODE) $BenchMark = new BenchMark(); 
    $page = new cPage();
    
    if(isset($where)) 
    {
        $page->createPage($where);
    }
    else
    {
        $page->createPage("Add an InputBox");        
    }
   
    if($DEBUGMODE) $BenchMark->clock();
    
?>
    
