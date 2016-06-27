<?php

/**
 * Created by PhpStorm.
 * User: Zoran Luledzija
 * Date: 25-Jun-16
 * Time: 10:17 PM
 */
class UsersDao extends AbstractDao
{
    public function fetchAll() {
        $sql = "SELECT * FROM users";
        $stmt = $this->db->query($sql);
        $results = [];
        while($row = $stmt->fetch()) {
            $results[] = $row;
        }
        return $results;
    }

    public function fetchById($id) {
        $sql = "SELECT * FROM users WHERE user_id = :user_id";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute(["user_id" => $id]);
        if($result) {
            return $stmt->fetch();
        }
    }

    public function delete($user) {
        $sql = "DELETE FROM users WHERE user_id = :user_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(["user_id" => $user['user_id']]);
    }

    public function update($user) {
        $sql = "UPDATE users SET
                  user_name = :user_name,
                  user_lastname = :user_lastname,
                  user_email = :user_email,
                  user_password = :user_password,
                  user_role = :user_role
                WHERE
                  user_id = :user_id
               ";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "user_name" => $user['user_name'],
            "user_lastname" => $user['user_lastname'],
            "user_email" => $user['user_email'],
            "user_password" => $user['user_password'],
            "user_role" => $user['user_role'],
            "user_id" => $user['user_id']
        ]);
        if(!$result) {
            throw new Exception("could not update record");
        }
    }

    public function save($user) {
        $sql = "INSERT INTO users (
                  user_name,
                  user_lastname,
                  user_email,
                  user_password,
                  user_role)
                VALUES (
                  :user_name,
                  :user_lastname,
                  :user_email,
                  :user_password,
                  :user_role
                )";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "user_name" => $user['user_name'],
            "user_lastname" => $user['user_lastname'],
            "user_email" => $user['user_email'],
            "user_password" => $user['user_password'],
            "user_role" => $user['user_role']
        ]);
        if(!$result) {
            throw new Exception("could not save record");
        }
    }
}