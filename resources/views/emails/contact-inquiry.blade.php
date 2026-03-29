<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; }
        .header { background: linear-gradient(135deg, #9333EA, #7E22CE); padding: 24px; border-radius: 8px 8px 0 0; }
        .header h1 { color: white; margin: 0; font-size: 20px; }
        .content { background: #f9fafb; padding: 24px; border: 1px solid #e5e7eb; border-top: none; border-radius: 0 0 8px 8px; }
        .field { margin-bottom: 16px; }
        .label { font-weight: bold; color: #6B7280; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px; }
        .value { margin-top: 4px; font-size: 15px; color: #111827; }
        .message-box { background: white; border: 1px solid #e5e7eb; border-radius: 8px; padding: 16px; margin-top: 4px; }
        .footer { text-align: center; padding: 16px; color: #9CA3AF; font-size: 12px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>New Contact Inquiry</h1>
    </div>
    <div class="content">
        <div class="field">
            <div class="label">Name</div>
            <div class="value">{{ $firstName }} {{ $lastName }}</div>
        </div>
        <div class="field">
            <div class="label">Email</div>
            <div class="value"><a href="mailto:{{ $email }}">{{ $email }}</a></div>
        </div>
        @if($phone)
        <div class="field">
            <div class="label">Phone</div>
            <div class="value">{{ $phone }}</div>
        </div>
        @endif
        <div class="field">
            <div class="label">Message</div>
            <div class="message-box">{{ $userMessage }}</div>
        </div>
    </div>
    <div class="footer">
        Sent from editsbydevixx.com contact form
    </div>
</body>
</html>
