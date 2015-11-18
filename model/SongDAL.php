<?php

class SongDAL {
    
    public function __construct(ConnectionDAL $connectionDAL, ArtistDAL $artistDAL) {
        $this->connectionDAL = $connectionDAL;
        $this->artistDAL = $artistDAL;
    }
    
    public function AddSongToDatabase($songName, $chords, $artistName) {
        $connection = $this->connectionDAL->OpenConnection();
        
        $artistQuery = $this->artistDAL->GetArtistQuery($connection, $artistName);
        $artistResult = $connection->query($artistQuery)->fetch_assoc();
        
        $songQuery = $this->InsertSong($connection, $artistResult['ArtistID'], $songName, $chords);
        $songResult = $connection->query($songQuery);
         
        $this->connectionDAL->CloseConnection($connection);
    }
    
    public function DeleteSongFromDatabase($songID) {
        $connection = $this->connectionDAL->OpenConnection();
        
        $songQuery = $this->deleteSongQuery($connection, $songID);
        $songResult = $connection->query($songQuery);
         
        $this->connectionDAL->CloseConnection($connection);
    }
    
    public function InsertSong($connection, $artistID, $songField, $formattedChords) {
        return 'INSERT INTO `Songs`(`ArtistID`, `SongName`, `Chords`) 
            VALUES ("' . $connection->real_escape_string($artistID) . '", "' . $connection->real_escape_string($songField) . '", "' . $connection->real_escape_string($formattedChords) . '")';
    }
    
    public function getSong($connection, $songField) {
        return 'SELECT * FROM `Songs` WHERE `SongName` = "' . $connection->real_escape_string($songField) . '"';
    }
    
    public function deleteSongQuery($connection, $songID) {
        return 'DELETE FROM `Songs` WHERE `SongID` = "' . $connection->real_escape_string($songID) . '"';
    }
    
    public function isSongRegistered($songName) {
        
        $connection = $this->connectionDAL->OpenConnection();
        $query = $this->getSong($connection, $songName);
        
        $result = $connection->query($query);
        $assocResult = $result->fetch_assoc();
        
        if($assocResult['SongName'] == $songName) {
            return true;
        }
        else {
            return false;
        }
    }
}