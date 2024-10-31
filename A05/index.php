<?php
include("connect.php");

$query = "SELECT * FROM userinfo";
$result = executeQuery($query);
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>User Information</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
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

    .card h5 i {
      margin-right: 10px;
      color: #007BFF;
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

  <div class="container">
    <div class="row justify-content-center">
      <?php
      if (mysqli_num_rows($result) > 0) {
        while ($user = mysqli_fetch_assoc($result)) {
      ?>
        <div class="col-md-6 col-lg-4 mb-4">
          <div class="card text-start">
            <h4 class="card-title text-center mb-3">User Information</h4>
            <h5 class="firstName"><i class="fas fa-user"></i> First Name: <?php echo htmlspecialchars($user['firstName']); ?></h5>
            <h5 class="lastName"><i class="fas fa-user-tag"></i> Last Name: <?php echo htmlspecialchars($user['lastName']); ?></h5>
            <h5 class="birthDate"><i class="fas fa-calendar-alt"></i> Birth Date: <?php echo htmlspecialchars($user['birthDate']); ?></h5>
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
    <p>&copy; <?php echo date("Y"); ?> Jalem Louise Grapani. All rights reserved.</p>
</div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
