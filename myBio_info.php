<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>My Bio</title>
<script src="http://www.w3schools.com/lib/w3data.js"></script>
<link rel="stylesheet" type="text/css" href="style.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>
<body>
<?php 

$id=$_GET['id'];
$sql = "SELECT * FROM bio WHERE bioID = $id"; 

include('connection.php');

$result = $conn->query($sql);

$row = $result->fetch_assoc();
$imageData = base64_encode($row['image']);
$imageSrc = "data:image/jpg;base64," . $imageData;

if (file_exists('bio-image/' . $row['image'])) {
    $imageSrc = 'bio-image/' . $row['image'];
}

?>
	<div class="container">
		<div class="main-container">
			<img src="<?php echo $imageSrc ?>">
			<br>
			<table class="bio-table" border="0">
				<tr>
					<td><span class="material-symbols-outlined">person</span></td>
					<td>Name</td>
					<td>:</td>
					<td><?php echo $row['name'] ?></td>
				</tr>
				<tr>
					<td><span class="material-symbols-outlined">Distance</span></td>
					<td>Location</td>
					<td>:</td>
					<td><?php echo $row['location'] ?></td>
				</tr>
				<tr>
					<td><span class="material-symbols-outlined">mail</span></td>
					<td>Email</td>
					<td>:</td>
					<td><?php echo $row['email'] ?></td>
				</tr>
				<tr>
					<td><span class="material-symbols-outlined">call</span></td>
					<td>Phone</td>
					<td>:</td>
					<td><?php echo $row['phone'] ?></td>
				</tr>
			</table>
			<br>
			<div style="display: flex;flex-direction: row;width: 100%;justify-content: center;align-items: center;">
				<hr>
				<p class="about"> About Me </p>
				<hr>
			</div>
			<br>
			<div class="text-area" style="white-space: pre-line;">
				<?php echo $row['about'] ?>
			</div>
			<br><br><br><br>
			<p>Submitted: <?php echo $row['date'] ?></p>
		</div>

</body>
</html>