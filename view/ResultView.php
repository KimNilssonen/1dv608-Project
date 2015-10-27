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
        
        $chordList = '<table> <tr>';
        
            $chordList .= '
                            <td>
                                ' . $this->chords . '
                            </td>
                        ';
        $chordList .= '</tr> </table>';
        
        return $chordList;
    }
    
    
}