<?php 
include "../config/db_connection.php";
$sql = "SELECT `users`.*,`users`.phone_code AS `phone_code_id`, `additional_info`.`working_info`,`additional_info`.`education` AS `education_info`, `additional_info`.`document_name` AS `education_proof`,`additional_info`.`document_location` AS `education_proof_location`, `country`.`name` AS `country_name`, `country`.`phonecode` AS `phone_code` FROM `users` 
        INNER JOIN `additional_info` ON `users`.`id` = `additional_info`.`user_id`
        INNER JOIN `country` ON `users`.`country_id` = `country`.`id`
        WHERE `users`.`status` = $status;";
?>