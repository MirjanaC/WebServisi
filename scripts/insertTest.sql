INSERT INTO users(user_name, user_lastname, user_email, user_password, user_role) 
  VALUES('Admin','Adminic','admin@admin.com','admin','admin'),
  ('Zoran','Luledzija','luledzija@gmail.com','zoki','programmer'),
  ('Mirjana','Curcin','curcin@gmail.com','mima','programmer'),
  ('Jovana','Ikonic','ikonic@gmail.com','jovana','programmer'),
  ('Milos','Mitrovic','mitrovic@gmail.com','milos','programmer'),
  ('Petar','Simeunovic','simeunovic@gmail.com','sima','programmer'),
  ('Ilija','Svetic','svetic@gmail.com','ilija','programmer'),
  ('Tamara','Simic','simic@gmail.com','tasa','programmer');
  
INSERT INTO teams(team_name)
  VALUES('Team1'),
        ('Team2'),
        ('Team3'),
        ('Team4'),
        ('Team5'),
        ('Team6');
        
INSERT INTO team_users(team_id, user_id)
  VALUES(1,1),
        (2,2),
        (3,3),
        (4,4),
        (5,5),
        (6,6),
        (6,3);
  
INSERT INTO projects(project_name, project_code, team_id) 
  VALUES('Project1', 'PR-1', 1),
        ('Project2', 'PR-2', 2),
        ('Project3', 'PR-3', 3),
        ('Project4', 'PR-4', 4),
        ('Project5', 'PR-5', 5),
        ('Project6', 'PR-6', 6);
  
INSERT INTO tasks(task_mark, task_title, task_creationDate, task_description, task_priority, task_status, project_id)
  VALUES('PR-1-1', 'Title 1', '2010-01-11', 'Opis', 'Trivial', 'To Do', 1),
        ('PR-1-2', 'Title 2', '2010-01-11', 'Opis', 'Trivial', 'To Do', 2),
        ('PR-1-3', 'Title 3', '2010-01-11', 'Opis', 'Trivial', 'To Do', 3),
        ('PR-1-4', 'Title 4', '2010-01-11', 'Opis', 'Trivial', 'To Do', 4),
        ('PR-1-5', 'Title 5', '2010-01-11', 'Opis', 'Trivial', 'To Do', 5),
        ('PR-1-6', 'Title 6', '2010-01-11', 'Opis', 'Trivial', 'To Do', 6);
        
 INSERT INTO task_users(task_id, task_creator, user_id)
  VALUES(1, 'C', 1),
        (2, 'C', 2),
        (3, 'C', 3),
        (4, 'C', 4),
        (5, 'C', 5),
        (6, 'C', 6),
        (6, 'D', 4);
  
INSERT INTO comments(comment_creationDate, comment_text, user_id, task_id)
  VALUES('2016-06-25', 'Komentar', 1, 1);
