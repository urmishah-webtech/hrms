<!DOCTYPE html>
<html>
<head>
    <title>Wazobia</title>
</head>
<body>
    <h1>{{ $details['title'] }}</h1>
	<h4>Hello</h4>
    <p>{{ $details['body'] }}</p>
   <?php $link_id = $details['emp_id']; ?>
    
	<h4>Current Profile Data</h4><br>
	First Name : <?php echo $details['old_first_name']; ?>  <br>
	Last Name : <?php echo $details['old_first_name']; ?><br>
	Phone Number : <?php echo $details['old_phone_no']; ?><br><br>
	
	<h4>Requested to change profile data to : </h4><br>

	First Name : <?php echo $details['first_name']; ?><br>
	Change Requested Last Name : <?php echo $details['last_name']; ?><br>
	Change Requested Phone Number : <?php echo $details['phone_no']; ?><br><br>
	<h4>Please take action please click the link </h4> - <a href="<?php echo url('/profile/'.$link_id)?>">Approve Link</a><br>
    <p>Thank you</p>
</body>
</html>