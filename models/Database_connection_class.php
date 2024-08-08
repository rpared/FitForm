<?php
require_once 'password.php'; // Remove dependency if a local database is being created 

class Database_connection {
    //ROGER's AZURE DATABASE - // Remove lines 6-8 if a local database is being created 
    private $dsn = 'mysql:host=rogersql.mysql.database.azure.com;dbname=db_fitform;sslmode=require';
    private $username = 'mysql';
    private $password;

    // Localhost // Uncomment lines 12-14 and replace variables if a local database is being created 
    // run models/db_fitform_CreationQuery.sql to create database
    // $dsn = 'mysql:host=localhost; dbname=db_fitform';
    // $username = 'root';
    // $password = '1234';

    private $ssl_cert = './SSLcert/MicrosoftRSARootCertificateAuthority2017.crt';
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
