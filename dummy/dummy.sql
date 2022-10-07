users, social_user_link, social_medium, additional_info,country



-- user info 

SELECT `users`.* ,`country`.`name` AS `country_name`, `country`.`phonecode` AS `phone_code`, `additional_info`.`bio`, `additional_info`.`education`, `additional_info`.`working_info`
FROM `users`
INNER JOIN `country` ON `users`.`country_id` = `country`.`id`
INNER JOIN `additional_info` ON `additional_info`.`user_id` = `users`.`id`;


-- `users`.`f_name`,`users`.`l_name`,`users`.`id`,

-- user links 

SELECT  `social_medium`.`id`, `social_medium`.`medium`,`social_user_link`.`link` AS `socail_link` 
FROM `users`
INNER JOIN `social_user_link` ON `social_user_link`.`user_id` = `users`.`id`
INNER JOIN  `social_medium` ON `social_medium`.`id`  = `social_user_link`.`medium_id`
WHERE `users`.`id` = 17;


-- addition info 

SELECT `users`.* ,`country`.`name` AS `country_name`, `country`.`phonecode` AS `phone_code`
FROM `users`
INNER JOIN `country` ON `users`.`country_id` = `country`.`id`
WHERE `users`.`id` = 17; 



doctor-> appointment
users -> appointmnet
roel -> users 


SELECT user_appointment.*,users.f_name AS pf_name, users.l_name as pl_name, users.id as p_id,
appointment.id as appointment_id,users.email as p_email,
FROM user_appointment
JOIN users ON user_appointment.patient_id = users.id
JOIN appointment ON user_appointment.appointment_id = appointment.id
WHERE user_appointment.id = 2;


FROM user_appointment WHERE patient_id = 19; 

SELECT * FROM appointment WHERE 