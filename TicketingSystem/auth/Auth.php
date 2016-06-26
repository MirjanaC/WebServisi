<?php

/**
 * Created by PhpStorm.
 * User: Zoran Luledzija
 * Date: 26-Jun-16
 * Time: 10:34 AM
 */

class Auth
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function isLoggedIn($token) {
        $user_id = null;

        // Retrieve data
        $sql = "SELECT * FROM auth WHERE auth_token = :auth_token";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute(["auth_token" => $token]);
        if($result) {
            $user_id = $stmt->fetch()['auth_user_id'];
        }
        $db = null;
        return $user_id;
    }

    public function logIn($token, $user_id) {
        // Store data
        $sql = "INSERT INTO auth (
                  auth_token,
                  auth_user_id)
                VALUES (
                  :auth_token,
                  :auth_user_id
                )";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(["auth_token" => $token, "auth_user_id" => $user_id]);
        $db = null;
    }

    public function logOut($token) {
        // Remove data
        $sql = "DELETE FROM auth WHERE auth_token = :auth_token";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(["auth_token" => $token]);
        $db = null;
    }
}