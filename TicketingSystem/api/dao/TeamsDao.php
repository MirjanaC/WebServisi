<?php

/**
 * Created by PhpStorm.
 * User: Zoran Luledzija
 * Date: 29-Jun-16
 * Time: 1:59 PM
 */

class TeamsDao extends AbstractDao
{
    public function fetchAll() {
        $sql = "SELECT * FROM teams";
        $stmt = $this->db->query($sql);
        $results = [];
        while($row = $stmt->fetch()) {
            $results[] = $row;
        }
        return $results;
    }

    public function fetchById($id) {
        $sql = "SELECT * FROM teams WHERE team_id = :team_id";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute(["team_id" => $id]);
        if($result) {
            return $stmt->fetch();
        }
    }

    public function delete($id) {
        $sql = "DELETE FROM teams WHERE team_id = :team_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(["team_id" => $id]);
    }

    public function update($team) {
        $sql = "UPDATE teams SET
                  team_name = :team_name
                WHERE
                  team_id = :team_id
               ";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "team_name" => $team['team_name'],
            "team_id" => $team['team_id']
        ]);
        if(!$result) {
            throw new Exception("could not update record");
        }
    }

    public function save($team) {
        $sql = "INSERT INTO teams (
                  team_name)
                VALUES (
                  :team_name
                )";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "team_name" => $team['team_name']
        ]);
        if(!$result) {
            throw new Exception("could not save record");
        }
    }

    public function getTeamUsers($id) {
        $sql = "SELECT users.user_id, user_name, user_lastname, user_email, user_role
                FROM teams
                JOIN team_users ON teams.team_id = team_users.team_id
                JOIN users ON team_users.user_id = users.user_id
                WHERE teams.team_id = :team_id";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute(["team_id" => $id]);
        if($result) {
            return $stmt->fetchAll();
        }
    }
}