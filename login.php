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
//query for name and password check
if (isset($_POST['name'])) {
	$name    = $conn->real_escape_string($_POST['name']);
}
if (isset($_POST['password'])) {	
	$password    = $conn->real_escape_string($_POST['password']);
}
if (isset($_POST['ordervardas'])) {
	$ordervardas  = $conn->real_escape_string($_POST['ordervardas']);
}
if (!empty($_POST['ordervardas'])){
$queryUserId   = "SELECT `user`.`id`  FROM `user` WHERE ((`user`.`name` ='$name'))";
$resultUserId = $conn->query($queryUserId);
if ($resultUserId ->num_rows > 0) {
    while($row = $resultUserId ->fetch_assoc()) {
$queryUserOrder   = "INSERT INTO `orders`(`order_name`, `order_type_id`, `user_id`) VALUES ('$ordervardas','1',".$row["id"].")";
$resultUserOrder  = $conn->query($queryUserOrder );
		}
	}
}

$queryCheck   = "SELECT `user`.`name` , `user`. `password` FROM `user` WHERE ((`user`.`name` ='$name') AND (`user`.`password` ='$password'))";
$resultCheck = $conn->query($queryCheck);

if ($resultCheck->num_rows >= 1) { 

$queryType   = "SELECT `user_type`.`type` FROM `user`
LEFT JOIN user_type ON user.user_type_id = user_type.id
WHERE ((`user`.`name` ='$name') AND (`user`.`password` ='$password'))";

$resultType = $conn->query($queryType);

if ($resultType ->num_rows > 0) {
    // output data of each row
    while($row = $resultType ->fetch_assoc()) {
        echo '
		<tr>
                  <td scope="row">'. "Privilegijos: " ."<b>". $row["type"] ."</b>". '</td>
        </tr>';
    }
} else {
    echo "0 results";
} 
echo '    
<div class="alert alert-success" style="position: fixed;bottom: 20;right: 10;z-index: 999;width: 15%;"><strong>Prisijungimas sekmingas!</strong></div>';
}else{
	echo '    
<div class="alert alert-danger" style="position: fixed;bottom: 20;right: 10;z-index: 999;width: 15%;"><strong>Klaida!</strong></div>';
die();
}

if (!$resultCheck) {
    die("Couldn't enter data: ".$conn->error);
}
	$resultCheck = $conn->query($queryCheck);
?>

<p>Prisijungtas: <b><?php echo $name ?></b></p>
<h3 class="text-center">Valdymo skydelis</h3>

<?php 
$queryUser   = "SELECT `user`. `user_type_id` FROM `user` WHERE (`user`.`name` ='$name')";
$resultUser = $conn->query($queryUser);
//admin
if ($resultUser ->num_rows > 0) {
    // output data of each row
    while($row = $resultUser ->fetch_assoc()) {
		if ($row["user_type_id"] == 1)
		{
			//nauju vartotoju sukurimas -> redirect to admin_klie ir tech failus
			include 'admin_naujas_klie.php';
			include 'admin_naujas_tech.php';
			
echo '<h3 class="text-center">Nepriskirti uzsakymai</h3>';
			//priskyrimas techams
			
$queryNepriUzsak   = "SELECT `orders`.`id`,`orders`.`order_name`, `orders`.`tech_id` FROM `orders` WHERE (`orders`.`tech_id` ='0')";
$resultNepriUzsak = $conn->query($queryNepriUzsak);

$queryAllTech = "SELECT `user`.`name` FROM `user` WHERE (`user`.`user_type_id` ='2')";
$resultAllTech = $conn->query($queryAllTech);

?>

<table class="table table-striped table-inverse" align="center" style="width:500px">                     
    <div class="table responsive">
        <thead>
            <tr>
			  <th width="20%">ID</th>
              <th width="40%">Uzsakymas</th>
              <th width="30%">Priskirtas</th>
            </tr>
        </thead>
    <tbody>
<?php

if ($resultNepriUzsak ->num_rows > 0) {
    // output data of each row
    while($row = $resultNepriUzsak ->fetch_assoc()) {
echo '<form method="post" action="admin_select.php">';		
echo '
		<tr>
                  <td scope="row">' . $row["id"] ."</b>". '</td>
				  <input type="hidden" name="order_id" value="'.$row["id"].'"/>
				  <td>' .$order = $row["order_name"] .'</td>
		<td>'; 

echo "<select name='id'>";
$result = $conn->query("SELECT `user`.`name` , `user`.`id` FROM `user` WHERE (`user`.`user_type_id` ='2')");
    while ($row = $result->fetch_assoc()) {
                  $id = $row['id'];
                  $name = $row['name']; 
                  echo '<option value="'.$id.'">'.$name.'</option>';
}
echo "</select>";
echo '<td>    <input class="btn btn-primary" type="submit" value="Priskirti"> </td>';
echo '</form>';
?>
<?php				
echo	'</td>

       </tr>';
    }
	
	echo '</tbody>
	   </div>
	</div>';
	}
}
		
//Tech 
if ($row["user_type_id"] == 2){


$queryUserId   = "SELECT `user`.`id`  FROM `user` WHERE ((`user`.`name` ='$name'))";
$resultUserId = $conn->query($queryUserId);
if ($resultUserId ->num_rows > 0) {
    while($row = $resultUserId ->fetch_assoc()) {
$queryTechData  = 	
"SELECT `orders`.`id`, `orders`.`order_name`, `order_vykd`.`order_type`, `orders`.`tech_id`, `orders`.`order_type_id`
FROM `orders`
LEFT JOIN `IT_projektas`.`order_vykd` ON `orders`.`order_type_id` = `order_vykd`.`id` 
WHERE ((`orders`.`tech_id` = ". $row["id"] .") AND (`orders`.`order_type_id` = '2'))";
$resultTechData = $conn->query($queryTechData);
	
?>

<table class="table table-striped table-inverse">                     
    <div class="table responsive">
        <thead>
            <tr>
			<th>ID</th>
              <th>Pavadinimas</th>
              <th>Busena</th>
            </tr>
        </thead>
    <tbody>
<?php
if ($resultTechData ->num_rows > 0) {
    // output data of each row
    while($row = $resultTechData ->fetch_assoc()) {
        echo '
		<tr>
                  <td scope="row">' . $row["id"] ."</b>". '</td>
				  <td>' . $row["order_name"] .'</td>
				  <td>' . $row["order_type"] .'</td>
				  
<td>';
?>
<form method="post" action="tech_atliktas.php">
				  <input class="btn btn-primary" type="submit" name="atliktas" value="Atliktas"/>
				  <input type="hidden" name="id" value="<?php echo $row["id"]; ?>" />
</form>

<?php

echo '</td>
       </tr>';
	echo '</tbody>
	   </div>
	</div>';
		}
}
		}
	}
}


//Klie 
if ($row["user_type_id"] == 3)
		{
	
$queryUserData  = 
"SELECT `orders`.`order_name` , `order_vykd`.`order_type`  FROM `orders`
LEFT JOIN user ON user.id = orders.user_id
LEFT JOIN order_vykd ON orders.order_type_id = order_vykd.id
WHERE (`user`.`name` ='$name')";
$resultUserData = $conn->query($queryUserData);
?>
<?php include 'naujas_forma.php';?>
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
if ($resultUserData ->num_rows > 0) {
    // output data of each row
    while($row = $resultUserData ->fetch_assoc()) {
        echo '
		<tr>
                  <td scope="row">' . $row["order_name"] ."</b>". '</td>
				  <td>' . $row["order_type"] .'</td>
        </tr>';
    }
	echo '</tbody>
	   </div>
	</div>';
		}
    }
}
}
?>
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