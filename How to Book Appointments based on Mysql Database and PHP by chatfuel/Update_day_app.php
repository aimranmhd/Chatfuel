<?php



$messenger_id = $_GET['messenger_id'];
$first_name_get= $_GET['first_name'];
$last_name_get = $_GET['last_name'];
$email_get = $_GET['email'];
$mobile_get = $_GET['mobile_number'];
$ppointment_get = $_GET['appointment'];

//echo $cop_here;

$link = mysqli_connect("SERVER_NAME", "USERNAME", "PASSWORD", "DBNAME"); 
  
if ($link ==  false) { 
    die("ERROR: Could not connect. "
                .mysqli_connect_error()); 
} 

mysqli_query($link, "SET NAMES 'utf8'"); 
mysqli_query($link, "SET CHARACTER SET utf8"); 
$sql="SELECT * FROM appointments where id = '$messenger_id' AND status = '1'";
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_array($result);
$name = $row['name'];
$email = $row['email'];
$mobile_number = $row['mobile'];
$appointment_user =  $row['appointment'];



if(mysqli_num_rows($result) > 0){

echo "you have one or more active appointment , if you forgot that you shall contact clinc on number 0303040340 to confirm the appointment  or rest";



$valid = array (
  'messages' => 
  array (
    0 => 
    array (
      'text' => 'you have one or more active appointment , if you forgot that you shall contact clinc by click on below button to rest or click on rest button',
      'quick_replies' => 
      array (
        0 => 
        array (
          'title' => 'contact us',
          'block_names' => 
           array (
            0 => 'contact_us',
          ),
        ),
                1 => 
        array (
          'title' => 'Rest Appointment',
          'block_names' => 
           array (
            0 => 'rest_me',
          ),
        ),
      ),
    ),
  ),
);

//echo json_encode($valid);

$file_name = $_GET['messenger_id'] . "_data.json";  
 if(file_put_contents($file_name, json_encode($valid,JSON_UNESCAPED_UNICODE )))  
 
 
 {  
 header("Content-Type: text/plain; charset=UTF-8");
      echo $file_name . ' File created';  
 }  
 else  
 {  
      echo 'There is some error';  
 }  


function json_encode_unicode($valid) {
	if (defined('JSON_UNESCAPED_UNICODE')) {
		return json_encode($data, JSON_UNESCAPED_UNICODE);
	}
	return preg_replace_callback('/(?<!\\\\)\\\\u([0-9a-f]{4})/i',
		function ($m) {
			$d = pack("H*", $m[1]);
			$r = mb_convert_encoding($d, "UTF8", "UTF-16BE");
			return $r!=="?" && $r!=="" ? $r : $m[0];
		}, json_encode($data)
	);
}



}
else{

$servername = "servername ";
$username = "username";
$password = "password";
$dbname = "dbname";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

mysqli_query($conn, "SET NAMES 'utf8'"); 
mysqli_query($conn, "SET CHARACTER SET utf8"); 



$sql = "INSERT INTO appointments (id, name, mobile, email, appointment)
VALUES ('$messenger_id', '$first_name_get. $last_name_get', '$mobile_get', '$email_get', '$ppointment_get')";
//mysqli_query($conn, $sql);

if (mysqli_query($conn, $sql)) {
    $sqla = "UPDATE working SET status= '1' WHERE appointment = '$ppointment_get'";
mysqli_query($conn, $sqla);
}



$valid = array (
  'messages' => 
  array (
    0 => 
    array (
      'text' => 'Appointment for '.$first_name_get.' '.$last_name_get. ' has been booked on'.$ppointment_get. '',
      'quick_replies' => 
         array (
        0 => 
        array (
          'title' => 'Cancel Appointment',
          'block_names' => 
           array (
            0 => 'cancel_app',
          ),
        ),
        1 => 
        array (
          'title' => 'Confirm Appointment',
          'block_names' => 
           array (
            0 => 'confirm_app',
          ),
          ),
      ),
  ),
),
);

//echo json_encode($valid);


$file_name = $_GET['messenger_id'] . "_data.json";  
 if(file_put_contents($file_name, json_encode($valid,JSON_UNESCAPED_UNICODE )))  
 
 
 {  
 header("Content-Type: text/plain; charset=UTF-8");
      echo $file_name . ' File created';  
 }  
 else  
 {  
      echo 'There is some error';  
 }  


function json_encode_unicode($valid) {
	if (defined('JSON_UNESCAPED_UNICODE')) {
		return json_encode($data, JSON_UNESCAPED_UNICODE);
	}
	return preg_replace_callback('/(?<!\\\\)\\\\u([0-9a-f]{4})/i',
		function ($m) {
			$d = pack("H*", $m[1]);
			$r = mb_convert_encoding($d, "UTF8", "UTF-16BE");
			return $r!=="?" && $r!=="" ? $r : $m[0];
		}, json_encode($data)
	);
}
















}


?>
