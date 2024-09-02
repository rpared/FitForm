<?php
// require_once 'password.php'; // Remove this dependency if a local database is being created 

class Database_connection {

    // Localhost > Example of how to replace variables if a local database is being created: 
    // run models/db_fitform_CreationQuery.sql file in your mySQL tool to create the required schema.
    // private $dsn = 'mysql:host=localhost; dbname=db_fitform';
    // private $username = 'root';
    // private $password = '';

    // private $ssl_cert = './SSLcert/MicrosoftRSARootCertificateAuthority2017.crt'; //SSL certificate
    // private $options;
    private $db;

    // //costra.ec - dattatec database:
    private $dbhost = 'localhost';
    private $dbuser = 'ml000558_fitform';
    private $dbpass = 'fbpvlnvjaofkh3D';
    private $dbname = 'ml000558_fitform';
    
    public function __construct() {
        try {
            $this->db = new PDO("mysql:host={$this->dbhost};dbname={$this->dbname};charset=utf8", $this->dbuser, $this->dbpass);
            // Set the PDO error mode to exception
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "<p>Connected to the database successfully 😊</p>";
        } catch (PDOException $e) {
            echo "<p>Error connecting to database ☹️: " . $e->getMessage() . "</p>";
        }
    }


    public function getConnection() {
        return $this->db;
    }
}

?>
