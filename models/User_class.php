<?php

class User {


    private $username;
    private $password;
    private $email;
    private $first_name;
    private $last_name;
  
    public function __construct($username, $password, $email, $first_name, $last_name) {

      $this->username = $username;
      $this->password = $password;
      $this->email = $email;
      $this->first_name = $first_name;
      $this->last_name = $last_name;
    }
  
    // Getters for each attribute
  
    public function getUsername() {
      return $this->username;
    }
  
    public function getPassword() {
      return $this->password;
    }
  
    public function getEmail() {
      return $this->email;
    }

    public function getFirstName() {
      return $this->first_name;
    }

    public function getLastName() {
      return $this->last_name;
    }
    
  
    // Setters for each attribute (optional, need validation)
    public function setUsername($username) {
      $this->username = $username;
    }
  
    public function setEmail($email) {
      $this->email = $email;
    }
  }


?>