<!DOCTYPE html>
<html lang="en">
<?php

// Inialize session
session_start();

// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['admin_user'])) {
header('Location: index.html');
}

?>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Use< Login</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="css/style.min.css" rel="stylesheet">

    <script src="js/jquery-1.8.3.min.js"></script>
    <link rel="stylesheet" type="text/css" href="medias/css/dataTable.css" />
    <script src="medias/js/jquery.dataTables.js" type="text/javascript"></script>
    <!-- end table-->
    <script type="text/javascript" charset="utf-8">
  $(document).ready(function(){
      $('#dtable').dataTable({
                "aLengthMenu": [[5, 10, 15, 25, 50, 100 , -1], [5, 10, 15, 25, 50, 100, "All"]],
                "iDisplayLength": 10
                //"destroy":true;
            });
  })
    </script>

  <style>
          select[multiple], select[size] {
    height: auto;
    width: 20px;
}
.pull-right {
    float: right;
    margin: 2px !important;
}

    .map-container{
overflow:hidden;
padding-bottom:56.25%;
position:relative;
height:0;
}
.map-container iframe{
left:0;
top:0;
height:100%;
width:100%;
position:absolute;
}
#loader{
        position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background: url('img/lg.flip-book-loader.gif') 50% 50% no-repeat rgb(249,249,249);
        opacity: 1;
    }
  </style>

    <script src="jquery.min.js"></script>
<script type="text/javascript">
  $(window).on('load', function(){
    //you remove this timeout
    setTimeout(function(){
          $('#loader').fadeOut('slow');  
      });
      //remove the timeout
      //$('#loader').fadeOut('slow'); 
  });
</script>
</head>

<body class="grey lighten-3">

  <!--Main Navigation-->
  <header>

    <!-- Navbar -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-light white scrolling-navbar">
      <div class="container-fluid">

        <!-- Brand -->
        <a class="navbar-brand waves-effect" href="#">
          <strong class="blue-text"></strong>
        </a>

        <!-- Collapse -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Links -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

          <!-- Left -->
          <ul class="navbar-nav mr-auto">
        
          </ul>
            <?php 

             require_once("include/connection.php");


               $id = mysqli_real_escape_string($conn,$_SESSION['admin_user']);


              $r = mysqli_query($conn,"SELECT * FROM admin_login where id = '$id'") or die (mysqli_error($con));

              $row = mysqli_fetch_array($r);

               $id=$row['admin_user'];
               // $fname=$row['fname'];
               // $lname=$row['lname'];

            ?>

          <!-- Right -->
          <ul class="navbar-nav nav-flex-icons">
                <li style="margin-top: 10px;">Welcome!,</font> <?php echo ucwords(htmlentities($id)); ?></li>
            <li class="nav-item">
              <a href="#" class="nav-link waves-effect" target="_blank">
                <i class="fab fa-facebook-f"></i>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link waves-effect" target="_blank">
                <i class="fab fa-twitter"></i>
              </a>
            </li>
            <li class="nav-item">
              <a href="logout.php" class="nav-link border border-light rounded waves-effect">
               <i class="far fa-user-circle"></i>SignOut
              </a>
            </li>
          </ul>

        </div>

      </div>
    </nav>
    <!-- Navbar -->

    <!-- Sidebar -->
    <div class="sidebar-fixed position-fixed">

      <a class="logo-wrapper waves-effect">
      
        <img src="img/images.jpg" width="150px" height="200px;" class="img-fluid" alt="">
      </a>

       <div class="list-group list-group-flush">
        <a href="dashboard.php" class="list-group-item active waves-effect">
          <i class="fas fa-chart-pie mr-3"></i>Dashboard
        </a>
         <a href="#" class="list-group-item list-group-item-action waves-effect"  data-toggle="modal" data-target="#modalRegisterForm">
          <i class="fas fa-user mr-3"></i>Add Admin</a>
            <a href="view_admin.php" class="list-group-item list-group-item-action waves-effect">
          <i class="fas fa-users"></i> View Admin</a>
        <a href="#" class="list-group-item list-group-item-action waves-effect" data-toggle="modal" data-target="#modalRegisterForm2">
          <i class="fas fa-user mr-3"></i>Add User</a>
           <a href="view_user.php" class="list-group-item list-group-item-action waves-effect">
          <i class="fas fa-users"></i>  View User</a>
        <a href="add_document.php" class="list-group-item list-group-item-action waves-effect">
          <i class="fas fa-file-medical"></i> Add Document</a>
        <a href="view_userfile.php" class="list-group-item list-group-item-action waves-effect">
          <i class="fas fa-folder-open"></i> View User File</a>
            <a href="admin_log.php" class="list-group-item list-group-item-action waves-effect">
          <i class="fas fa-chalkboard-teacher"></i> Admin logged</a>
              <a href="user_log.php" class="list-group-item list-group-item-action waves-effect">
          <i class="fas fa-chalkboard-teacher"></i> User logged</a>
    <!--     <a href="#" class="list-group-item list-group-item-action waves-effect">
          <i class="fas fa-money-bill-alt mr-3"></i>Orders</a> -->
      </div>

    </div>
  <!--Add admin-->
   <div class="modal fade" id="modalRegisterForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <form action="create_Admin.php" method="POST">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold"><i class="fas fa-user-plus"></i> Add Admin</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
           <div class="md-form mb-5">
          <input type="hidden" id="orangeForm-name" name="status" value = "Admin" class="form-control validate">
        </div>
        <div class="md-form mb-5">
          <i class="fas fa-user prefix grey-text"></i>
          <input type="text" id="orangeForm-name" name="name" class="form-control validate" required="">
          <label data-error="wrong" data-success="right" for="orangeForm-name">Your name</label>
        </div>
        <div class="md-form mb-5">
          <i class="fas fa-envelope prefix grey-text"></i>
          <input type="email" id="orangeForm-email" name="admin_user" class="form-control validate" required="">
          <label data-error="wrong" data-success="right" for="orangeForm-email">Your email</label>
        </div>

        <div class="md-form mb-4">
          <i class="fas fa-lock prefix grey-text"></i>
          <input type="password" id="orangeForm-pass" name="admin_password" class="form-control validate" required="">
          <label data-error="wrong" data-success="right" for="orangeForm-pass">Your password</label>
        </div>

      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button class="btn btn-info" name="reg">Sign up</button>
      </div>
    </div>
  </div>
</div>
</form>
<!--end modaladmin-->
  <!--Add user-->
   <div class="modal fade" id="modalRegisterForm2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <form action="create_user.php" method="POST">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold"><i class="fas fa-user-plus"></i> Add User Employee</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
           <div class="md-form mb-5">
          <input type="hidden" id="orangeForm-name" name="status" value = "Employee" class="form-control validate" required="">
        </div>
        <div class="md-form mb-5">
          <i class="fas fa-user prefix grey-text"></i>
          <input type="text" id="orangeForm-name" name="name" class="form-control validate">
          <label data-error="wrong" data-success="right" for="orangeForm-name">Your name</label>
        </div>
        <div class="md-form mb-5">
          <i class="fas fa-envelope prefix grey-text"></i>
          <input type="email" id="orangeForm-email" name="email_address" class="form-control validate" required="">
          <label data-error="wrong" data-success="right" for="orangeForm-email">Your email</label>
        </div>

        <div class="md-form mb-4">
          <i class="fas fa-lock prefix grey-text"></i>
          <input type="password" id="orangeForm-pass" name="user_password" class="form-control validate" required="">
          <label data-error="wrong" data-success="right" for="orangeForm-pass">Your password</label>
        </div>

      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button class="btn btn-info" name="reguser">Sign up</button>
      </div>
    </div>
  </div>
</div>
</form>
<!--end modaluser-->

  </header>
  <!--Main Navigation-->
 <div id="loader"></div>
  <!--Main layout-->
  <main class="pt-5 mx-lg-5">
    <div class="container-fluid mt-5">

      <!-- Heading -->
      <div class="card mb-4 wow fadeIn">

        <!--Card content-->
        <div class="card-body d-sm-flex justify-content-between">

          <h4 class="mb-2 mb-sm-0 pt-1">
            <a href="dashboard.php">Home Page</a>
            <span>/</span>
            <span>Dashboard</span>

            <div class="department">

                <a href=""><span>ICT</span></a>
                <a href=""><span>Libray</span></a>
                <a href=""><span>Accounts</span></a>
                <a href=""><span>Planning</span></a>
                <a href="">Others<span></span></a>
            </div>
            <style>
              
              .department {
                            margin-left: 630px;
                            margin-bottom: 45px;
                            display: flex;
                                         
                            justify-content: space-between;
                            align-items: center;
              }

              .department a {
                 display: inline-block;
                 padding: 8px 16px;
                 border: 2px solid #007BFF;
                 border-radius: 5px;
                 text-decoration: none;
                 color: #333;
                  font-size: 15px; /* Adjust font size as needed */
                  font-weight: bold;
                   transition: all 0.3s ease;
                    margin-right: 9px; /* Add some space between buttons */
                }

             .department a:last-child {
                                                margin-right: 0; /* Remove margin-right for the last button */
                         }

              .department a:hover {
                                                background-color: #C8E3FF;;
              }


            </style>
          </h4>
<!-- 
          <form class="d-flex justify-content-center">
       
            <input type="search" placeholder="Type your query" aria-label="Search" class="form-control">
            <button class="btn btn-primary btn-sm my-0 p" type="submit">
              <i class="fas fa-search"></i>
            </button>

          </form> -->

        </div>

      </div>
      <!-- Heading -->
      <div class="">
    <!--   <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalRegisterForm">Add File</button> -->
    <a href="add_document.php"><button type="button" class="btn btn-info"><i class="fas fa-chevron-circle-left"></i>  Document</button></a>
    </div>
  
<hr>
 
 <div class="col-md-12">

  <table id="dtable" class = "table table-striped" styles="">
     <thead>

    <!-- <th>ID</th> -->
    <th>USER LOGGED</th>    
     <th>YOUR IP</th>
     <th>HOST</th>
     <th>ACTION</th> 
     <th>TIMEIN</th>
     <th>ACTION</th> 
     <th>TIMEOUT</th>


</thead>
<tbody>

    
    <tr>
        <?php 
   
        require_once("include/connection.php");

      $query = mysqli_query($conn,"SELECT * from history_log") or die (mysqli_error($conn));
      while($file=mysqli_fetch_array($query)){
       //  $id =  $file['id'];
         $name =  $file['email_address'];
         $ip =  $file['ip'];
         $host =  $file['host'];
         $action =  $file['action'];
         $logintime =  $file['login_time'];
         $actions =  $file['actions'];
         $logouttime =  $file['logout_time'];
      
    
      ?>
     
      <!-- <td><?php echo  $id; ?></td> -->
      <td><?php echo $name; ?></td>
       <td><?php echo $ip; ?></td>
      <td><?php echo $host; ?></td>
      <td><?php echo $action; ?></td>
      <td><?php echo $logintime; ?></td>
      <td><?php echo $actions; ?></td>
      <td><?php echo $logouttime; ?></td>

    </tr>
<?php } ?>
</tbody>
   </table>
    </div>  
    <!--Copyright-->
    <hr></div>
    <div class="footer-copyright py-3">
  <p>All right Reserved 2021&copy; <?php echo date('Y');?> Created By:CampCodes</p>
    </div>
    <!--/.Copyright-->

  </footer>
  <!--/.Footer-->

<!-- Card -->
  <!-- /Start your project here-->

  <!-- SCRIPTS -->
  <!-- JQuery -->
  <script type="text/javascript" src="js/jquery-3.4.0.min.js"></script>

  <script type="text/javascript" src="js/popper.min.js"></script>

  <script type="text/javascript" src="js/bootstrap.min.js"></script>

  <script type="text/javascript" src="js/mdb.min.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css"/>   
<script type="text/javascript" src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/1.0.3/css/dataTables.responsive.css">
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/responsive/1.0.3/js/dataTables.responsive.js"></script>

</body>

</html>
