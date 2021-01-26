<?php
	/*
		Name: get-jokes.php
		Description: Returns an array of random jokes in JSON format
		Author: 
		Last Modified: 
		Example usage: get-jokes.php?limit=3
	*/
	
	// I. define some constants
	define('MIN_LIMIT', 1); 
	define('MAX_LIMIT', 10); 
	
	
	// II. $jokes contains our data
	// this is an indexed array of associative arrays
	// the associative arrays are jokes -  they have an 'q' key and an 'a' key
	$jokes = [
		["q"=>"What do you call a very small valentine?","a"=>"A valen-tiny! LAUGH NOW."],
		["q"=>"What did the dog say when he rubbed his tail on the sandpaper?","a"=>"Ruff, Ruff! LAUGH NOW."],
		["q"=>"Why don't sharks like to eat clowns?","a"=>"Because they taste funny! LAUGH NOW."],
		["q"=>"What did the boy cat say to the girl cat?","a"=>"You're Purr-fect! LAUGH NOW."],
		["q"=>"What is a frog's favorite outdoor sport?","a"=>"Fly Fishing! LAUGH NOW."],
		["q"=>"I hate jokes about German sausages.","a"=>"Theyre the wurst. LAUGH NOW."],
		["q"=>"Did you hear about the cheese factory that exploded in France?","a"=>"There was nothing left but de Brie. LAUGH NOW."],
		["q"=>"Our wedding was so beautiful ","a"=>"Even the cake was in tiers. LAUGH NOW."],
		["q"=>"Is this pool safe for diving?","a"=>"It deep ends. LAUGH NOW."],
		["q"=>"Dad, can you put my shoes on?","a"=>"I dont think theyll fit me. LAUGH NOW."],
		["q"=>"Can February March?","a"=>"No, but April May. LAUGH NOW."],
		["q"=>"What lies at the bottom of the ocean and twitches?","a"=>"A nervous wreck. LAUGH NOW."],
		["q"=>"Im reading a book on the history of glue.","a"=>"I just cant seem to put it down. LAUGH NOW."],
		["q"=>"Dad, can you put the cat out?","a"=>"I didnt know it was on fire. LAUGH NOW."],
		["q"=>"What did the ocean say to the sailboat?","a"=>"Nothing, it just waved. LAUGH NOW."],
		["q"=>"What do you get when you cross a snowman with a vampire?","a"=>"Frostbite. LAUGH NOW."]
	];
	
	
	// III. Sanitize the `limit` parameter to be sure that it is numeric, and is not too small or large
	$limit = MIN_LIMIT; // the default
	if(array_key_exists('limit', $_GET)){ // if there is a `limit` parameter in the query string
		$limit = $_GET['limit'];
		$limit = (int)$limit; // explicitly cast value to an integer
		$limit =  ($limit < 1) ? MIN_LIMIT : $limit; // PHP has a ternary operator too
		$limit =  ($limit > MAX_LIMIT) ? MAX_LIMIT : $limit; // PHP has a ternary operator too
	}
	
	
	// IV. Do a final check that there are enough jokes in the $jokes array
	if($limit > count($jokes)){
		$limit = count($jokes);
	}
	
	
	// V. get a random element of the $jokes array
	// there are a bunch more PHP array functions at: http://php.net/manual/en/ref.array.php
	// https://www.php.net/manual/en/function.shuffle.php
	// https://www.php.net/manual/en/function.array-push.php
	$randomKeys = array_keys($jokes); // creates an array of indexes - something like [0,1,2,3,4,5,6,7,...]
	shuffle($randomKeys); // randomizes the $randomKeys array - something like [1,5,3,2,0,8,4,7,6, ...]
	$randomKeys = array_slice($randomKeys, 0, $limit); // just get the first `n` number of indexes we need
	$randomJokes = []; // the random jokes will go here
	foreach($randomKeys as $key){ // loop through $randomKeys
 		array_push($randomJokes,$jokes[$key]); // add a random joke to the array
 	}
	
	
	// VI. Send HTTP headers
	// https://www.php.net/manual/en/function.header.php
	// DO THIS **BEFORE** you `echo()` the content!
	header('content-type:application/json');      			// tell the requestor that this is JSON
	header('Access-Control-Allow-Origin: *');     			// turn on CORS
	//header('X-this-430-service-is-kinda-lame: true');   // a custom header 
	header('X-author-name: Jae');
	
	
	// VII. Send the content
	// json_encode() turns a PHP associative array into a string of well-formed JSON
	// https://www.php.net/manual/en/function.json-encode.php
	$string = json_encode($randomJokes);
	echo $string;

?>
