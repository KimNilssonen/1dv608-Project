<?php

class AddView {
    
    private static $artist = 'AddSongView::Artist';
    private static $song = 'AddSongView::Song';
    private static $chords = 'AddSongView::Chords';
    private static $postAdd = 'AddSongView::Add';
    
    private static $saveArtistField = '';
    private static $saveSongField = '';
    private static $saveChordsField = '';
    
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
                        <input type="text" id="' . self::$artist . '" name="' . self::$artist . '" maxlength = "100" value = "' . self::$saveArtistField . '" /><br>
                        
                        <label>Song name: </label><br>
                        <input type="text" id="' . self::$song . '" name="' . self::$song . '" maxlength = "100" value = "' . self::$saveSongField . '" /><br>
                        
                        <label>Chords: </label><br>
                        <input type="text" id="' . self::$chords . '" name="' . self::$chords . '" maxlength = "250" value = "' . self::$saveChordsField . '" /><br>
                        
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
           
            try { 
                self::$saveArtistField = $_POST[self::$artist];
                self::$saveSongField = $_POST[self::$song];
                self::$saveChordsField = $_POST[self::$chords];
                
                if(empty($_POST[self::$artist])){
                    $this->setErrorMessage("You have to write something in the artist field.");
                    return false;
                }
                else if($_POST[self::$artist] != strip_tags($_POST[self::$artist])) {
                    $this->setErrorMessage("The artist you've entered contains forbidden characters.");
                    return false;
                }
                else if(empty($_POST[self::$song])){
                    $this->setErrorMessage("You have to write something in the song field.");
                    return false;
                }
                else if($_POST[self::$song] != strip_tags($_POST[self::$song])) {
                    $this->setErrorMessage("The song you've entered contains forbidden characters.");
                    return false;
                }
                else if(empty($_POST[self::$chords])){
                    $this->setErrorMessage("You have to write something in the chords field.");
                    return false;
                }
                else if($_POST[self::$chords] != strip_tags($_POST[self::$chords])) {
                    $this->setErrorMessage("The chords you've entered contains forbidden characters.");
                    return false;
                }
                
                else {
                    return true;
                }
            }
            catch (\model\SongExistsException $e) {
                $this->setErrorMessage("Song already exists!");
            }
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