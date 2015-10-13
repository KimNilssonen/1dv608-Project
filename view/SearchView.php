<?php

class SearchView {
    
    private static $search = 'SearchView::Search';
    private static $postSearch = 'SearchView::PostSearch';
    
    public function generateSearch() {
        return '
        <h1>Welcome to Guitardo</h1>
        <p>Here you can search for different songs or artists to learn the guitar chords,<br> making learning guitar easy!</p>
            <form method = "post">
                <input type="text" id"' . self::$search . '" name="' . self::$search . '" value="Search..."/>
            	<input type="submit" name="' . self::$postSearch . '" value="Search!" />
        	</form>
        ';
    }
    
    public function isPosted() {
        
        if(isset($_POST[self::$postSearch])) {
            return true;
        }
    }
    
    public function getSearchField() {
        return $_POST[self::$search];
    }
}