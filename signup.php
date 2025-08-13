<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Signup</title>
    <link rel="stylesheet" href="signup.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f3f3;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        form {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
            width: 300px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        input {
            width: 100%;
            padding: 10px;
            margin-top: 8px;
            margin-bottom: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        button {
            width: 100%;
            padding: 10px;
            background: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
        }
        .msg {
            margin-top: 15px;
            text-align: center;
        }
        .msg.success { color: green; }
        .msg.error { color: red; }
    </style>
</head>
<body>
    <form method="POST">
        <h2>Admin Signup</h2>
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="signup">Signup</button>
        
        <?php
        if (isset($_POST['signup'])) {
            $username = $_POST['username'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

            // Check if username already exists
            $check = $conn->prepare("SELECT * FROM admin WHERE username = ?");
            $check->bind_param("s", $username);
            $check->execute();
            $result = $check->get_result();

            if ($result->num_rows > 0) {
                echo "<div class='msg error'>⚠️ Username already exists!</div>";
            } else {
                $stmt = $conn->prepare("INSERT INTO admin (username, password) VALUES (?, ?)");
                $stmt->bind_param("ss", $username, $password);

                if ($stmt->execute()) {
                    echo "<div class='msg success'>✅ Signup Successful. <a href='login.php'>Login Here</a></div>";
                } else {
                    echo "<div class='msg error'>❌ Error: " . $conn->error . "</div>";
                }
            }
        }
        ?>
    </form>
</body>
</html>
