<!DOCTYPE html>
<html>
<head>
    <title>Ticket Reply</title>
</head>
<body>
    <h1>Ticket Reply</h1>
    <p>Hello {{ $name }},</p>
    <p>This is regarding your ticket with reference number {{ $refNo }}.</p>
    <p>{{ $replyTicket->ticket_reply_message }}.</p>
    <p>Thank you for using our support system.</p>
</body>
</html>
