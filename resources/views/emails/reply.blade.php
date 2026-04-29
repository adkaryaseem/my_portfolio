<!DOCTYPE html>
<html>
<head>
    <title>Reply to your message</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px;">
        <h2 style="color: #6366f1;">Hello {{ $originalMessage->name }},</h2>
        
        <div style="margin: 20px 0; padding: 15px; background: #f9f9f9; border-left: 4px solid #6366f1;">
            {!! nl2br(e($replyContent)) !!}
        </div>
        
        <p>Best regards,</p>
        <p><strong>Ashim Adhikari</strong></p>
        
        <hr style="border: none; border-top: 1px solid #ddd; margin: 30px 0;">
        <div style="color: #888; font-size: 0.9em;">
            <p><strong>Your original message:</strong></p>
            <blockquote style="margin: 0; padding-left: 10px; border-left: 2px solid #ccc;">
                {{ $originalMessage->message }}
            </blockquote>
        </div>
    </div>
</body>
</html>
