<?php
	$conn = mysqli_connect("localhost", "root", "", "test") or die("connection to database is failed");

	$student_id 		=	$_POST['edit_id_KEY'];
	$student_first_name = 	$_POST['edit_first_name_KEY'];
	$student_last_name 	= 	$_POST['edit_last_name_KEY'];

	$sql = "UPDATE students SET full_name = '{$student_first_name}', last_name = '{$student_last_name}' WHERE id = '{$student_id}'";

	if (mysqli_query($conn, $sql)) {
		echo 1;
	}else{
		echo 0;
	}
 ?>