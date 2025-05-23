  <!-- =============footer section ============== -->
  <footer class="footer ">
    <div class="footer__body f-bdy">
      <div class="f-bdy__segment">
        <h3 class="f-bdy__title">Quick Links</h3>
        <ul class="f-bdy__contents">
          <li class="f-bdy__content"><a href="./doctor_appointment.php" class="f-bdy__content-link">Get Help</a></li>
          <li class="f-bdy__content"><a href="./community.php" class="f-bdy__content-link">Community</a></li>
          <li class="f-bdy__content"><a href="contact_us.php" class="f-bdy__content-link">Contact Us</a></li>
          <li class="f-bdy__content"><a href="about.php" class="f-bdy__content-link">About</a></li>
        </ul>
      </div>

      <div class="f-bdy__segment">
        <h3 class="f-bdy__title">Get Involved</h3>
        <ul class="f-bdy__contents">
          <li class="f-bdy__content"><a href="councilor_reg.php" class="f-bdy__content-link">Join as counselor</a></li>
          <li class="f-bdy__content"><a href="contact_us.php" class="f-bdy__content-link">Browse and contact </a></li>
          <li class="f-bdy__content"><a href="doc_reg.php" class="f-bdy__content-link">Become a doctor </a></li>
          <li class="f-bdy__content"><a href="index.php" class="f-bdy__content-link">Work with us</a></li>
        </ul>
      </div>

      <div class="f-bdy__segment">
        <h3 class="f-bdy__title">Social Links</h3>
        <ul class="f-bdy__contents">
          <li class="f-bdy__content"><a href="https://www.facebook.com/" class="f-bdy__content-link">Facebook</a></li>
          <li class="f-bdy__content"><a href="https://twitter.com/i/flow/login" class="f-bdy__content-link">Twitter</a></li>
          <li class="f-bdy__content"><a href="https://www.instagram.com/" class="f-bdy__content-link">Instagram</a></li>
          <li class="f-bdy__content"><a href="https://bd.linkedin.com/" class="f-bdy__content-link">Linkdin</a></li>
        </ul>
      </div>
    </div>
    <div class="footer__bottom f-btm">
      <p class="f-btm__content">Copyright ©2022 All rights reserved | This template is made with &#128420; by Mayesha</p>

    </div>
  </footer>
  <!-- modal area  -->
  <?php
  include "./modals/login.php";
  include "./modals/register_modal.php";
  ?>


  </div>
  <!-- js link -->
  <!--bootstrap js-->
  <!-- <script src="./vendor/bootstrap-5.2.0/js/bootstrap.min.js" defer type="text/javascript"></script> -->
  <!--bootstrap pooper js-->
  <!-- <script defer src="./vendor/bootstrap-5.2.0/js/bootstrap.bundle.js" type="text/javascript"></script> -->
  <!--fontawesome js-->
  <script src="./vendor/fontawesome-free-6.1.1/js/all.js" type="text/javascript"></script>
  <!-- jquery js  -->
  <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
  <!-- datatable  -->
  <script type="text/javascript" src="vendor/DataTables/datatables.min.js"></script>
  <script type="text/javascript" src="vendor/DataTables/dataTables.responsive.min.js"></script>



  <script src="./js/main.js" type="text/javascript"></script>

  <?php
  function login_alert($data)
  {
    if ($data['status']) {
      $success = '';
      unset($data['status']);
      foreach ($data as $message) {
        $success .= trim($message);
      }
      return array('status' => 'success', 'message' => $success);
    } else {
      $error  = '';

      foreach ($data as $message) {
        $error .= trim($message);
      }
      return array('status' => 'error', 'message' => $error);
    }
  }

  if (isset($_SESSION['login_status'])) {
    $login_status = login_alert($_SESSION['login_status']);
    unset($_SESSION['login_status']);
  } else {
    $login_status = false;
  }


  ?>
  <script type="text/javascript">
    let loginStatus;
    loginStatus = <?= json_encode($login_status) ?>;
    if (loginStatus) {
      Swal.fire({
        position: 'top-end',
        icon: loginStatus['status'],
        title: loginStatus['message'],
        showConfirmButton: false,
        timer: 2000
      });
    }
  </script>

  </body>

  </html>