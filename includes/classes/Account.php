<?php 

	class Account {

		private $errorArray;


		public function __construct() {
			$this->errorArray = array();
		}

		public function register($un, $fn, $ln, $em, $cem, $pw, $cpw) {

			$this->validateUsername($un);
			$this->validateFirstName($fn);
			$this->validateLastName($ln);
			$this->validateEmails($em, $cem);
			$this->validatePasswords($pw, $cpw);

			if (empty($this->errorArray)) {
				//insert into database
				return true;
			} else {
				return false;
			}
		}

		public function getError($error) {
			if(!in_array($error, $this->errorArray)) {
				$error ="";
			}
			return "<span class='errorMessage'>$error</span>";
		}

		private function validateUsername($un) {

			if(strlen($un) > 25 || strlen($un) < 5) {
				array_push($this->errorArray, Constants::$usernameCharacters);
				return;
			}

			//TODO: check if username exists

		}

		private function validateFirstName($fn) {
			if(strlen($fn) > 25 || strlen($fn) < 2) {
				array_push($this->errorArray, Constants::$firstNameCharacters);
				return;
			}
		}

		private function validateLastName($ln) {
			if(strlen($ln) > 25 || strlen($ln) < 2) {
				array_push($this->errorArray, Constants::$lastNameCharacters);
				return;
			}
		}

		private function validateEmails($em, $cem) {
			if($em != $cem) {
				array_push($this->errorArray, Constants::$emailDoNotMatch);
				return;
			}

			if(!filter_var($em, FILTER_VALIDATE_EMAIL)) {
				array_push($this->errorArray, Constants::$emailInvaild);
				return;
			}

			//TODO: check that username hasn't already been used
		}

		private function validatePasswords($pw, $cpw) {
			if($pw != $cpw) {
				array_push($this->errorArray, Constants::$passwordDoNotMatch);
				return;
			}

			if(preg_match('/[^A-Za-z0-9]/', $pw)) {
				array_push($this->errorArray, Constants::$passwordNotAlphanumeric);
				return;
			}
			if(strlen($pw) > 20 || strlen($pw) < 5) {
				array_push($this->errorArray, Constants::$passwordCharacters);
				return;
			}
		}

	}

?>