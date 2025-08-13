<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Contact Us</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg, #74ebd5, #9face6);
      display: flex;
      flex-direction: column;
      align-items: center;
      min-height: 100vh;
      padding: 40px 20px;
      color: #333;
    }

    h2 {
      font-size: 2.5rem;
      margin-bottom: 20px;
      color: #2c3e50;
    }

    .contact-card {
      background: #ffffff;
      padding: 30px 40px;
      border-radius: 16px;
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
      text-align: center;
      max-width: 600px;
      width: 100%;
      margin-bottom: 30px;
    }

    .contact-card p {
      font-size: 1.1rem;
      margin: 10px 0;
    }

    .contact-card a {
      display: inline-block;
      margin-top: 20px;
      padding: 10px 20px;
      background-color: #2c3e50;
      color: white;
      text-decoration: none;
      border-radius: 8px;
      transition: background-color 0.3s ease;
    }

    .contact-card a:hover {
      background-color: #1abc9c;
    }

    .map-container {
      width: 100%;
      max-width: 600px;
      height: 400px;
      border-radius: 16px;
      overflow: hidden;
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
    }

    iframe {
      width: 100%;
      height: 100%;
      border: 0;
    }

    @media (max-width: 600px) {
      .contact-card {
        padding: 20px;
      }

      h2 {
        font-size: 2rem;
      }

      .map-container {
        height: 300px;
      }
    }
  </style>
</head>
<body>

  <div class="contact-card">
    <h2>Contact Us</h2>
    <p>📧 Email: alakhpanday.2251@example.com</p>
    <p>📞 Phone: +91-7709280916</p>
    <p>📍 Address:  kota , Rajasthan, India</p>
    <a href="dashboard.php">⬅ Back to Dashboard</a>
  </div>

  <!-- Google Maps Embed -->
  <div class="map-container">
    <iframe 
      src="https://www.google.com/maps?q=R+K+Desai+College,+Vapi,+Gujarat,+India&output=embed" 
      allowfullscreen="" 
      loading="lazy" 
      referrerpolicy="no-referrer-when-downgrade">
    </iframe>
  </div>

</body>
</html>
