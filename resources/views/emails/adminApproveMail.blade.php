<!DOCTYPE html>
<html>
<head>
    <title>Wazobia</title>
</head>
<body>
    <h1>{{ $details['title'] }}</h1>
    <p>{{ $details['body'] }}</p>
   <?php $link_id = $details['emp_id']; ?>
    <a href="<?php echo url('/profile/'.$link_id)?>">Approve Request for link</a>
    <p>Thank you</p>
</body>
</html>