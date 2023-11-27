<!-- add_package.php -->
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Add New Package</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      padding: 20px;
    }

    form {
      max-width: 500px;
      margin: 0 auto;
      background-color: #f8f9fa;
      padding: 15px;
      border-radius: 10px;
      margin-bottom: 20px;
    }

    label {
      font-weight: bold;
    }
  </style>
</head>

<body>

  <div class="container">
    <h2>Add New Package</h2>
    <hr class="my-4">
    <div class="row" id="packagesNew">
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

    // Handle form submission for adding a new package
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
        $title = $_POST['title'];
        $priceMatang = $_POST['priceMatang'];
        $priceNasiBox = $_POST['priceNasiBox'];
        $tusuk = $_POST['tusuk'];
        $box = $_POST['box'];
        $imageUrl = $_POST['imageUrl'];
        $whatsappLink = $_POST['whatsappLink'];

        // Insert new package into the database
        $sql = "INSERT INTO packages (title, priceMatang, priceNasiBox, tusuk, box, imageUrl, whatsappLink) VALUES ('$title', '$priceMatang', '$priceNasiBox', '$tusuk', '$box', '$imageUrl', '$whatsappLink')";

        if ($conn->query($sql) === TRUE) {
            echo '<div class="alert alert-success" role="alert">New package added successfully</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">Error adding new package: ' . $conn->error . '</div>';
        }
    }
    ?>

    <form method="post" action="">
      <div class="mb-3">
        <label for="title" class="form-label">Title:</label>
        <input type="text" name="title" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="priceMatang" class="form-label">Price Matang:</label>
        <input type="text" name="priceMatang" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="priceNasiBox" class="form-label">Price Nasi Box:</label>
        <input type="text" name="priceNasiBox" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="tusuk" class="form-label">Tusuk:</label>
        <input type="text" name="tusuk" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="box" class="form-label">Box:</label>
        <input type="text" name="box" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="imageUrl" class="form-label">Image URL:</label>
        <input type="text" name="imageUrl" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="whatsappLink" class="form-label">WhatsApp Link:</label>
        <input type="text" name="whatsappLink" class="form-control" required>
      </div>
      <button type="submit" name="add" class="btn btn-warning">Add Package</button>
    </form>

    <hr>

    <!-- Link to the page for managing packages -->
    <a href="manage_packages.php" class="btn btn-secondary">Back to Manage Packages</a>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>