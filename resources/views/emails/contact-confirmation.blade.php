<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Contact Confirmation</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, sans-serif; background: #f4f4f4; padding: 40px; color: #333; }
        .container { max-width: 600px; background: #fff; padding: 30px; border-radius: 8px; margin: auto; box-shadow: 0 4px 10px rgba(0,0,0,0.05); }
        h2 { color: #0275d8; }
        .footer { margin-top: 30px; font-size: 14px; color: #777; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Hello {{ $contact->name }} ji,</h2>
        <p>✅ Thank you for reaching out to us. We’ve received your message:</p>

        <p><strong>Subject:</strong> {{ $contact->subject }}</p>
        <p><strong>Message:</strong><br>{{ $contact->message }}</p>

        <p>Our team will get back to you soon.</p>

        <div class="footer">
            Regards,<br>
            <strong>RoomMitra Support Team</strong>
        </div>
    </div>
</body>
</html>
