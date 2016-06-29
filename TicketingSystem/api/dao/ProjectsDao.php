<?php

/**
 * Created by PhpStorm.
 * User: Zoran Luledzija
 * Date: 26-Jun-16
 * Time: 12:35 AM
 */
class ProjectsDao extends AbstractDao
{
    public function fetchAll() {
        $sql = "SELECT * FROM projects";
        $stmt = $this->db->query($sql);
        $results = [];
        while($row = $stmt->fetch()) {
            $results[] = $row;
        }
        return $results;
    }

    public function fetchNamesOfUsersWorkingOnProject($id) {
        $sql = "SELECT projects.project_name, users.user_name
                FROM projects
                JOIN team_users ON projects.team_id = team_users.team_id
                JOIN users ON users.user_id = team_users.user_id
                WHERE projects.project_id = :project_id";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute(["project_id" => $id]);
        if($result) {
            return $stmt->fetch();
        }
    }

    public function fetchTasksOnProject($id) {
        $sql = "SELECT projects.project_name, tasks.task_title FROM projects LEFT JOIN tasks ON projects.task_id = tasks.task_id WHERE projects.project_id = :project_id";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute(["project_id" => $id]);
        if($result) {
            return $stmt->fetch();
        }
    }

     public function fetchProjectsOfUser($id) {
        $sql = "SELECT project_id FROM projects JOIN teams ON projects.team_id = teams.team_id JOIN team_users ON teams.team_id = team_users.team_id WHERE team_users.user_id = :user_id";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute(["user_id" => $id]);
        if($result) {
            return $stmt->fetch();
        }
    }

    public function fetchById($id) {
        $sql = "SELECT * FROM projects WHERE project_id = :project_id";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute(["project_id" => $id]);
        if($result) {
            return $stmt->fetch();
        }
    }

    public function delete($id) {
        $sql = "DELETE FROM projects WHERE project_id = :project_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(["project_id" => $id]);
    }

    public function update($projects) {
        $sql = "UPDATE projects SET
                  project_name = :project_name,
                  project_code = :project_code,
                  team_id = :team_id
                WHERE
                  project_id = :project_id
               ";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "project_name" => $projects['project_name'],
            "project_code" => $projects['project_code'],
            "team_id" => $projects['team_id'],
            "project_id" => $projects['project_id']
        ]);
        if(!$result) {
            throw new Exception("could not update record");
        }
    }

    public function save($projects) {
        $sql = "INSERT INTO projects (
                  project_name,
                  project_code,
                  team_id)
                VALUES (
                  :project_name,
                  :project_code,
                  :team_id
                )";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "project_name" => $projects['project_name'],
            "project_code" => $projects['project_code'],
            "team_id" => $projects['team_id']
        ]);
        if(!$result) {
            throw new Exception("could not save record");
        }
    }
}