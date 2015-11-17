<?php 

class UserNameIsMissingException extends \Exception{};
class PasswordIsMissingException extends \Exception{};
class WrongNameOrPassException extends \Exception{};

class LoginModel {
    
     private $registerDAL; 
    
    public function __construct(){
        if (!isset($_SESSION['UserLoggedIn'])) {
            $_SESSION['UserLoggedIn'] = false;
        }
    }
   
   
     //Check name and password, return a message.
    public function Check($name, $password){
        $correctUsername = 'Admin';
        $correctPassword = 'Password';
        $message = '';
        
        // Trim away spaces since I use empty() on the name and password.
        trim($name);
        trim($password);
        
        // If the name and password are correct...
        if($name == $correctUsername && $password == $correctPassword){
            
            // ...sets the session to true. Then returns true to the controller.
            $_SESSION['UserLoggedIn'] = true;
            return $this->isUserLoggedIn();
        }
        
        else if(empty($name)){
            throw new UserNameIsMissingException;
        }
        else if(empty($password)){
            throw new PasswordIsMissingException;
        }
        else{
            throw new WrongNameOrPassException;
        }
    }
    
    public function logout(){
        if(isset($_SESSION['UserLoggedIn']) && $_SESSION['UserLoggedIn']){
            $_SESSION['UserLoggedIn'] = false;
        }
        session_destroy();
    }
    
    public function isUserLoggedIn(){
        if(isset($_SESSION['UserLoggedIn']) && $_SESSION['UserLoggedIn']){
            return true;
        }
        else {
            return false;
        }
    }
    
}