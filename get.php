<?php

define('DB_SERVER', "172.28.82.47");
define('DB_USER', "root");
define('DB_PASSWORD', "Mn$0c.l.");
define('DB_DATABASE', "snow");
define('DB_DRIVER', "mysql");

//connect to mysql db
$server = "172.28.82.47";
$username = "root";
$password = "Mn$0c.l.";
$database = "snow";
mysql_connect($server,$username,$password) or die("Failed");
mysql_select_db($database) or die("Database Failed");
$conecta = mysql_connect($server,$username,$password) or die("Failed");
// borro tabla		
   mysql_query("TRUNCATE TABLE numero") or die (mysql_error());



    //read the json file contents


// nueva funcion

$url = 'https://kionetworksdev.service-now.com/api/now/v2/table/incident?sysparm_fields=number%2Csys_created_on&sysparm_limit=1000';
$cURL = curl_init();
curl_setopt($cURL, CURLOPT_URL, $url);
curl_setopt($cURL, CURLOPT_HTTPGET, true);

curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);


curl_setopt($cURL, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Accept: application/json',
    'Authorization: Basic YWRtaW5zbm93QG1hc25lZ29jaW8uY29tOnMwcDBydDMxMjM=',


));

$result = curl_exec($cURL);

curl_close($cURL);

//print_r($result);

 //var_dump(json_decode($result, true));
 // echo json_decode($result, true);



// fin nueva funcion

/*
	
$url = 'https://kionetworksdev.service-now.com/api/now/v2/table/incident?sysparm_fields=number%2Csys_created_on&sysparm_limit=10000';
$jsondata = file_get_contents($url);

*/

    //convert json objet to php associative array
   $data = json_decode($result, true);
	
//	$elementCount  = count($data["response"]["result"]);
	$elementCount  = count($data["result"]);
	echo 'longitud del json:  ', $elementCount, ' - '; // Access Array data
	echo "<br>";
	echo "<br>";
	echo "<br>";
	$i = 0;
	foreach($data["result"] as $item){
//  Declara variables para cada elemento

	 $number = $item['number'];
	 $sys_created_on = $item['sys_created_on'];  


	$i++; 
	echo "<br>";
	echo "<br>";
	echo  $i;"<br>";
	echo "<br>";
	echo "<br>";
	
		echo $number;"<br>";
	    echo "<br>";
		
		echo $sys_created_on;"<br>";
	    echo "<br>";


$db = new PDO(DB_DRIVER . ":dbname=" . DB_DATABASE . ";host=" . DB_SERVER, DB_USER, DB_PASSWORD);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	
$stmt = $db->prepare("INSERT INTO numero (numero,creado) 
VALUES (:numero, :creado)");


$stmt->bindParam(':numero', $number);

$stmt->bindParam(':creado', $sys_created_on);



$stmt->execute();



	
}


?>
