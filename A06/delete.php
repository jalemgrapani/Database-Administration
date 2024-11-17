<?php
include("connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['user_id'])) {
  $user_id = intval($_POST['user_id']); 

 
  $query = "DELETE FROM userinfo WHERE userInfoID = $user_id";
  $result = executeQuery($query);  

  if ($result) {
    header("Location: index.php"); 
    exit();
  } else {
    echo "Error deleting record: " . mysqli_error($conn);
  }
} else {
  echo "Invalid request.";
}
?>
