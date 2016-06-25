INSERT INTO Users(user_name, user_lastname, user_email, user_password, user_role) 
  VALUES('Admin','Adminic','admin@admin.com','admin','ad');
  
INSERT INTO Projects(project_name, user_id) 
  VALUES('Project1', 1);
  
INSERT INTO Tasks(task_mark, task_title, task_creationDate, task_userCreator, task_userAssigned, task_description, task_priority, task_status, user_id, project_id)
  VALUES('Mark1', 'Title 1', '2010-01-11', 'Covek1', 'Covek2', 'Opis', 'Trivial', 'To Do', 1, 1);
  
INSERT INTO Comments(comment_creationDate, comment_text, comment_userCreator, user_id, task_id)
  VALUES('2016-06-25', 'Komentar', 'Creator', 1, 1);