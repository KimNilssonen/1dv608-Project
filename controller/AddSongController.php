<?php

class AddSongController {
    
    public function __construct(RenderView $renderView, AddSongView $addSongView) {
        $this->renderView = $renderView;
        $this->addSongView = $addSongView;
    }
    
    public function Start() {
        $this->renderView->render($this->addSongView, true);
    }
    
}