<?php

/**
 * Created by PhpStorm.
 * User: Zoran Luledzija
 * Date: 26-Jun-16
 * Time: 12:49 AM
 */

class CommentsDao extends AbstractDao
{
    public function fetchAll() {
        $sql = "SELECT * FROM comments";
        $stmt = $this->db->query($sql);
        $results = [];
        while($row = $stmt->fetch()) {
            $results[] = $row;
        }
        return $results;
    }

    public function fetchById($id) {
        $sql = "SELECT * FROM comments WHERE comment_id = :comment_id";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute(["comment_id" => $id]);
        if($result) {
            return $stmt->fetch();
        }
    }

    public function delete($id) {
        $sql = "DELETE FROM comments WHERE comment_id = :comment_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(["comment_id" => $id]);
    }

    public function update($comment) {
        $sql = "UPDATE comments SET
                  comment_creationDate = :comment_creationDate,
                  comment_text = :comment_text,
                  comment_userCreator = :comment_userCreator,
                  user_id = :user_id,
                  task_id = :task_id
                WHERE
                  comment_id = :comment_id
               ";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "comment_creationDate" => $comment['comment_creationDate'],
            "comment_text" => $comment['comment_text'],
            "comment_userCreator" => $comment['comment_userCreator'],
            "user_id" => $comment['user_id'],
            "task_id" => $comment['task_id'],
            "comment_id" => $comment['comment_id']
        ]);
        if(!$result) {
            throw new Exception("could not update record");
        }
    }

    public function save($comment) {
        $sql = "INSERT INTO comments (
                  comment_creationDate,
                  comment_text,
                  comment_userCreator,
                  user_id,
                  task_id)
                VALUES (
                  :comment_creationDate,
                  :comment_text,
                  :comment_userCreator,
                  :user_id,
                  :task_id
                )";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "comment_creationDate" => $comment['comment_creationDate'],
            "comment_text" => $comment['comment_text'],
            "comment_userCreator" => $comment['comment_userCreator'],
            "user_id" => $comment['user_id'],
            "task_id" => $comment['task_id']
        ]);
        if(!$result) {
            throw new Exception("could not save record");
        }
    }
}