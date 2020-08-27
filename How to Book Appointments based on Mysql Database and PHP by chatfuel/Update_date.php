<?php


php > $unixTime = time();
php > print_r(getdate($unixTime));

echo "<pre>";
print_r(getdate($unixTime));

$dayOfWeek = date("l", $unixTime);

echo $dayOfWeek;

$link = mysqli_connect("SERVERNAME", "USERNAME", "PASSWORD", "DBNAME"); 
  
if ($link ==  false) { 
    die("ERROR: Could not connect. "
                .mysqli_connect_error()); 
} 
mysqli_query($link, "SET NAMES 'utf8'"); 
mysqli_query($link, "SET CHARACTER SET utf8"); 

$sql="SELECT * FROM working WHERE status = '0' ";

$result = mysqli_query($link, $sql);

if($dayOfWeek === 'Sunday'){
 $sqla = "UPDATE working SET status= '1' WHERE day = 'Saturday' ";
mysqli_query($link, $sqla);
}

if($dayOfWeek === 'Monday'){
 $sqla = "UPDATE working SET status= '1' WHERE day = 'Sunday' OR day = 'Saturday'";
mysqli_query($link, $sqla);
}
if($dayOfWeek === 'Tuesday'){
 $sqla = "UPDATE working SET status= '1' WHERE day = 'Sunday' OR day = 'Saturday' OR day = 'Monday'";
mysqli_query($link, $sqla);
}
if($dayOfWeek === 'Wednesday'){
 $sqla = "UPDATE working SET status= '1' WHERE day = 'Sunday' OR day = 'Saturday' OR day = 'Monday' OR day = 'Tuesday'";
mysqli_query($link, $sqla);
}
if($dayOfWeek === 'Thursday'){
 $sqla = "UPDATE working SET status= '1' WHERE day = 'Sunday' OR day = 'Saturday' OR day = 'Monday' OR day = 'Tuesday' OR day = 'Wednesday'";
mysqli_query($link, $sqla);
}

if($dayOfWeek === 'Friday'){
 $sqla = "UPDATE working SET status= '1' WHERE day = 'Sunday' OR day = 'Saturday' OR day = 'Monday' OR day = 'Tuesday' OR day = 'Wednesday' OR day = 'Thursday'";
mysqli_query($link, $sqla);
}
