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

if (isset($_POST['id'])) {	
	$id    = $conn->real_escape_string($_POST['id']);
}
$queryUpdateTech  =    "
UPDATE `orders` SET `order_type_id` = '3' WHERE `orders`.`id` = ".$id." ";
$resultUpdateTech = $conn->query($queryUpdateTech);

?>
<h3 class="text-center"><b>Uzsakymas atliktas.</b></h3>
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