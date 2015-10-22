<?php

class AddSongView {
    
    private static $artist = 'AddSongView::Artist';
    private static $song = 'AddSongView::Song';
    private static $chords = 'AddSongView::Chords';
    private static $postAdd = 'AddSongView::Add';
    
    
    public function response() {
        $message = '';
        $response = '';
        
        // if($this->errorMessage != null) {
        //     $message = $this->errorMessage;
        // }
        
        $response = $this->generateHTML($message);
        
        return $response;
    }
    
    public function generateHTML($message){
        return '
                <h3>Fill in the form below.</h3>
                <fieldset>
                <legend>Enter credentials</legend>
                    <form method = "post">
                        <label>Artist: </label></br>
                        <input type="text" id="' . self::$artist . '" name="' . self::$artist . '"/></br>
                        
                        <label>Song name: </label></br>
                        <input type="text" id="' . self::$song . '" name="' . self::$song . '"/></br>
                        
                        <label>Chords: </label></br>
                        <input type="text" id="' . self::$chords . '" name="' . self::$chords . '"/></br>
                        
                    	<input type="submit" name="' . self::$postAdd . '" value="Add" />
                    	<p id=error>' . $message . '</p>
            	    </form>
        	    </fieldset>
        	';
    }
}