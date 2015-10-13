<?php

// Views...
require_once('view/RenderView.php');
require_once('view/SearchView.php');

// Controllers...
require_once('controller/SearchController.php');

// Models...
require_once('model/SearchModel.php');

class MasterController {
    
    public function start() {
        
        $renderView = new RenderView();
        
        $searchModel = new SearchModel();
        $searchView = new SearchView();
        $searchController = new SearchController($renderView, $searchView, $searchModel);
        
        $searchController->start();
    }
    
}