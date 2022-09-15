
<!--Sign in Modal -->
<div class="modal fade" id="login" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="login">Sign In</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="row g-3" action="./backend/login.php" method="POST">
            <div class="col-md-12">
                <label for="inputEmail4" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="inputEmail4">
            </div>
            <div class="col-md-12">
                <label for="inputPassword4" class="form-label">Password</label>
                <input type="password" name="pass" class="form-control" id="inputPassword4">
            </div>
            <div class="col-12 sign-in">
                <div class="signin-button">
                    <button type="submit" name="btn-login" class="mx-auto button buttton--size-medium">Sign in</button>  
                </div>
                <div class="no-account">
                    <a href="#">Forgot Password</a>
                </div>
                <div class="no-account">
                    <a href="<?=$register?>">I don't have account</a>
                </div>
            </div>
        </form>
      </div>
      
    </div>
  </div>
</div>



