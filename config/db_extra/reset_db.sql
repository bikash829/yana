
-- Active: 1665315356750@@127.0.0.1@3306@yana
START TRANSACTION;
SET FOREIGN_KEY_CHECKS = 0;

TRUNCATE additional_info;
TRUNCATE comments;
TRUNCATE comment_react;
TRUNCATE contact_us;
TRUNCATE forum;
TRUNCATE post_react;
TRUNCATE report;
TRUNCATE social_user_link;
TRUNCATE users;
TRUNCATE user_appointment;
SET FOREIGN_KEY_CHECKS = 1;

INSERT INTO `users` (`f_name`, `l_name`, `email`, `gender`, `date_of_birth`, `pass`, `country_id`, `phone_code`, `phone_number`, `addr`, `city`, `zip_code`, `profile_photo`, `profile_location`, `role_id`, `status`) 
VALUES
('Admin', NULL, 'admin@email.com', NULL, NULL, MD5('admin@email.com'), NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1),
('Jemmy', 'Lehri', 'jemmy@gmail.com', 'male', '1994-10-12', MD5('admin@email.com'), 5, 5, '015454545', 'Somewherw at london', 'London', '41444', NULL, NULL, 3, 1),
('mayesha', 'fahmida', 'mayesha@gmail.com', 'female', '1994-09-25', MD5(`email`), 5, 5, '016454530', 'Somewherw at Dhaka', 'Dhaka', '1201', NULL, NULL, 3, 1),
('rayhan', 'ahmed', 'rayhan@gmail.com', 'male', '1994-09-25', MD5(`email`), 5, 5, '0174545944', 'Somewherw at Savar', 'Dhaka', '1241', NULL, NULL, 3, NULL),
('yeasin', 'ahmed', 'yeasin@gmail.com', 'male', '1998-09-25', MD5(`email`), 5, 5, '0174545900', 'Somewherw at Chanpur', 'Cumilla', '1241', NULL, NULL, 2, 1),
('bikash', 'chowdhury', 'bikash@gmail.com', 'male', '1996-09-25', MD5(`email`), 5, 5, '01745459139', 'Somewherw at Dhaka', 'Dhaka', '1221', NULL, NULL, 4, 1),
('tonoya', 'rahman', 'tonoya@gmail.com', 'female', '1996-09-25', MD5(`email`), 5, 5, '01745459113', 'Somewherw at N.Ganj', 'N.Ganj', '1221', NULL, NULL, 4, 1),
('oishe', 'binita', 'oishe@gmail.com', 'female', '2000-09-25', MD5(`email`), 5, 5, '01745459113', 'Somewherw at N.Ganj', 'N.Ganj', '5454', NULL, NULL, 4, 1)
;


INSERT INTO `additional_info` (`user_id`, `education`, `working_info`, `document_name`, `document_location`, `bio`) VALUES
(2, 'Education,example', 'There is several working info.', 'Denise_edu1664440426137598886.pdf', './uploads/educatoinal_doc/', 'Its my bio example '),
(3, 'One more, education, example', 'Few working info', 'Noble_edu1664440574755575728.pdf', './uploads/educatoinal_doc/', 'Other bio example'),
(4, 'One more, education, example', 'Other Few working info', 'Noble_edu1664440574755575728.pdf', './uploads/educatoinal_doc/', 'bio  lash example'),
(5, 'Other educaiton example','Blah blah blah', 'Daquan_edu1664440607357116983.pdf', './uploads/educatoinal_doc/', NULL),
(6, '', '', '', '', ''),
(7, '', '', '', '', ''),
(8, '', '', '', '', '');


COMMIT;