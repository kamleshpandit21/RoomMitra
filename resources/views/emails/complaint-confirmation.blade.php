<!-- resources/views/emails/complaint-confirmation.blade.php -->
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Complaint Received</title>
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
            color: #0275d8;
        }

        .detail {
            background-color: #f2f2f2;
            border-left: 4px solid #0275d8;
            padding: 10px 15px;
            margin: 15px 0;
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
        <h2>Hello {{ $complaint->name }} ji,</h2>

        <p>✅ Your complaint has been successfully submitted. Below are the details:</p>

        <div class="detail">
            <p><strong>Subject:</strong> {{ $complaint->subject }}</p>
            <p><strong>Category:</strong> {{ $complaint->category }}</p>
            <p><strong>Description:</strong><br>{{ $complaint->description }}</p>
        </div>

        <p>We will review your concern and get back to you shortly.</p>

        <p>Need urgent help? Reach us at <a class="support-link" href="mailto:support@roommitra.com">support@roommitra.com</a></p>

        <div class="footer">
            Regards,<br>
            <strong>RoomMitra Support Team</strong>
        </div>
    </div>
</body>

</html>
