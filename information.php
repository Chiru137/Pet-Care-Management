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
    $pet_query = "SELECT * FROM dog_details WHERE customer_id = '$customer_id'";
    $pet_result = mysqli_query($conn, $pet_query);
    $pet_data = mysqli_fetch_assoc($pet_result);
    $pet_name = $pet_data['dog_name'];
    $pet_breed = $pet_data['dog_breed'];
    $pet_age = $pet_data['dog_age'];
    $pet_image = $pet_data['image'];

    // Fetch vaccination details along with veterinarian name
    $vaccination_query = "SELECT vd.vaccination_name, v.vaccination_date, vet.vet_name 
                          FROM vaccination_done v
                          JOIN vaccination_details vd ON v.vaccination_id = vd.vaccination_id
                          JOIN veterinary vet ON v.vet_id = vet.vet_id
                          WHERE v.dog_id IN (SELECT dog_id FROM dog_details WHERE customer_id = '$customer_id')";
    $vaccination_result = mysqli_query($conn, $vaccination_query);

    // Profile delete button functionality
    if(isset($_POST['delete_profile'])) {
        $delete_query = "DELETE FROM customer_details WHERE customer_id = '$customer_id'";
        $delete_query2 = "DELETE FROM dog_details WHERE customer_id = '$customer_id'";

        if(mysqli_query($conn, $delete_query) && mysqli_query($conn, $delete_query2)) {
            echo "<script>alert('Profile and pet details deleted successfully!');</script>";
            header("location: logout.php"); // Redirect to logout page after deletion
            exit;
        } else {
            echo "<script>alert('Error deleting profile details: " . mysqli_error($conn) . "');</script>";
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
    <title>Customer Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="profile_style.css">
    
    <style>
        body {
            position: relative;
            background-image: url('<?php echo $pet_image; ?>');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        .profile-container {
            position: relative;
            z-index: 1;
            padding: 20px;

        }
        .left_sec{
            padding: 35px;
            background-color: rgba(255, 255, 255, 0.8); /* Add background color with transparency */
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        }

        .pet-card {
            width: 100%;
            max-width: 300px;
            height: auto;
            border-radius: 50px;
        }

        .pet-card img {
            height: auto;
            width: 100%;
            border-radius: 50px;
        }

        .blar{
            background-color: rgba(255, 255, 255, 0.8); /* Add background color with transparency */
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
<?php include 'header.php'; ?>
<br>
<div class="container profile-container">
    <div class="row">
        <!-- Left Section (25%) -->
        <div class="col-md-4 left_sec">
            <!-- Card for Pet Profile Picture -->
            <div class="card pet-card">
                <img src="<?php echo $pet_image; ?>" class="card-img-top" alt="Pet Profile Picture">
            </div>
            <!-- Pet's Name and Breed -->
            <div class="mt-3">
                <h4><?php echo $pet_name; ?></h4>
                <p>Breed: <?php echo $pet_breed; ?></p>
                <p>Age: <?php echo $pet_age; ?> years</p>
            </div>
            <h6 class="mt-3">Owner: <?php echo $customer_name; ?></h6>
            <!-- Logout Button -->
            <form method="post" action="logout.php">
                <button type="submit" class="btn btn-danger mt-3">Logout</button>
            </form>
            <!-- Update Button -->
            <form method="post" action="update.php">
                <button type="submit" class="btn btn-primary mt-3">Update Profile</button>
            </form>
            <!-- Delete Button -->
            <form method="post">
                <button type="submit" name="delete_profile" class="btn btn-danger mt-3" onclick="return confirm('Are you sure you want to delete your profile?')">Delete Profile</button>
            </form>
        </div>
        <!-- Right Section (75%) -->
        <div class="col-md-8">
            <div class="panel blar p-3">
                <div class="panel-heading ">
                    <h2>Vaccination Details</h2>
                </div>
                <div class="panel-body">
                    <table class="table table-striped ">
                        <thead class="btn-primary">
                            <tr>
                                <th><h4> Vaccine Name</h4></th>
                                <th><h4>Vaccination Date</h4></th>
                                <th><h4>Veterinarian</h4></th>
                            </tr>
                        </thead>
                        <tbody >
                            <?php while($row = mysqli_fetch_assoc($vaccination_result)): ?>
                            <tr>
                                <td><h6><?php echo $row['vaccination_name'];?></h6></td>
                                <td><h6><?php echo $row['vaccination_date'];?></h6></td>
                                <td><h6><?php echo $row['vet_name']; ?></h6></td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>


