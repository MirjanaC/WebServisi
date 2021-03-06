DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS teams;
DROP TABLE IF EXISTS team_users;
DROP TABLE IF EXISTS projects;
DROP TABLE IF EXISTS tasks;
DROP TABLE IF EXISTS task_users;
DROP TABLE IF EXISTS comments;
DROP TABLE IF EXISTS auth;

CREATE TABLE users (
	user_id INT NOT NULL AUTO_INCREMENT,
	user_name VARCHAR(20) NOT NULL, 
	user_lastname VARCHAR(20) NOT NULL,
	user_email VARCHAR(40) NOT NULL,
	user_password VARCHAR(20)NOT NULL,
	user_role VARCHAR(10) NOT NULL,
	PRIMARY KEY (user_id)
);

CREATE TABLE teams (
	team_id INT NOT NULL AUTO_INCREMENT,
	team_name VARCHAR(20) NOT NULL, 
	PRIMARY KEY (team_id)
);

CREATE TABLE team_users (
	team_id INT NOT NULL,
	user_id INT NOT NULL,
	PRIMARY KEY (team_id, user_id),
	FOREIGN KEY fk_team_user (user_id) REFERENCES Users(user_id),
	FOREIGN KEY fk_team (team_id) REFERENCES Teams(team_id)
);

CREATE TABLE projects (
	project_id INT NOT NULL AUTO_INCREMENT,
	project_name VARCHAR(20) NOT NULL,
	project_code VARCHAR(5) NOT NULL,
    	team_id INT,
	PRIMARY KEY (project_id),
    	FOREIGN KEY fk_team (team_id) REFERENCES Teams(team_id)
);

CREATE TABLE tasks (
	task_id INT NOT NULL AUTO_INCREMENT,
    	task_mark VARCHAR(10) NOT NULL,
	task_title VARCHAR(20) NOT NULL, 
	task_creationDate DATE NOT NULL,
	task_description VARCHAR(40),
	task_priority VARCHAR(20)NOT NULL,
	task_status VARCHAR(20) NOT NULL,
    	project_id INT NOT NULL,
	PRIMARY KEY (task_id),
    	FOREIGN KEY fk_project (project_id) REFERENCES Projects(project_id)
);

CREATE TABLE task_users (
	task_id INT NOT NULL,
	task_creator CHAR(1) NOT NULL,
	user_id INT NOT NULL,
	FOREIGN KEY fk_task_user (user_id) REFERENCES Users(user_id),
	FOREIGN KEY fk_task_ (task_id) REFERENCES Tasks(task_id)
);

CREATE TABLE comments (
	comment_id INT NOT NULL AUTO_INCREMENT,
	comment_creationDate DATE NOT NULL, 
	comment_text VARCHAR(100) NOT NULL,
    	user_id INT NOT NULL,
    	task_id INT NOT NULL,
	PRIMARY KEY (comment_id),
    	FOREIGN KEY fk_comments_user (user_id) REFERENCES Users(user_id),
    	FOREIGN KEY fk_comments_task (task_id) REFERENCES Tasks(task_id)
);

CREATE TABLE auth (
	auth_token VARCHAR(32) NOT NULL,
	auth_user_id INT NOT NULL,
	FOREIGN KEY fk_auth_user (auth_user_id) REFERENCES Users(user_id)
);
