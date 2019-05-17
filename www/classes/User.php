<?php
/**
 * Created by PhpStorm.
 * User: Kristaps
 * Date: 16-May-19
 * Time: 13:24
 */

/* Class to handle users */

class User {

    /* Properties */
    public $id = null;
    public $username = null;
    public $email = null;
    public $password = null;

    /* Constructor */
    public function __construct($data = array()) {
        if (isset($data['username'])) $this->username = preg_replace("/[^.,-_'@?!:$ a-zA-Z0-9()]/", "", $data['username']);
        if (isset($data['email'])) $this->email = $data['email'];
        if (isset($data['password'])) $this->password = $data['password'];
    }

    /* Store form */
    public function storeFormValues($params) {
        // Store all the parameters
        $this->__construct($params);
    }

    public static function getUsernameByUsername($usernameVerify) {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "SELECT username FROM users WHERE username = :username";
        $st = $conn->prepare($sql);
        $st->bindValue(":username", $usernameVerify, PDO::PARAM_STR);
        $st->execute();
        $row = $st->fetchColumn();
        $conn = null;
        if ($row) return $row;
    }

    public static function getPasswordByUsername($usernameVerify) {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "SELECT password FROM users WHERE username = :username";
        $st = $conn->prepare($sql);
        $st->bindValue(":username", $usernameVerify, PDO::PARAM_STR);
        $st->execute();
        $row = $st->fetchColumn();
        $conn = null;
        if ($row) return $row;
    }

    public function insert() {

        // Does the Ticket object already have an ID?
        if (!is_null($this->id)) trigger_error("User::insert(): Attempt to insert an User object that already has its ID property set (to $this->id).", E_USER_ERROR);

        // Insert the Ticket
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "INSERT INTO users ( username, email, password) VALUES ( :username, :email, :password)";

        $st = $conn->prepare($sql);

        $st->bindValue(":username", $this->username, PDO::PARAM_STR);
        $st->bindValue(":email", $this->email, PDO::PARAM_STR);
        $st->bindValue(":password", md5($this->password), PDO::PARAM_STR);

        $st->execute();
        $this->id = $conn->lastInsertId();
        $conn = null;
    }

    function encryptPassword( $q ) {
        $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
        $qEncoded      = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
        return( $qEncoded );
    }

    function decryptPassword( $q ) {
        $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
        $qDecoded      = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), base64_decode( $q ), MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ), "\0");
        return( $qDecoded );
    }
}