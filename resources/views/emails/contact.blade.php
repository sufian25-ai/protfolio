<!DOCTYPE html>
<html>
<head>
    <title>New Contact Message</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 5px;">
        <h2 style="color: #38bdf8;">New Message from Portfolio</h2>
        <p><strong>Name:</strong> {{ $data['name'] }}</p>
        <p><strong>Email:</strong> {{ $data['email'] }}</p>
        <p><strong>Subject:</strong> {{ $data['subject'] }}</p>
        <hr>
        <p><strong>Message:</strong></p>
        <p style="background: #f4f4f4; padding: 15px; border-radius: 5px;">{{ $data['message'] }}</p>
        <hr>
        <p style="font-size: 0.8rem; color: #777;">This email was sent from your portfolio website contact form.</p>
    </div>
</body>
</html>
