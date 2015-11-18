<?php

class ArtistDAL {
    
    public function __construct(ConnectionDAL $connectionDAL) {
        $this->connectionDAL = $connectionDAL;
    }
    
    public function AddArtistToDatabase($artistName) {
        
        $connection = $this->connectionDAL->OpenConnection();
                
        // Save the SQL Query in a variable called query.
        $query = $this->InsertArtistQuery($connection, $artistName);
        
        //Ask database using the selected query.
        $connection->query($query);

        // Another querysave.
        $lastInsertedArtistQuery = $this->GetArtistQuery($connection, $artistName);
        
        // Use the lastInsertedArtistQuery to ask the database. Save result as a variable called lastInsertedArtistResult.
        $lastInsertedArtistResult = $connection->query($lastInsertedArtistQuery);
        
        /* Get the associative array from the last result the database gave me. This associative array contains the columns in the database.
            Example ['ArtistName'] and ['ArtistID'] */
        $latestArtist = $lastInsertedArtistResult->fetch_assoc();
        
        $this->connectionDAL->CloseConnection($connection);
        
        return $latestArtist;
        

    }
    
     public function DeleteArtistFromDatabase($artistName) {
        $connection = $this->connectionDAL->OpenConnection();
        
        $artistQuery = $this->deleteArtistQuery($connection, $artistName);
        $artistResult = $connection->query($artistQuery);
         
        $this->connectionDAL->CloseConnection($connection);
    }
    
    public function InsertArtistQuery($connection, $artistName) {
        return 'INSERT INTO `Artists`(`ArtistName`) 
            VALUES ("' . $connection->real_escape_string($artistName) . '")';
    }
    
    public function GetArtistQuery($connection, $artistName) {
        return 'SELECT * FROM `Artists` WHERE `ArtistName` = "' . $connection->real_escape_string($artistName) . '"';
    }
    
    public function deleteArtistQuery($connection, $artistName) {
        
        return 'DELETE FROM `Artists` WHERE `ArtistName` = "' . $connection->real_escape_string($artistName) . '"';
    }
    
    public function isArtistRegistered($artistName) {
        $connection = $this->connectionDAL->OpenConnection();
        
        $query = $this->GetArtistQuery($connection, $artistName);
        
        $result = $connection->query($query);
        $assocResult = $result->fetch_assoc();
        
        $this->connectionDAL->CloseConnection($connection);
        
        if($assocResult['ArtistName'] == $artistName) {
            return true;
        }
        else {
            return false;
        }
    }
    
}