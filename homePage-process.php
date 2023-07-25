<?php 
include 'connection.php';

if($_GET['c']=='bio'){
$name = $_POST['name'];
$state = $_POST['state'];
$mail = $_POST['mail'];
$phone = $_POST['phone'];
$about = $_POST['about'];
$img = $_FILES['img']['name'];
date_default_timezone_set('Asia/Singapore');
$currentDateTime = date('Y-m-d H:i:s');

if (isset($_FILES['img'])) {
    $target_dir = "bio-image/";
    $unique_name = time() . '_' . $img;
    $target_path = $target_dir . $unique_name;

    if (move_uploaded_file($_FILES['img']['tmp_name'], $target_path)) {
      // File uploaded successfully
      echo "File uploaded: " . $img . "<br>";
    } else {
      // Failed to upload file
      echo "Failed to upload file: " . $img . "<br>";
      $unique_name=NULL;
    }
  }else{
    $unique_name=NULL;
  }

$stmt = $conn->prepare("INSERT INTO bio (name, location, email, phone, about, image, date) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $name, $state, $mail, $phone, $about, $unique_name, $currentDateTime);
    if ($stmt->execute()) {
            echo '<script type="text/javascript">';
            echo 'alert("Your bio have been submitted successfully.");';
            echo 'parent.window.location.href = "myBio.php";';
            echo '</script>';
    } else {
        echo '<script type="text/javascript">';
        echo 'alert("Error submitting your bio, Please try again.");';
        echo 'parent.window.location.href = "myBio.php";';
        echo '</script>';
    }
    $stmt->close();
    $conn->close();
 }


elseif($_GET['c']=='feedback'){
$feedback = $_POST['feedback'];
date_default_timezone_set('Asia/Singapore');
$currentDateTime = date('Y-m-d H:i:s');

$stmt = $conn->prepare("INSERT INTO feedback (feedback,date) VALUES (?, ?)");
    $stmt->bind_param("ss", $feedback,$currentDateTime);
    if ($stmt->execute()) {
            echo '<script type="text/javascript">';
            echo 'alert("Your feedback have been submitted successfully.");';
            echo 'parent.window.location.href = "myBio.php";';
            echo '</script>';
    } else {
        echo '<script type="text/javascript">';
        echo 'alert("Error submitting your feedback, Please try again.");';
        echo 'parent.window.location.href = "myBio.php";';
        echo '</script>';
    }
    $stmt->close();
    $conn->close();
 }

 elseif($_GET['c']=='deleteBio'){
$id = $_GET['id'];

$sql = "DELETE FROM bio WHERE bioID = $id"; 

if (mysqli_query($conn, $sql)) {
    echo '<script type="text/javascript">';
    echo 'alert("Bio has been deleted successfully.");';
    echo 'window.location.href = "adminBio.php?section=bio";';
    echo '</script>';
    mysqli_close($conn);
} else {
    echo '<script type="text/javascript">';
    echo 'alert("Erro deleting bio information.\n Please try again.");';
    echo 'window.location.href = "adminBio.php?section=bio";';
    echo '</script>';
}
}

 elseif($_GET['c']=='deleteFeedback'){
$id = $_GET['id'];

$sql = "DELETE FROM feedback WHERE feedbackID = $id"; 

if (mysqli_query($conn, $sql)) {
    echo '<script type="text/javascript">';
    echo 'alert("Feedback has been deleted successfully.");';
    echo 'window.location.href = "adminBio.php?section=feedback";';
    echo '</script>';
    mysqli_close($conn);
} else {
    echo '<script type="text/javascript">';
    echo 'alert("Erro deleting feedback information.\n Please try again.");';
    echo 'window.location.href = "adminBio.php?section=feedback";';
    echo '</script>';
}
}

if($_GET['c']=='editbio'){
$name = $_POST['name'];
$state = $_POST['state'];
$mail = $_POST['mail'];
$phone = $_POST['phone'];
$about = $_POST['about'];
$img = $_FILES['img']['name'];

if($_FILES['img']['name'] !== ""){
  if(isset($_FILES['img'])){
     $target_dir = "bio-image/";
      $unique_name = time() . '_' . $img;
        $target_path = $target_dir . $unique_name;

if (move_uploaded_file($_FILES['img']['tmp_name'], $target_path)) {
            // File uploaded successfully
            echo "File uploaded: " .$img . "<br>";
        } else {
            // Failed to upload file
            echo "Failed to upload file: " . $img . "<br>";
        }
}
else{
    echo "image not found!";
}
  $sql = "UPDATE admin SET name='$name',location='$state',email='$mail',phone='$phone',about='$about',image='$unique_name' WHERE adminID=1";
}
else{
    $sql = "UPDATE admin SET name='$name',location='$state',email='$mail',phone='$phone',about='$about' WHERE adminID=1";
}


$result = mysqli_query($conn, $sql);
?>
<?php
if ($conn->query($sql) === TRUE) {
    echo '<script type="text/javascript">';
    echo 'alert("Your bio has been edited successfully.");';
    echo 'parent.window.location.href = "adminBio.php";';
    echo '</script>';
}
 else { 
    echo '<script type="text/javascript">';
    echo 'alert("Failed to edit your bio.\n Please try again.");';
    echo 'parent.window.location.href = "adminBio.php";';
    echo '</script>';
}
    $conn->close();
 }

  elseif($_GET['c']=='login'){
$name = $_POST['name'];
$password = $_POST['password'];

 $sql = "SELECT * FROM admin WHERE username='$name' AND password=md5('$password')";

 $result = $conn->query($sql);
 $row = $result->fetch_assoc();



 if ($result->num_rows == 1) { // check if the query returned a single row
  session_start();
  $_SESSION['adminID'] = $row['adminID'];

  echo '<script type="text/javascript">';
  echo 'alert("Login successful!");';
  echo 'window.location.href = "adminBio.php";';
  echo '</script>';
}
else {
  echo '<script type="text/javascript">';
  echo 'alert("Invalid username or password!");';
  echo 'window.location.href = "adminLogin.php";';
  echo '</script>';
}
}