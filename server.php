<?php 
	session_start();
	$db = mysqli_connect('localhost', 'root', '', 'experiment');

	// initialize variables
	$name = "";
	$address = "";
	$email = "";
	$contactnum = "";
	$image ="";
	$id = 0;
	$update = false;

	if (isset($_POST['save'])) {
		$name = $_POST['name'];
		$address = $_POST['address'];
		$email = $_POST['emailadd'];
		$contactnum = $_POST['contactno'];
		$image = $_POST['image'];
		
		mysqli_query($db, "INSERT INTO info (name, address, email, contactnumber, image) VALUES ('$name', '$address', '$email', '$contactnum', '$image')"); 
		$_SESSION['message'] = "Contact saved"; 
		header('location: index.php');

		
	}


	if (isset($_POST['update'])) {
		$id = $_POST['id'];
		$name = $_POST['name'];
		$address = $_POST['address'];
		$email = $_POST['emailadd'];
		$contactnum = $_POST['contactno'];
		$image = $_POST['image'];
		
		mysqli_query($db, "UPDATE info SET name='$name', address='$address', email='$email', contactnumber='$contactnum',image='$image' WHERE id=$id");
		$_SESSION['message'] = "Contact updated!"; 
		header('location: index.php');
	}

if (isset($_GET['del'])) {
	$id = $_GET['del'];
	
	mysqli_query($db, "DELETE FROM info WHERE id=$id");
	$_SESSION['message'] = "Contact deleted!"; 
	header('location: index.php');
}


	$results = mysqli_query($db, "SELECT * FROM info");


?>