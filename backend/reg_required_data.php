<?php
include "../config/db_connection.php";
$sql = "SELECT name AS country_name, id  AS country_id, phonecode, nicename FROM country;";
// $sql = "select * from country";
if (db_connection()->query($sql)) {
    $country_data_collection = db_connection()->query($sql);
    $country_data_set = mysqli_fetch_all($country_data_collection, MYSQLI_ASSOC);
} else {
    echo "Technical error please email us for your about the problem.";
}
