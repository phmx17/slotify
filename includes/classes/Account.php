<?php
 class Account {

   private $con;
   private $errorArray;

   public function __construct($con) {
      $this->con = $con;
      $this->errorArray = array();
   }

    /**
    * run validation on all inputs and insert into DB
    */  
    public function register($un, $fn, $ln, $em, $em2, $pw, $pw2) {
      $this->validateUsername($un);
      $this->validateFirstName($fn);
      $this->validateLastName($ln);
      $this->validateEmails($em, $em2);
      $this->validatePasswords($pw, $pw2);

      if(empty($this->errorArray)) {
        // insert into db
        return $this->insertUserDetails($un, $fn, $ln, $em, $pw);
      } else {
        return false;
      }
    }

    // getError gets called from register.php <form>
    public function getError($error) {
      if (!in_array($error, $this->errorArray)) {
        $error = "";
      }
      return "<span class='errorMessage'>$error</span>"; 
    }

    /**
     * Insert User Details
     */
     private function insertUserDetails($un, $fn, $ln, $em, $pw) {
        $encryptedPw = md5($pw);  // encrypt using method md-5
        $profilePic = "assets/images/profile-pics/profilePic-126px.jpg";
        $date = date('d-m-Y');
        // debugging: this would display all values if there was an error in submitting
        // echo "INSERT INTO users VALUES ('', '$un', '$fn', '$ln', '$em', '$encryptedPw', '$date', '$profilePic')";
        $result = mysqli_query($this->con, "INSERT INTO users VALUES ('', '$un', '$fn', '$ln', '$em', '$encryptedPw', '$date', '$profilePic')");
        return $result; // $result is boolean
     }




    private function validateUsername($un) {
      if(strlen($un) > 25 || strlen($un) < 5) {
        array_push($this->errorArray, Constants::$usernameCharacters);  // imported in register.php
        return;
      }
      // check if username exists
      $checkUsernameQuery = mysqli_query($this->con, "SELECT username FROM users WHERE username='$un'");
      if (mysqli_num_rows($checkUsernameQuery) != 0) {  // if there is an entry push error
        array_push($this->errorArray, Constants::$usernameTaken);  // imported in register.php
        return;
      }
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
    private function validateEmails($em, $em2) {
      if ($em !=$em2) {
        array_push($this->errorArray, Constants::$emailsDoNotMatch);
        return;
      }
      if (!filter_var($em, FILTER_VALIDATE_EMAIL)) {  // "email" in form only checks for '@'
        array_push($this->errorArray, Constants::$emailInvalid);        
        return;
      }
      $checkEmailQuery = mysqli_query($this->con, "SELECT email FROM users WHERE email='$em'");
      if (mysqli_num_rows($checkEmailQuery) != 0) {  // if there is an entry push error
        array_push($this->errorArray, Constants::$emailTaken);  // imported in register.php
        return;
      }


      // TODO: check username not taken yet
    }
    private function validatePasswords($pw, $pw2) {
      if ($pw != $pw2) {
        array_push($this->errorArray, Constants::$passwordsDoNotMatch);
        return;
      }
      if (preg_match('/[^A-Za-z0-9]/', $pw)){ // ^ means 'not'; ie if $pw does not fall into alphanumeric range
        array_push($this->errorArray, Constants::$passwordNotAlphanumeric);
        return;
      }
      if(strlen($pw) > 30 || strlen($pw) < 5) {
        array_push($this->errorArray, Constants::$passwordCharacters);
        return;
      }

    }      
   
 }
?>