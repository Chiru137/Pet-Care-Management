<?php
session_start();
include("database.php");

if($_SERVER['REQUEST_METHOD']=="POST") {   
    // Retrieve customer_id from form
    $customer_id = $_POST['customer_id'];
    
    // Check if the customer_id exists in customer_details table
    $query = "SELECT * FROM customer_details WHERE customer_id = $customer_id";
    $result = mysqli_query($conn, $query);
    
    if(mysqli_num_rows($result) > 0) {
        // Retrieve dog details from form
        $dog_id = $_POST['dog_id'];
        $dog_name = $_POST['dog_name'];
        $dog_breed = $_POST['dog_breed'];
        $dog_age = $_POST['dog_age'];

        // Insert dog details into dog_details table
        $insert_query = "INSERT INTO dog_details (dog_id, customer_id, dog_name, dog_breed, dog_age) VALUES ('$dog_id', '$customer_id', '$dog_name', '$dog_breed', '$dog_age')";
        mysqli_query($conn, $insert_query);

        // Redirect to login page after insertion
        header("location: login.php");
        exit; 
    } else {
        echo "<script>alert('Customer ID does not exist');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Dog Details</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <br>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body">
                        <h1 class="card-title text-center">Add Dog Details</h1>
                        <form action="petadd.php" method="post">
                            <div class="mb-3">
                                <label for="customer_id" class="form-label">Customer ID:</label>
                                <input type="text" class="form-control" id="customer_id" name="customer_id" required>
                            </div>

                            <div class="mb-3">
                                <label for="dog_id" class="form-label">Dog ID:</label>
                                <input type="text" class="form-control" id="dog_id" name="dog_id" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="dog_name" class="form-label">Dog Name:</label>
                                <input type="text" class="form-control" id="dog_name" name="dog_name" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="dog_breed" class="form-label">Dog Breed:</label>
                                <input type="text" class="form-control" id="dog_breed" name="dog_breed" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="dog_age" class="form-label">Dog Age:</label>
                                <input type="text" class="form-control" id="dog_age" name="dog_age" required>
                            </div>
                            
                            <div class="text-center">
                                <button type="submit" value="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
