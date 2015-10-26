<?php

class SearchController {
    
    public function __construct(RenderView $renderView, SearchView $searchView, SearchModel $searchModel, ResultView $resultView) {
        $this->renderView = $renderView;
        $this->searchView = $searchView;
        $this->searchModel = $searchModel;
        $this->resultView = $resultView;
    }
    
    public function Start() {
        
        if($this->searchView->isPosted()) {
            
            try {
                $this->searchField = $this->searchView->getSearchField();
                $this->userWantsToSearch($this->searchField);
            }
            catch(Exception $e) {
                $this->searchView->setErrorMessage($e->getMessage());
            }
        }

        $this->renderSearchView();
    }
    
    public function userWantsToSearch($sField) {
        
            $result = $this->searchModel->checkDatabase($sField); // Returns an array from database.
            $artistNames = $this->searchModel->getArtistNames($result); // Forward the array to another function in model that use the array to get the artist name.
            $artistSongs = $this->searchModel->getSongNames($result); // Forward the array to another function in model that use the array to get an array with song names.
            
            $this->searchView->setSearchedArtistAndSongNames($artistNames, $artistSongs);
    }
    
    public function renderSearchView() {
        $this->renderView->render($this->searchView, false);
    }
    
    public function renderChordsView() {
        $this->renderView->render($this->resultView, true);
    }
    
    public function Chords($songID) {
        
        
        $songName = $this->searchModel->getSpecificSong($songID);
        $chords = $this->searchModel->getChords($songID);
        
        $this->resultView->setSongAndChords($songName, $chords);
        $this->renderChordsView();
    }
    
}