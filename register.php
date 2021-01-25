<?php
  include('includes/config.php');
  include('includes/classes/Account.php');
  include('includes/classes/Constants.php');

  $account = new Account($con); // gets access from Account.php; $account gets passed to register-handler.php
  include('includes/handlers/register-handler.php');  // will access:  $account->register();
  include('includes/handlers/login-handler.php'); // includes work like pasting code

  // populate input field if value available
  function getInputValue($name) {
    if (isset($_POST[$name])) {
      echo $_POST[$name];
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome to Slotify</title>
</head>
<body>
  <div id="inputContainer">
  <form id="loginForm" action="register.php" method="POST">
    <h2>Login to your account</h2>
    
    <p>      
      <label for="loginUsername">Username</label>
      <input id="loginUsername" type="text" name="loginUsername" placeholder="e.g. Bart Simpson" required/>
    </p>

    <p>
      <label for="loginPassword">Password</label>
      <input id="loginPassword" type="password" name="loginPassword"placeholder="Your password"required/>
    </p>

    <button type="submit" name="loginButton">LOG IN</button>
  </form>

  <form id="registerForm" action="register.php" method="POST">
    <h2>Create your free account</h2>

    <p>
      <?php echo $account->getError(Constants::$usernameCharacters); ?>
      <?php echo $account->getError(Constants::$usernameTaken); ?>
      <label for="username">Username</label>
      <input id="username" type="text" name="username" placeholder="e.g. BartSimpson" required value="<?php echo getInputValue('username'); ?>"/>
    </p>

    <p>
    <?php echo $account->getError(Constants::$firstNameCharacters)?>
      <label for="firstName">First name</label>
      <input id="firstName" type="text" name="firstName" placeholder="e.g. Bart" required value="<?php echo getInputValue('firstName'); ?>"/>
    </p>

    <p>
      <?php echo $account->getError(Constants::$lastNameCharacters)?>
      <label for="lastName">Last name</label>
      <input id="lastName" type="text" name="lastName" placeholder="e.g. Simpson" required value="<?php echo getInputValue('lastName'); ?>"/>
    </p>

    <p>
      <?php echo $account->getError(Constants::$emailInvalid)?>
      <?php echo $account->getError(Constants::$emailTaken)?>
      <label for="email">Email</label>
      <input id="email" type="email" name="email" placeholder="e.g. bartsimpson@gmail.com" required value="<?php echo getInputValue('email'); ?>"/>
    </p>

    <p>
      <?php echo $account->getError(Constants::$emailsDoNotMatch)?>
      <label for="email2">Confirm Email</label>
      <input id="email2" type="email" name="email2" required required value="<?php echo getInputValue('email2'); ?>"/>
    </p>

    <p>
      <?php echo $account->getError(Constants::$passwordNotAlphanumeric)?>
      <?php echo $account->getError(Constants::$passwordCharacters)?>
      <label for="password">Password</label>
      <input id="password" type="password" name="password" placeholder="Your password" required/>
    </p>

    <p>
      <?php echo $account->getError(Constants::$passwordsDoNotMatch)?>
      <label for="password2">Confirm password</label>
      <input id="password2" type="password" name="password2" required/>
    </p>

    <button type="submit" name="registerButton">SIGN UP</button>
  </form>

  </div>
</body>
</html>