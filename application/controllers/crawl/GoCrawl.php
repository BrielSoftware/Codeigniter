<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GoCrawl extends CI_Controller {

    public function index(){
    	//$this->find_links();
    	echo "aa";
    }
    
    public function find_links(){
         
        $this->load->helper('briel_crawler');
        
        // It may take a whils to crawl a site ...
        set_time_limit(200);
        
//         if(empty($_GET['site_id'])){
//         	echo 'No site selected';
//         }else{

            $site_id = $_GET['site_id'];
            
            $query = $this->db->get_where('site', array('id' => $site_id), 1);
            $arrSite = $query->row_array();
            
            $crawler = new BrielCrawler();
            print_a($arrSite);
            
            // URL to crawl
            $crawler->setURL("emag.ro");
            
            // Only receive content of files with content-type "text/html"
            //$crawler->addContentTypeReceiveRule("#text/html#");
            
            // Ignore links to pictures, dont even request pictures
            $crawler->addURLFilterRule("#(jpg|jpeg|gif|png)$# i");
            $crawler->addURLFilterRule("#(css|js)$# i");
            // Store and send cookie-data like a browser does
            $crawler->enableCookieHandling(true);
            
            // Set the traffic-limit to 1 MB (in bytes,
            // for testing we dont want to "suck" the whole site)
            $crawler->setPageLimit(2);
//             $crawler->setFollowMode(3);
            $crawler->setFollowRedirects(true);
            $crawler->setFollowRedirectsTillContent(true);
            $crawler->setRequestDelay(1);
            $crawler->setCrawlingDepthLimit(2);
            
            // Thats enough, now here we go
            $crawler->go();
            
            
        //}
    }
    
    public function crawl_products(){
    	
        
        
    }
}