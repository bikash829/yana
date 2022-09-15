<!--Register Modal -->
<div class="modal fade" id="register_popup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center">Register Now</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body row register-card-popup">
                <h3 class="col-12 text-center pb-4">Register as a </h3>
                <div class="btn-group col-12 justify-centent-center" role="group" aria-label="Basic mixed styles example">
                    <a href="<?=$councilor_reg?>" class="btn btn-lg btn-danger">Councilor</a>
                    <a href="<?= $register ?>" class="btn btn-lg btn-success">Patient</a>
                    <a href="<?=$doc_reg?>" class="btn btn-lg btn-warning">Doctor</a>
                </div>
                <div class="no-account text-center pt-3">
                    <a href="./modals/login.php">Already Have an account</a>
                </div>
            </div>

        </div>
    </div>
</div>