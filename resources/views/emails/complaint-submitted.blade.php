<!-- resources/views/emails/complaint-submitted.blade.php -->
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>New Complaint Submitted</title>
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

        .info {
            background-color: #f2f2f2;
            border-left: 4px solid #5bc0de;
            padding: 10px 15px;
            margin: 15px 0;
        }

        .footer {
            margin-top: 30px;
            font-size: 14px;
            color: #777;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <h2>🚨 New Complaint Submitted</h2>

        <div class="info">
            <p><strong>Name:</strong> {{ $complaint->name }}</p>
            <p><strong>Email:</strong> {{ $complaint->email ?? 'N/A' }}</p>
            <p><strong>Phone:</strong> {{ $complaint->phone ?? 'N/A' }}</p>
            <p><strong>User Type:</strong> {{ ucfirst($complaint->user_type) }}</p>
            <p><strong>Category:</strong> {{ $complaint->category }}</p>
            <p><strong>Subject:</strong> {{ $complaint->subject }}</p>
            <p><strong>Description:</strong><br>{{ $complaint->description }}</p>
        </div>

        @if ($complaint->attachment)
        <p><strong>Attachment:</strong> <a href="{{ asset('storage/' . $complaint->attachment) }}" target="_blank">View File</a></p>
        @endif

        <div class="footer">
            Please login to the admin dashboard to review this complaint.<br>
            <strong>RoomMitra System</strong>
        </div>
    </div>
</body>

</html>
