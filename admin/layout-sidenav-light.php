<?php
include_once "./admin-layouts/head.php";
include_once "./admin-layouts/nav.php";
?>

<div id="layoutSidenav">
    <!-- aside  -->
    <?php include_once "./admin-layouts/aside.php"; ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Sidenav Light</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="<?=$dashboard?>">Dashboard</a></li>
                    <li class="breadcrumb-item active">Sidenav Light</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-body">
                        This page is an example of using the light side navigation option. By appending the
                        <code>.sb-sidenav-light</code>
                        class to the
                        <code>.sb-sidenav</code>
                        class, the side navigation will take on a light color scheme. The
                        <code>.sb-sidenav-dark</code>
                        is also available for a darker option.
                    </div>
                </div>
            </div>
        </main>
         <!-- footer  -->
         <?php include_once "./admin-layouts/footer.php"; ?>
    </div>
</div>
<!-- script -->
<?php include_once "./admin-layouts/closer.php"; ?>