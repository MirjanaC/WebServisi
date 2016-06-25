<?php

/**
 * Created by PhpStorm.
 * User: Zoran Luledzija
 * Date: 26-Jun-16
 * Time: 12:19 AM
 */
class TasksDao extends AbstractDao
{
    public function fetchAll() {
        $sql = "SELECT * FROM tasks";
        $stmt = $this->db->query($sql);
        $results = [];
        while($row = $stmt->fetch()) {
            $results[] = $row;
        }
        return $results;
    }

    public function fetchById($id) {
        $sql = "SELECT * FROM tasks WHERE task_id = :task_id";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute(["task_id" => $id]);
        if($result) {
            return $stmt->fetch();
        }
    }

    public function delete($id) {
        $sql = "DELETE FROM tasks WHERE task_id = :task_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(["task_id" => $id]);
    }

    public function update($task) {
        $sql = "UPDATE tasks SET
                  task_mark = :task_mark,
                  task_title = :task_title,
                  task_creationDate = :task_creationDate,
                  task_userCreator = :task_userCreator,
                  task_userAssigned = :task_userAssigned,
                  task_description = :task_description,
                  task_priority = :task_priority,
                  task_status = :task_status,
                  user_id = :user_id,
                  project_id = :project_id,
                WHERE
                  task_id = :task_id
               ";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "task_mark" => $task['task_mark'],
            "task_title" => $task['task_title'],
            "task_creationDate" => $task['task_creationDate'],
            "task_userCreator" => $task['task_userCreator'],
            "task_userAssigned" => $task['task_userAssigned'],
            "task_description" => $task['task_description'],
            "task_priority" => $task['task_priority'],
            "task_status" => $task['task_status'],
            "user_id" => $task['user_id'],
            "project_id" => $task['project_id'],
            "task_id" => $task['task_id']
        ]);
        if(!$result) {
            throw new Exception("could not update record");
        }
    }

    public function save($task) {
        $sql = "INSERT INTO tasks (
                  task_mark,
                  task_title,
                  task_creationDate,
                  task_userCreator,
                  task_userAssigned,
                  task_description,
                  task_priority,
                  task_status,
                  user_id,
                  project_id)
                VALUES (
                  :task_mark,
                  :task_title,
                  :task_creationDate,
                  :task_userCreator,
                  :task_userAssigned,
                  :task_description,
                  :task_priority,
                  :task_status,
                  :user_id,
                  :project_id
                )";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "task_mark" => $task['task_mark'],
            "task_title" => $task['task_title'],
            "task_creationDate" => $task['task_creationDate'],
            "task_userCreator" => $task['task_userCreator'],
            "task_userAssigned" => $task['task_userAssigned'],
            "task_description" => $task['task_description'],
            "task_priority" => $task['task_priority'],
            "task_status" => $task['task_status'],
            "user_id" => $task['user_id'],
            "project_id" => $task['project_id']
        ]);
        if(!$result) {
            throw new Exception("could not save record");
        }
    }
}