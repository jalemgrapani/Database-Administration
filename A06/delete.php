<?php
include("connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['user_id'])) {
  $user_id = intval($_POST['user_id']);  // Retrieve the userInfoID value passed from the form

  // SQL query to delete the user, where userInfoID matches the passed value
  $query = "DELETE FROM userinfo WHERE userInfoID = $user_id";
  $result = executeQuery($query);  // Execute the delete query

  if ($result) {
    header("Location: index.php"); // Redirect to the index page after successful deletion
    exit();
  } else {
    echo "Error deleting record: " . mysqli_error($conn);
  }
} else {
  echo "Invalid request.";
}
?>
