<?php
session_start();
include("database.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $customer_id = $_POST['customer_id'];
    $password = $_POST['password'];

    // Query the database to check if the credentials are valid
    $query = "SELECT * FROM customer_details WHERE customer_id = '$customer_id' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        // User authenticated successfully, set customer_id and customer_name session variables
        $customer_data = mysqli_fetch_assoc($result);
        $_SESSION['customer_id'] = $customer_id;
        $_SESSION['customer_name'] = $customer_data['customer_name'];

        // Redirect to home page or any other desired page
        header("Location: home.php");
        exit;
    } else {
        // Authentication failed, display error message
        echo "<script>alert('Invalid customer ID or password');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>


<body>

    <?php include 'header.php'; ?>

    <!-- Login Form -->
    <div class="container-fluid bg-light py-5 ">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-5">
                            <h1 class="text-center mb-4">Login</h1>
                            <form method="post">
                                <div class="mb-3">
                                    <label for="customer_id" class="form-label">Customer ID:</label>
                                    <input type="text" class="form-control" id="customer_id" name="customer_id" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password:</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary">Login</button>
                                </div>
                            </form>
                            <p class="mt-3 text-center">Don't have an account? <a href="signup.php">SignUp here</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
