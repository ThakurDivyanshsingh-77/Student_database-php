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
  <title>Register Student</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #eef2f5;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }

    .form-container {
      background-color: #fff;
      padding: 40px;
      border-radius: 12px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 600px;
    }

    h2 {
      text-align: center;
      margin-bottom: 25px;
      color: #2c3e50;
    }

    label {
      display: block;
      margin: 12px 0 6px;
      font-weight: 500;
    }

    input[type="text"],
    input[type="email"],
    textarea {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 15px;
    }

    input[type="radio"] {
      margin-right: 5px;
    }

    .gender-group {
      display: flex;
      gap: 15px;
      margin-top: 5px;
    }

    button {
      padding: 10px 16px;
      border: none;
      font-size: 16px;
      border-radius: 6px;
      cursor: pointer;
      margin-right: 10px;
      margin-top: 20px;
    }

    button[type="reset"] {
      background-color: #e74c3c;
      color: white;
    }

    button[type="submit"] {
      background-color: #3498db;
      color: white;
    }

    .message {
      margin-top: 20px;
      text-align: center;
      font-weight: bold;
    }

    .success {
      color: green;
    }

    .error {
      color: red;
    }
  </style>
</head>
<body>
<div class="form-container">
  <h2>Student Registration Form</h2>
  <form method="POST">
    <label>Name:</label>
    <input type="text" name="name" required>

    <label>Email:</label>
    <input type="email" name="email" required>

    <label>Gender:</label>
    <div class="gender-group">
      <label><input type="radio" name="gender" value="Male" required> Male</label>
      <label><input type="radio" name="gender" value="Female" required> Female</label>
    </div>

    <label>City:</label>
    <input type="text" name="city" required>

    <label>Address:</label>
    <textarea name="address" required></textarea>

    <label>Phone:</label>
    <input type="text" name="phone" required>

    <button type="reset">Reset</button>
    <button type="submit" name="submit" onclick="return confirm('Submit student details?')">Submit</button>
  </form>

  <?php
  if (isset($_POST['submit'])) {
      $stmt = $conn->prepare("INSERT INTO students (name, email, gender, city, address, phone) VALUES (?, ?, ?, ?, ?, ?)");
      $stmt->bind_param("ssssss", $_POST['name'], $_POST['email'], $_POST['gender'], $_POST['city'], $_POST['address'], $_POST['phone']);
      
      if ($stmt->execute()) {
          echo "<div class='message success'>✅ Student Registered Successfully.</div>";
      } else {
          echo "<div class='message error'>❌ Error: " . $conn->error . "</div>";
      }
  }
  ?>
</div>
</body>
</html>
