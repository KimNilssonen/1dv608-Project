<?php

// Views...
require_once('view/RenderView.php');
require_once('view/SearchView.php');
require_once('view/ResultView.php');
require_once('view/NavigationView.php');
require_once('view/AddView.php');

// Controllers...
require_once('controller/SearchController.php');
require_once('controller/AddController.php');

// Models...
require_once('model/SearchModel.php');
require_once('model/ArtistDAL.php');
require_once('model/SongDAL.php');
require_once('model/AddModel.php');
require_once('model/ConnectionDAL.php');

// Server settings...
require_once("settings.php");

class MasterController {
    
    public function start() {
        
        $renderView = new RenderView();
        $resultView = new ResultView();
        $addView = new AddView();
        
        $searchModel = new SearchModel();
        $searchView = new SearchView($searchModel);
        $searchController = new SearchController($renderView, $searchView, $searchModel, $resultView);
        
        $connectionDAL = new ConnectionDAL();
        $artistDAL = new ArtistDAL($connectionDAL);
        $songDAL = new SongDAL($connectionDAL, $artistDAL);
        $addModel = new AddModel($artistDAL, $songDAL);
        
        $addController = new AddController($renderView, $addView, $addModel);
        
        $navigationView = new NavigationView();
        
        $page = $navigationView->checkPage();
        
        if($page == "/" || $page == "/index.php" || $page == "/project/") {
           $searchController->Start(); 
        }
        else if($page == "add"){
            $addController->Start();
        }
        else {
           $searchController->Chords($page);
        }    
    }
}