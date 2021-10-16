<?php

// add parameters
function signup(){          //function to sign up user
	if(count($_POST)>0){        //check if data exists
		// check if the fields are empty
		if (empty($_POST['email'] || empty($_POST['password']))) {
			echo 'Email or password is missing';
		}
		else {
			// check if the email is valid
			if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
				echo('Your email is invalid');
			}
			else{
				// check if password length is between 8 and 16 characters
				if(strlen($_POST['password'])<8 || strlen($_POST['password'])>16) {
					echo('Please enter a password between 8 and 16 characters');
				}
				else {
					// check if the password contains at least 2 special characters
					$sc=['#','@','&','*'];
					$hasSC=false;
					foreach($sc as $c){
						if(strstr($_POST['password'],$c)) $hasSC=true;
					}
					if(!$hasSC) {
						echo'Please add a special character to your password: (#@&*)';
					}
					else {
						if(!file_exists('banned.csv')) die ('The banned file does not exist');
						$banEmail=[];
						if (($handle = fopen('banned.csv', 'r')) !== FALSE) { // Check the resource is valid
							while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) { // Check opening the file is OK!
								//print_r($data);
								$banEmail[]= $data;// Array
							}
							fclose($handle);
						}
						if ($banEmail[0][0]==$_POST['email'] || $banEmail[1][0]==$_POST['email'] || $banEmail[2][0]==$_POST['email']) {
							echo 'Email is banned.';
						}
						else{

							$file = file_get_contents('users.csv');
							if (strpos($file, $_POST['email']) !== false) {
								echo 'email is already registered';
							}
							else {
								$newUser = array(
									[$_POST['email'],password_hash($_POST['password'],PASSWORD_DEFAULT)]
								);
								$handle =fopen('users.csv','a');
								foreach ($newUser as $fields) {
									fputcsv($handle, $fields,';');
								}
								fclose($handle);
							}
						}
					}
				}
			}
		}
	}
}

// add parameters
function signin(){
	if(count($_POST)>0){
		if (!empty($_POST['email'] && !empty($_POST['password']))) {          //check if data exists
			// 2. check if the email is well formatted
			// 3. check if the password is well formatted
			if(!file_exists('banned.csv')) die ('The banned file does not exist');
			$banEmail=[];
			if (($handle = fopen('banned.csv', 'r')) !== FALSE) { // Check the resource is valid
				while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) { // Check opening the file is OK!
					//print_r($data);
					$banEmail[]= $data;// Array
				}
				fclose($handle);
			}
			if ($banEmail[0][0]==$_POST['email'] || $banEmail[1][0]==$_POST['email'] || $banEmail[2][0]==$_POST['email']) {
				('Email is banned.');
			}
			else{
				if (!file_exists('users.csv')) die ('The user file does not exist');

				$userInfo=[];
				if (($handle = fopen('users.csv', 'r')) !== FALSE) { // Check the resource is valid
					while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) { // Check opening the file is OK!
						//print_r($data);
						$userInfo[]= $data;// Array
					}
					fclose($handle);
				}
				$file = file_get_contents('users.csv');
				$userArray = explode(';',$file);
				//print_r($userInfo);
				//echo(count($userInfo));
				if (strpos($file, $_POST['email']) !== false) {
					for($x=0; $x<=count($userInfo)-1; $x++) {
						if(password_verify($_POST['password'], $userInfo[$x][1]) !== false) {
							$_SESSION['logged']=true;
							echo "You have logged in";
							header("location: ../index.php");
						}
					}
				}
			}
		}
	}
}

function signout(){          //sign a user out if they are logged. return them to index.
	if($_SESSION['logged']==false) {
	  header('location: ../index.php');
	}
	if ($_SESSION['logged']==true) {
	  $_SESSION['logged']=false;
	  session_destroy();
	  header('location: ../index.php');
	}
}

function is_logged(){
	if(isset($_SESSION['logged'])) {         //check if logged exists and is true.
	if ($_SESSION['logged']==true) {
		return true;
	}
	else {
		return false;
	}
}
}
