INSERT INTO Users(user_name, user_lastname, user_email, user_password, user_role, project_id) 
  VALUES('Admin','Adminic','admin@admin.com','admin','admin', 1),
  ('Zoran','Luledzija','luledzija@gmail.com','zoki','programmer', 2),
  ('Mirjana','Curcin','curcin@gmail.com','mima','programmer', 3),
  ('Jovana','Ikonic','ikonic@gmail.com','jovana','programmer', 4),
  ('Milos','Mitrovic','mitrovic@gmail.com','milos','programmer', 5),
  ('Petar','Simeunovic','simeunovic@gmail.com','sima','programmer', 6),
  ('Ilija','Svetic','svetic@gmail.com','ilija','programmer', 7),
  ('Tamara','Simic','simic@gmail.com','tasa','programmer', 8);
  
INSERT INTO Teams(team_name, user_id)
  VALUES('Team1', 2),
  ('Team1', 3),
  ('Team2', 4),
  ('Team2', 5),
  ('Team2', 6),
  ('Team3', 7),
  ('Team3', 8);
  
INSERT INTO Projects(project_name, user_id, task_id) 
  VALUES('Project1', 1, 2),
        ('Project2', 2, 1),
        ('Project3', 3, 3),
        ('Project4', 4, 4),
        ('Project5', 5, 5),
        ('Project6', 6, 6),
        ('Project7', 7, 7),
        ('Project8', 8, 8),
        ('Project9', 9, 5),
        ('Project6', 5, 2);
  
INSERT INTO Tasks(task_mark, task_title, task_creationDate, task_userCreator, task_userAssigned, task_description, task_priority, task_status, user_id, project_id)
  VALUES('Mark1', 'Title 1', '2010-01-11', 'Covek1', 'Covek2', 'Opis', 'Trivial', 'To Do', 1, 1);
  
INSERT INTO Comments(comment_creationDate, comment_text, comment_userCreator, user_id, task_id)
  VALUES('2016-06-25', 'Komentar', 'Creator', 1, 1);