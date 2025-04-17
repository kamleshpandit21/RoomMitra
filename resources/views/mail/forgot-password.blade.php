<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>OTP Verification</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 480px;
            margin: 20px auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .logo {
            width: 100px;
            margin-bottom: 20px;
        }
        .otp {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            background: #f8f9fa;
            display: inline-block;
            padding: 12px 20px;
            border-radius: 6px;
            letter-spacing: 2px;
        }
        .message {
            font-size: 16px;
            color: #555;
            margin: 20px 0;
        }
        .footer {
            font-size: 12px;
            color: #777;
            margin-top: 20px;
            border-top: 1px solid #ddd;
            padding-top: 15px;
        }
        @media (max-width: 600px) {
            .container {
                width: 90%;
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <img class="logo" src="https://yourcompany.com/logo.png" alt="Company Logo">
        <h2>OTP Verification</h2>
        <p class="message">Your One-Time Password (OTP) for verification is:</p>
        <div class="otp">{{ $otp }}</div>
        <p class="message">This OTP is valid for <strong>10 minutes</strong>. Do not share this code with anyone.</p>
        <p class="message">If you did not request this, please ignore this email.</p>
        <div class="footer">
            <p>Best Regards,</p>
            <p><strong>RoomMitra</strong></p>
            <p><a href="https://roommitra.com">Visit Our Website</a></p>
        </div>
    </div>
</body>
</html>
