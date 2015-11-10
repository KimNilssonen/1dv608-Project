<?php

class SongExistsException extends \Exception{};

class AddModel {
    
    public function __construct(ArtistDAL $artistDAL, SongDAL $songDAL) {
        $this->artistDAL = $artistDAL;
        $this->songDAL = $songDAL;
    }
    
    public function AddProcess($artistField, $songField, $chordsField) {
        $formattedArtistField = ucfirst($artistField);
        $formattedSongField = ucfirst($songField);
        $formattedChords = ucwords($chordsField);
        
        if(!$this->artistDAL->isArtistRegistered($formattedArtistField)) {
            $lastInsertedArtist = $this->AddArtist($formattedArtistField);
        }
        else {
            if(!$this->songDAL->isSongRegistered($formattedSongField)) {
                $this->AddSong($formattedSongField, $formattedChords, $formattedArtistField);
            }
            else {
                throw new SongExistsException();
            }
        }
    }
    
    public function AddArtist($artistName) {
        return $this->artistDAL->AddArtistToDatabase($artistName);        
    }
    
    public function AddSong($songName, $chords, $artistName) {
        $this->songDAL->AddSongToDatabase($songName, $chords, $artistName);
    }
        
   

    //     $connection = $this->OpenConnection();
        
    //     if(!$this->isArtistRegistered($connection, $formattedArtistField)) {
    //          // Adding Artist.
    //         $query = $this->InsertArtist($connection, $formattedArtistField);
    //         $artistResult = $this->QueryDatabase($connection, $query);
            
    //          // Adding Song.
    //         $lastInsertedArtistQuery = $this->getArtist($connection, $formattedArtistField);
    //         $lastInsertedArtistResult = $this->QueryDatabase($connection, $lastInsertedArtistQuery);
            
    //         // Getting the artist.
    //         $latestArtist = $lastInsertedArtistResult->fetch_assoc();
            
    //         $query = $this->InsertSong($connection, $latestArtist['ArtistID'], $formattedSongField, $formattedChords);
            
    //         $songResult = $this->QueryDatabase($connection, $query);
    //     }
    //     else {
    //         if(!$this->isSongRegistered($connection, $formattedSongField)) {
    //             // Fetch artist that already exits
    //             $artistQuery = $this->getArtist($connection, $formattedArtistField);
    //             $artistResult = $this->QueryDatabase($connection, $artistQuery);
                
    //             $artistArray = $artistResult->fetch_assoc();
                
    //             $query = $this->InsertSong($connection, $artistArray['ArtistID'], $formattedSongField, $formattedChords);
               
    //             $songResult = $this->QueryDatabase($connection, $query);
    //         }
    //         else {
    //             throw new Exception('This song is already exists.');
    //         }
    //     }
        
    //     $this->closeConnection($connection);
    // }
    
    // public function OpenConnection() {
    //     $this->connection = mysqli_connect(settings::$hostname, settings::$username, settings::$password, settings::$db, settings::$port)or die(mysql_error());
    //     return $this->connection;
    // }
    
    // public function CloseConnection($connection) {
    //     $connection->close();
    // }
    
    // public function InsertArtist($connection, $artistField) {
    //     return 'INSERT INTO `Artists`(`ArtistName`) 
    //             VALUES ("' . $connection->real_escape_string($artistField) . '")';
    // }
    
    // public function getArtist($connection, $artistField) {
    //     return 'SELECT * FROM `Artists` WHERE `ArtistName` = "' . $connection->real_escape_string($artistField) . '"';
    // }
    
    // public function InsertSong($connection, $artistID, $songField, $formattedChords) {
    //     return 'INSERT INTO `Songs`(`ArtistID`, `SongName`, `Chords`) 
    //             VALUES ("' . $connection->real_escape_string($artistID) . '", "' . $connection->real_escape_string($songField) . '", "' . $connection->real_escape_string($formattedChords) . '")';
    // }
    
    // public function getSong($connection, $songField) {
    //     return 'SELECT * FROM `Songs` WHERE `SongName` = "' . $connection->real_escape_string($songField) . '"';
    // }
    
    // public function QueryDatabase($connection, $query) {
    //     // Return result that you got back from database.
    //     return $connection->query($query);
    // }
    
    // public function isArtistRegistered($connection, $artistField) {
    //     $query = $this->getArtist($connection, $artistField);
        
    //     $result = $this->QueryDatabase($connection, $query);
    //     $assocResult = $result->fetch_assoc();
        
    //     if($assocResult['ArtistName'] == $artistField) {
    //         return true;
    //     }
    //     else {
    //         return false;
    //     }
    // }
    
    // public function isSongRegistered($connection, $songField) {
    //     $query = $this->getSong($connection, $songField);
        
    //     $result = $this->QueryDatabase($connection, $query);
    //     $assocResult = $result->fetch_assoc();
        
    //     if($assocResult['SongName'] == $songField) {
    //         return true;
    //     }
    //     else {
    //         return false;
    //     }
    
}