<!DOCTYPE html>
<html>
<head>
    <title>Payment Reminder from Ankesh</title>
</head>
<body>
<div class="">
    <p>Vehicle No. {{ $vehicle_record->vehicle_no }} next renewal date is {{ \Carbon\Carbon::parse($vehicle_record->renewal_date)->format('d/m/Y') }}</p>
</div>
</body>
</html>