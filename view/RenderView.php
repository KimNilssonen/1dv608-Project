<?php

class RenderView {
    
    public function render($view, $isUserAtResult) {
        echo '<!DOCTYPE html>
        <html>
            <head>
              <meta charset="utf-8">
              <title>Guitardo</title>
            </head>
            <body>
                <div class="container">
                    ' . $this->atResult($isUserAtResult) . '
                    ' . $view->response() . '
                </div>
            </body>
      </html>
        ';
    }
    
    public function atResult($isUserAtResult) {
        if($isUserAtResult) {
          return '<a href="?">Back to search</a>';
        }
    }
    
}