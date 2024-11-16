<?php  
include("connect.php");

if (isset($_POST['submit'])) { 
  $firstName = $_POST['firstName'];
  $lastName = $_POST['lastName'];
  $birthDate = $_POST['birthDate'];
  
  $addData = "INSERT INTO userinfo (firstName, lastName, birthDate) VALUES ('$firstName', '$lastName', '$birthDate')";
  
  if (mysqli_query($conn, $addData)) {
    header("Location: index.php");
  } else {
    echo "<p class='text-center text-danger'>Error: " . mysqli_error($conn) . "</p>";
  }
}

$query = "SELECT * FROM userinfo";
$result = mysqli_query($conn, $query);
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>User Information</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #FFFDB5;
      font-family: Arial, sans-serif;
    }

    .title {
      background-color: #FFC107;
      color: #333;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.2);
      font-size: 2.5rem;
      font-weight: bold;
      margin-bottom: 30px;
    }

    .card {
      background-color: #6FDCE3;
      border: none;
      border-radius: 15px;
      box-shadow: 8px 8px 12px rgba(0, 0, 0, 0.3);
      text-align: center;
      padding: 20px;
      transition: transform 0.3s, box-shadow 0.3s;
    }

    .card:hover {
      transform: scale(1.05);
      box-shadow: 10px 10px 20px rgba(0, 0, 0, 0.4);
    }

    .card h5 {
      color: #333;
      font-weight: 500;
      margin: 10px 0;
      display: flex;
      align-items: center;
    }

    .footer {
      text-align: center;
      margin-top: 30px;
      padding: 20px 0;
      background-color: #FFC107;
      border-radius: 10px;
      box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.2);
      position: relative;
      bottom: 0;
      width: 100%;
    }
  </style>
</head>

<body>
  <div class="container-fluid mb-5">
    <h3 class="title text-center">Social Media User Information</h3>
  </div>

  <h3 class="text-center mb-2" style="font-weight: bold;">Add New User</h3>
  <div class="container mb-5 d-flex justify-content-center" style="background-color: #ABBA7C; width: 400px; padding: 30px; border-radius: 10px;">
    <form method="POST" class="w-100">
      <div class="mb-3">
        <label class="form-label">First Name</label>
        <input type="text" placeholder="First Name" class="form-control" name="firstName" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Last Name</label>
        <input type="text" placeholder="Last Name" class="form-control" name="lastName" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Birth Date</label>
        <input type="date" placeholder="Birth Date" class="form-control" name="birthDate" required>
      </div>
      <button type="submit" name="submit" class="btn btn-primary">Add User</button>
    </form>
  </div>

  <div class="container">
    <div class="row justify-content-center">
      <?php
      if (mysqli_num_rows($result) > 0) {
        while ($user = mysqli_fetch_assoc($result)) {
      ?>
        <div class="col-md-6 col-lg-4 mb-4">
          <div class="card text-start">
            <h4 class="card-title text-center mb-3">User Information</h4>
            <h5 class="firstName">First Name: <?php echo $user['firstName']; ?></h5>
            <h5 class="lastName">Last Name: <?php echo $user['lastName']; ?></h5>
            <h5 class="birthDate">Birth Date: <?php echo $user['birthDate']; ?></h5>
            <form method="post" action="delete.php">
              <input type="hidden" name="user_id" value="<?php echo $user['userInfoID']; ?>"> <!-- Correct primary key here -->
              <button type="submit" class="btn btn-danger mt-3">Delete</button>
            </form>
          </div>
        </div>
      <?php
        }
      } else {
        echo "<p class='text-center'>No user information found.</p>";
      }
      ?>
    </div>
  </div>

  <div class="footer">
    <p>&copy; 2024 Jalem Louise T. Grapani. All rights reserved.</p>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
