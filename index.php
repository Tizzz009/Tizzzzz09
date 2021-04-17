<?php 
include('server.php');
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
		}

	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Anthony: CReate, Update, Delete with search PHP MySQL </title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<form action="search.php" method="post">
	<div class="input-group">
		<label>Search:</label>
		<input type="text" name="search" placeholder="Input contact name here">
	</div>
	<div class="input-group">

		
			<button class="btn" type="submit" name="searchsubmit" style="background: #556B2F;">Search</button>
		
		
	</div>
	</form>
	<?php if (isset($_SESSION['message'])): ?>
		<div class="msg">
			<?php 
				echo $_SESSION['message']; 
				unset($_SESSION['message']);
			?>
		</div>
	<?php endif ?>

<?php $results = mysqli_query($db, "SELECT * FROM info"); ?>

<table>
	<thead>
		<tr>
			<th>Name</th>
			<th>Address</th>
			<th>Email</th>
			<th>Contact #</th>
			<th colspan="2">Action</th>
		</tr>
	</thead>
	
	<?php while ($row = mysqli_fetch_array($results)) { ?>
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
	<?php } ?>
</table>
<form method="post" action="server.php" >

	<input type="hidden" name="id" value="<?php echo $id; ?>">

	<div class="input-group">
		<label>Name</label>
		<input type="text" name="name" value="<?php echo $name; ?>" required>
	</div>
	<div class="input-group">
		<label>Address</label>
		<input type="text" name="address" value="<?php echo $address; ?>" required>
	</div>
	<div class="input-group">
		<label>Email address</label>
		<input type="text" name="emailadd" value="<?php echo $email; ?>" required>
	</div>
	<div class="input-group">
		<label>Contact #</label>
		<input type="text" name="contactno" value="<?php echo $contactnum; ?>" required>
	</div>
	<div class="input-group">
	 <label> File:</label>
	 <input type='file' name= 'image' >
	</div>
	<div class="input-group">

		<?php if ($update == true): ?>
			<button class="btn" type="submit" name="update" style="background: #556B2F;" >update</button>
		<?php else: ?>
			<button class="btn" type="submit" name="save" >Save</button>
		<?php endif ?>
	</div>
</form>
</body>
</html>