<?php
session_start();
$title = "Manage Articles";
$hover_nav = "blog";
include_once "layouts/head.php";
include_once "layouts/nav.php";

include "config/db_connection.php";
$con = connection();


if (isset($_GET['blog_id'])){
    $id = $_GET['blog_id'];
    $sql = "SELECT * FROM blog WHERE id = $id";
    $blog_data = $con->query($sql);

}
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-10">
            <div class="card my-4">
                <h3 class="card-header">Edit Blog</h3>
                <div class="card-body">
                    <?php foreach ($blog_data as $row) { ?>
                    <form action="backend/update_blog.php" id="update_blog" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="hidden" name="blog_id" value="<?=$id?>">
                            <label for="" class="col-form-label">Blog Heading</label>
                            <input type="text" name="header" value="<?=$row['blog_head']?>" class="form-control" placeholder="Blog Header" required maxlength="100">
                        </div>
                        <div class="form-group">
                            <label for="" class="col-form-label">Blog Heading</label>
                            <textarea name="blog_content" required placeholder="Write your post article here" class="form-control" rows="8"><?=$row['blog_details']?></textarea>
                        </div>

                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file"  name="blog_file" class="custom-file-input" id="inputGroupFile02">
                                <label class="custom-file-label" for="inputGroupFile02">Chose to change image</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row justify-content-end">
                                <button type="button" onclick="window.location.href='manage_blog.php'" class="btn btn-danger mr-2">Cancel</button>
                                <button type="submit" name="edit_blog"  class="btn btn-primary">Update Post</button>
                            </div>
                        </div>
                    </form>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>




<?php
include_once "layouts/footer.php";

?>
