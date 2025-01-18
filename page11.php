<?php 
	if (!empty($_GET['submit'])) {
	
		if( isset($_GET['firstname'])) $firstname=trim($_GET['firstname']); 
		if( isset($_GET['lastname'])) $lastname=trim($_GET['lastname']); 
		if( isset($_GET['gender'])) $gender=$_GET['gender']; 
		if( isset($_GET['course'])) $course=$_GET['course']; 

		if (!empty($firstname) && !empty($lastname) && 
			!empty($gender) && !empty($course)) {
			//first save the information to the file and then 
			//redirect to the page you want to display
			header('Location: enrolled11.php');
			exit;
		}
	}

	echo "<html><head></head><body>";
	echo "<h1>Form input examples:</h1>";

	$incomplete = !empty($firstname) || !empty($lastname) || 
		!empty($gender) || !empty($course);

	echo $incomplete ? "<p>Please fill in the missing information below</p>" 
			: "<p>Please fill in the form below</p>";
	
	echo "<form action=\"page11.php\">";

	echo "<table>";
	echo "<tr><td>First name:</td>";
	echo "<td><input type=\"text\" size=\"20\" name=\"firstname\" ";
	if ($incomplete)
		empty($firstname) ? print("style=\"background-color:Yellow;\"") 
						: print("value=\"".htmlspecialchars($firstname)."\"");
	echo"></td></tr>";
	
	
	echo "<tr><td>Last name:</td>";
	echo "<td><input type=\"text\" size=\"20\" name=\"lastname\" ";
	if ($incomplete)
		empty($lastname) ? print("style=\"background-color:Yellow;\"") 
						: print("value=\"".htmlspecialchars($lastname)."\"");
	echo"></td></tr>";
	echo"<tr valign=\"top\"><td>Gender:</td><td ";
	if ($incomplete && empty($gender)) print("style=\"background-color:Yellow;\"");
	echo ">";
	
	echo "<input type=\"radio\" name=\"gender\" value=\"male\" ";
	if (!empty($gender) && $gender=="male" ) echo "checked"; 
	echo ">Male<br>";
	echo "<input type=\"radio\" name=\"gender\" value=\"female\" ";
	if (!empty($gender) && $gender=="female" ) echo "checked"; 
	echo ">Female<br>";
	echo "<input type=\"radio\" name=\"gender\" value=\"other\" ";
	if (!empty($gender) && $gender=="other" ) echo "checked"; 
	echo ">Other";
	echo"</td></tr>";

	echo "<tr><td>Course:</td>";
	echo "<td><select name=\"course\"";
	if ($incomplete && empty($course)) print(" style=\"background-color:Yellow;\"");
	echo ">\n";
	
	echo "<option value=\"\" ";
	if (!empty($course) && $course=="" ) echo "selected"; 
	echo ">Select a course</option>\n";

	echo "<option value=\"iat100\" ";
	if (!empty($course) && $course=="iat100" ) echo "selected"; 
	echo ">IAT100 - Digital Image Design</option>\n";
	
    echo "<option value=\"iat102\" ";
	if (!empty($course) && $course=="iat102" ) echo "selected"; 
	echo ">IAT102 - Graphic design</option>\n";
	
	echo "<option value=\"iat103\" ";
	if (!empty($course) && $course=="iat103" ) echo "selected"; 
	echo ">IAT103 - Design Communication and Collaboration</option>\n";
	
	echo "</select>\n";
	echo "<tr><td><input type=\"submit\" name=\"submit\" border=0 value=\"Submit\"></td></td>";
	echo "</form>";
	echo "</body>";
	echo "</html>";
?>
