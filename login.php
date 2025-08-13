<?php
include 'db.php';
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Admin Login</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #f4f6f8;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .login-box {
      background-color: white;
      padding: 40px 50px;
      border-radius: 12px;
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 400px;
    }

    h2 {
      text-align: center;
      margin-bottom: 30px;
      color: #333;
    }

    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 12px;
      margin: 10px 0 20px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 16px;
    }

    button {
      width: 100%;
      padding: 12px;
      background-color: #2c3e50;
      color: white;
      border: none;
      border-radius: 6px;
      font-size: 16px;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    button:hover {
      background-color: #1abc9c;
    }

    .error {
      color: red;
      text-align: center;
      margin-top: 10px;
    }

    .success {
      color: green;
      text-align: center;
      margin-top: 10px;
    }
  </style>
</head>
<body>
<div class="login-box">
  <h2>🔐 Admin Login</h2>
  <form method="POST">
    <input type="text" name="username" placeholder="Enter username" required>
    <input type="password" name="password" placeholder="Enter password" required>
    <button type="submit" name="login">Login</button>
  </form>

    <?php
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $stmt = $conn->prepare("SELECT * FROM admin WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            if (password_verify($password, $row['password'])) {
                $_SESSION['admin'] = $username;
                echo "<p class='success'>✅ Login successful! Redirecting...</p>";
                echo "<script>setTimeout(function(){ window.location.href = 'dashboard.php'; }, 1500);</script>";
                exit();
            } else {
                echo "<p class='error'>❌ Invalid password.</p>";
            }
        } else {
            echo "<p class='error'>❌ Admin not found.</p>";
        }
    }
    ?>
  </div>
  </body>
  </html>
