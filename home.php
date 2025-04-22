<?php
session_start();
include("database.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PET Care</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <?php include 'header.php'; ?>

    <div class="hero-container">
        <h4 class="display-6">Caring for Our Pets,<br> One Click at a Time.</h4>
        <h3 class="display-3 ">Pet Care</h3>
        <p class="lead">We are there to remind you of the important things.</p>
        <div class="d-flex align-items-center justify-content-center justify-content-lg-start pt-4 ">
            <a href="info_vaccine.php" class="btn btn-outline-dark border-2 py-md-3 px-md-5 me-5">Vaccines</a>
        </div>
    </div>
</body>

</html>