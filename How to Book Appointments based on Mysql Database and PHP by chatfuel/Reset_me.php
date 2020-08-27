<?php



$messenger_id = $_GET['messenger_id'];


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

$appointment_user =  $row['appointment'];



if(mysqli_num_rows($result) > 0){

$servername = "servername";
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



$sql = "UPDATE appointments SET status = '0' WHERE id = '$messenger_id' ";
//mysqli_query($conn, $sql);

if (mysqli_query($conn, $sql)) {
    $sqla = "UPDATE working SET status= '0' WHERE appointment = '$appointment_user'";
mysqli_query($conn, $sqla);
}





$valid = array (
  'messages' => 
  array (
    0 => 
    array (
      'text' => 'All Your appointments have been reset book another ',
      'quick_replies' => 
      array (
        0 => 
        array (
          'title' => 'Book Another',
          'block_names' => 
           array (
            0 => 'another_day',
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



$valid = array (
  'messages' => 
  array (
    0 => 
    array (
      'text' => 'there is no any active appointment on our database for your, if you still facing issue kindly contact us',
      'quick_replies' => 
         array (
        0 => 
        array (
          'title' => 'Contact Us',
          'block_names' => 
           array (
            0 => 'contact_us',
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
