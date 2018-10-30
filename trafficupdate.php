
<!DOCTYPE html>
<html>
<head>
	<title></title>
 <link rel="stylesheet"
  href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<fieldset>
   <legend> <h1 class="jumbotron">TRAFFIC UPDATE</h1></legend>
   <form action="" method="post">
   	 <input type="text" name="roadname" placeholder ="enter road name ">
   	  <br> <br> 

     <input type="text" name="trafficinfo" placeholder ="enter traffic info ">
   	  <br> <br>
   	   <input type="submit" value="SAve" class="btn btn-info">
   	  </fieldset>
</body>  
</html>


<?php 
 $conn= mysqli_connect("localhost","root","","clinic_db");
   $response1 = mysqli_query($conn,"SELECT * FROM table_traffic
     	ORDER BY date DESC");

     while($row = mysqli_fetch_array($response1)){
     	echo "<i class='text-info'>$row[0]</i>";
     	echo "<p class='alert alert-warning'>$row[1]</p>";
     	echo "<b class='badge badge-secondary'>$row[2]</b>";     	
        echo "<hr>";
     }


if (empty($_POST)) {
	exit();
}

$object= new Traffic($_POST ['roadname'],
                      $_POST ['trafficinfo']);        

$object ->save();


class Traffic{
   function __construct($roadname,$trafficinfo){
    $this->roadname =$roadname;
    $this->trafficinfo = $trafficinfo;
}
function save(){
    $conn= mysqli_connect("localhost","root","","clinic_db");

    //save to table
    $response = mysqli_query($conn,"INSERT INTO `table_traffic`
    	(`roadname`, `trafficinfo`) VALUES ('$this->roadname', '$this->trafficinfo')");

     if ($response==true) {
     echo "Succesfully saved record";
     header("location:trafficupdate.php");
      }


     else{
      echo "record failed.check your Details";
     }//end else


 }//end function
}//end class            

 ?>