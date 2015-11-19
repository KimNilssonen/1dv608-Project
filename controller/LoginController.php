<?php

class LoginController {
    
    public function __construct(RenderView $renderView, LoginView $loginView, LoginModel $loginModel) {
        $this->renderView = $renderView;
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