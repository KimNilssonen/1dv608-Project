<?php

class DeleteModel {
    
    public function __construct(SongDAL $songDAL, ArtistDAL $artistDAL) {
        $this->songDAL = $songDAL;
        $this->artistDAL = $artistDAL;
    }
    
    public function deleteSong($songID) {
        $this->songDAL->DeleteSongFromDatabase($songID);
    }
    
    public function deleteArtist($artistName) {
        $this->artistDAL->DeleteArtistFromDatabase($artistName);
    }
}