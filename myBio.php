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
include 'connection.php';
$sql = "SELECT * FROM admin";
$result = $conn->query($sql);
$row2 = $result->fetch_assoc();

$imageData2 = base64_encode($row2['image']);
$imageSrc2 = "data:image/jpg;base64," . $imageData2;

if (file_exists('bio-image/' . $row2['image'])) {
    $imageSrc2 = 'bio-image/' . $row2['image'];
}
?>
	<div class="container">
		<div class="main-container">
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
		</div>


		<div class="sub-container">
			<div class="add-button-container">
				<button class="add-button" id="feedback-button">Submit Feedback</button>
				<button class="add-button" id="add-button">Add My Bio</button>
			</div>
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
                <p class="submit-date">Submitted: <?php echo $row['date']; ?></p> 
            </div>
            <a href="myBio_info.php?id=<?php echo $row['bioID'] ?>" target="_blank"><span class="material-symbols-outlined" id="open-bio">open_in_new</span></a>
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
        echo '<a href="myBio.php?page=' . ($page - 1) . '">&lt;</a>';
    }
    for ($i = 1; $i <= $total_pages; $i++) {
        if ($i == $page) {
            echo '<a href="myBio.php?page=' . $i . '" class="page-active">' . $i . '</a>';
        } else {
            echo '<a href="myBio.php?page=' . $i . '">' . $i . '</a>';
        }
    }
    if ($page == $total_pages) {
        // Handle last page
    } else {
        echo '<a href="myBio.php?page=' . ($page + 1) . '"> &gt;</a>';
    }
    echo '</div>';
} else {
    echo '<p style="font-size:35px;text-align:center;width:100%">No Bio Submitted.</p>';
}
?>

			

<div id="AddModal" class="modal">
  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h2 style="color:white">Add My Bio</h2>
      </div>
      <iframe name="hiddenFrame" class="hide"></iframe>
    <form id="addForm" action="homePage-process.php?c=bio" method="post" target="hiddenFrame" enctype="multipart/form-data">
    		<table class="add-table" border="0">
				<tr>
					<td><span class="material-symbols-outlined">person</span></td>
					<td>Name</td>
					<td>:</td>
					<td><input type="text" name="name" required> </td>
				</tr>
				<tr>
					<td><span class="material-symbols-outlined">Distance</span></td>
					<td>Location</td>
					<td>:</td>
					<td><select name="state" required >
		              <option value="" disabled selected>Select your living state</option>
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
					<td><input type="email" name="mail" required> </td>
				</tr>
				<tr>
					<td><span class="material-symbols-outlined">call</span></td>
					<td>Phone</td>
					<td>:</td>
					<td><input type="number" name="phone" required> </td>
				</tr>
				<tr>
					<td><span class="material-symbols-outlined">clinical_notes</span></td>
					<td>About You</td>
					<td>:</td>

					<td><textarea maxlength="500" placeholder="Write something to describe yourself...(max 500 characters)" name="about" required ></textarea></td>
				</tr>
				<tr>
					<td><span class="material-symbols-outlined">photo_camera</span></td>
					<td>Image</td>
					<td>:</td>
					<td><input type="file" id="img" name="img" accept="image/*" required style="background-color:white" ></td>
				</tr>
			</table>
			<div class="form-button-container">
				<button class="form-button" style="background-color:white;color: black;" id="cancel1">Cancel</button>
				<button class="form-button">Submit</button>
			</div>
    </form>
</div>
</div>

<div id="FeedbackModal" class="modal">
  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close2">&times;</span>
      <h2 style="color:white">Give Feedback</h2>
      </div>
      <iframe name="hiddenFrame" class="hide"></iframe>
    <form id="addForm" action="homePage-process.php?c=feedback" method="post" target="hiddenFrame" enctype="multipart/form-data">
    		<table class="add-table" border="0">
				<tr>
					<td><span class="material-symbols-outlined">rate_review</span></td>
					<td>Feedback</td>
					<td>:</td>

					<td><textarea maxlength="500" placeholder="Give some feedback...(max 500 characters)" name="feedback" required ></textarea></td>
				</tr>
			</table>
			<div class="form-button-container">
				<button class="form-button" style="background-color:white;color: black;" type="button" id="cancel2">Cancel</button>
				<button class="form-button" type="submit">Submit</button>
			</div>
    </form>
</div>
</div>

<script type="text/javascript">
var Modal1 = document.getElementById("AddModal");
var btn = document.getElementById("add-button");
var cancel = document.getElementById("cancel1");
var addForm = document.getElementById("addForm");
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


var Modal2 = document.getElementById("FeedbackModal");
var btn2 = document.getElementById("feedback-button");
var span2 = Modal2.getElementsByClassName("close2")[0];
var cancel2 = document.getElementById("cancel2");
var feedbackForm = document.getElementById("feedbackForm");

btn2.onclick = function() {
  Modal2.style.display = "block";
}

span2.onclick = function() {
  Modal2.style.display = "none";
  feedbackForm.reset();
}

cancel2.onclick = function() {
  Modal2.style.display = "none";
  feedbackForm.reset();
}

</script>
</body>
</html>