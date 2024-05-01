<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Email</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
        }

        p {
            margin-bottom: 20px;
            color: #666;
        }

        .details {
            background: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
            margin-top: 20px;
        }

        .details p {
            margin: 5px 0;
            color: #555;
        }

        .details p strong {
            color: #333;
        }

        .welcome {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-align: center;
            border-radius: 5px;
            margin-top: 30px;
        }

        .welcome p {
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to Our Platform!</h1>
        <p>Your account has been created successfully. You are now part of our community!</p>
        
        <div class="details">
            <p><strong>Name:</strong> {{ $name }}</p>
            <p><strong>Password:</strong> {{ $password }}</p>
        </div>

        <div class="welcome">
            <p>We are excited to have you on board!</p>
            <p>Feel free to explore and enjoy our services.</p>
        </div>
    </div>
</body>
</html>
