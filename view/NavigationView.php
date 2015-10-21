<?php

require_once("model/SearchModel.php");

class NavigationView {
    
    public function __construct (SearchView $searchView, SearchModel $searchModel) {
        $this->searchView = $searchView;
        $this->searchModel = $searchModel;
    }
    
    public function checkPage() {
        
        $url = parse_url($_SERVER['REQUEST_URI']);
    
        if(count($url) > 1) {
            
            return $url['query'];
        }
        else {
            return $url['path'];
            echo "Tjena";
        }
        
        // try {
            
            // $songList = $this->searchModel->getSongNames();
            
            // foreach($songList as $song) {
            //     if(isset($_GET[$song['SongID']])) {
            //         return $song['SongID'];
            //     }    
            // }
            
            // return "?";
        // }
        // catch (Exception $e) {
        //     $this->searchView->setErrorMessage($e->getMessage());
        // }
    }
    
}