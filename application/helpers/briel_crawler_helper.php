<?php  

// Inculde the phpcrawl-mainclass 
include_once("crawler/libs/PHPCrawler.class.php");

// Extend the class and override the handleDocumentInfo()-method  
class BrielCrawler extends PHPCrawler{ 
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

?>