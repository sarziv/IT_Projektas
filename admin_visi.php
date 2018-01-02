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
			<div>
<?php

	require 'backend/connect.php';
	$conn    = Connect();
	
$queryVisiRecord  = "SELECT `orders`.`order_name`, `order_vykd`.`order_type`
FROM `order_vykd`
LEFT JOIN `IT_projektas`.`orders` ON `order_vykd`.`id` = `orders`.`order_type_id` ";
$resultVisiRecord = $conn->query($queryVisiRecord);
?>

<table class="table table-striped table-inverse">                     
    <div class="table responsive">
        <thead>
            <tr>
              <th>Pavadinimas</th>
              <th>Busena</th>
            </tr>
        </thead>
    <tbody>
	
<?php

if ($resultVisiRecord ->num_rows > 0) {
    // output data of each row
    while($row = $resultVisiRecord ->fetch_assoc()) {
        echo '
		<tr>
                  <td scope="row">' . $row["order_name"] . '</td>
				  <td>' . $row["order_type"] .'</td>
        </tr>';

	echo '</tbody>
	</div>
	</div>';
		}
    }
	$conn -> close();

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