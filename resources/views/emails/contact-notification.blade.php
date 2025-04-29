<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>New Contact Message</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, sans-serif; background: #f9f9f9; padding: 40px; color: #333; }
        .container { max-width: 600px; background: #fff; padding: 30px; border-radius: 8px; margin: auto; box-shadow: 0 4px 10px rgba(0,0,0,0.05); }
        h2 { color: #d9534f; }
        .footer { margin-top: 30px; font-size: 14px; color: #777; }
    </style>
</head>
<body>
    <div class="container">
        <h2>📩 New Contact Message Received</h2>

        <p><strong>Name:</strong> {{ $contact->name }}</p>
        <p><strong>Email:</strong> {{ $contact->email }}</p>
        <p><strong>Phone:</strong> {{ $contact->phone }}</p>
        <p><strong>Subject:</strong> {{ $contact->subject }}</p>
        <p><strong>Message:</strong><br>{{ $contact->message }}</p>

        <div class="footer">
            Please respond to this message promptly.<br>
            <strong>RoomMitra Admin</strong>
        </div>
    </div>
</body>
</html>
