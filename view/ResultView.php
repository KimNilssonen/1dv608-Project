<?php

class ResultView {
    
    public function response() {        
        return '
            <h3>' . $this->songName . '</h3>
            ' . $this->generateChords() . '
        ';
    }
    
    public function setSongAndChords($song, $chordsArray) {
        $this->songName = $song;
        $this->chords = $chordsArray;
        
    }
    
    public function generateChords() {
        
        $songList = '<table> <tr>';
        
        foreach($this->chords as $chords) {
            $songList .= '
                            <td>
                                ' . $chords['Chords'] . '
                            </td>
                        ';
        }
        
        $songList .= '</tr> </table>';
        
        return $songList;
    }
    
}