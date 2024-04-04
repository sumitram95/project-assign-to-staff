<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>welcome to the user</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333333;
        }

        p {
            color: #555555;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007BFF;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
        }

        .logo {
            width: 100px;
            height: 100px;
        }

        .badge {
            border: none;
            padding: 2px 18px;
            color: white;
            border-radius: 6px;
        }

        .bg-warning {
            background-color: #ffcc00;
        }

        .bg-danger {
            background-color: #cc3300;
        }

        .bg-primary {
            background-color: #5113a7;
        }

        .bg-success {
            background-color: #339900;
        }

        .text-capitalize {
            text-transform: capitalize;
        }

        .text-success {
            color: green;
        }
    </style>
</head>

<body>
    <div class="container">
        <img src="https://t4.ftcdn.net/jpg/01/00/76/57/240_F_100765796_hVO2AGkofuyqsiiPGd4rdEkjq1FaC11k.jpg"
            alt="Company Logo" class="logo">
        <h1>Welcome to SysQube, {{ $fullName ?? 'null' }}!</h1>
        <p>Thank you for joining us. We're excited to have you on board in our Staff Management System!</p>
        <p>Position : <span class="badge bg-warning text-capitalize">{{ $position ?? '' }}</span> </p>
        <p>Role : <span class="badge bg-primary  text-capitalize">{{ $role ?? '' }}</span> </p>
        <p>Status : <span
                class="badge {{ $status == 'active' ? 'bg-success' : 'bg-danger' }} text-capitalize">{{ $status ?? 'null' }}</span>
        </p>
        <p class="text-success">Current Password : password</p>

        </p>
        <p>To get started, click the button below:</p>
        <a href="{{ route('email.verify', $id) }}" class="button">Activate Your Account</a>
        <p>If the button above doesn't work, you can also copy and paste the following link into your browser:</p>
        <p>{{ route('email.verify', $id) }}</p>
        <p>Best regards,<br>The SysQube Team</p>
    </div>
</body>

</html>
