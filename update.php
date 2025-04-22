<?php
session_start();
include("database.php");

// Check if the user is logged in
if(isset($_SESSION['customer_id'])) {
    $customer_id = $_SESSION['customer_id'];

    // Fetch customer name
    $customer_query = "SELECT customer_name FROM customer_details WHERE customer_id = '$customer_id'";
    $customer_result = mysqli_query($conn, $customer_query);
    $customer_data = mysqli_fetch_assoc($customer_result);
    $customer_name = $customer_data['customer_name'];

    // Fetch pet details
    $pet_query = "SELECT dog_name,dog_breed,image FROM dog_details WHERE customer_id = '$customer_id'";
    $pet_result = mysqli_query($conn, $pet_query);
    $pet_data = mysqli_fetch_assoc($pet_result);
    $pet_name = $pet_data['dog_name'];
    $pet_breed = $pet_data['dog_breed'];
    $pet_image = $pet_data['image'];

    // Update profile button functionality
    if(isset($_POST['update_profile'])) {
        $new_customer_name = $_POST['customer_name'];
        $new_pet_name = $_POST['pet_name'];
        $new_pet_breed = $_POST['pet_breed'];

        $update_query = "UPDATE customer_details SET customer_name = '$new_customer_name' WHERE customer_id = '$customer_id'";
        $update_query2 = "UPDATE dog_details SET dog_name = '$new_pet_name', dog_breed = '$new_pet_breed' WHERE customer_id = '$customer_id'";

        if(mysqli_query($conn, $update_query) && mysqli_query($conn, $update_query2)) {
            // Update the session variable with the new customer name
            $_SESSION['customer_name'] = $new_customer_name;
            echo "<script>alert('Profile details updated successfully!');</script>";
            header("location: information.php"); // Redirect to information.php after update
            exit;
        } else {
            echo "<script>alert('Error updating profile details: " . mysqli_error($conn) . "');</script>";
        }
    }
} else {
    // If user not logged in, redirect to login page
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            position: relative;
            background-image: url('<?php echo $pet_image; ?>');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            padding: 20px;
        }
        .profile-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .blar {
            background-color: rgba(255, 255, 255, 0.8); /* Add background color with transparency */
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            padding: 20px;
            max-width: 400px;
            width: 100%;
        }
        .blar form {
            margin-bottom: 0; /* Remove default form margin */
        }
        .blar .form-group {
            margin-bottom: 20px;
        }
        .blar label {
            font-weight: bold;
        }
        .blar input[type="text"] {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
    </style>
</head>
<body>
<?php include 'header.php'; ?>
<br>
<div class="container profile-container">
    <div class="blar">
        <div class="profile-header text-center">
            <div class="profile-info">
                <h3>Update <?php echo $customer_name; ?>'s Profile</h3>
            </div>
        </div>
        <div class="panel">
            <div class="panel-body">
                <!-- Update Profile Form -->
                <form method="post">
                    <div class="form-group">
                        <label for="customer_name">Customer Name:</label>
                        <input type="text" id="customer_name" name="customer_name" value="<?php echo $customer_name; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="pet_name">Pet Name:</label>
                        <input type="text" id="pet_name" name="pet_name" value="<?php echo $pet_name; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="pet_breed">Pet Breed:</label>
                        <input type="text" id="pet_breed" name="pet_breed" value="<?php echo $pet_breed; ?>" required>
                    </div>
                    <button type="submit" name="update_profile" class="btn btn-primary">Update Profile</button>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>

