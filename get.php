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
	/*
     $DetailsPageURL = $item['DetailsPageURL'];
	 $TODAYUNAVAILPERCENT = $item['TODAYUNAVAILPERCENT'];
 	 */
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
		/*
		echo $AvailabilityRCAURL;"<br>";
	    echo "<br>";
		
		echo $Action;"<br>";
	    echo "<br>";
		
		echo $NAME;"<br>";
	    echo "<br>";
		
		echo $TODAYAVAILPERCENT;"<br>";
	    echo "<br>";
		
		echo $TODAYSCHEDDOWNPERCENT;"<br>";
	    echo "<br>";
		
		
		echo $Type;"<br>";
	    echo "<br>";

		echo $HEALTHSEVERITY;"<br>";
	    echo "<br>";
		
		echo $AVAILABILITYSEVERITY;"<br>";
	    echo "<br>";
		
		echo $AVAILABILITYMESSAGE;"<br>";
	    echo "<br>";
		
		echo $RESOURCEID;"<br>";
	    echo "<br>";
		
		echo $HealthRCAURL;"<br>";
	    echo "<br>";
		
		echo $TODAYUNMANGDPERCENT;"<br>";
	    echo "<br>";
		
		echo $HEALTHMESSAGE;"<br>";
	    echo "<br>";
		
		echo $MODTIME;"<br>";
	    echo "<br>";
		
		echo $DISPLAYNAME;"<br>";
	    echo "<br>";
		
		echo $HEALTHSTATUS;"<br>";
	    echo "<br>";
		
		echo $AVAILABILITYSTATUS;"<br>";
	    echo "<br>";

	
	*/

$db = new PDO(DB_DRIVER . ":dbname=" . DB_DATABASE . ";host=" . DB_SERVER, DB_USER, DB_PASSWORD);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	
$stmt = $db->prepare("INSERT INTO numero (numero,creado) 
VALUES (:numero, :creado)");


$stmt->bindParam(':numero', $number);

$stmt->bindParam(':creado', $sys_created_on);



$stmt->execute();


/*
$stmt->bindParam(':AvailabilityRCAURL', $AvailabilityRCAURL);
$stmt->bindParam(':Action', $Action);
$stmt->bindParam(':NAME', $NAME);
$stmt->bindParam(':TODAYAVAILPERCENT', $TODAYAVAILPERCENT);
$stmt->bindParam(':TODAYSCHEDDOWNPERCENT', $TODAYSCHEDDOWNPERCENT);
$stmt->bindParam(':Type', $Type);
$stmt->bindParam(':HEALTHSEVERITY', $HEALTHSEVERITY);
$stmt->bindParam(':AVAILABILITYSEVERITY', $AVAILABILITYSEVERITY);
$stmt->bindParam(':AVAILABILITYMESSAGE', $AVAILABILITYMESSAGE);
$stmt->bindParam(':RESOURCEID', $RESOURCEID);
$stmt->bindParam(':HealthRCAURL', $HealthRCAURL);
$stmt->bindParam(':TODAYUNMANGDPERCENT', $TODAYUNMANGDPERCENT);
$stmt->bindParam(':HEALTHMESSAGE', $HEALTHMESSAGE);
$stmt->bindParam(':MODTIME', $MODTIME);
$stmt->bindParam(':DISPLAYNAME', $DISPLAYNAME);
$stmt->bindParam(':HEALTHSTATUS', $HEALTHSTATUS);
$stmt->bindParam(':AVAILABILITYSTATUS', $AVAILABILITYSTATUS);

*/





	
}

/*
	
  print_r($data["response"]["result"][0]["DISPLAYNAME"]);        // Dump all data of the Array
  echo 'perritos', $data[0]["DISPLAYNAME"]; // Access Array data

 */
    
    //get the employee details
   //   $id = $data['empid'];
 //   $name = $data['result']['DISPLAYNAME'];
  /*  $gender = $data['personal']['gender'];
    $age = $data['personal']['age'];
    $streetaddress = $data['personal']['address']['streetaddress'];
    $city = $data['personal']['address']['city'];
    $state = $data['personal']['address']['state'];
    $postalcode = $data['personal']['address']['postalcode'];
    $designation = $data['profile']['designation'];
    $department = $data['profile']['department'];*/
    
	
	/*
	
    //insert into mysql table
    $sql = "INSERT INTO tbl_emp(empid, empname, gender, age, streetaddress, city, state, postalcode, designation, department)
    VALUES('$id', '$name', '$gender', '$age', '$streetaddress', '$city', '$state', '$postalcode', '$designation', '$department')";
    if(!mysql_query($sql,$con))
    {
        die('Error : ' . mysql_error());
    }
	
	*/
?>
