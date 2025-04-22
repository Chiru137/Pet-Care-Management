<?php
session_start();
include("database.php");

// Check if the user is logged in
if (isset($_SESSION['customer_id'])) {
    $customer_id = $_SESSION['customer_id'];

    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        // Retrieve selected vaccine details from the form
        $vaccination_id = $_POST['vaccination_id']; // Assuming the form has a select dropdown for vaccine selection
        $vet_id = $_POST['vet_id']; // Assuming the form has a select dropdown for vet selection
        $vaccination_date = $_POST['vaccination_date']; // Assuming the form has a field for vaccination date

        // Retrieve dog ID associated with the customer
        $dog_query = "SELECT dog_id FROM dog_details WHERE customer_id = '$customer_id'";
        $dog_result = mysqli_query($conn, $dog_query);

        if ($dog_result && mysqli_num_rows($dog_result) > 0) {
            $dog_row = mysqli_fetch_assoc($dog_result);
            $dog_id = $dog_row['dog_id'];

            // Insert the vaccination details into the vaccination_done table
            $insert_query = "INSERT INTO vaccination_done (dog_id, vaccination_id, vet_id, vaccination_date) VALUES ('$dog_id', '$vaccination_id', '$vet_id', '$vaccination_date')";
            if (mysqli_query($conn, $insert_query)) {
                echo "<script>alert('Vaccination details updated successfully!');</script>";
            } else {
                echo "<script>alert('Error updating vaccination details: " . mysqli_error($conn) . "');</script>";
            }

            // Redirect to another page after vaccination
            header("location: home.php");
            exit;
        } else {
            echo "<script>alert('Error retrieving dog ID: " . mysqli_error($conn) . "');</script>";
        }
    }
} else {
    echo "<script>alert('User not logged in!');</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Vaccination</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('img/testimonial.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
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
    <div class="container mt-5">
        <div class="card shadow p-3 mx-auto blar" style="max-width: 500px;">
            <h1 class="text-center mb-4">Vaccination</h1>
            <h6>
            <form method="post" >
                <div class="mb-3">
                    <label for="vaccination_id" class="form-label">Vaccine:</label>
                    <select class="form-select" id="vaccination_id" name="vaccination_id" required>
                        <!-- Retrieve and display available vaccine names from the database -->
                        <?php
                        $query = "SELECT vaccination_id, vaccination_name FROM vaccination_details";
                        $result = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='" . $row['vaccination_id'] . "'>" . $row['vaccination_name'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <!-- Assuming you have a field for vet selection -->
                <div class="mb-3">
                    <label for="vet_id" class="form-label">Veterinarian:</label>
                    <select class="form-select" id="vet_id" name="vet_id" required>
                        <?php
                        $query = "SELECT vet_id, vet_name FROM veterinary";
                        $result = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='" . $row['vet_id'] . "'>" . $row['vet_name'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <!-- Assuming you have a field for vaccination date -->
                <div class="mb-3">
                    <label for="vaccination_date" class="form-label">Vaccination Date:</label>
                    <input type="date" class="form-control" id="vaccination_date" name="vaccination_date" required>
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Vaccinate</button>
                </div>
            </form>
            </h6>
        </div>
    </div>
</body>

</html>