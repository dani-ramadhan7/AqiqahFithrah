<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Manage Packages</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            padding: 20px;
        }

        .form-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }

        form {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        hr {
            margin-top: 20px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

	<div class="container">
    <h2>Daftar Paket</h2>
    <hr class="my-4">
    <div class="row" id="packagesRow">
    </div>

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "db_aqiqahfithrah";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if the delete button is clicked
        if (isset($_POST['delete'])) {
            $id = $_POST['id'];

            // Delete the package from the database
            $sql = "DELETE FROM packages WHERE id='$id'";

            if ($conn->query($sql) === TRUE) {
                echo '<div class="alert alert-success" role="alert">Record deleted successfully</div>';
            } else {
                echo '<div class="alert alert-danger" role="alert">Error deleting record: ' . $conn->error . '</div>';
            }
        } else {
            // Process form data when the form is submitted for update
            $id = $_POST['id'];
            $title = $_POST['title'];
            $priceMatang = $_POST['priceMatang'];
            $priceNasiBox = $_POST['priceNasiBox'];
            $tusuk = $_POST['tusuk'];
            $box = $_POST['box'];
						$imageUrl = isset($_POST['imageUrl']) ? $_POST['imageUrl'] : '';
						$whatsappLink = isset($_POST['whatsappLink']) ? $_POST['whatsappLink'] : '';

            // Update the database with the new values
            $sql = "UPDATE packages SET title='$title', priceMatang='$priceMatang', priceNasiBox='$priceNasiBox', tusuk='$tusuk', box='$box', imageUrl='$imageUrl', whatsappLink='$whatsappLink' WHERE id='$id'";

            if ($conn->query($sql) === TRUE) {
                echo '<div class="alert alert-success" role="alert">Record updated successfully</div>';
            } else {
                echo '<div class="alert alert-danger" role="alert">Error updating record: ' . $conn->error . '</div>';
            }
        }
    }

    // Fetch packages from the database
    $sql = "SELECT * FROM packages";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<div class="form-container">';
        while ($row = $result->fetch_assoc()) {
            echo '
            <form method="post" action="">
                <input type="hidden" name="id" value="' . $row['id'] . '">
                <div class="mb-3">
                    <label for="title" class="form-label">Title:</label>
                    <input type="text" name="title" class="form-control" value="' . $row['title'] . '">
                </div>
                <div class="mb-3">
                    <label for="priceMatang" class="form-label">Price Matang:</label>
                    <input type="text" name="priceMatang" class="form-control" value="' . $row['priceMatang'] . '">
                </div>
                <div class="mb-3">
                    <label for="priceNasiBox" class="form-label">Price Nasi Box:</label>
                    <input type="text" name="priceNasiBox" class="form-control" value="' . $row['priceNasiBox'] . '">
                </div>
                <div class="mb-3">
                    <label for="tusuk" class="form-label">Tusuk:</label>
                    <input type="text" name="tusuk" class="form-control" value="' . $row['tusuk'] . '">
                </div>
                <div class="mb-3">
                    <label for="box" class="form-label">Box:</label>
                    <input type="text" name="box" class="form-control" value="' . $row['box'] . '">
                </div>
								<div class="mb-3">
                    <label for="box" class="form-label">imageUrl:</label>
                    <input type="text" name="box" class="form-control" value="' . $row['imageUrl'] . '">
                </div>
								<div class="mb-3">
                    <label for="box" class="form-label">whatsappLink:</label>
                    <input type="text" name="box" class="form-control" value="' . $row['whatsappLink'] . '">
                </div>
                <button type="submit" class="btn btn-warning">Update</button>
                <button type="submit" name="delete" class="btn btn-danger">Delete</button>
            </form>';
        }
        echo '</div>';
    } else {
        echo '<div class="alert alert-warning" role="alert">0 results</div>';
    }

    $conn->close();
    ?>

		<hr>

    <!-- Link to the page for adding a new package -->
    <a href="add_package.php" class="btn btn-warning">Add New Package</a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

	</div>

</body>

</html>