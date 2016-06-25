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
                  user_id = :user_id
                WHERE
                  project_id = :project_id
               ";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "project_name" => $projects['project_name'],
            "user_id" => $projects['user_id'],
            "project_id" => $projects['project_id']
        ]);
        if(!$result) {
            throw new Exception("could not update record");
        }
    }

    public function save($projects) {
        $sql = "INSERT INTO projects (
                  project_name,
                  user_id)
                VALUES (
                  :project_name,
                  :user_id
                )";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "project_name" => $projects['project_name'],
            "user_id" => $projects['user_id']
        ]);
        if(!$result) {
            throw new Exception("could not save record");
        }
    }
}