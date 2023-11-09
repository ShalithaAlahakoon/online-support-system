<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Reply</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #007bff;
            color: #fff;
            text-align: center;
            padding: 1em 0;
        }

        h1, p {
            margin: 0;
            padding: 0.5em;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <header>
        <h1>Ticket Reply</h1>
    </header>

    <div class="container">
        <p>Hello {{ $name }},</p>
        <p>This is regarding your ticket with reference number {{ $refNo }}.</p>
        <p>{{ $replyTicket->ticket_reply_message }}.</p>
        <p>Thank you for using our support system.</p>
    </div>
</body>
</html>
