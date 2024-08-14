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

// Validate username uniqueness
    public function usernameExists($username) {
        $query = 'SELECT COUNT(*) FROM User WHERE username = :username';
        $statement = $this->db->prepare($query);
        $statement->bindValue(':username', $username);
        $statement->execute();
        $count = $statement->fetchColumn();
        $statement->closeCursor();
        return $count > 0;
    }
// Validate email uniqueness
    public function emailExists($email) {
        $query = 'SELECT COUNT(*) FROM User WHERE email = :email';
        $statement = $this->db->prepare($query);
        $statement->bindValue(':email', $email);
        $statement->execute();
        $count = $statement->fetchColumn();
        $statement->closeCursor();
        return $count > 0;
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
    // Get User by credential, either username or email
    public function getUserByCredential($credential) {
        $query = 'SELECT * FROM User WHERE email = :credential OR username = :credential';
        $statement = $this->db->prepare($query);
        $statement->bindValue(':credential', $credential);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        return $result;
    }

    // Edit User Account Information, either username or email
    public function updateUser($email, $updated_data) {
        try {
            $query = 'UPDATE User SET username = :username, password = :password, first_name = :first_name, last_name = :last_name WHERE email = :email';
            $statement = $this->db->prepare($query);
            $statement->bindValue(':username', $updated_data['username']);
            $statement->bindValue(':password', $updated_data['password']);
            $statement->bindValue(':first_name', $updated_data['first_name']);
            $statement->bindValue(':last_name', $updated_data['last_name']);
            $statement->bindValue(':email', $email);
            $result = $statement->execute();
            $statement->closeCursor();
            return $result;
        } catch (PDOException $e) {
            throw new Exception("Error updating user: " . $e->getMessage());
        }
    }
    

    
    
    // Deleting User Account
        public function deleteUser($user_id) {
            try {
                $query = 'DELETE FROM User WHERE user_id = :user_id';
                $statement = $this->db->prepare($query);
                $statement->bindValue(':user_id', $user_id, PDO::PARAM_INT);
                $statement->execute();
                $statement->closeCursor();
                return true; // Return true on successful deletion
            } catch (PDOException $e) {
                throw new Exception("Error deleting user: " . $e->getMessage());
            }
        }

    

    // Get profile by user_id
   
    public function getUserProfile($user_id) {
        $query = 'SELECT * FROM Profile WHERE user_id = :user_id';
        $statement = $this->db->prepare($query);
        $statement->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $statement->execute();
        $profile = $statement->fetch(PDO::FETCH_ASSOC);
        $statement->closeCursor();
    
        return $profile ? $profile : null; // Return null if no profile is found this is important to redirect if it does not exist
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
        return true; // Ensure the function returns true on success to redirect to user_home.php
    } catch (PDOException $e) {
        throw new Exception("Error adding profile: " . $e->getMessage());
    }
}

// Edit Profile
    public function updateProfile($user_id, $updated_data) {
        try {
            $query = 'UPDATE Profile 
                    SET age = :age, gender = :gender, height = :height, weight = :weight, activity_level = :activity_level, desired_objective = :desired_objective 
                    WHERE user_id = :user_id';
            $statement = $this->db->prepare($query);
            $statement->bindValue(':age', $updated_data['age']);
            $statement->bindValue(':gender', $updated_data['gender']);
            $statement->bindValue(':height', $updated_data['height']);
            $statement->bindValue(':weight', $updated_data['weight']);
            $statement->bindValue(':activity_level', $updated_data['activity_level']);
            $statement->bindValue(':desired_objective', $updated_data['desired_objective']);
            $statement->bindValue(':user_id', $user_id);
            $result = $statement->execute();
            $statement->closeCursor();
            return $result;
        } catch (PDOException $e) {
            throw new Exception("Error updating profile: " . $e->getMessage());
        }
    }

// Update Desired Objective
public function updateObjective($user_id, $desired_objective) {
    try {
        $query = 'UPDATE Profile SET desired_objective = :desired_objective WHERE user_id = :user_id';
        $statement = $this->db->prepare($query);
        $statement->bindValue(':desired_objective', $desired_objective);
        $statement->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $result = $statement->execute();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        throw new Exception("Error updating desired objective: " . $e->getMessage());
    }
}
// Delete Profile, function for Admins only
public function deleteProfile($user_id) {
    $query = 'DELETE FROM Profile WHERE user_id = :user_id';
    $statement = $this->db->prepare($query);
    $statement->bindValue(':user_id', $user_id);
    $statement->execute();
    $statement->closeCursor();
}


// Add Progress - Inserts rows into Statistics table in the db
public function addProgress($user_id, $progressData) {
    try {
        $query = 'INSERT INTO Statistics (user_id, date, weight, calorie_intake, protein, carbs, fats) 
                  VALUES (:user_id, :date, :weight, :calorie_intake, :protein, :carbs, :fats)';
        $statement = $this->db->prepare($query);
        $statement->bindValue(':user_id', $user_id);
        $statement->bindValue(':date', $progressData['date']);
        $statement->bindValue(':weight', $progressData['weight']);
        $statement->bindValue(':calorie_intake', $progressData['calorie_intake'], PDO::PARAM_INT); // PARAM_INT because query should not attempt to insert an empty string into a DECIMAL column.
        $statement->bindValue(':protein', $progressData['protein'], PDO::PARAM_INT);
        $statement->bindValue(':carbs', $progressData['carbs'], PDO::PARAM_INT);
        $statement->bindValue(':fats', $progressData['fats'], PDO::PARAM_INT);
        $statement->execute();
        $statement->closeCursor();
        return true;
    } catch (PDOException $e) {
        throw new Exception("Error adding progress info: " . $e->getMessage());
    }
}

     // Get User Statistics Ordered by date
     public function getUserStatistics($user_id) {
        $query = 'SELECT * FROM Statistics WHERE user_id = :user_id ORDER BY date DESC'; // ASC for ascending order
        $statement = $this->db->prepare($query);
        
        // Bind the :user_id parameter to the actual user_id value
        $statement->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        
        return $results;
    }
    // Get User Statistics Ordered by date Limited to 5 entries for User Dashboard
    public function getLast5UserStatistics($user_id) {
        $query = 'SELECT * FROM Statistics WHERE user_id = :user_id ORDER BY date DESC LIMIT 5';
        $statement = $this->db->prepare($query);
        $statement->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        return $results;
    }
    // Get User Statistics paginated (6 per page)
    public function getUserStatisticsPaginated($user_id, $limit, $offset) {
        $query = 'SELECT * FROM Statistics WHERE user_id = :user_id ORDER BY date DESC LIMIT :limit OFFSET :offset';
        $statement = $this->db->prepare($query);
        $statement->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $statement->bindValue(':limit', $limit, PDO::PARAM_INT);
        $statement->bindValue(':offset', $offset, PDO::PARAM_INT);
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        return $results;
    }
    // Get User Statistics Count
    public function getTotalStatisticsCount($user_id) {
        $query = 'SELECT COUNT(*) FROM Statistics WHERE user_id = :user_id';
        $statement = $this->db->prepare($query);
        $statement->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $statement->execute();
        $total_records = $statement->fetchColumn();
        $statement->closeCursor();
        return $total_records;
    }
    
    // Function to delete a statistic
    public function deleteStatistic($stat_id) {
        $query = 'DELETE FROM Statistics WHERE stat_id = :stat_id';
        $statement = $this->db->prepare($query);
        $statement->bindValue(':stat_id', $stat_id);
        $statement->execute();
        $statement->closeCursor();
    }



}


?>
