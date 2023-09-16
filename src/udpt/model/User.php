<?php

require_once 'dbconn.php';

class User
{
    private $UserID;
    private $UserName;
    private $Role;
    private $password;
    private $dbConnection;

    public function __construct($UserID, $UserName, $Role, $password)
    {
        $this->UserID = $UserID;
        $this->UserName = $UserName;
        $this->Role = $Role;
        $this->password = $password;
        $this->dbConnection = dbconn::getInstance()->getConnection();
    }

    // Getter methods

    public function getUserID()
    {
        return $this->UserID;
    }

    public function getUserName()
    {
        return $this->UserName;
    }

    public function getRole()
    {
        return $this->Role;
    }

    public function getPassword()
    {
        return $this->password;
    }

    // Setter methods

    public function setUserID($UserID)
    {
        $this->UserID = $UserID;
    }

    public function setUserName($UserName)
    {
        $this->UserName = $UserName;
    }

    public function setRole($Role)
    {
        $this->Role = $Role;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function login($username, $password)
    {
        $query = "SELECT UserName, password FROM users WHERE UserName = '$username' AND password = '$password'";
        $result = mysqli_query($this->dbConnection, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            return 1; // Login successful
        } else {
            return 0; // Invalid username or password
        }
    }
    public function get_user_by_username($username)
    {
        $query = "SELECT * FROM users WHERE UserName = '$username'";
        $result = mysqli_query($this->dbConnection, $query);
        $user = mysqli_fetch_assoc($result);
        return $user;
    }
    public function get_user_by_id($id)
    {
        $query = "SELECT * FROM users WHERE UserID = '$id'";
        $result = mysqli_query($this->dbConnection, $query);
        $user = mysqli_fetch_assoc($result);
        return $user;
    }
    public function edit($username, $newPassword)
    {
        $query = "UPDATE users SET password = '$newPassword' WHERE UserName = '$username'";
        $result = mysqli_query($this->dbConnection, $query);

        if ($result) {
            return 1; // Edit successful
        } else {
            return 0; // Edit failed
        }
    }

    public function create($username, $password)
    {
        $username = mysqli_real_escape_string($this->dbConnection, $username);
        $password = mysqli_real_escape_string($this->dbConnection, $password);

        $query = "INSERT INTO user (UserName, password) VALUES ('$username', '$password')";
        $result = mysqli_query($this->dbConnection, $query);

        if ($result) {
            return 1; // Create successful
        } else {
            return 0; // Create failed
        }
    }

    public function delete($username)
    {
        $username = mysqli_real_escape_string($this->dbConnection, $username);

        $query = "DELETE FROM users WHERE UserName = '$username'";
        $result = mysqli_query($this->dbConnection, $query);

        if ($result) {
            return 1; // Delete successful
        } else {
            return 0; // Delete failed
        }
    }
    public function list_user()
    {
        $query = "SELECT * FROM users";
        $result = mysqli_query($this->dbConnection, $query);

        $userList = array(); // Mảng chứa danh sách câu hỏi

        while ($row = mysqli_fetch_assoc($result)) {
            $userList[] = $row; // Thêm bản ghi vào mảng
        }
        return $userList;
    }
}
