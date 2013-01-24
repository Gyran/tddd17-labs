<?php


class Account { // The basic class for an account
	private $username;
	private $secret;

	public function __construct($username, $secret) {
		$this->username = $username;
		$this->secret = $secret;
	} 

	public function getUsername() {
		return $this->username;
	}

	public function getSecret() {
		return $this->secret;
	}
}

function readAccounts() { // Reads all the accounts from a file and returns them in an array
	$accounts = array();

	$fd = fopen("accounts", "r");
	if ($fd) {
		while(($line = fgets($fd, 1024)) !== false) {
			$account = explode(":", $line);

			$account = new Account($account[0], $account[1]);

			$accounts[$account->getUsername()] = $account;
		}
		fclose($fd);
	}

	return $accounts;
}

function signup($username) { // Saves a new account
	$secret = rand(1, 10); // generate a secret
	$account = $username . ":" . $secret . "\n";

	$fd = fopen("accounts", 'a');
	if ($fd) {
		fwrite($fd, $account);
		fclose($fd);

		return $secret;
	}
	return 0;
}

function userExists($username) { // returns true if a account with that username already exists
    $accounts = readAccounts();
	foreach ($accounts as $account) {
		if ($account->getUsername() == $username) {
			return true;
		}
	}

	return false;
}

function getAccount($username) { // returns the account with that username, otherwhise false
	foreach (readAccounts() as $account) {
		if ($account->getUsername() == $username) {
			return $account;
		}
	}
	return null;
}

?>