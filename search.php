<?php
session_start();


$db = mysqli_connect('localhost', 'root', '', 'experiment','search');


$name = "";
$address = "";
$email = "";
$contactnum = "";
$id = 0;
$image ="";
$update = false;


?>

<?php
if (isset($_GET['edit'])) {
		$id = $_GET['edit'];
		$update = true;
		$record = mysqli_query($db, "SELECT * FROM info WHERE id=$id");

		if (count($record) == 1 ) {
			$n = mysqli_fetch_array($record);
			$name = $n['name'];
			$address = $n['address'];
			$email = $n['email'];
			$contactnum = $n['contactnumber'];
			$image = $n['image'];
			

		}

	}
?>

<!doctype html>
<html>
<head>
<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="style.css">
<title>Search</title>
</head>

<body>
	<table>
	<thead>
		<tr>
			<th>Name</th>
			<th>Address</th>
			<th>Email</th>
			<th>Contact #</th>
			<th>Image</th>
			<th colspan="2">Action</th>
		</tr>
	</thead>
	
	<?php 
		
		$scontact = $_POST['search'];

if(empty($scontact)){
	echo " <center> no results found, search field is empty! </center> ";
}else{

$sresults = mysqli_query($db, "SELECT * FROM info WHERE name LIKE '%" . $scontact[0] . "%'");



		while ($row = mysqli_fetch_array($sresults)) { ?>
		<tr>
			<td><?php echo $row['name']; ?></td>
			<td><?php echo $row['address']; ?></td>
			<td><?php echo $row['email']; ?></td>
			<td><?php echo $row['contactnumber']; ?></td>
			<td><?php echo $row['image']; ?></td>
			<td>
				<a href="index.php?edit=<?php echo $row['id']; ?>" class="edit_btn" >Edit</a>
			</td>
			<td>
				<a href="server.php?del=<?php echo $row['id']; ?>" class="del_btn">Delete</a>
			</td>
			
		</tr>
	<?php } }?>

	

</body>
</html>