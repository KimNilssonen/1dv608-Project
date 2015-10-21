<?php
require_once("settings.php");

class SearchModel {
    
    private $connection;
    private $artistNames;
    private $artistSongs;
    private $allrows;
    
    public function checkDatabase($sField) {
        $this->sField = $sField;
        
        // Open a connection.
        $connection = $this->openConnection();
        $this->connection = $connection;
        
        // The query that are going to be asked to the database.
        $query = $this->getEverything();

        // Save result that you got back from database.
        $result = $this->connection->query($query);
        
        // USE THIS SOLUTION. http://conctus.eu/example/6
        $allrows = array();
        $i = 0;
        
        while ($row = $result->fetch_assoc()) {
            array_push($allrows,$row);
            $i++;
            
        }
        
        // If there is set an array called $allrows return it, otherwise return null.
        $this->result = $allrows;
        return isset($allrows) ? $allrows : null;

        // Close the connection.
        $this->closeConnection($connection);
    }
    
    
    public function getEverything() {
        return 'SELECT * 
                FROM Artists LEFT JOIN Songs 
                ON Songs.ArtistID = Artists.ArtistID
                WHERE Artists.ArtistName LIKE  "%' . $this->sField . '%"
                OR Songs.SongName LIKE  "%' . $this->sField . '%"'; 
    }

    
    public function openConnection() {
            $this->connection = mysqli_connect(settings::$hostname, settings::$username, settings::$password, settings::$db, settings::$port)or die(mysql_error());
            return $this->connection;
    }
    
    public function closeConnection($connection) {
        $connection->close();
    }
    
    public function getArtistNames($result) {
        
         if(empty($result[0]['ArtistName'])) {
            
            throw new Exception('Could not find: ' . $this->sField . ' in the database.');
         }
         else {
            $artists = array();
            foreach ($result as $artist) {
                $artist['ArtistName'];
                array_push($artists, $artist);
            }
            
            $this->artistNames = $artists;
            
            return $this->artistNames;
         }
    }
    
    // Don't use the parameter anymore.
    public function getSongNames(/*$result*/) {

        if(empty($this->result[0]['SongName'])) {
            throw new Exception('Could not find: ' . $this->sField . ' in the database.');
        }
        else {
            $artistSongs = array();
            foreach ($this->result as $songs) {
                $songs['SongName'];
                array_push($artistSongs, $songs);
            }
            
            $this->artistSongs = $artistSongs;
            var_dump($this->artistSongs);
            return $this->artistSongs;
        }
    }
    
    
//TODO: FIX THESES FUNCTIONS--------------------------------    
    public function getSpecificSong($songID, $songs){
        var_dump($songs);
        
        foreach ($songs as $song) {
            if($song['songID'] == $songID) {
                var_dump($songs[$songID]);
                // return $songs[$songID]['SongName'];
        }
                
        }
    }
    
    public function getChords() {
        if($this->artistSongs[$songID] == $songID) {
            return $this->artistSongs[$songID]['Chords'];
        }
    }
//-----------------------------------------------------------
    
    
    public function isUserAtResult() {
        if($this->artistNames != null || $this->artistSongs != null) {
            return true;
        }
        else {
            return false;
        }
    }
    
}