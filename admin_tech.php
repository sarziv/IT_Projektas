<html>
<?php include 'head.html';?>
<body>
		
<div id="wrapper">

<!-- Sidebar -->
		<?php include 'sidePanel/menu.html';?>
<!-- /#sidebar-wrapper -->

<div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
		<?php include 'button/buttonMenuCp.html';?>
			<div
<?php
	require 'backend/connect.php';
	$conn    = Connect();
	
if (isset($_POST['name'])) {
	$name    = $conn->real_escape_string($_POST['name']);
}
if (isset($_POST['password'])) {	
	$password    = $conn->real_escape_string($_POST['password']);
}
$queryNameValidation =
"SELECT name FROM user WHERE (name = '" . $name . "')";
$resultNameValidation  = $conn->query($queryNameValidation);

if($resultNameValidation->num_rows < 1){

$queryInfo   = "INSERT INTO `user`(`name`,`password`,`user_type_id`) VALUES ('$name','$password','2')";
$resultInfo = $conn->query($queryInfo);
?>
<h3 class="text-center"><b>Vartotojas uzregistruotas</b></h3>
<h5>Prisijungimo vardas:<b> <?php echo $name ?></b></h5>
<h5>Slaptazodis: <b><?php echo $password ?></b></h5> 
<?php

}else{
	echo '    
<div class="alert alert-danger" id="top">
<strong>Toks vardas jau yra!</strong></div>';
}

?>

<button class="btn btn-primary" style="margin: 20 15 15 15" onclick="history.go(-1);">Atgal </button>

                </div>
            </div>
        </div>
    </div>
    <!-- /#wrapper -->
	<script src="js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>

<?php 
echo "<script>
setTimeout(function () {
  $('.alert').alert('close')
}, 3000)
</script>";
?>
</body>
</html>