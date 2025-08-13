<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include 'db.php'; // Make sure this connects to your DB

// Fetch student count
$result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM students");
$data = mysqli_fetch_assoc($result);
$studentCount = $data['total'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f0f4f8;
            color: #333;
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 220px;
            background: #2c3e50;
            color: #fff;
            padding: 20px;
            display: flex;
            flex-direction: column;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 1.8rem;
        }

        .sidebar a {
            color: #fff;
            text-decoration: none;
            margin: 10px 0;
            padding: 10px 15px;
            border-radius: 6px;
            transition: background 0.3s;
        }

        .sidebar a:hover {
            background: #1abc9c;
        }

        /* Main Content */
        .main {
            flex: 1;
            padding: 30px;
        }

        h1 {
            font-size: 2rem;
            margin-bottom: 20px;
        }

        .profile-card {
            background: #fff;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 0 12px rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 30px;
        }

        .profile-card img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #1abc9c;
        }

        .profile-info h3 {
            margin-bottom: 5px;
        }

        .stats {
            background: #1abc9c;
            color: #fff;
            padding: 20px;
            border-radius: 10px;
            font-size: 1.3rem;
            margin-bottom: 30px;
            display: inline-block;
        }

        /* Footer */
        footer {
            background: #2c3e50;
            color: #fff;
            text-align: center;
            padding: 15px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        @media (max-width: 768px) {
            body {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                flex-direction: row;
                justify-content: space-around;
                align-items: center;
            }

            .main {
                padding: 15px;
            }

            footer {
                position: relative;
            }
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Admin</h2>
        <a href="register_student.php">📋 Register Student</a>
        <a href="search.php">🔍 Search Student</a>
        <a href="contact.php">📨 Contact Us</a>
        <a href="feedback.php">💬 Feedback</a>
        <a href="logout.php">🚪 Logout</a>
    </div>

    <!-- Main Section -->
    <div class="main">
        <h1>Welcome, Admin 👋</h1>

        <!-- Profile Card -->
        <div class="profile-card">
            <img src="https://i.pinimg.com/736x/65/fd/bd/65fdbd8b30ecfa5bec62a735b1d53832.jpg" alt="Admin Avatar">
            <div class="profile-info">
                <h3>Iconic-6</h3>
                <p>System Administrator</p>
                <p>Email:  iconic6.2251@gmail.com</p>
            </div>
        </div>

        <!-- Student Stats -->
        <div class="stats">
            👨‍🎓 Total Registered Students: <strong><?php echo $studentCount; ?></strong>
        </div>

    </div>

    <!-- Footer -->
    <footer>
        &copy; <?php echo date("Y"); ?>  Student database Dashboard. All rights reserved.
    </footer>

</body>
</html>
