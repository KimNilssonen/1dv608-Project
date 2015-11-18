<?php

class LoginController {
    
    public function __construct(RenderView $renderView, SearchView $searchView, LoginView $loginView, LoginModel $loginModel) {
        $this->renderView = $renderView;
        $this->searchView = $searchView;
        $this->loginView = $loginView;
        $this->loginModel = $loginModel;
    }
    
    public function Start() {
        
        if($this->loginView->isPosted()) {
            $this->username = $this->loginView->getUsername();
            $this->password = $this->loginView->getPassword();
         
            try {
                if($this->loginModel->Check($this->username, $this->password)) {
                    
                    // Sends user back to start if the login was successful.
                    header("location:?");
                   // $this->renderView->render($this->loginModel->isUserLoggedIn(), $this->searchView, false);
                }
            }
            
            catch (UserNameIsMissingException $e){
                $this->loginView->userNameIsMissingMessage($e);
            }
            catch (PasswordIsMissingException $e){
                $this->loginView->passwordIsMissingMessage($e);
            }
            catch (WrongNameOrPassException $e){
                $this->loginView->wrongNameOrPassgMessage($e);
            }
        }
        if(!$this->loginModel->isUserLoggedIn()) {
            $this->renderView->render(true, $this->loginView, true);
        }
    }
}