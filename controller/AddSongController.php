<?php

class AddSongController {
    
    public function __construct(RenderView $renderView, AddSongView $addSongView, AddSongModel $addSongModel) {
        $this->renderView = $renderView;
        $this->addSongView = $addSongView;
        $this->addSongModel = $addSongModel;
    }
    
    public function Start() {
        
         if($this->addSongView->isPosted()) {
            
            try {
                $this->artistField = $this->addSongView->getArtistField();
                $this->songField = $this->addSongView->getSongField();
                $this->chordsField = $this->addSongView->getChordsField();
                

                $this->userWantsToAdd($this->artistField,  $this->songField,  $this->chordsField);
            }
            catch(Exception $e) {
                $this->addSongView->setErrorMessage($e->getMessage());
            }
        }
        
        $this->renderView->render($this->addSongView, true);
    }
    
    public function userWantsToAdd($artistField,  $songField,  $chordsField) {
        
        $this->addSongModel->AddProcess($artistField, $songField, $chordsField);

    }
    
}