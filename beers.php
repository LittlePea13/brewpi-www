<?php
//ini_set('display_errors', 1);
session_start();
if(isset($_SESSION["member_id"])) {
    if($_SESSION["member_id"]== 1){
    	echo "Hola Pere!";
    	$user = "pere";
    } else {
	    if($_SESSION["member_id"] == 2){
	    	$user = "adel";
	    	echo "Hola Adel!";
	    } else {
	    	$user = "public";
	    	echo "Hola Desconegut! Benvingut a Peace&Hops";
	    }
    }
} else {
	$user = "public";
}
$bottles = "drunk_bottles_" . $user;
//$user = if(isset($_COOKIE["member_login"])) { . echo $_COOKIE["member_login"] .;};

$config = parse_ini_file('private/config.ini');
$conn = mysqli_connect("localhost", $config['username'], $config['password'], $config['dbname']);
if (!$conn) {
    die('Could not connect: ' . mysql_error());
}
    $sql = "Select * from beers";
    $result = mysqli_query($conn,$sql);
    //$beers = mysqli_fetch_array($result);
 	$conn->close();

	if(isset($_POST['id']))
	{
	    $conn = mysqli_connect("localhost", $config['username'], $config['password'], $config['dbname']);
	    if ($conn->connect_error) {
	        die("Connection failed: " . $conn->connect_error);
	    }
	    $sql = "UPDATE beers SET drunk_bottles_". $user ." = drunk_bottles_". $user ." + 1 WHERE beer_id='" . $_POST["id"] . "'";
	    if ($conn->query($sql) === TRUE) {
	        echo "Record updated successfully";
	        $sql = "Select * from beers";
	        $result = mysqli_query($conn,$sql);
	    } else {
	        echo "Error updating record: " . $conn->error;
	    }
	    $conn->close();
	}   
	$_POST = array();
 ?>

 <title>Peace&Hops</title>
  <a href="protected.php">View Panel</a>
 <div class="cols">
<?php
	while ($row=mysqli_fetch_array($result)) {
?> 
		<a class="beer col-4 beer-circle-holder">
		<div class="beer-circle" style="background: #009844;"></div>
		<div class="beer-circle" style="background: #009844;"></div>
		<div class="beer-image-wrap">
		<img src="beer.png"></div>
		<div class="beer-details">
		<h4> <?php echo $row[1] ?> </h4>
		<p class="medium"> Litres <?php echo $row[2] ?> </p>
		<p class="small"> IBU  <?php echo $row[5] ?> </p>
		<p class="small"> Alcohol <?php echo $row[6] ?> % </p>
		<p class="small"> Ampolles <?php echo $row[7] ?> </p>
		<?php
		if($user != "public"){
		?>  
		<p class="small"> Ampolles disponibles <?php echo ($row[7]/2-$row["$bottles"]); ?> </p>
		<p class="small"> Ampolles begudes <?php echo $row[8] ?> </p>
		<form action="" method="post" style="height:50px;width:50px;">
    		<input class="add-button" type="submit" name="fields" value="Afegir una" />
			<input type="hidden" name="id" value="<?php echo $row[0] ?>" />
		</form>
		<?php
		}
		?>  
		</div>
		</a>
		<?php
	}
?>
<style>
<?php include 'beers.css'; ?>
</style>
<style>
.beer-details {
    max-width: 185px;
    float: left;
    margin-top: 40px;
    margin-left: 10px;
}
.cols {
    clear: both;
    margin: 0 auto;
    max-width: 990px;
    min-width: 320px;
    width: auto;
}
.beer-circle {
    width: 100%;
    height: 100%;
    position: absolute;
    left: 0;
    top: 0;
    border-radius: 100%;
    background: #9b8449;
    opacity: 1;
    -moz-transition: opacity 0.2s ease-in-out;
    -ms-transition: opacity 0.2s ease-in-out;
    -o-transition: opacity 0.2s ease-in-out;
    -webkit-transition: opacity 0.2s ease-in-out;
    transition: opacity 0.2s ease-in-out;
}
.beer-image-wrap {
    width: 75px;
    height: 100%;
    float: left;
}
.beer-image-wrap img {
    float: left;
    height: 255px;
    width: auto;
    max-width: 97px;
    margin-left: 0px;
}
.add-button{
	background-color: #808080;
    color: #fff;
    text-align: center;
    padding: 7px 20px;
    margin-bottom: 10px;
    text-transform: uppercase;
    float: none;
    font-family: "FunctionProExtraBold";
    font-size: 14px;
    display: inline-block;
}
.add-button:hover {
	transform: scale(1.1); 
}
p {
    margin: 0;
    padding: 0!important;
}
body {
	padding: 40px;
    height: 100%;
    height: auto;
    background-color: #eaeaea;
    z-index: -1!important;
    position: relative;
}
</style>