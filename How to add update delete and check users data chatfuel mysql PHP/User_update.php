<?php



$messenger_id = $_GET['messenger_id'];
$first_name_get= $_GET['first_name'];
$last_name_get = $_GET['last_name'];
$email_get = $_GET['email'];
$mobile_get = $_GET['mobile_number'];

//echo $cop_here;

$link = mysqli_connect("servername", "username", "password", "db name"); 
  
if ($link ==  false) { 
    die("ERROR: Could not connect. "
                .mysqli_connect_error()); 
} 


$sql="SELECT * FROM users_data where id = '$messenger_id'";
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_array($result);
$first_name = $row['first_name'];
$last_name = $row['last_name'];
$email = $row['email'];
$mobile_number = $row['mobile_number'];
$messenger_user =  $row['id'];



if(mysqli_num_rows($result) > 0){

echo "user updated into database ";
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

$sql = "UPDATE users_data SET first_name='$first_name_get', last_name = '$last_name_get', email = '$email_get', mobile_number= '$mobile_get' WHERE id=$messenger_id";
mysqli_query($conn, $sql);


$valid = array (
  'messages' => 
  array (
    0 => 
    array (
      'text' => 'User ID '.$messenger_id. ' has been updated successfully',
      'quick_replies' => 
         array (
        0 => 
        array (
          'title' => 'Check Data',
          'block_names' => 
           array (
            0 => 'Welcome Message',
          ),
        ),
        1 => 
        array (
          'title' => 'Add Data',
          'block_names' => 
           array (
            0 => 'add_user',
          ),
          ),
                  2 => 
        array (
          'title' => 'Update Data',
          'block_names' => 
           array (
            0 => 'update_user',
          ),
),
  3 => 
        array (
          'title' => 'Delete Data',
          'block_names' => 
           array (
            0 => 'delete_user',
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






}else{





echo "No User found";



$valid = array (
  'messages' => 
  array (
    0 => 
    array (
      'text' => 'User ID '.$messenger_id. ' Not exist',
      'quick_replies' => 
      array (
        0 => 
        array (
          'title' => 'Check Data',
          'block_names' => 
           array (
            0 => 'Welcome Message',
          ),
        ),
        1 => 
        array (
          'title' => 'Add Data',
          'block_names' => 
           array (
            0 => 'add_user',
          ),
          ),
                  2 => 
        array (
          'title' => 'Update Data',
          'block_names' => 
           array (
            0 => 'update_user',
          ),
),
  3 => 
        array (
          'title' => 'Delete Data',
          'block_names' => 
           array (
            0 => 'delete_user',
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
