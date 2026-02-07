<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Welcome Letter</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 14px;
            line-height: 1.7;
            color: #000;
        }

        .container {
            padding: 40px;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #0d6efd;
            margin-bottom: 30px;
            padding-bottom: 10px;
        }

        .header h2 {
            margin: 0;
            color: #0d6efd;
        }

        .info-table {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
        }

        .info-table td {
            padding: 8px;
            border: 1px solid #ddd;
        }

        .signature {
            margin-top: 50px;
        }
    </style>
</head>
<body>

<div class="container">

    <div class="header">
        <h2>Paheli Herbal’s Marketing Pvt. Ltd.</h2>
        <p><strong>Official Welcome Letter</strong></p>
    </div>

    <p>Dear <strong>{{ $user->fullname }}</strong>,</p>

    <p>
        We are pleased to welcome you to Paheli Herbal’s Marketing Pvt. Ltd.
        Your decision to join us marks the beginning of a successful journey
        toward growth and financial independence.
    </p>

    <p>Your account has been successfully created. Please find your details below:</p>

    <table class="info-table">
        <tr>
            <td><strong>Username</strong></td>
            <td>{{ $user->username }}</td>
        </tr>
        <tr>
            <td><strong>Joining Date</strong></td>
            <td>{{ showDateTime($user->created_at) }}</td>
        </tr>
        <tr>
            <td><strong>Current Plan</strong></td>
            <td>{{ optional($user->plan)->name ?? 'N/A' }}</td>
        </tr>
    </table>

    <p>
        We encourage you to actively participate in our business programs.
        Our support team is always ready to assist you.
    </p>

    <p>We wish you great success with Paheli Herbals.</p>

    <div class="signature">
        <p>Warm Regards,</p>
        <strong>Management Team</strong><br>
        Paheli Herbal’s Marketing Pvt. Ltd.
    </div>

</div>

</body>
</html>
