<?php
// Localhost
// $dsn = 'mysql:host=localhost; dbname=db_fitform';
// $username = 'root';
// $password = '1234';
// $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);


// AZURE DB
$dsn = 'mysql:host=rogersql.mysql.database.azure.com;dbname=db_fitform;sslmode=require';
$username = 'mysql';
$password = 'ask db admin';
$ssl_cert = './SSLcert/MicrosoftRSARootCertificateAuthority2017.crt';

$options = array(
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  PDO::MYSQL_ATTR_SSL_CA => $ssl_cert,
  PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false
);

try {                                     
  $db = new PDO ($dsn, $username, $password, $options);
  echo "Database Connected!😁";
  $query = 'SELECT * FROM User';
  $statement = $db->prepare($query);
  $statement->execute();
  $results = $statement->fetchAll();
  $statement->closeCursor();
 
  // Print results
  if ($results) {
    echo "<h2>Users Table</h2>
            <table border='1'>
            <tr>
                <th>User ID</th>
                <th>Username</th>
                <th>Email</th>
            </tr>";
    
    foreach ($results as $row) {
      echo "<tr>
              <td>{$row['user_id']}</td>
              <td>{$row['username']}</td>
              <td>{$row['email']}</td>
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

try {                                     
    $db = new PDO ($dsn, $username, $password, $options);
    echo " <br>Database Connected!😁";
    $query = 'SELECT * FROM Profile';
    $statement = $db->prepare($query);
    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closeCursor();
   
    // Print results
    if ($results) {
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
      
      foreach ($results as $row) {
        echo "<tr>
                <td>{$row['user_id']}</td>
                <td>{$row['weight']}</td>
                <td>{$row['height']}</td>
                <td>{$row['age']}</td>
                <td>{$row['activity_level']}</td>
                <td>{$row['desired_objective']}</td>
              </tr>";
      }
      
      echo "</table>";
    } else {
      echo "No items found.";
    }
  
  } catch (PDOException $e) {
  
    $error_message = $e->getMessage();
    echo "<p>Error connecting to database: $error_message </p>";
  
  } 


  try {                                     
    $db = new PDO ($dsn, $username, $password, $options);
    echo " <br>Database Connected!😁";
    $query = 'SELECT * FROM Statistics';
    $statement = $db->prepare($query);
    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closeCursor();
   
    // Print results
    if ($results) {
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
      
      foreach ($results as $row) {
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
      
      echo "</table>";
    } else {
      echo "No items found.";
    }
  
  } catch (PDOException $e) {
  
    $error_message = $e->getMessage();
    echo "<p>Error connecting to database: $error_message </p>";
  
  } 





exit();


?>



