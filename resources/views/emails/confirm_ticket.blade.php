<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Confirmation</title>
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

        p {
            margin: 0;
            padding: 0.5em;
        }

        ul {
            list-style: none;
            padding: 0;
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
        <h1>Ticket Confirmation</h1>
    </header>

    <div class="container">
        <p>Dear {{ $userName }},</p>
        <p>We hope this email finds you well. 🌟</p>
        <p>We are thrilled to inform you that your ticket has been confirmed, and we've assigned the reference number {{ $referenceNumber }} to it. 🎫</p>
        <p>Here are the details of your ticket:</p>
        <ul>
            <li>Ticket Reference Number: {{ $referenceNumber }}</li>
        </ul>
        <p>Our team is already on the case, and we'll do our utmost to provide you with the support you need. If you have any additional information to share or questions, feel free to reply to this email.</p>
        <p>Thank you for choosing our support system. We appreciate your trust in us.</p>
        <p>Best regards, Support Team 🚀</p>
    </div>
</body>
</html>
