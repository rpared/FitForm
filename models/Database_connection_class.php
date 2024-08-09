<?php
require_once 'password.php'; // Remove this dependency if a local database is being created 

class Database_connection {
    //ROGER's AZURE DATABASE - // Replace variables in lines 6-8 if a local database is being created (This info will not be available once the repository is public)
    private $dsn = 'mysql:host=rogersql.mysql.database.azure.com;dbname=db_fitform;sslmode=require';
    private $username = 'mysql';
    private $password;

    // Localhost > Example of how to replace variables if a local database is being created: 
    // run models/db_fitform_CreationQuery.sql file in your mySQL tool to create the required schema.
    // private $dsn = 'mysql:host=localhost; dbname=db_fitform';
    // private $username = 'root';
    // private $password = '1234';

    private $ssl_cert = './SSLcert/MicrosoftRSARootCertificateAuthority2017.crt'; //SSL certificate
    private $options;
    private $db;

    public function __construct() {
        $this->password = getPassword(); // Remove line if a local database is being created 
        $this->options = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::MYSQL_ATTR_SSL_CA => $this->ssl_cert,
            PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false
        );

        try {
            $this->db = new PDO($this->dsn, $this->username, $this->password, $this->options);
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Error connecting to database ☹️: $error_message </p>";
            exit();
        }
    }

    public function getConnection() {
        return $this->db;
    }
}

?>
