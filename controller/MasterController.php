<?php

// Views...
require_once('view/RenderView.php');
require_once('view/SearchView.php');
require_once('view/ResultView.php');
require_once('view/NavigationView.php');

// Controllers...
require_once('controller/SearchController.php');

// Models...
require_once('model/SearchModel.php');

class MasterController {
    
    public function start() {
        
        $renderView = new RenderView();
        
        $resultView = new ResultView();
        
        $searchModel = new SearchModel();
        $searchView = new SearchView($searchModel);
        $searchController = new SearchController($renderView, $searchView, $searchModel, $resultView);
        
        $navigationView = new NavigationView($searchView, $searchModel);
        
        $page = $navigationView->checkPage();
        
        if($page == "/") {
           $searchController->Start(); 
        }
        
        else {
           $searchController->Chords($page);
        }    
    }
}