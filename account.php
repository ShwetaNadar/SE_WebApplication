<?php
// Initialize the session
session_start();
 
//Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

// Include config file
require_once "config.php";

$user = htmlspecialchars($_SESSION["username"]);

$sql = "SELECT pid, pname, page, pdisease, rid FROM patient WHERE uid='$user'";
if($result = mysqli_query($link, $sql))
{
    if(mysqli_num_rows($result) > 0)
    {
        $row = mysqli_fetch_array($result);
        $pid = $row['pid'];
        $sql1 = "SELECT dname FROM doctor WHERE did = (SELECT did FROM treats WHERE pid = '$pid')";
        if($result1 = mysqli_query($link, $sql1))
        {
            if(mysqli_num_rows($result1) > 0)
            {
            //$row = mysqli_fetch_array($result)
            $row1 = mysqli_fetch_array($result1);
            }
        }        
    }
}


if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    
// Escape user inputs for security
//$dept = mysqli_real_escape_string($link, $_REQUEST['dept']);
$doc = mysqli_real_escape_string($link, $_REQUEST['doc']);
$problem = mysqli_real_escape_string($link, $_REQUEST['problem']);
$date = mysqli_real_escape_string($link, $_REQUEST['date']);
$slot = mysqli_real_escape_string($link, $_REQUEST['slot']);
    $sql3 = "SELECT did FROM doctor WHERE dname = '$doc'";

    if($res = mysqli_query($link, $sql3))
    {
        $list = mysqli_fetch_array($res);
        $did = $list['did'];   
    // Attempt insert query execution
    $sql4 = "INSERT INTO appointment (a_date, problem, slot, did, pid) VALUES ('$date', '$problem', '$slot', '$did', '$pid')";
    if(mysqli_query($link, $sql4)){
        echo "<script> alert('Appontment Set!'); </script>";
    } else{
        //echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        //echo json_encode(array('success' => 0));
    }
}



}


$sql5 = "SELECT a_date, problem, slot, did FROM appointment WHERE pid = '$pid'";
$res1 =  mysqli_query($link, $sql5)

    //$num = mysql_num_rows($getTS)

    //while($det = mysqli_fetch_array($res1))
    //{
      //  echo "<script> $(document).ready(function(){ $('#hist').append('<tr> <td> {$det['a_date']} </td> <td> {$det['slot']} </td> <td> {$det['problem']} </td> </tr>'); }); </script>";

    //}





?>






<!DOCTYPE html>
<html>
  <head>
  <title> Welcome </title>
  <link rel="stylesheet" type="text/css" href="style1.css">
  <link rel="icon" href="fav.ico"type="image/x-icon"/>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
-->
<style>
#to {
    font-size 60px;
}

#myTab a:link {
    color: #40bfc1;
}

</style>



<!-- Font Awesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
<!-- Bootstrap core CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
<!-- Material Design Bootstrap -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.10/css/mdb.min.css" rel="stylesheet">



<!-- JQuery -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.10/js/mdb.min.js"></script>

<style>
.btn-cyan{
    float:right;
}
h1{
    text-align:center;
}
</style>

</head>

<body>

  <!--Navigation bar-->
  <div id="nav-placeholder">
</div>
<script>
$(function(){
  $("#nav-placeholder").load("nav.php");
});
</script>
<!--end of Navigation bar-->

<div class="page-header">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site. 
        <a href="logout.php" class="btn btn-cyan" >Logout</a></h1>
        
    </div>
        

    <div class="bs-example">
    <ul class="nav nav-tabs nav-justified" id="myTab">
        <li class="nav-item">
            <a href="#home" class="nav-link" data-toggle="tab"><b>Appointments</b></a>
        </li>
        <li class="nav-item">
            <a href="#profile" class="nav-link" data-toggle="tab"><b>Profile</b></a>
        </li>
        <li class="nav-item">
            <a href="#history" class="nav-link" data-toggle="tab"><b>History</b></a>
        </li>
        
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade" id="home">        
            <div class="py-3">
                <div class="row">

                    
                    <div class=" mx-auto col-sm-5">
                                <!-- form user info -->
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="mb-0">Appointment Form</h4>
                                    </div>
                                    <div class="card-body">
                                        <form class="form" role="form" autocomplete="off" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label form-control-label">Department</label>
                                                <div class="col-lg-9">
                                                <select class="form-control" id="dept" name="dept">
                                                    <option selected disabled> --Choose Department-- </option> 
                                                    <option value="Cardiology">Cardiology</option>
                                                    <option value="Neurology">Neurology</option>
                                                </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label form-control-label">Doctor Name</label>
                                                <div class="col-lg-9">
                                                <select class="form-control" name="doc" id="doc">
                                                

                                                </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label form-control-label">Appointment Date</label>
                                                <div class="col-lg-9">
                                                    <input class="form-control" type="date" name="date">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label form-control-label">Slot</label>
                                                <div class="col-lg-9">
                                                <select class="form-control" id="slot" name="slot">
                                                    <option selected disabled> --Choose Slot-- </option>
                                                    <option>Morning</option>
                                                    <option>Afternoon</option>
                                                    <option>Evening</option>
                                                </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label form-control-label">Problem</label>
                                                <div class="col-lg-9">
                                                    <input class="form-control" type="text" name="problem" value="">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label form-control-label"></label>
                                                <div class="col-lg-9">
                                                    <input type="submit" class="btn btn-primary" value="Set Appointment">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- /form user info -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="profile">
                <div class="py-3">
                <div class="row">

                    
                    <div class=" mx-auto col-sm-5">
                                <!-- form user info -->
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="mb-0">Patient Details</h4>
                                    </div>
                                    <div class="card-body">
                                    <table class="table table-success" id="to">
                                        <tbody>
                                            <tr>
                                            <th scope="row">1</th>
                                            <th>Patient Name</th>
                                            <th><?php echo $row['pname'];?></th>
                                            </tr>
                                            <tr>
                                            <th scope="row">2</th>
                                            <th>Age</th>
                                            <th><?php echo $row['page'];?></th>
                                            </tr>
                                            <tr>
                                            <th scope="row">3</th>
                                            <th>Problem</th>
                                            <th><?php echo $row['pdisease'];?></th>
                                            </tr>
                                            <tr>
                                            <th scope="row">4</th>
                                            <th>Doctor Name</th>
                                            <th><?php echo $row1['dname'];?></th>
                                            </tr>
                                            <tr>
                                            <th scope="row">5</th>
                                            <th>Room No</th>
                                            <th><?php echo $row['rid'];?></th>
                                            </tr>
                                        </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- /form user info -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="history">        
            <div class="py-3">
                <div class="row">
                    <div class=" mx-auto col-sm-5">
                                <!-- form user info -->
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="mb-0">History</h4>
                                    </div>
                                    <div class="card-body">
                                        <table class="table">
                                    <thead>
                                        <tr>
                                        <th scope="col">Date</th>
                                        <th scope="col">Slot</th>
                                        <th scope="col">Problem</th>
                                        <th scope="col">Doctor Name</th>
                                        </tr>
                                    </thead>
                                    <tbody id="hist">
                                    <?php
                                    while($det = mysqli_fetch_array($res1))
                                    {   $n = "SELECT dname FROM doctor where did = {$det['did']}";
                                        if($ans = mysqli_query($link, $n))
                                        {
                                            $naam = mysqli_fetch_array($ans);
                                        echo "<tr> <td> {$det['a_date']} </td> <td> {$det['slot']} </td> <td> {$det['problem']} </td> <td> {$naam['dname']} </td> </tr>";
                                        }
                                    }
                                    ?>

                                    </tbody>
                                    </table>

                                <!-- /form user info -->
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>

        <script>
$('#dept').on('change', function(){
    $('#doc').html('<option selected disabled> --Choose Doctor-- </option>');
    if($('#dept').val()=="Cardiology"){
        $('#doc').append('<option value="Ken">Ken</option> <option value="Wren">Wren</option>');
    }else if($('#dept').val()=="Neurology"){
        $('#doc').append('<option value="Riya">Riya</option><option value="Henry">Henry</option>');
    }
});
</script>


</body>
</html>