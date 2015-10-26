<?php

// Views...
require_once('view/RenderView.php');
require_once('view/SearchView.php');
require_once('view/ResultView.php');
require_once('view/NavigationView.php');
require_once('view/AddSongView.php');

// Controllers...
require_once('controller/SearchController.php');
require_once('controller/AddSongController.php');

// Models...
require_once('model/SearchModel.php');
require_once('model/AddSongModel.php');

// Server settings...
require_once("settings.php");

class MasterController {
    
    public function start() {
        
        $renderView = new RenderView();
        $resultView = new ResultView();
        $addSongView = new AddSongView();
        
        $searchModel = new SearchModel();
        $searchView = new SearchView($searchModel);
        $searchController = new SearchController($renderView, $searchView, $searchModel, $resultView);
        
        $addSongModel = new AddSongModel();
        $addSongController = new AddSongController($renderView, $addSongView, $addSongModel);
        
        $navigationView = new NavigationView($searchView, $searchModel);
        
        $page = $navigationView->checkPage();
        
        if($page == "/" || $page == "/index.php") {
           $searchController->Start(); 
        }
        else if($page == "add"){
            $addSongController->Start();
        }
        else {
           $searchController->Chords($page);
        }    
    }
}