<?php

class RenderView {
    
    public function render($view) {
        echo '<!DOCTYPE html>
        <html>
            <head>
              <meta charset="utf-8">
              <title>Guitardo</title>
            </head>
            <body>
                <div class="container">
                    ' . $view->generateSearch() . '
                </div>
            </body>
      </html>
        ';
    }
    
}