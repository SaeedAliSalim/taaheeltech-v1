<?php
if (!isset($_SESSION)) {
   session_start();
}
include('config.php');
include('function.php');
// Select Queries

if (!isset($_SESSION['admin_role'])) {
   if (isset($_POST['username']) && isset($_POST['password'])) {
      $username = input_secure($_POST['username']);
      $password = input_secure($_POST['password']);
      $ency_password = sha1(md5($password));

      $sql_stmnt = "SELECT * from users where username ='" . $username . "'
       and password ='" . $ency_password . "' ";

      $sql_qury = mysqli_query($connection, $sql_stmnt);
      $users_num = mysqli_num_rows($sql_qury);

      if ($users_num > 0) {
         $_SESSION['admin_role'] = 1;
?>
         <script language="javascript">
            window.location.href = "dashboard.php";
         </script>
      <?php
      } else {
      ?>
         <script language="javascript">
            window.location.href = "index.php?error_msg=1";
         </script>
      <?php
      }
   } else {
      ?>
      <script language="javascript">
         window.location.href = "index.php?error_msg=1";
      </script>
   <?php
   }
} else {

   ?>
   <?php

   $breadcrumb_array = array(
      "لوحة التحكم"
   );
   include('header.php');
   ?>
   <!--begin::Dashboard-->
   welcome
   <!--end::Dashboard-->
<?php
   $widget_page = true;
   include('footer.php');
}
?>