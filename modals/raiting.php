
<!-- Raiting And Feedback -->
<div class="modal fade" id="councilor_feedback" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Feedback</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="./backend/feedback.php" method="POST" class="row g-3" >
                    

                    <div class="input-group has-validation">
                        <input type="hidden" name="user_id" value="<?=$_SESSION['user']['id']?>">
                        <input type="hidden" name="councilor_id" value="<?=$data['id']?>">
                        <input name="ratings" type="number" max="5" min="0" class="form-control" maxlength="1" placeholder="Enter a point out of 5" required>
                        <div class="invalid-feedback">
                           please provide point out of 5
                        </div>

                    </div>

                    <div class="input-group has-validation">
                        <!-- <input name="password" type="password" class="form-control" id="password" minlength="8" placeholder="Password" required> -->
                        <textarea name="feedback" class="form-control" rows="4" placeholder="Write Your Feedback"></textarea>
                        

                    </div>

                    <div class="col-12 d-grid">
                        <button name="btn-feedback" value="btn-feedback" type="submit" class="btn btn-primary">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
