<?php
session_start();
// Views...
require_once('view/RenderView.php');
require_once('view/SearchView.php');
require_once('view/ResultView.php');
require_once('view/NavigationView.php');
require_once('view/AddView.php');
require_once('view/LoginView.php');

// Controllers...
require_once('controller/SearchController.php');
require_once('controller/AddController.php');
require_once('controller/LoginController.php');

// Models...
require_once('model/SearchModel.php');
require_once('model/ArtistDAL.php');
require_once('model/SongDAL.php');
require_once('model/AddModel.php');
require_once('model/ConnectionDAL.php');
require_once('model/LoginModel.php');
require_once('model/DeleteModel.php');

// Server settings...
require_once("settings.php");

class MasterController {
    
    public function start() {
        
        $renderView = new RenderView();
        $resultView = new ResultView();
        $addView = new AddView();
        
        $connectionDAL = new ConnectionDAL();
        $artistDAL = new ArtistDAL($connectionDAL);
        $songDAL = new SongDAL($connectionDAL, $artistDAL);
        $addModel = new AddModel($artistDAL, $songDAL);
        
        $loginModel = new LoginModel();
        $deleteModel = new DeleteModel($songDAL, $artistDAL);
        $searchModel = new SearchModel($deleteModel);
        $searchView = new SearchView($searchModel, $loginModel);
        $searchController = new SearchController($renderView, $searchView, $searchModel,$loginModel, $deleteModel, $resultView);
        
        $addController = new AddController($renderView, $addView, $addModel, $loginModel);
        
        $loginView = new LoginView($searchView);
        $loginController = new LoginController($renderView, $searchView, $loginView, $loginModel);
        
        $navigationView = new NavigationView();
        
        $page = $navigationView->checkPage();
        
        if($page == "/" || $page == "/index.php" || $page == "/project/") {
           $searchController->Start(); 
        }
        else if($page == "login") {
            $loginController->Start();
        }
        else if($page == "add"){
            $addController->Start();
        }
        else {
           $searchController->Chords($page);
        }    
    }
}