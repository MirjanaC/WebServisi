<?php

/**
 * Created by PhpStorm.
 * User: Zoran Luledzija
 * Date: 26-Jun-16
 * Time: 10:34 AM
 */

class Auth
{
    private $config;

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function isLoggedIn($token) {
        $user_id = null;

        // Retrieve data
        $db = new PDO("mysql:host={$this->config['db']['host']};dbname={$this->config['db']['dbname']}",
            $this->config['db']['username'],
            $this->config['db']['password']);
        $sql = "SELECT * FROM auth WHERE auth_token = :auth_token";
        $stmt = $db->prepare($sql);
        $result = $stmt->execute(["auth_token" => $token]);
        if($result) {
            $user_id = $stmt->fetch()['auth_user_id'];
        }
        $db = null;
        return $user_id;
    }

    public function logIn($token, $user_id) {
        // Store data
        $db = new PDO("mysql:host={$this->config['db']['host']};dbname={$this->config['db']['dbname']}",
            $this->config['db']['username'],
            $this->config['db']['password']);
        $sql = "INSERT INTO auth (
                  auth_token,
                  auth_user_id)
                VALUES (
                  :auth_token,
                  :auth_user_id
                )";
        $stmt = $db->prepare($sql);
        $stmt->execute(["auth_token" => $token, "auth_user_id" => $user_id]);
        $db = null;
    }

    public function logOut($token) {
        // Remove data
        $db = new PDO("mysql:host={$this->config['db']['host']};dbname={$this->config['db']['dbname']}",
            $this->config['db']['username'],
            $this->config['db']['password']);
        $sql = "DELETE FROM auth WHERE auth_token = :auth_token";
        $stmt = $db->prepare($sql);
        $stmt->execute(["auth_token" => $token]);
        $db = null;
    }
}