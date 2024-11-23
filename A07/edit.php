<?php
include('connect.php');

$id = $_GET['id'];

if (isset($_POST['btnEdit'])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $birthDate = $_POST['birthDate'];

    $editQuery = "UPDATE userinfo SET firstName='$firstName', lastName='$lastName', birthDate='$birthDate' WHERE userInfoID='$id'";
    executeQuery($editQuery);
}

$query = "SELECT * FROM userinfo WHERE userInfoID = '$id'";
$result = executeQuery($query);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #FFFDB5;
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
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

        .footer {
            text-align: center;
            padding: 20px 0;
            background-color: #FFC107;
            border-radius: 10px;
            box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.2);
            position: absolute;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="container-fluid mb-5">
        <h3 class="title text-center">Edit User Information</h3>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card text-start">
                    <h4 class="card-title text-center mb-3">Edit User</h4>

                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        while ($user = mysqli_fetch_assoc($result)) {
                    ?>
                        <form method="post">
                            <div class="mb-3">
                                <label class="form-label">First Name</label>
                                <input value="<?php echo $user['firstName']; ?>" class="form-control" type="text" name="firstName" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Last Name</label>
                                <input value="<?php echo $user['lastName']; ?>" class="form-control" type="text" name="lastName" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Birth Date</label>
                                <input value="<?php echo $user['birthDate']; ?>" class="form-control" type="date" name="birthDate" required>
                            </div>
                            <button class="btn btn-primary" type="submit" name="btnEdit">Save Changes</button>
                        </form>

                    <?php
                        }
                    } else {
                        echo "<p class='text-center'>User not found!</p>";
                    }
                    ?>
                    <a href="index.php" class="btn btn-secondary mt-3">Return to Home</a>

                </div>
            </div>
        </div>
    </div>

    <div class="footer">
        <p>&copy; 2024 Jalem Louise T. Grapani. All rights reserved.</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
