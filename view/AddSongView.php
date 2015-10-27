<?php

class AddSongView {
    
    private static $artist = 'AddSongView::Artist';
    private static $song = 'AddSongView::Song';
    private static $chords = 'AddSongView::Chords';
    private static $postAdd = 'AddSongView::Add';
    
    private $errorMessage;
    
    public function response() {
        $message = '';
        $response = '';
        
        if($this->errorMessage != null) {
            $message = $this->errorMessage;
        }
        
        $response = $this->generateHTML($message);
        
        return $response;
    }
    
    public function generateHTML($message){
        return '
                <h3>Fill in the form below.</h3>
                <fieldset>
                <legend>Enter credentials</legend>
                    <form method = "post">
                        <label>Artist: </label><br>
                        <input type="text" id="' . self::$artist . '" name="' . self::$artist . '" maxlength = "100"/><br>
                        
                        <label>Song name: </label><br>
                        <input type="text" id="' . self::$song . '" name="' . self::$song . '" maxlength = "100"/><br>
                        
                        <label>Chords: </label><br>
                        <input type="text" id="' . self::$chords . '" name="' . self::$chords . '" maxlength = "250"/><br>
                        
                    	<input type="submit" name="' . self::$postAdd . '" value="Add" />
                    	<p id=error>' . $message . '</p>
                    	' . $this->success() . '
            	    </form>
        	    </fieldset>
        	';
    }
    
    public function setErrorMessage($e) {
        $this->errorMessage = $e;
    }
    
    public function isPosted() {
        if(isset($_POST[self::$postAdd])) {
            return true;
        }
    }
    
    public function getArtistField() {
        return $_POST[self::$artist];
    }
    
    public function getSongField() {
        return $_POST[self::$song];
    }
    
    public function getChordsField() {
        return $_POST[self::$chords];
    }
    
    public function success() {
        if($this->isPosted()) {
            if(empty($this->errorMessage)) {
                return '<p>Song added!<p>';
            }
            else {
                return '';
            }
        }
    }
}