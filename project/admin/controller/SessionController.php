<?php
	if( !isset($_SESSION )){
		session_start();
	}
	
	function verify($username, $password){
		if($_SESSION['username'] == $username && $_SESSION['password'] == $password){
			return true;
		}
		else
			return false;
	}
	
	function isCredentialSaved(){
		if(!isset($_SESSION['username']) || !isset($_SESSION['password'])){
			return false;
		}
		return true;
	}
	
	function saveCredential($username, $password){
		$_SESSION['username'] = $username;
		$_SESSION['password'] = $password;
	}
?>