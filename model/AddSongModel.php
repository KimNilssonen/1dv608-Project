<?php

class AddSongModel {
    
    public function AddProcess($artistField, $songField, $chordsField) {
        
        $formattedArtistField = ucfirst($artistField);
        $formattedSongField = ucfirst($songField);
        $formattedChords = ucwords($chordsField);
        
        if($formattedArtistField != strip_tags($formattedArtistField)) {
            throw new Exception("The artist name contains forbidden characters.");
        }
        if($formattedSongField != strip_tags($formattedSongField)) {
            throw new Exception("The song name contains forbidden characters.");
        }
        if($formattedChords != strip_tags($formattedChords)) {
            throw new Exception("The chords contains forbidden characters.");
        }
        
        if(empty($formattedArtistField)) {
            throw new Exception ("You must enter a name of the artist.");    
        }
        else if(empty($formattedSongField)) {
            throw new Exception ("You must enter a name of the song.");    
        }
        else if(empty($formattedChords)) {
            throw new Exception ("You must enter the chords of the song.");    
        }
        
        
        
        $connection = $this->OpenConnection();
        
        if(!$this->isArtistRegistered($connection, $formattedArtistField)) {
             // Adding Artist.
            $query = $this->InsertArtist($connection, $formattedArtistField);
            $artistResult = $this->QueryDatabase($connection, $query);
            
             // Adding Song.
            $lastInsertedArtistQuery = $this->getArtist($connection, $formattedArtistField);
            $lastInsertedArtistResult = $this->QueryDatabase($connection, $lastInsertedArtistQuery);
            
            // Getting the artist ID.
            $artistID = $lastInsertedArtistResult->fetch_assoc()['ArtistID'];
            
            $query = $this->InsertSong($connection, $artistID, $formattedSongField, $formattedChords);
            
            $songResult = $this->QueryDatabase($connection, $query);
        }
        else {
            if(!$this->isSongRegistered($connection, $formattedSongField)) {
                // Fetch artist that already exits
                $artistQuery = $this->getArtist($connection, $formattedArtistField);
                $artistResult = $this->QueryDatabase($connection, $artistQuery);
                
                $query = $this->InsertSong($connection, $artistResult->fetch_assoc()['ArtistID'], $formattedSongField, $formattedChords);
               
                $songResult = $this->QueryDatabase($connection, $query);
            }
            else {
                throw new Exception('This song is already exists.');
            }

        }
        
        $this->closeConnection($connection);
    }
    
    public function OpenConnection() {
        $this->connection = mysqli_connect(settings::$hostname, settings::$username, settings::$password, settings::$db, settings::$port)or die(mysql_error());
        return $this->connection;
    }
    
    public function CloseConnection($connection) {
        $connection->close();
    }
    
    public function InsertArtist($connection, $artistField) {
        return 'INSERT INTO `Artists`(`ArtistName`) 
                VALUES ("' . $connection->real_escape_string($artistField) . '")';
    }
    
    public function getArtist($connection, $artistField) {
        return 'SELECT * FROM `Artists` WHERE `ArtistName` = "' . $connection->real_escape_string($artistField) . '"';
    }
    
    public function InsertSong($connection, $artistID, $songField, $formattedChords) {
        return 'INSERT INTO `Songs`(`ArtistID`, `SongName`, `Chords`) 
                VALUES ("' . $connection->real_escape_string($artistID) . '", "' . $connection->real_escape_string($songField) . '", "' . $connection->real_escape_string($formattedChords) . '")';
    }
    
    public function getSong($connection, $songField) {
        return 'SELECT * FROM `Songs` WHERE `SongName` = "' . $connection->real_escape_string($songField) . '"';
    }
    
    public function QueryDatabase($connection, $query) {
        // Return result that you got back from database.
        return $connection->query($query);
    }
    
    public function isArtistRegistered($connection, $artistField) {
        $query = $this->getArtist($connection, $artistField);
        
        $result = $this->QueryDatabase($connection, $query);
        
        if($result->fetch_assoc()['ArtistName'] == $artistField) {
            return true;
        }
        else {
            return false;
        }
    }
    
    public function isSongRegistered($connection, $songField) {
        $query = $this->getSong($connection, $songField);
        
        $result = $this->QueryDatabase($connection, $query);
        
        if($result->fetch_assoc()['SongName'] == $songField) {
            return true;
        }
        else {
            return false;
        }
    }
    
}