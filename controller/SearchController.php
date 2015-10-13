<?php

class SearchController {
    
    public function __construct(RenderView $renderView, SearchView $searchView, SearchModel $searchModel) {
        $this->renderView = $renderView;
        $this->searchView = $searchView;
        $this->searchModel = $searchModel;
    }
    
    public function start() {
        
        //TODO: put model checks here.
        if($this->searchView->isPosted()) {
            $this->searchField = $this->searchView->getSearchField();
            $this->userWantsToSearch($this->searchField);
        }
        
        $this->renderView->render($this->searchView);
    }
    
    public function userWantsToSearch($sField) {
        $result = $this->searchModel->checkDatabase($sField); // Returns $data from database.
        
        
        //TODO: Cleanup and fix.
        //$result[0]['ArtistName'];
        
        foreach ($result as $artistsongs)
        {
            $artistsongs['SongName'];
        }
        //TODO: if(result = null) { "Finns inte i databas..." }
    }
    
}