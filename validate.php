<?php
	function validate($pass){
		$salt = 'XyZzy12*_';
		$stored_hash = "1a52e17fa899cf40fb04cfc42e6352f1";
		$md5 = hash('md5', $salt . $pass);
		if($md5 !== $stored_hash){
			return false;
		}
		return true;
	}

	function hashed($pass){
		$salt = 'XyZzy12*_';
		return hash('md5', $salt . $pass);
	}

?>