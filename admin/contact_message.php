<?php

include_once "./admin-layouts/head.php";
include_once "./admin-layouts/nav.php";

// database connection 

include "../config/db_connection.php";


$sql = "SELECT * FROM `contact_us` ORDER BY id DESC;";

if($message_set = db_connection()->query($sql)){
    $messages = $message_set->fetch_all(MYSQLI_ASSOC);

}else{
    $validation_message = "Error database connection";
}

?>
<div id="layoutSidenav">
    <!-- aside  -->
    <?php include_once "./admin-layouts/aside.php"; ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Contact Message</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="<?=$dashboard?>">Dashboard</a></li>
                    <li class="breadcrumb-item active">Messages</li>
                </ol>
                <div class="card mb-4">
                    
                </div>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Messages From Users
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email Id</th>
                                    <th>Message</th>
                                    
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Email Id</th>
                                    <th>Message</th>
                                </tr>
                            </tfoot>
                            <tbody>
                            <?php 
                            foreach($messages AS $row){
                            ?>

                                <tr>
                                    <td><?=$row['f_name'] . $row['l_name']?></td>
                                    <td><?=$row['email']?></td>
                                    <td><?=$row['comment']?></td>
                                    
                                </tr>

                                <?php  } ?>
                               
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
        <!-- footer  -->
        <?php include_once "./admin-layouts/footer.php"; ?>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
<script src="js/datatables-simple-demo.js"></script>
</body>

</html>