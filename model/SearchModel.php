<?php
require_once("settings.php");

class SearchModel {
    
    public function checkDatabase($sField) {
        $this->sField = $sField;
        
        // Open a connection.
        $connection = $this->openConnection();
        
        $query = $this->getEverything();
        
        
        // Save result from the query.
        $result = $connection->query($query);
        
        
        //TODO: Cleanup and fix!
        // Gets the array from the result.
       // $data = $result->fetch_assoc();

        //var_dump($data);
        
//----------------------------------------------------------
        // USE THIS SOLUTION. http://conctus.eu/example/6
        $allrows = array();
        $i = 0;
        while ($row = $result->fetch_assoc())
        {
            array_push($allrows,$row);
            
            echo $allrows[$i]['SongName'];
            $i++;
        }
        
        return isset($allrows) ? $allrows : null;
//----------------------------------------------------------        

        // Close the connection.
        $this->closeConnection($connection);
    }
    
    public function getAllArtists() {
        return "SELECT * FROM Artists";
    }
    
    public function getEverything() {
        return "SELECT * FROM  `Artists` ,  `Songs` 
                WHERE  `Artists`.`ArtistName` =  '$this->sField' OR `Songs`.`SongName` = '$this->sField'";
    }
    
    
    public function getAllSongs() {
        return "SELECT * FROM Songs";
    }
    
    public function openConnection() {
        $connection = mysqli_connect(settings::$hostname, settings::$username, settings::$password, settings::$db, settings::$port)or die(mysql_error());
        return $connection;
        
    }
    
    public function closeConnection($connection) {
        $connection->close();
    }
    
}