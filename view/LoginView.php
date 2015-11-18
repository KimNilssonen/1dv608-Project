<?php

class LoginView {
    
    private static $login = 'LoginView::Login';
	private static $logout = 'LoginView::Logout';
	private static $name = 'LoginView::UserName';
	private static $password = 'LoginView::Password';
	private static $cookieName = 'LoginView::CookieName';
	private static $cookiePassword = 'LoginView::CookiePassword';
	private static $keep = 'LoginView::KeepMeLoggedIn';
	private static $messageId = 'LoginView::Message';
	
	private static $saveName = '';
	
    private static $userNameIsMissingMessage = 'Username is missing.';
    private static $passwordIsMissingMessage = 'Password is missing.';
    private static $WrongNameOrPassgMessage = 'Wrong username or password.';
    private $errorMessage;
    
    public function __construct (SearchView $searchView) {
        $this->searchView = $searchView;
        
    }
    
    public function response() {
        $message = '';
        $response = '';
        
        if($this->errorMessage != null) {
            $message = $this->errorMessage;
        }
        
        $response = $this->generateLoginFormHTML($message);

        return $response;
    }
    
   private function generateLoginFormHTML($message) {
		return '
		<p>Login if you want to remove songs.</p>
			<form method="post" > 
				<fieldset>
					<legend>Login - enter Username and password</legend>
					<p id="' . self::$messageId . '">' . $message . '</p>
					
					<label for="' . self::$name . '">Username :</label>
					<input type="text" id="' . self::$name . '" name="' . self::$name . '" value="' . self::$saveName. '" />

					<label for="' . self::$password . '">Password :</label>
					<input type="password" id="' . self::$password . '" name="' . self::$password . '" />
					
					<input type="submit" name="' . self::$login . '" value="login" action="?" />
				</fieldset>
			</form>
		';
	}
	
	
	
	public function isPosted(){
    	if(isset($_POST[self::$login])){
    		self::$saveName = strip_tags($_POST[self::$name]);
    		return true;
    	}
    	else {
    		return false;
    	}
	}
	
	public function getUsername(){
		return $_POST[self::$name];
	}
	
	public function getPassword(){
		return $_POST[self::$password];
	}
	
	 public function setErrorMessage($e) {
        $this->errorMessage = $e;
    }
    
    public function userNameIsMissingMessage($e) {
        $e = self::$userNameIsMissingMessage;
        $this->errorMessage = $e;
    }
    
    public function passwordIsMissingMessage($e) {
        $e = self::$passwordIsMissingMessage;
        $this->errorMessage = $e;
    }
    
    public function wrongNameOrPassgMessage($e) {
        $e = self::$WrongNameOrPassgMessage;
        $this->errorMessage = $e;
    }
}