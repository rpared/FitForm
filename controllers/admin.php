<?php
require_once '../models/Repository_class.php';
// This file will display all recors from the tables in the Database

$repository = new Repository();


echo "<h1>Admin page</h1> <p>Displays all records from the tables in the Database.";
# Returning All Users
try{
$users = $repository->fetchAllUsers();
// var_dump($users);
if ($users) {
    echo "<h2>Users Table</h2>
            <table border='1'>
            <tr>
                <th>User ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>First Name</th>
                <th>Last Name</th>
            </tr>";
    
    foreach ($users as $row) {
      echo "<tr>
              <td>{$row['user_id']}</td>
              <td>{$row['username']}</td>
              <td>{$row['email']}</td>
              <td>{$row['first_name']}</td>
              <td>{$row['last_name']}</td>
            </tr>";
    }
    
    echo "</table><br>";
  } else {
    echo "No items found.";
  }

} catch (PDOException $e) {

    $error_message = $e->getMessage();
    echo "<p>Error connecting to database: $error_message </p>";
  
  };  

# Returning All Profiles
  try {             
    $profiles = $repository->fetchAllProfiles();
    // var_dump($profiles);                        

    // Print results
    if ($profiles) {
      echo "<h2>Profile Table</h2>
              <table border='1'>
              <tr>
                  <th>User ID</th>
                  <th>weight</th>
                  <th>height</th>
                  <th>age</th>
                  <th>activity_level</th>
                  <th>desired_objective</th>
              </tr>";
      
      foreach ($profiles as $row) {
        echo "<tr>
                <td>{$row['user_id']}</td>
                <td>{$row['weight']}</td>
                <td>{$row['height']}</td>
                <td>{$row['age']}</td>
                <td>{$row['activity_level']}</td>
                <td>{$row['desired_objective']}</td>
              </tr>";
      }
      
      echo "</table><br>";
    } else {
      echo "No items found.";
    }
  
  } catch (PDOException $e) {
  
    $error_message = $e->getMessage();
    echo "<p>Error connecting to database: $error_message </p>";
  
  }; 

#Returning all Statistics
  try {                                     
    $statistics = $repository->fetchAllStatistics();
    // var_dump($statistics); 
    if ($statistics) {
      echo "<h2>Statistics Table</h2>
              <table border='1'>
              <tr>
                  <th>stat_id</th>
                  <th>user_id</th>
                  <th>date</th>
                  <th>weight</th>
                  <th>calorie_intake</th>
                  <th>protein</th>
                  <th>carbs</th>
                  <th>fats</th>
              </tr>";
      
      foreach ($statistics as $row) {
        echo "<tr>
                <td>{$row['stat_id']}</td>
                <td>{$row['user_id']}</td>
                <td>{$row['date']}</td>
                <td>{$row['weight']}</td>
                <td>{$row['calorie_intake']}</td>
                <td>{$row['protein']}</td>
                <td>{$row['carbs']}</td>
                <td>{$row['fats']}</td>
              </tr>";
      }
      
      echo "</table><br>";
    } else {
      echo "No items found.";
    }
  
  } catch (PDOException $e) {
  
    $error_message = $e->getMessage();
    echo "<p>Error connecting to database: $error_message </p>";
  
  } 

?>