<?php

$day = $_GET['day'];



//echo $cop_here;

$link = mysqli_connect("SERVER_NAME", "USERNAME", "PASSWORD", "DBNAME"); 
  
if ($link ==  false) { 
    die("ERROR: Could not connect. "
                .mysqli_connect_error()); 
} 
mysqli_query($link, "SET NAMES 'utf8'"); 
mysqli_query($link, "SET CHARACTER SET utf8"); 

$sql="SELECT * FROM working WHERE day = '$day' AND status = '0' ";

$result = mysqli_query($link, $sql);


if (mysqli_num_rows($result) > 0) {


$rows = array();
while($row = mysqli_fetch_assoc($result)) {

$check = array(

 'title' => $row["appointment"],

          'block_names' => 
           array (
            0 => 'book',
          )
);
//   echo "Available Appointment: " . $row["day"]. " - Appointment : " . $row["appointment"].  "<br>";
 array_push($rows,$check);
    }
    
 
  

$valid = array (
  'messages' => 
  array (
    0 => 
    array (
      'text' => 'kindly find Avilable Slots below for '.$day,
      'quick_replies' => 
          
     
$rows,
     
                     
  ),
),
);
  
//echo"<pre>";
//print_r($answer);

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

////////////////


    }else{
    
//    echo "sorry there is no available slot , kindly choose another day";
$valid = array (
  'messages' => 
  array (
    0 => 
    array (
      'text' => 'Sorry there is no available slot on '.$day. 'or the selected day is past kindly choose another day',
      'quick_replies' => 
          array (
        0 => 
        array (
          'title' => 'Choose Another day',

          'block_names' => 
           array (
            0 => 'another_day',
          ),
        ),
  
      ),
  ),
),
);


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
