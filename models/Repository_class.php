<?php
require_once 'Database_connection_class.php';
require_once 'User_class.php';

//This repository connects to the database automatically and has functions to fetch all items from User, Profile and Statistics tables 
class Repository {
    private $db;

    public function __construct() {
        $database = new Database_connection();
        $this->db = $database->getConnection();
    }

    // Fetch all items
    public function fetchAllUsers() {
        $query = 'SELECT * FROM user';
        $statement = $this->db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        return $results;
    }

    // Fetch all user names (just the column!!)
    public function fetchAllUserNames() {
        $query = 'SELECT username FROM user';
        $statement = $this->db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_COLUMN);
        $statement->closeCursor();
        return $results;
    }

    // Fetch all profiles
    public function fetchAllProfiles() {
        $query = 'SELECT * FROM profile';
        $statement = $this->db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        return $results;
    }

    // Fetch all Statistics
    public function fetchAllStatistics() {
        $query = 'SELECT * FROM statistics';
        $statement = $this->db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        return $results;
    }

     // Get user by user_id
 public function getUser($user_id) {
    $query = 'SELECT * FROM user WHERE user_id = :user_id';
    $statement = $this->db->prepare($query);
    $statement->bindValue(':user_id', $user_id);
    $statement->execute();
    $results = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();
    return $results;
}

     // Create User
     public function createUser(User $new_user) {
        try {
          $query = 'INSERT INTO User (username, password, email, first_name, last_name) 
                    VALUES (:username, :password, :email, :first_name, :last_name)';
          $statement = $this->db->prepare($query);
          $statement->bindValue(':username', $new_user->getUsername());
          $statement->bindValue(':password', $new_user->getPassword());
          $statement->bindValue(':email', $new_user->getEmail());
          $statement->bindValue(':first_name', $new_user->getFirstName());  // Use getFirstName()
          $statement->bindValue(':last_name', $new_user->getLastName());  // Use getLastName()
          $statement->execute();
          $statement->closeCursor();
          echo "<b> Successful User Creation 😁. </b> Welcome " . $new_user->getFirstName() . "<br>";
        } catch (PDOException $e) {
          throw new Exception("Error adding item: " . $e->getMessage());
        }
      }

    //Getting the Id with the email
    public function getUserId($email) {
        $query = 'SELECT user_id FROM User WHERE email = :email';
        $statement = $this->db->prepare($query);
        $statement->bindValue(':email', $email);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        if ($result) {
            return $result['user_id'];
        } else {
            return null; // or handle the case where no user is found
        }
    }

    public function getUserByCredential($credential) {
        $query = 'SELECT * FROM User WHERE email = :credential OR username = :credential';
        $statement = $this->db->prepare($query);
        $statement->bindValue(':credential', $credential);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        return $result;
    }

    // Get profile by user_id
    public function getUserProfile($user_id) {
        $query = 'SELECT * FROM Profile WHERE user_id = :user_id';
        $statement = $this->db->prepare($query);
        $statement->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        
        if ($result) {
            return $result;
        } else {
            throw new Exception("Profile not found for user ID: $user_id");
        }
    }


// Create new Profile
public function createProfile($user_id, Profile $new_profile) {
    try {
        $query = 'INSERT INTO Profile (user_id, age, gender, height, weight, activity_level, desired_objective) 
                  VALUES (:user_id, :age, :gender, :height, :weight, :activity_level, :desired_objective)';
        $statement = $this->db->prepare($query);
        $statement->bindValue(':user_id', $user_id);
        $statement->bindValue(':age', $new_profile->getAge());
        $statement->bindValue(':gender', $new_profile->getGender());
        $statement->bindValue(':height', $new_profile->getHeight());
        $statement->bindValue(':weight', $new_profile->getWeight());
        $statement->bindValue(':activity_level', $new_profile->getActivityLevel());
        $statement->bindValue(':desired_objective', $new_profile->getDesiredObjective());
        $statement->execute();
        $statement->closeCursor();
        echo "<b>Successful Profile Creation 😁.</b> Profile has been created.<br>";
    } catch (PDOException $e) {
        throw new Exception("Error adding profile: " . $e->getMessage());
    }
}
}


?>
