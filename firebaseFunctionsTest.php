<?php
include "firebase/firebaseFunctions.php";
/*Firebase Credentials
Base URL is the project URL eg: https://my-custom-project.firebaseio.com/
Token can be found in the databse tab under project settings i.e. Project Settings->Database eg:XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
A sample url pattern to the link to Project settings -> databse is given below:
https://console.firebase.google.com/project/my-custom-project/settings/database
*/

$url =  'https://my-custom-project.firebaseio.com/';
$token = 'XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX';

//Initializing the object
$fboject = new FirebaseFunctions($url, $token);

//Path Set for Adding - This should be changed for different operations
$fboject->path = "/courses";

//Generating JSON to add to firebase
$json = $fboject->generateJSON(10);

//Add JSON to firebase
$fboject->addData($json);

//Retrieve the added data from firebase
$added_data = $fboject->getData();

//Populate the JSON in tabular format
$table = $fboject->parseJSON($added_data);
echo $table;

/* Update course number 2 at position 1 since array indexing is from 0-9 for 10 listings
1. Create an updated JSON.
2. Set the course path to the "/courses/1" that corresponds to the second course in firebase. */
$updated_json = array(
					"course_id" => 2,
					"course_name" => "Updated Course - 2",
					"desc" => "Updated Course Description 2",
					"user" => "User2"
				 );
$fboject->path = "/courses/1";
$fboject->updateData($updated_json);

/* Delete course number 10 at position 9 since array indexing is from 0-9 for 10 listings, set the course path to the "/courses/9" that corresponds to the last course in firebase. */
$fboject->path = "/courses/9";
$fboject->deleteData();

/* Retrieve and Populate the JSON in tabular format with updated values
Change the path to the root from 9th position which we have used to delete */
$fboject->path = "/courses";
$added_data = $fboject->getData();
$table = $fboject->parseJSON($added_data);
echo $table;
?>