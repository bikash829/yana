<?php
$title = "Mange Faq";
include_once "layouts/head.php";
include "config/db_connection.php";
$con = connection();

$sql = "SELECT * FROM user_faq";
$faq_set = $con->query($sql);
include "layouts/alert.php";
?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 mt-5">
            <table class="rounded table table-dark">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Header</th>
                    <th scope="col">Message</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($faq_set AS $data){ ?>
                    <tr>
                        <td><?=$data['id']?></td>
                        <td ><?=$data['header']?></td>
                        <td ><?=$data['subject']?></td>
                        <td>
                            <a href="backend/delete_faq.php?id=<?=$data['id']?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                    <?php }?>

                </tbody>
            </table>
        </div>
    </div>
</div>
