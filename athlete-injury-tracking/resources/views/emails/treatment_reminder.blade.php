<!DOCTYPE html>
<html>
<head>
    <title>Upcoming Treatment Reminder</title>
</head>
<body>
    <h1>Dear {{ $athlete->name }},</h1>

    <p>This is a reminder that you have an upcoming treatment scheduled for <strong>{{ $treatment->treatment_date }}</strong>.</p>

    <p>Please make sure to be there on time. If you have any questions, feel free to contact us.</p>

    <p>Best regards,<br>Your Treatment Team</p>
</body>
</html>
