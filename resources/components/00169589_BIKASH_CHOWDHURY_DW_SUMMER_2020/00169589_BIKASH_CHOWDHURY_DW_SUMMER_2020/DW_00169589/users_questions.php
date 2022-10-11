<?php
$title = "User questions list";
include_once "layouts/head.php";
include "config/db_connection.php";
$con = connection();

$sql = "SELECT * FROM user_ques";
$user_data = $con->query($sql)

?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card mt-5">
                <h2 class="card-header">User Questions</h2>
                <div class="card-body">
                    <table class="rounded table table-dark">
                        <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Subject</th>
                            <th scope="col">Question</th>
                            <th scope="col">Action</th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($user_data AS $value){ ?>
                        <tr>
                            <td><?=$value['id']?> </td>
                            <td><?=$value['name']?> </td>
                            <td><?=$value['e_mail']?> </td>
                            <td><?=$value['subject']?> </td>
                            <td><?=$value['messeage']?> </td>
                            <td>
                                <a href="#" title="This is only prototype" class="btn btn-success">Reply</a>
                                <a href="backend/delete_user_ques.php?id=<?=$value['id']?>" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <div class="row justify-content-end">
                        <button type="button" onclick="window.location.href='index.php'" class="btn btn-primary">Back TO Home</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

