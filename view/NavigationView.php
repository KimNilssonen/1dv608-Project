<?php

require_once("model/SearchModel.php");

class NavigationView {
    
    public function checkPage() {
        
        $uri = parse_url($_SERVER['REQUEST_URI']);
    
        if(count($uri) > 1) {
            return $uri['query'];
        }
        
        else {
            return $uri['path'];
        }
    }
}