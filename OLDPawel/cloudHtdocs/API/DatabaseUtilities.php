<?php
/**
 * Created by PhpStorm.
 * User: Pawel
 * Date: 30/04/2018
 * Time: 16:43
 */

require_once("_dbCon.php");
include ("Login.php");

if (version_compare(phpversion(), '5.4.0', '<')) {
    if(session_id() == '') {
        session_start();
    }
}
else
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
}


class DatabaseUtilities
{

    public function Login()
    {
        $login = null;
        $email = null;
        $password = null;
        $database = null;
        $connection = null;
        $query = null;

        try {
            $login = new Login();
            $email = $login->getEmail();
            $password = $login->getPassword();
            $database = new Database;
            $connection = $database ->getConnection();

            $query = "SELECT * FROM USERS WHERE Email = ? AND Password = ?";
            $stmt = $connection->prepare($query);
            $stmt->bind_param("ss", $email,$password);

            if ($stmt->execute())
            {
                $stmt->store_result();
                $stmt->bind_result($userID);

                $stmt->fetch();

                $_SESSION["email"] = $email;
                $_SESSION["pass"] = $password;
                $_SESSION["userID"] = $userID;

                $stmt->close();
            }
            else
            {
                echo "User does not Exist";
            }

            unset($login);
            unset($email);
            $database->closeConnection();
            unset($database);
        }
        catch (Exception $e)
        {
            $error = $e->errorMessage();
            echo $error;
        }
    }


}