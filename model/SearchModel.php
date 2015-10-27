<?php


class SearchModel {
    
    private $connection;
    private $artistNames;
    private $artistSongs;
    private $allrows;
    
    public function checkDatabase($sField) {
        $this->sField = $sField;
        
        if($this->sField != strip_tags($this->sField)) {
            throw new Exception("The search field contains forbidden characters.");
        }
        
        if(empty($this->sField)) {
            throw new Exception("You have to write something in the search field.");
        }
        
        // Open a connection.
        $connection = $this->openConnection();
        
        // The query that are going to be asked to the database.
        $query = $this->getEverything($connection);

        // Fetch from database using the selected query..
        $result = $this->fetchFromDatabase($connection, $query);
        
        // Close the connection.
        $this->closeConnection($connection);
        
        return $result;
    }
    
    public function fetchFromDatabase($connection, $query) {
        // Save result that you got back from database.
        $result = $connection->query($query);
        
        // USE THIS SOLUTION. http://conctus.eu/example/6
        $allrows = array();
        $i = 0;
        
        while ($row = $result->fetch_assoc()) {
            array_push($allrows,$row);
            $i++;
            
        }
        
        // If there is set an array called $allrows return it, otherwise return null.
        $allrows;
        return isset($allrows) ? $allrows : null;
    }
    
    
    public function getEverything($connection) {
        return 'SELECT * 
                FROM Artists LEFT JOIN Songs 
                ON Songs.ArtistID = Artists.ArtistID
                WHERE Artists.ArtistName LIKE  "%' . $connection->real_escape_string($this->sField) . '%"
                OR Songs.SongName LIKE  "%' . $connection->real_escape_string($this->sField) . '%"'; 
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
    public function getSongNames($result) {

        if(empty($result[0]['SongName'])) {
            throw new Exception('Could not find: ' . $this->sField . ' in the database.');
        }
        else {
            
            $artistSongs = array();
            foreach ($result as $songs) {
                $songs['SongName'];
                array_push($artistSongs, $songs);
            }
            
            $this->artistSongs = $artistSongs;
            return $this->artistSongs;
        }
    }
    
    public function askForThisSong($songID){
        return 'SELECT * 
                FROM Songs 
                WHERE Songs.SongID = ' . $songID . ''; 
    }
    
    
//TODO: FIX THESES FUNCTIONS--------------------------------    
    public function getSpecificSong($songID){
        $connection = $this->openConnection();

        $query = $this->askForThisSong($songID);
        
        // Fetch from database using the selected query..
        $result = $this->fetchFromDatabase($connection, $query);
        
        $this->closeConnection($connection);
        
        return $result[0]['SongName'];
    }
    
    public function getChords($songID) {
        $connection = $this->openConnection();

        $query = $this->askForThisSong($songID);
        
        // Fetch from database using the selected query..
        $result = $this->fetchFromDatabase($connection, $query);
        
        $this->closeConnection($connection);
        
        return $result[0]['Chords'];
        
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