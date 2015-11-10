<?php

class ConnectionDAL {
    
    public function OpenConnection() {
        $this->connection = mysqli_connect(settings::$hostname, settings::$username, settings::$password, settings::$db, settings::$port)or die(mysql_error());
        return $this->connection;
    }
    
    public function CloseConnection($connection) {
        $connection->close();
    }
    
}