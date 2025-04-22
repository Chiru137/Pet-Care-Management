<?php
session_start();
include("database.php");

// Check if the user is logged in
if (isset($_SESSION['customer_id'])) {
    $customer_id = $_SESSION['customer_id'];

    // Fetch vaccination details along with veterinarian name
    $vet_query = "SELECT * FROM veterinary";
    $vet_result = mysqli_query($conn, $vet_query);
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
    <style>
        body {
            background-image: url('img/offer.jpg');
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
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title">Veterinarian Details</h2>
                <div class="input-group mb-3">
                    <input type="text" id="searchInput" class="form-control" onkeyup="searchTable()" placeholder="Search by Vet Name or Place..">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <table class="table table-striped blar">
                    <thead class="btn-primary">
                        <tr>
                            <th>Vet Name</th>
                            <th>Place</th>
                            <th>Phone number</th>
                        </tr>
                    </thead>
                    <tbody >
                        <?php while ($row = mysqli_fetch_assoc($vet_result)) : ?>
                            <tr>
                                <td><h6><?php echo $row['vet_name']; ?></h6></td>
                              <td><h6><?php echo $row['vet_address'];?></h6></td>
                                <td><h6><?php echo $row['vet_phone'];?></h6></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function searchTable() {
            let input, filter, table, tr, td1, td2, i, txtValue1, txtValue2;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            table = document.getElementsByTagName("table")[0]; // Get the first table
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td1 = tr[i].getElementsByTagName("td")[0]; // Index 0 for Vet Name
                td2 = tr[i].getElementsByTagName("td")[1]; // Index 1 for Place
                if (td1 && td2) {
                    txtValue1 = td1.textContent || td1.innerText;
                    txtValue2 = td2.textContent || td2.innerText;
                    if (txtValue1.toUpperCase().indexOf(filter) > -1 || txtValue2.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
</body>

</html>
