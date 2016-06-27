INSERT INTO Users(user_name, user_lastname, user_email, user_password, user_role) 
  VALUES('Admin','Adminic','admin@admin.com','admin','admin'),
  ('Zoran','Luledzija','luledzija@gmail.com','zoki','programmer'),
  ('Mirjana','Curcin','curcin@gmail.com','mima','programmer'),
  ('Jovana','Ikonic','ikonic@gmail.com','jovana','programmer'),
  ('Milos','Mitrovic','mitrovic@gmail.com','milos','programmer'),
  ('Petar','Simeunovic','simeunovic@gmail.com','sima','programmer'),
  ('Ilija','Svetic','svetic@gmail.com','ilija','programmer'),
  ('Tamara','Simic','simic@gmail.com','tasa','programmer');
  
INSERT INTO Teams(team_name, user_id)
  VALUES('Team1', 2),
  ('Team1', 3),
  ('Team2', 4),
  ('Team2', 5),
  ('Team2', 6),
  ('Team3', 7),
  ('Team3', 8);
  
INSERT INTO Projects(project_name, user_id) 
  VALUES('Project1', 1);
  
INSERT INTO Tasks(task_mark, task_title, task_creationDate, task_userCreator, task_userAssigned, task_description, task_priority, task_status, user_id, project_id)
  VALUES('Mark1', 'Title 1', '2010-01-11', 'Covek1', 'Covek2', 'Opis', 'Trivial', 'To Do', 1, 1);
  
INSERT INTO Comments(comment_creationDate, comment_text, comment_userCreator, user_id, task_id)
  VALUES('2016-06-25', 'Komentar', 'Creator', 1, 1);