<?php
namespace App\Controllers\Auth;

use App\Controllers\Controller;

class PassController extends Controller{

    public function getEditPassword($request, $response) {
    }

    public function postEditPassword($request, $response) {
        $id = $request->getParam('id');
        $password = password_hash($request->getParam('password'), PASSWORD_BCRYPT);

        $sql = "UPDATE users SET password = ? WHERE id = ?";

        $conn = $this->container->db;

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('si', $password, $id);
        $check = $stmt->execute();

        if ($check){
            return $response->withStatus(200)->withHeader('Content-Type', 'application/json')->write(json_encode(true));
        }
    }
}