<?php  
	
	function debugToConsole($data) 
	{
	    $output = $data;
	    if ( is_array($output) )
	        $output = implode( ',', $output);

	    echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
	}

	function getBdd()
	{
		$bdd = new PDO('mysql:host=localhost;dbname=messenger_database;'
			. 'charset=utf8', 'root', 'root');
		return $bdd;
	}
