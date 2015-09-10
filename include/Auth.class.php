<?php

class Auth {
	protected $_logins;
	
	public function __construct($f_users) {
		$logins = file($f_users);
		foreach($logins as $login) {
			list($f_user, $f_pass) = preg_split('/:/', rtrim($login));
			$this->_logins[$f_user] = $f_pass;
		}
	}
	
	public function verify($user, $pass) {
		return $this->_logins[$user] == $pass;
	}
}

?>