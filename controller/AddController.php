<?php

class AddController {
    
    public function __construct(RenderView $renderView, addView $addView, AddModel $addModel) {
        $this->renderView = $renderView;
        $this->addView = $addView;
        $this->addModel = $addModel;
    }
    
    public function Start() {
        
        if($this->addView->isPosted()) {
            
            $this->artistField = $this->addView->getArtistField();
            $this->songField = $this->addView->getSongField();
            $this->chordsField = $this->addView->getChordsField();
        
            $this->userWantsToAdd($this->artistField,  $this->songField,  $this->chordsField);
        }
        $this->renderView->render(true, $this->addView, true);
    }
    
    public function userWantsToAdd($artistField,  $songField,  $chordsField) {
        try {
            $this->addModel->AddProcess($artistField, $songField, $chordsField);
        }
        catch (SongExistsException $e) {
            $this->addView->songExistsMessage($e); 
        }
        catch (ForbiddenCharException $e) {
            $this->addView->forbiddenCharMessage($e);
        }
    }
    
}