<?php

class ReportsQuery {

	protected $db;

    public function __construct($db) {
        $this->db = $db;
    }

	public function fetchAssignedTasks($id) {
        
        // dobavljanje broja korisnika na projektu //
        /*$sql = "SELECT projects.project_name, tasks.task_title, users.user_name, COUNT(*) as numberOfUsers
    		FROM projects
    		JOIN tasks ON tasks.project_id = projects.project_id
    		JOIN team_users ON projects.team_id=team_users.team_id
    		JOIN users ON team_users.user_id=users.user_id
    		WHERE projects.project_id = :project_id
    		GROUP BY projects.project_name";

    	$sql = "SELECT projects.project_name, tasks.task_id, task_users.user_id, users.user_name, COUNT(*) as numberOfUsers
    		FROM projects
    		JOIN teams ON projects.team_id = teams.team_id
    		JOIN tasks ON projects.project_id = tasks.project_id
    		JOIN task_users ON tasks.task_id = task_users.task_id
    		JOIN users ON task_users.task_id = users.user_id
    		WHERE projects.project_id = :project_id
    		GROUP BY projects.project_name";*/

        // svi zadaci na jednom projektu //
    	$sql = "SELECT tasks.task_id, tasks.task_title, task_users.user_id, users.user_name FROM tasks 
    			JOIN task_users ON tasks.task_id=task_users.task_id
    			JOIN users ON task_users.user_id=users.user_id
    			WHERE project_id= :project_id";
        
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute(["project_id" => $id]);
        if($result) {
            return $stmt->fetchAll();
        }
    }
	
}