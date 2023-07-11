<?php

class User extends Database
{
    private $id;
    private $email;
    private $firstName;
    private $lastName;
    private $userName;
    private $password;

    public function __construct()
    {
        // code here...
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * @param mixed $userName
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function saveUserInfo()
    {
        $insertUserQuery =
            "INSERT INTO user_info (email, first_name, last_name, username, password) VALUES (?, ?, ?, ?, ?)";
        $mysqliStatement = mysqli_prepare($this->getConnection(), $insertUserQuery);
        mysqli_stmt_bind_param(
            $mysqliStatement,
            'sssss',
            $this->email,
            $this->firstName,
            $this->lastName,
            $this->userName,
            $this->password);
        if (mysqli_stmt_execute($mysqliStatement)) {
            echo "Insert successfully";
        } else {
            echo "Insert failed: " . mysqli_stmt_error($mysqliStatement);
        }
    }


}
