<?php 

// It may take a whils to crawl a site ... 
set_time_limit(200); 

// Inculde the phpcrawl-mainclass 
include_once("libs/PHPCrawler.class.php");

// Extend the class and override the handleDocumentInfo()-method  
class MyCrawler extends PHPCrawler  
{ 
    public function handleDocumentInfo($DocInfo){
        // Just detect linebreak for output ("\n" in CLI-mode, otherwise "<br>"). 
        if (PHP_SAPI == "cli"){
            $lb = "\n"; 
        }else{
            $lb = "<br />"; 
        }
    //     unset($DocInfo->content);
    //     unset($DocInfo->source);
        
        echo "Source url: <br />";
        print_a($DocInfo->url);
        
        echo "Links found: <br />";
        if(!empty($DocInfo->links_found) && is_array($DocInfo->links_found)){
        	foreach ($DocInfo->links_found as $found_link){
        	    if($this->brielCheckLinkType($found_link['url_rebuild'], '.css|.js')){
        		    echo '<br> link: '.$found_link['url_rebuild'];
        	    }
        	}
        }
//     print_a($DocInfo->links_found);
    
    
        //print_a($DocInfo);
        
        // Print the URL and the HTTP-status-Code 
        echo "Page requested: ".$DocInfo->url." (".$DocInfo->http_status_code.")".$lb; 
         
        // Print the refering URL 
        echo "Referer-page: ".$DocInfo->referer_url.$lb; 
         
        // Print if the content of the document was be recieved or not 
        if ($DocInfo->received == true){
            echo "Content received: ".$DocInfo->bytes_received." bytes".$lb; 
        }else{ 
            echo "Content not received".$lb;
        }  
     
        // Now you should do something with the content of the actual 
        // received page or file ($DocInfo->source), we skip it in this example  
         
        echo $lb; 
         
        flush(); 
  }
    public function brielCheckLinkType($url, $pattern){
        
        $arrTmp = explode('|', $pattern);
        $arrPattern = array();
        foreach ($arrTmp as $pat){
        	if(!empty($pat)){
        		array_push($arrPattern, $pat);
        	}
        }
        foreach ($arrPattern as $file_type){
            if(strripos($url, $file_type) == (strlen($url) - strlen($file_type))){
                return false;	
            }
        }
        
        return true;
    }
} 

function print_a($arr){
	echo '<pre>';
	print_r($arr);
	echo '</pre>';
}

// Now, create a instance of your class, define the behaviour 
// of the crawler (see class-reference for more options and details) 
// and start the crawling-process.  

$crawler = new MyCrawler(); 

// URL to crawl 
$crawler->setURL("www.php.net"); 

// Only receive content of files with content-type "text/html" 
$crawler->addContentTypeReceiveRule("#text/html#"); 

// Ignore links to pictures, dont even request pictures 
$crawler->addURLFilterRule("#(jpg|jpeg|gif|png)$# i"); 
$crawler->addURLFilterRule("#(css|js)$# i");
// Store and send cookie-data like a browser does 
$crawler->enableCookieHandling(true); 

// Set the traffic-limit to 1 MB (in bytes, 
// for testing we dont want to "suck" the whole site) 
//$crawler->setTrafficLimit(1000 * 1024); 
$crawler->setPageLimit(6);
$crawler->setFollowRedirects(true);
$crawler->setFollowRedirectsTillContent(true);
$crawler->setRequestDelay(1);
$crawler->setCrawlingDepthLimit(2);
// Thats enough, now here we go 
$crawler->go(); 

// At the end, after the process is finished, we print a short 
// report (see method getProcessReport() for more information) 
$report = $crawler->getProcessReport(); 

if (PHP_SAPI == "cli") $lb = "\n"; 
else $lb = "<br />"; 
     
echo "Summary:".$lb; 
echo "Links followed: ".$report->links_followed.$lb; 
echo "Documents received: ".$report->files_received.$lb; 
echo "Bytes received: ".$report->bytes_received." bytes".$lb; 
echo "Process runtime: ".$report->process_runtime." sec".$lb;  
?>