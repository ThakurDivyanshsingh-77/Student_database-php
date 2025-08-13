<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
include 'db.php';
?>
<!DOCTYPE html>
<html>
<head>
  <title>Search Student</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f1f4f9;
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
      min-height: 100vh;
      padding: 20px;
    }

    h2 {
      color: #2c3e50;
      margin-bottom: 20px;
    }

    form {
      background: #fff;
      padding: 25px 30px;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      margin-bottom: 30px;
    }

    input[type="text"] {
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 16px;
      width: 250px;
      margin-right: 10px;
    }

    button {
      padding: 10px 16px;
      font-size: 16px;
      background-color: #3498db;
      color: white;
      border: none;
      border-radius: 6px;
      cursor: pointer;
    }

    .result {
      background: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      width: 100%;
      max-width: 500px;
    }

    .error {
      color: red;
      font-weight: bold;
    }

    .label {
      font-weight: bold;
    }
  </style>
</head>
<body>
  <h2>Search Student by Phone Number</h2>
  <form method="GET">
    <input type="text" name="phone" placeholder="Enter phone number" required>
    <button type="submit">Search</button>
  </form>

  <?php
  if (isset($_GET['phone'])) {
      $phone = $_GET['phone'];
      $stmt = $conn->prepare("SELECT * FROM students WHERE phone = ?");
      $stmt->bind_param("s", $phone);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($row = $result->fetch_assoc()) {
          echo "<div class='result'>";
          echo "<h3>✅ Student Found:</h3>";
          echo "<p><span class='label'>Name:</span> " . $row['name'] . "</p>";
          echo "<p><span class='label'>Email:</span> " . $row['email'] . "</p>";
          echo "<p><span class='label'>Gender:</span> " . $row['gender'] . "</p>";
          echo "<p><span class='label'>City:</span> " . $row['city'] . "</p>";
          echo "<p><span class='label'>Address:</span> " . $row['address'] . "</p>";
          echo "<p><span class='label'>Phone:</span> " . $row['phone'] . "</p>";
          echo "</div>";
      } else {
          echo "<div class='result error'>❌ No Student Found with phone: <strong>$phone</strong></div>";
      }
  }
  ?>
</body>
</html>
