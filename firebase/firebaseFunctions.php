<?php
include "FirebaseToken.php";
include "firebaseLib.php";

/**
 * Firebase PHP Client Functions
 *
 * @author Eldhose M Joy <eldhosemjoy@gmail.com>
 * @url    https://github.com/eldhosemjoy/firebase
 * @link   http://www.eldhosemjoy.in
 * I would like to thank Tamas Kalman <ktamas77@gmail.com> on whose Library I have extended up my project.
 */

class FirebaseFunctions{
	private $firebase;
	private $url;
	private $token;
	public $path;
	
	//Constructor initializing the connections to firebase
	function __construct($url, $token)
	{
		$this->url = $url;
		$this->token = $token;
		$this->firebase = new \Firebase\FirebaseLib($url,$token);
		
	}
	
	public function addData($json)
	{
		$this->firebase->set($this->path, $json);
	}
	
	public function getData()
	{
		$json = $this->firebase->get($this->path);
		return $json;
	}
	
	public function updateData($json)
	{
		$this->firebase->update($this->path, $json);
	}
	
	public function deleteData()
	{
		$this->firebase->delete($this->path);
	}
	
	//JSON Related Functions
	
	//Generating JSON for test Purpose
	public function generateJSON($n)
	{
		//n denotes the number of json nodes to be created
		$json = array();
		for($i=0; $i<=$n; $i++)
		{
			$j=$i+1;
			//Create A JSON
			$json_single = array(
							"course_id" => $j,
							"course_name" => "Course - $j",
							"desc" => "Course Description $j",
							"user" => "User$j"
						 );
			$json[$i] = $json_single;
			//print_r($json_single);
		}
		return $json;
	}
	
	//Parsing JSON and returns the result in a tabular format
	public function parseJSON($json)
	{
		$json_p = json_decode($json, true);
		$table ="<table> 
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Description</th>
						<th>User</th>
					</tr>";
		foreach ($json_p as $json_list => $json_each) 
		{
			if($json_each!=null)
			{
				$table =$table."<tr>
									<td>".$json_each['course_id']."</td>
									<td>".$json_each['course_name']."</td>
									<td>".$json_each['desc']."</td>
									<td>".$json_each['user']."</td>
								</tr>";
			}
		}
		$table =$table."</table>";
		return $table;
	}
	
}
?>