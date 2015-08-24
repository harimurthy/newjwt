<?php 
// this webservire is written for getting data from moodle user table and send it in to json format
// url is http://localhost:8080/jwt/wservice.php?user=vrish&num=10&format=json
//where http://localhost:8080/jwt/ is root

//if(isset($_GET['user']) && intval($_GET['user'])) {
//echo $_GET['user'];
	/* soak in the passed variable or set our own */
	$number_of_posts = isset($_GET['num']) ? intval($_GET['num']) : 10; //10 is the default
	$format = strtolower($_GET['format']) == 'json' ? 'json' : 'xml'; //xml is the default
	$user_id = intval($_GET['user']); //no default

	/* connect to the db */
	//$link = mysql_connect('localhost','root','root'); //or die('Cannot connect to the DB');
	//mysql_select_db('moodle',$link); //or die('Cannot select the DB');
       
        $con = mysqli_connect("localhost","root","root","moodle");

        // Check connection
       if (mysqli_connect_errno())
       { echo "Failed to connect to MySQL: " . mysqli_connect_error();   }

	/* grab the posts from the db */
	$query = "SELECT username FROM mdl_user";
	$result = mysqli_query($con, $query);

	/* create one master array of the records */
	$posts = array();
	if(mysqli_num_rows($result)) {
		while($post = mysqli_fetch_assoc($result)) {
			$posts[] = array('post'=>$post);
		}
	}

	/* output in necessary format */
	if($format == 'json') {
		header('Content-type: application/json');
		echo $json=json_encode(array('posts'=>$posts));

	}
//}




?> 
