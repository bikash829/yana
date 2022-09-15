<?php
session_start();
$title = "Air Pollution";

include_once "layouts/head.php";
include_once "layouts/nav.php";

include "config/db_connection.php";
$con = connection();

$sql = "SELECT * FROM blog";
if ($con->query($sql)){
    $blog_data_set = $con->query($sql);
}else{
    $_GET['success'] = "There is an error: ".$con->error;
}
?>
<div class="container">
    <div class="card-body">
            <div class="row justify-content-end">
                <div class="form-group ">
                    <button type="button" data-toggle="modal" data-target=".create_blog" class="btn btn-info"><i class="fas fa-plus-circle"></i> Create Post</button>
                </div>
            </div>
        </div>
    <div class=" row">
     <?php
    foreach ($blog_data_set as $item) {
        //Zipping paragraph
        $explode_blog = explode(' ',$item['blog_details']);
        $count = 0;
        $short_blog = "";
        foreach ($explode_blog as $value){
//            $short_blog .= $value.' ';

            $count++;
            if ($count<=40){
                $short_blog .= $value.' ';
            }
        }
        //file accessing
        $file_location = "images/blog_image/".$item['image_name'].'.'.$item['image_ext'];
    ?>
        <div class="col-12 col-md-6 col-lg-6">
            <div class="card mb-3">
                <h3 class="card-header" ><?=$item['blog_head']?></h3>
                <div class="card-header py-1 bg-white d-flex justify-content-end" >
                    <button type="button" onclick="window.location.href='edit_blog.php?blog_id=<?=$item['id']?>'" class="btn mr-2 btn-primary">Edit</button>
                    <button type="button" onclick="window.location.href='backend/delete_post.php?pid=<?=$item['id']?>'" class="btn btn-danger">Delete</button>
                </div>
                <div class="card-body">
                    <div class="blog-entry align-self-stretch">
                        <a href="blog-single.php" class="block-20 rounded img-2" style="background-image: url('<?=$file_location?>');">
                        </a>
                        <div class="text mt-3">
                            <div class="meta mb-2">
                                <div><a href="#"><?=$item['post_date']?></a></div>
                                <div><a href="#">Admin</a></div>
                            </div>
                            <p><?=$short_blog.'.....'?></p>
                            <p><a href="blog-single.php?bid=<?=$item['id']?>" class="btn btn-primary">Read more</a></p>
                            <input type="hidden" name="post_id" value="<?=$item['id']?>">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    <?php }?>
    </div>



    </div>





<!------ Create post modal ---->
    <div class="modal fade create_blog" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Create New Blog</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="backend/create_blog.php" id="create_new_blog" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="text" name="header" class="form-control" placeholder="Blog Header" required maxlength="100">
                        </div>
                        <div class="form-group">
                            <textarea name="blog_content" required placeholder="Write your post article here" class="form-control" rows="3"></textarea>
                        </div>

                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" required name="blog_file" class="custom-file-input" id="inputGroupFile02">
                                <label class="custom-file-label" for="inputGroupFile02">Choose file</label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" form="create_new_blog" name="post_sender" class="btn btn-primary">Upload Blog</button>
                </div>
            </div>
        </div>
    </div>

<!--Post edit modal -->
    <div class="modal fade edit_blog" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit The Blog</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="backend/edit_blog.php" id="edit_blog" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="text" name="header" value="<?=$item['blog_head']?>" class="form-control" placeholder="Blog Header" required maxlength="100">
                        </div>
                        <div class="form-group">
                            <textarea name="blog_content" required placeholder="Write your post article here" class="form-control" rows="3"></textarea>
                        </div>

                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" required name="blog_file" class="custom-file-input" id="inputGroupFile02">
                                <label class="custom-file-label" for="inputGroupFile02">Choose file</label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" form="create_new_blog" name="post_sender" class="btn btn-primary">Upload Blog</button>
                </div>
            </div>
        </div>
    </div>


<?php

include_once "layouts/footer.php";
?>