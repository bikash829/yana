<?php
session_start();

$title = "User Information";
include_once "layouts/head.php";
include_once "layouts/nav.php";


include "config/db_connection.php";
$con = connection();

$sql = "SELECT users.*,adrees_info.id AS add_id, adrees_info.zip_code, adrees_info.city,adrees_info.country_id,country.name AS country_name,country.phonecode
                    FROM users
                    left join user_address on user_address.user_id_fk = users.id
                    left join adrees_info on adrees_info.id = user_address.address_id_fk
                    left join country on country.id = adrees_info.country_id
                    ;";
if ($con->query($sql)){
    $user_data_set = $con->query($sql);
}else{
    echo "there is an error:".$con->error;
}

?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header">User Information</div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Address</th>
                            <th scope="col">Contact No</th>
                            <th scope="col">Action</th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($user_data_set AS $row){
                            $address = $row['zip_code'].', '.ucwords($row['city']).', '.ucwords(strtolower($row['country_name']));
                            $disable ='';
                            $tooltip ='';
                            if ($row['role']==1){
                                $disable = 'disabled';
                                $tooltip = "data-toggle=\"tooltip\" data-placement=\"bottom\" title=\"Warning! This is admin user, Can't be access.\"";
                            }

                            ?>
                        <tr <?= $tooltip?>>
                            <th scope="row"><?=$row['id']?></th>
                            <td><?=ucwords($row['name'])?></td>
                            <td><?=$row['email_add']?></td>
                            <td><?=$address?></td>
                            <td><?=$row['phonecode'].$row['phone']?></td>
                            <td class="d-flex">
                                <span <?=$tooltip?>><a  href="admin_user_control.php?uid=<?=$row['id']?>"  class="btn <?=$disable?>   btn-sm mr-1 btn-primary">Edit</a></span>
                                <span <?=$tooltip?> ><a  href="backend/delete_user.php?uid=<?=$row['id']?>" class="btn <?=$disable?> btn-sm btn-danger">Delete</a></span>
                            </td>
                        </tr>
                        <?php } ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>




<?php
include_once "layouts/footer.php";
?>
