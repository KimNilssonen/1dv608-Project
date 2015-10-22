<?php

class SearchView {
    
    private static $search = 'SearchView::Search';
    private static $postSearch = 'SearchView::PostSearch';
    
    private $errorMessage;
    
    public function __construct (SearchModel $searchModel) {
        $this->searchModel = $searchModel;
    }
    
    public function response() {
        $message = '';
        $response = '';
        
        if($this->errorMessage != null) {
            $message = $this->errorMessage;
        }
        
        $response = $this->generateHTML($message);
        
        if($this->isUserAtResult()) {
            $response .= $this->generateResultHTML();
        }
        
        return $response;
    }
    
    public function generateResultHTML() {
        return '
            <fieldset>
            <legend>Search Result</legend>
            <p id=searchedFor>Searched for: ' . $this->searchedFor . '</p>
            
            <h4>Songs: </h4>' . $this->generateSongList() . '
            </fieldset>
        ';
    }
    
    public function generateHTML($message) {
        return '
        <h1>Welcome to Guitardo</h1>
        <p>Here you can search for different songs or artists to learn the guitar chords,<br> 
            making learning guitar easy!</p>
        <p>Search for <b>artist</b> or <b>song</b> below...</p>
            <form method = "post" id="searchForm">
                <input type="text" id="' . self::$search . '" name="' . self::$search . '" value="Search..."/>
            	<input type="submit" name="' . self::$postSearch . '" value="Search!" />
            	<p id=error>' . $message . '</p>
        	</form>
    	<p>Cannot find a song?<br>
    	    If you know the chords you can add them by clicking <a href="?add">here</a></p>
        ';
    }
    
    
    public function setErrorMessage($e) {
     
        $this->errorMessage = $e;
        
    }
    
    
    public function isPosted() {
        if(isset($_POST[self::$postSearch])) {
            return true;
        }
    }
    
    
    public function isUserAtResult() {
        if($this->searchModel->isUserAtResult()) {
            return true;
        }
        else {
            return false;
        }
    }
    
    
    public function getSearchField() {
        return $_POST[self::$search];
    }
    
    
    public function setSearchedArtistAndSongNames($artists, $songArray) {
        $this->searchedFor = $this->getSearchField();
        $this->artistNames = $artists;
        $this->songList = $songArray;
        
    }
    
    
    public function generateSongList() {
        
        $songList = '<table id=songList>';
        foreach($this->songList as $song) {
            $songList .= '<tr>
                            <td>
                                <a href="?' . $song['SongID'] . '">' . $song['SongName'] . '</a> - ' . $song['ArtistName'] . '
                            </td>
                        </tr>';
        }
        
        $songList .= '</table>';
        return $songList;
    }
    
    
    public function generateArtistList() {
        
        $artistList = '<table>';
        foreach($this->artistNames as $artist) {
            $artistList .= '<tr>
                                <td>
                                    ' . $artist['ArtistName'] != $artist['ArtistName'] . '
                                </td>
                            </tr>';
            
        }
        
        $artistList .= '</table>';
        return $artistList;
    }
}