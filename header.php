<?php
include("database.php");

$pet_image = '';

if (isset($_SESSION['customer_id'])) {
    $customer_id = $_SESSION['customer_id'];
    $pet_query = "SELECT image FROM dog_details WHERE customer_id = '$customer_id'";
    $pet_result = mysqli_query($conn, $pet_query);

    if ($pet_result && mysqli_num_rows($pet_result) > 0) {
        $pet_data = mysqli_fetch_assoc($pet_result);
        $pet_image = $pet_data['image'];
    }
}
?>

<nav class="navbar navbar-expand-lg navbar-light shadow-sm bg-white transparent-bg">
    <div class="container-fluid">
        <!-- Logo and Brand -->
        <a href="about.php" class="navbar-brand">
            <h1 class="text-uppercase text-dark ms-2 mb-0"><i class="fas fa-paw fa-lg text-success"></i>Pet Care</h1>
        </a>
        <!-- Navigation Links -->
        <div class=" justify-content-end">
            <ul class="navbar-nav fw-bold fs-5">
                <li class="nav-item">
                    <a href="home.php" class="nav-link">Home</a>
                </li>
                <li class="nav-item">
                    <a href="vaccine.php" class="nav-link">Vaccinate</a>
                </li>
                <li class="nav-item">
                    <a href="vet.php" class="nav-link">Vets</a>
                </li>
                <li class="nav-item">
                    <a href="information.php" class="nav-link">
                        <?php if(isset($_SESSION['customer_name'])): ?>
                            <img src="<?php echo $pet_image; ?>" class="rounded-circle me-1" width="30" height="30" alt="Profile Image">
                        <?php else: ?>
                            <i class="fas fa-user-circle fa-lg me-1 text-primary"></i>
                        <?php endif; ?>
                        <?php echo isset($_SESSION['customer_name']) ? $_SESSION['customer_name'] : "Profile"; ?>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
