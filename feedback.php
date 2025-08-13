<?php
include 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Feedback</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg, #fdfbfb, #ebedee);
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 40px 20px;
    }

    h2 {
      font-size: 2.5rem;
      margin-bottom: 20px;
      color: #2c3e50;
    }

    form {
      background: #ffffff;
      padding: 30px 40px;
      border-radius: 12px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
      max-width: 500px;
      width: 100%;
    }

    input, textarea {
      width: 100%;
      padding: 10px;
      margin-top: 6px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 1rem;
    }

    button {
      background-color: #1abc9c;
      color: white;
      padding: 12px 20px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-size: 1rem;
      transition: background-color 0.3s ease;
    }

    button:hover {
      background-color: #16a085;
    }

    .response {
      margin-top: 20px;
      padding: 15px 20px;
      border-radius: 8px;
      font-size: 1rem;
      max-width: 500px;
      width: 100%;
    }

    .success {
      background-color: #d4edda;
      color: #155724;
      border: 1px solid #c3e6cb;
    }

    .error {
      background-color: #f8d7da;
      color: #721c24;
      border: 1px solid #f5c6cb;
    }

    @media (max-width: 600px) {
      form {
        padding: 20px;
      }
    }
  </style>
</head>
<body>

<h2>Feedback Form</h2>

<form method="POST">
  <label>Name:</label>
  <input type="text" name="name" required>

  <label>Email:</label>
  <input type="email" name="email" required>

  <label>Message:</label>
  <textarea name="message" rows="5" required></textarea>

  <button type="submit" name="send">Send Feedback</button>
</form>

<?php
if (isset($_POST['send'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $messageText = trim($_POST['message']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<div class='response error'>❌ Invalid email address.</div>";
    } else {
        // Insert into database
        $stmt = $conn->prepare("INSERT INTO feedback (name, email, message) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $messageText);

        if ($stmt->execute()) {
            echo "<div class='response success'>✅ Feedback Submitted Successfully.</div>";

            // Send email
            $to = "rajsingh71143@gmail.com";
            $subject = "New Feedback from $name";
            $message = "Name: $name\nEmail: $email\nMessage:\n$messageText";
            $headers = "From: $email";

            if (mail($to, $subject, $message, $headers)) {
                echo "<div class='response success'>📧 Email sent successfully.</div>";
            } else {
                echo "<div class='response error'>❌ Failed to send email.</div>";
            }
        } else {
            echo "<div class='response error'>❌ Error: " . $conn->error . "</div>";
        }
    }
}
?>

</body>
</html>
