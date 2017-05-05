<?php

class User extends activeRecord {

    public $username;
    private $email;
    private $passwordHash;

    public function __construct() {
        parent::__construct();
        $this->username = '';
        $this->email = '';
        $this->passwordHash = '';
    }

    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPasswordHash() {
        return $this->passwordHash;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setPasswordHash($passwordHash) {
        $this->passwordHash = md5($passwordHash);
    }

    public function save() {
        if (self::$db->conn != null) {
            if ($this->id == -1) {
                $sql = "INSERT INTO Users (username, email, passwordHash) values (:username, :email, :passwordHash)";
                $stmt = self::$db->conn->prepare($sql); //MySQL inejction preventing during registering new user
                $result = $stmt->execute([
                    'username' => $this->username,
                    'email' => $this->email,
                    'passwordHash' => $this->passwordHash
                ]);



                if ($result == true) {
                    $this->id = self::$db->conn->lastInsertId();
                    return true;
                } else {
                    echo self::$db->conn->error;
                }
            } else {
                $sql = "UPDATE Users SET username = :username, email = :email, passwordHash = :passwordHash WHERE id = $this->id";

                $stmt = self::$db->conn->prepare($sql);
                $result = $stmt->execute([
                    'username' => $this->username,
                    'email' => $this->email,
                    'passwordHash' => $this->passwordHash
                ]);

                if ($result == true) {
                    return true;
                }
            }
        } else {
            echo "Brak polaczenia\n";
        }
        return false;
    }

    static public function loadById($id) {
        self::connect();
        $sql = "SELECT * FROM Users WHERE id=$id";
        $result = self::$db->conn->query($sql);
        if ($result && $result->rowCount() == 1) {
            $row = $result->fetch(PDO::FETCH_ASSOC);
            $loadedUser = new User();
            $loadedUser->id = $row['id'];
            $loadedUser->username = $row['username'];
            $loadedUser->passwordHash = $row['passwordHash'];
            $loadedUser->email = $row['email'];
            return $loadedUser;
        }
        return null;
    }

    static public function loadAll() {
        self::connect();
        $sql = "SELECT * FROM Users";
        $returnTable = [];
        if ($result = self::$db->conn->query($sql)) {
            foreach ($result as $row) {
                $loadedUser = new user();
                $loadedUser->id = $row['id'];
                $loadedUser->username = $row['username'];
                $loadedUser->passwordHash = $row['passwordHash'];
                $loadedUser->email = $row['email'];
                $returnTable[] = $loadedUser;
            }
        }
        return $returnTable;
    }

    public function delete() {
        if ($this->id != -1) {
            if (self::$db->conn->query("DELETE FROM Users WHERE id=$this->id")) {
                $this->id = -1;
                return true;
            }
            return false;
        }
        return true;
    }

    //funkcja ładująca podaną nazwę uzytkownika do sprawdzenia przy rejestracji
    static public function loadByUsername($username) {
        self::connect();
        $sql = "SELECT username FROM Users WHERE username='$username'";
        $result = self::$db->conn->query($sql);
        if ($result && $result->rowCount() == 1) {
            $row = $result->fetch(PDO::FETCH_ASSOC);
            $loadedUser = new User();
            $loadedUser->username = $row['username'];
            return $loadedUser;
        }
        return null;
    }

    static public function loadByEmail($email) {
        self::connect();
        $sql = "SELECT email FROM Users WHERE email='$email'";
        $result = self::$db->conn->query($sql);
        if ($result && $result->rowCount() == 1) {
            $row = $result->fetch(PDO::FETCH_ASSOC);
            $loadedEmail = new User();
            $loadedEmail->email = $row['email'];
            return $loadedEmail;
        }
        return null;
    }

    static public function loadIdByUsername($name) {
        self::connect();
        $sql = "SELECT id FROM Users where username = '$name'";
        $result = self::$db->conn->query($sql);
        if ($result && $result->rowCount() == 1) {
            $row = $result->fetch(PDO::FETCH_ASSOC);
            $loadedUser = new User();
            $loadedUser->id = $row['id'];
            return $loadedUser->id;
        }
        return null;
    }

    static public function verifyPassword($password, $username) {
        $sql = "SELECT passwordHash FROM Users WHERE username = '$username'";
        $result = self::$db->conn->query($sql);

        if ($result->rowCount() == 1) {
            $pass = md5($password);
            $dbPass = $result->fetch();
            if ($dbPass['passwordHash'] == $pass) {
                return true;
            }
        }
        return false;
    }

}


// sql for creating table Users

/*
    CREATE TABLE `Users` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(50) NOT NULL,
    `email` VARCHAR(50) NOT NULL UNIQUE,
    `passwordHash` VARCHAR(255) NOT NULL
);

 */