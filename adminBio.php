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
	include 'header.php';
include 'connection.php';
if(!isset($_SESSION['adminID'])){
	header("Location: adminLogin.php");
  exit();
}

$sql = "SELECT * FROM admin WHERE adminID=$adminID";
$result = $conn->query($sql);
$row2 = $result->fetch_assoc();

$imageData2 = base64_encode($row2['image']);
$imageSrc2 = "data:image/jpg;base64," . $imageData2;

if (file_exists('bio-image/' . $row2['image'])) {
    $imageSrc2 = 'bio-image/' . $row2['image'];
}
?>
	<div class="container">
		<div class="main-container" id="admin-main">
			<img src="<?php echo $imageSrc2 ?>">
			<br>
			<table class="bio-table" border="0">
				<tr>
					<td><span class="material-symbols-outlined">person</span></td>
					<td>Name</td>
					<td>:</td>
					<td><?php echo $row2['name']; ?></td>
				</tr>
				<tr>
					<td><span class="material-symbols-outlined">Distance</span></td>
					<td>Location</td>
					<td>:</td>
					<td><?php echo $row2['location']; ?></td>
				</tr>
				<tr>
					<td><span class="material-symbols-outlined">mail</span></td>
					<td>Email</td>
					<td>:</td>
					<td><?php echo $row2['email']; ?></td>
				</tr>
				<tr>
					<td><span class="material-symbols-outlined">call</span></td>
					<td>Phone</td>
					<td>:</td>
					<td><?php echo $row2['phone']; ?></td>
				</tr>
			</table>
			<br>
			<div style="display: flex;flex-direction: row;width: 100%;justify-content: center;align-items: center;">
				<hr>
				<p class="about"> About Me </p>
				<hr>
			</div>
			<br>
			<div class="text-area">
				<?php echo $row2['about']; ?>
			</div>
			<br><br><br>
			<button class="add-button" id="edit-button">Edit</button>
		</div>


		<div class="sub-container">
			<div class="add-button-container">
				<a class="add-button" href="adminBio.php?section=feedback" style="height:35px;text-align: center;padding-top: 5px;">Manage Feedback</a>
				<a class="add-button" href="adminBio.php?section=bio" id="manage-bio">Manage Bio</a>
			</div>
	<?php
	if(isset($_GET['section'])){
		if($_GET['section']=='feedback'){
			feedback();
		}
		elseif($_GET['section']=='bio'){
			bio();
		}
	}
	else{
		feedback();
	}
	?>
	<?php function bio(){ ?>
			<div class="card-container">
			<?php
			include 'connection.php';
			$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Cast $page to an integer
    $count = "SELECT count(*) as total from bio";
    $data = $conn->query($count);
    $dat = $data->fetch_assoc();
    $total_records = $dat["total"];
    $records_per_page = 12;
    $total_pages = ceil($total_records / $records_per_page);
    if ($page < 1) {
    $page = 1;
}
    $offset = ($page - 1) * $records_per_page;
    $sql = "SELECT * FROM bio ORDER BY bioID DESC LIMIT $offset, $records_per_page";

    $result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch all the rows into an array
    $rows = $result->fetch_all(MYSQLI_ASSOC);
    foreach ($rows as $row) {
        $imageData = base64_encode($row['image']);
        $imageSrc = "data:image/jpg;base64," . $imageData;
        if (file_exists('bio-image/' . $row['image'])) {
            $imageSrc = 'bio-image/' . $row['image'];
        }
        ?>
        
        <div class="card">
            <img src="<?php echo $imageSrc; ?>" alt="Avatar">
            <div class="information">
                <h4><b><?php echo $row['name']; ?></b></h4><br> 
                <p style="font-size: 17px">Submitted: <?php echo $row['date']; ?></p> 
            </div>
            <div style="display:flex;flex-direction:row;justify-content:center;width:100%">
            <a href="myBio_info.php?id=<?php echo $row['bioID'] ?>" target="_blank" style="margin: 0 4%;"><span class="material-symbols-outlined" id="open-bio">open_in_new</span></a>
            <a href="homePage-process.php?c=deleteBio&id=<?php echo $row['bioID'] ?>" style="margin: 0 4%;" onclick="return confirm('Are you sure you want to delete this bio?');"><span class="material-symbols-outlined" id="open-bio" style="color:red">delete</span></a>
        </div>
        </div>
    
    <?php
    }
    // Add links to navigate to different pages
    ?>
    </div>
    <div class="pagination">
    <?php
    if ($page == 1) {
        // Handle first page
    } else {
        echo '<a href="adminBio.php?section=bio&page=' . ($page - 1) . '">&lt;</a>';
    }
    for ($i = 1; $i <= $total_pages; $i++) {
        if ($i == $page) {
            echo '<a href="adminBio.php?section=bio&page=' . $i . '" class="page-active">' . $i . '</a>';
        } else {
            echo '<a href="adminBio.php?section=bio&page=' . $i . '">' . $i . '</a>';
        }
    }
    if ($page == $total_pages) {
        // Handle last page
    } else {
        echo '<a href="adminBio.php?section=bio&page=' . ($page + 1) . '"> &gt;</a>';
    }
    echo '</div>';
} else {
    echo '<p style="font-size:35px;text-align:center;width:100%">No Bio Submitted.</p>';
}
?>
</div>
<?php }

function feedback(){ 
	include 'connection.php';
$sql = "SELECT * FROM feedback ORDER BY feedbackID DESC";

    $result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch all the rows into an array
    $rows = $result->fetch_all(MYSQLI_ASSOC);
    foreach ($rows as $row) {
	?>

	<div class="feedback-container">
		<div style="display:flex;flex-direction: column;justify-content: center;width: 60%;">
			<div class="date">
				<b>Feedback:</b>
			</div>
		<div class="feedback-content">
			<?php echo $row['feedback']; ?>
		</div>
	</div>
		<div class="feedback-date">
			<div class="date">
				<b>Submitted:</b>
			</div>
			<div class="date">
				<?php echo $row['date']; ?>
			</div>	
		</div>
		<div class="feedback-button">
		<a href="homePage-process.php?c=deleteFeedback&id=<?php echo $row['feedbackID'] ?>" style="margin: 0 4%;" onclick="return confirm('Are you sure you want to delete this feedback?');"><span class="material-symbols-outlined" id="delete-bio" style="color:red">delete</span></a>
	</div>
	</div>
	<?php }}
	else {
    echo '<p style="font-size:35px;text-align:center;width:100%">No feedback Submitted.</p>';
}
}
 ?>


<div id="EditModal" class="modal">
<?php
include 'connection.php';
$sql = "SELECT * FROM admin";
$result = $conn->query($sql);
$row3 = $result->fetch_assoc();
?>
  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h2 style="color:white">Edit My Bio</h2>
      </div>
      <iframe name="hiddenFrame" class="hide"></iframe>
    <form id="editForm" action="homePage-process.php?c=editbio" method="post" target="hiddenFrame" enctype="multipart/form-data">
    		<table class="add-table" border="0">
				<tr>
					<td><span class="material-symbols-outlined">person</span></td>
					<td>Name</td>
					<td>:</td>
					<td><input type="text" name="name" required value="<?php echo $row3['name']; ?>"> </td>
				</tr>
				<tr>
					<td><span class="material-symbols-outlined">Distance</span></td>
					<td>Location</td>
					<td>:</td>
					<td><select name="state" required>
		              <option value="<?php echo $row3['location']; ?>" selected><?php echo $row3['location']; ?></option>
		              <option>Johor</option>
		                <option>Kedah</option>
		                <option>Kelantan</option>
		                <option>Melaka</option>
		                <option>Negeri Sembilan</option>
		                <option>Pahang</option>
		                <option>Perak</option>
		                <option>Perlis</option>
		                <option>Penang</option>
		                <option>Sabah</option>
		                <option>Sarawak</option>
		                <option>Terengganu</option>
		                <option>Kuala Lumpur</option>
		                <option>Labuan</option>
		                <option>Putrajaya</option>
		                <option>Kelantan</option>
		          </select>
		      </td>
			</tr>
				<tr>
					<td><span class="material-symbols-outlined">mail</span></td>
					<td>Email</td>
					<td>:</td>
					<td><input type="email" name="mail" required value="<?php echo $row3['email']; ?>"> </td>
				</tr>
				<tr>
					<td><span class="material-symbols-outlined">call</span></td>
					<td>Phone</td>
					<td>:</td>
					<td><input type="number" name="phone" required value="<?php echo $row3['phone']; ?>"> </td>
				</tr>
				<tr>
					<td><span class="material-symbols-outlined">clinical_notes</span></td>
					<td>About You</td>
					<td>:</td>

					<td><textarea maxlength="500" placeholder="Write something to describe yourself...(max 500 characters)" name="about" required ><?php echo $row3['about']; ?></textarea></td>
				</tr>
				<tr>
					<td><span class="material-symbols-outlined">photo_camera</span></td>
					<td>Image</td>
					<td>:</td>
					<td><input type="file" id="img" name="img" accept="image/*" style="background-color:white" ></td>
				</tr>
			</table>
			<div class="form-button-container">
				<button class="form-button" style="background-color:white;color: black;" id="cancel1" type="button">Cancel</button>
				<button class="form-button" type="submit">Submit</button>
			</div>
    </form>
</div>
</div>

<script type="text/javascript">
var Modal1 = document.getElementById("EditModal");
var btn = document.getElementById("edit-button");
var cancel = document.getElementById("cancel1");
var addForm = document.getElementById("editForm");
var span = Modal1.getElementsByClassName("close")[0];

btn.onclick = function() {
  Modal1.style.display = "block"; 
}

span.onclick = function() {
  Modal1.style.display = "none";
  addForm.reset();
}

cancel.onclick = function() {
  Modal1.style.display = "none";
  addForm.reset();
}
</script>
</body>
</html>