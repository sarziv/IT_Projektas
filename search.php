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
	
if (isset($_POST['products'])) {
	$products    = $conn->real_escape_string($_POST['products']);
}
echo "$products";
$query   = "
SELECT * FROM products WHERE products LIKE '%{$products}%'";

	$success = $conn->query($query);
	
if (!$success) {
    die("Couldn't enter data: ".$conn->error);
}

	$result = $conn->query($query);
echo "$products";
?>

<h3 class="text-center">Search</h3>
<h2><?php echo $products ?></h2>
<table class="table table-striped">                     
    <div class="table responsive">
        <thead>
            <tr>
				<th>ID</th>
              <th>Products</th>
              <th>Price</th>
            </tr>
        </thead>
    <tbody>

<?php 

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo '<tr>
                  <td scope="row">' 
						. $row["id"]. '</td>
						<td> '.$row["products"] .'</td>
                  <td> '.$row["price"] .'</td>
                </tr>';
    }
} else {
    echo "0 results";
} 
?>
       </tbody>
    </div>
	</div>
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
</body>
</html>