<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Account Deletion Notice</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9f9f9;
            padding: 40px;
            color: #333;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            padding: 30px;
        }

        h2 {
            color: #d9534f;
        }

        .reason {
            background-color: #f2f2f2;
            border-left: 4px solid #d9534f;
            padding: 10px 15px;
            margin: 15px 0;
            font-weight: bold;
        }

        .note {
            background-color: #fdf5e6;
            border-left: 4px solid #f0ad4e;
            padding: 10px 15px;
            margin: 10px 0 20px 0;
            font-style: italic;
        }

        .footer {
            margin-top: 30px;
            font-size: 14px;
            color: #777;
        }

        .support-link {
            color: #0275d8;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <h2>Hello {{ $user->full_name }} ji,</h2>

        <p>We regret to inform you that your account has been permanently removed from our platform.</p>

        <div class="reason">
            📌 <strong>Reason for Deletion:</strong> {{ ucwords(str_replace('_', ' ', $reason)) }}
        </div>

        @if ($note)
            <div class="note">
                📝 <strong>Note from Admin:</strong><br>
                {{ $note }}
            </div>
        @endif

        <p>If you believe this action was taken in error or you need further clarification, feel free to reach out to our support team.</p>

        <p>Click here to contact support: <a class="support-link" href="mailto:support@example.com">support@example.com</a></p>

        <div class="footer">
            Warm regards,<br>
            <strong>Admin Team</strong><br>
            RoomMitra.com
        </div>
    </div>
</body>

</html>
