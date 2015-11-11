<?php

class SongExistsException extends \Exception{};
class ForbiddenCharException extends \Exception{};

class AddModel {
    
    public function __construct(ArtistDAL $artistDAL, SongDAL $songDAL) {
        $this->artistDAL = $artistDAL;
        $this->songDAL = $songDAL;
    }
    
    public function AddProcess($artistField, $songField, $chordsField) {
        $formattedArtistField = ucfirst($artistField);
        $formattedSongField = ucfirst($songField);
        $formattedChords = ucwords($chordsField);
        
        if(!preg_match('/([A-Z])|([a-z])|([0-9])/', $formattedArtistField) || 
            !preg_match('/([A-Z])|([a-z])|([0-9])/', $formattedSongField) ||
            !preg_match('/([A-Z])|([a-z])|([0-9])/', $formattedChords )) 
        {
            throw new ForbiddenCharException();
        }
        
        if(!$this->artistDAL->isArtistRegistered($formattedArtistField)) {
            $lastInsertedArtist = $this->AddArtist($formattedArtistField);
        }
        if(!$this->songDAL->isSongRegistered($formattedSongField)) {
            $this->AddSong($formattedSongField, $formattedChords, $formattedArtistField);
        }
        else {
            throw new SongExistsException();
        }
        
    }
    
    public function AddArtist($artistName) {
        return $this->artistDAL->AddArtistToDatabase($artistName);        
    }
    
    public function AddSong($songName, $chords, $artistName) {
        $this->songDAL->AddSongToDatabase($songName, $chords, $artistName);
    }
}