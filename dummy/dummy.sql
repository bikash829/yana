users, social_user_link, social_medium, additional_info,country



-- user info 

SELECT `users`.* ,`country`.`name` AS `country_name`, `country`.`phonecode` AS `phone_code`, `additional_info`.`bio`, `additional_info`.`education`, `additional_info`.`working_info`
FROM `users`
INNER JOIN `country` ON `users`.`country_id` = `country`.`id`
INNER JOIN `additional_info` ON `additional_info`.`user_id` = `users`.`id`;; 


-- `users`.`f_name`,`users`.`l_name`,`users`.`id`,

-- user links 

SELECT  `social_medium`.`medium`,`social_user_link`.`link` AS `socail_link` 
FROM `users`
INNER JOIN `social_user_link` ON `social_user_link`.`user_id` = `users`.`id`
INNER JOIN  `social_medium` ON `social_medium`.`id`  = `social_user_link`.`medium_id`
WHERE `users`.`id` = 17;


-- addition info 

SELECT `users`.* ,`country`.`name` AS `country_name`, `country`.`phonecode` AS `phone_code`
FROM `users`
INNER JOIN `country` ON `users`.`country_id` = `country`.`id`
WHERE `users`.`id` = 17; 