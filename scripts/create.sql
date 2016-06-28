DROP TABLE IF EXISTS Users;
DROP TABLE IF EXISTS Teams;
DROP TABLE IF EXISTS Projects;
DROP TABLE IF EXISTS Tasks;
DROP TABLE IF EXISTS Comments;

CREATE TABLE Users (

	user_id INT NOT NULL AUTO_INCREMENT,
	user_name VARCHAR(20) NOT NULL, 
	user_lastname VARCHAR(20) NOT NULL,
	user_email VARCHAR(40) NOT NULL,
	user_password VARCHAR(20)NOT NULL,
	user_role VARCHAR(10) NOT NULL,
	project_id INT,
	PRIMARY KEY (user_id),
	FOREIGN KEY fk_project (project_id) REFERENCES Projects(project_id)
);

CREATE TABLE Teams (

	team_id INT NOT NULL AUTO_INCREMENT,
	team_name VARCHAR(20) NOT NULL, 
	user_id INT,
	PRIMARY KEY (team_id),
	FOREIGN KEY fk_teammember (user_id) REFERENCES Users(user_id)
);

CREATE TABLE Projects (

	project_id INT NOT NULL AUTO_INCREMENT,
	project_name VARCHAR(20) NOT NULL,
    user_id INT,
    task_id INT,
	PRIMARY KEY (project_id),
    FOREIGN KEY fk_user (user_id) REFERENCES Users(user_id),
    FOREIGN KEY fk_task (task_id) REFERENCES Tasks(task_id)
);

CREATE TABLE Tasks (

	task_id INT NOT NULL AUTO_INCREMENT,
    task_mark VARCHAR(20) NOT NULL,
	task_title VARCHAR(20) NOT NULL, 
	task_creationDate DATE NOT NULL,
    task_userCreator VARCHAR(20) NOT NULL,
    task_userAssigned VARCHAR(20),
	task_description VARCHAR(40),
	task_priority VARCHAR(20)NOT NULL,
	task_status VARCHAR(20) NOT NULL,
    user_id INT,
    project_id INT,
	PRIMARY KEY (task_id),
    FOREIGN KEY fk_user (user_id) REFERENCES Users(user_id),
    FOREIGN KEY fk_project (project_id) REFERENCES Projects(project_id)
);

CREATE TABLE Comments (

	comment_id INT NOT NULL AUTO_INCREMENT,
	comment_creationDate DATE NOT NULL, 
	comment_text VARCHAR(100) NOT NULL,
    comment_userCreator VARCHAR(20) NOT NULL,
    user_id INT,
    task_id INT,
	PRIMARY KEY (comment_id),
    FOREIGN KEY fk_user (user_id) REFERENCES Users(user_id),
    FOREIGN KEY fk_task (task_id) REFERENCES Tasks(task_id)
);

/*CREATE TABLE Teams2(
  team_id INT NOT NULL AUTO_INCREMENT,
  PRIMARY KEY(team_id),
  team_name VARCHAR(20) NOT NULL DEFAULT 1
) AS
SELECT
  user_name
FROM
  Users*/