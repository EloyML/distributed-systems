<?php
namespace App\Controllers\Auth;

use App\Controllers\Controller;

class AuthController extends Controller{

    public function postUser($request, $response){
        $email = $request->getParam('email');
        $password = password_hash($request->getParam('password'), PASSWORD_BCRYPT);

        $sql = "INSERT INTO users (Email, Pass) VALUES (?, ?)";

        $conn = $this->container->db;

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ss', $email, $password);
        $stmt->execute();
        $error = $stmt->error;

        if (!empty($error)){
            echo $error;
        } else{
            return $response->withStatus(200)->withHeader('Content-Type', 'application/json')->write(json_encode(true));
        }
    }

    public function emailValidation($request, $response){
        $email = $request->getParam('email');
        $check = false;

        $sql = "SELECT Email FROM USERS WHERE Email = ?";

        $conn = $this->container->db;

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows){
            $check = true;
        }

        return $response->withStatus(200)->withHeader('Content-Type', 'application/json')->write(json_encode($check));
    }

    public function postLogin($request, $response){
        $email = $request->getParam('email');
        $password = $request->getParam('password');

        $sql = "SELECT ID, Email, Pass FROM USERS WHERE Email = ?";

        $conn = $this->container->db;

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $result = $result->fetch_assoc();

        if (password_verify($password, $result['Pass'])){
            return $response->withStatus(200)->withHeader('Content-Type', 'application/json')->write(json_encode($result));
        }
        return null;
    }
}