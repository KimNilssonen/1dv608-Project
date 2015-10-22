<?php

class RenderView {
    
    public function render($view, $isUserNotOnStart) {
        echo '<!DOCTYPE html>
        <html>
            <head>
              <meta charset="utf-8">
              <title>Guitardo</title>
              <link rel="stylesheet" type="text/css" href="../css/style.css">
            </head>
            <body>
                <div class="container">
                    ' . $this->atResult($isUserNotOnStart) . '
                    ' . $view->response() . '
                </div>
            </body>
      </html>
        ';
    }
    
    public function atResult($isUserNotOnStart) {
        if($isUserNotOnStart) {
          return '<a href="?">Back to search</a>';
        }
    }
    
}