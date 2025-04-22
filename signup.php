<?php
session_start();
include("database.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $customer_id = $_POST['customer_id'];
    $customer_name = $_POST['customer_name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    if (!empty($customer_id) && !empty($password)) {
        $query = "INSERT INTO customer_details VALUES ('$customer_id','$customer_name','$address','$phone','$password')";
        mysqli_query($conn, $query);
        header("location: petadd.php");
        die;
    } else {
        echo "<script type='text/javascript'>alert('Please enter some valid input')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Signup Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <?php include 'header.php'; ?>
    <br>
    <!-- Signup Form -->
    <div class="container-fluid signup-bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-5">
                            <h1 class="text-center mb-4">Sign Up</h1>
                            <form method="post">
                                <div class="mb-3">
                                    <label for="customer_id" class="form-label">Customer ID:</label>
                                    <input type="text" class="form-control" id="customer_id" name="customer_id" required>
                                </div>
                                <div class="mb-3">
                                    <label for="customer_name" class="form-label">Name:</label>
                                    <input type="text" class="form-control" id="customer_name" name="customer_name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address:</label>
                                    <input type="text" class="form-control" id="address" name="address">
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone Number:</label>
                                    <input type="tel" class="form-control" id="phone" name="phone" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password:</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                            <p class="mt-3 text-center">Already have an account? <a href="login.php">Login here</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
