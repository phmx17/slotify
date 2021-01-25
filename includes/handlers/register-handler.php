<?php

function sanitizeFormPassword($inputText) {
  $inputText = strip_tags($inputText);  // remove any html elements
  return $inputText;
}

function sanitizeFormUsername($inputText) {
  $inputText = strip_tags($inputText);  // remove any html elements
  $inputText = str_replace(' ', '', $inputText);  // remove spaces
  return $inputText;
}

function sanitizeFormString($inputText) {
  $inputText = strip_tags($inputText);  // remove any html elements
  $inputText = str_replace(' ', '', $inputText);
  $inputText = ucfirst(strtolower($inputText)); // make all lower and upper first
  return $inputText;
}

function sanitizeEmail($inputText) {
  $inputText = strip_tags($inputText);  // remove any html elements
  $inputText = str_replace(' ', '', $inputText);
  $inputText = strtolower($inputText); // make all lower and upper first
  return $inputText;
}

if (isset($_POST['loginButton'])) {
  
}
if (isset($_POST['registerButton'])) {
  $username = sanitizeFormUsername($_POST['username']);
  $firstName = sanitizeFormString($_POST['firstName']);
  $lastName = sanitizeFormString($_POST['lastName']);
  $email = sanitizeEmail($_POST['email']);
  $email2 = sanitizeEmail($_POST['email2']);
  $password = sanitizeFormPassword($_POST['password']);
  $password2 = sanitizeFormPassword($_POST['password2']);
  
  $wasSuccessful = $account->register($username, $firstName, $lastName, $email, $email2, $password, $password2);  // returns boolean
  if ($wasSuccessful) {
    header('Location: index.php');
  }
}




?>