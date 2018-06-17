<?php
class fileupload{

	function upload_image($path,$filename,$tmpname){

	
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($path,PATHINFO_EXTENSION));
		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
   			 $check = getimagesize($tmpname);
		    if($check !== false) {
		        echo "File is an image - " . $check["mime"] . ".";
		        $uploadOk = 1;
		    } else {
		        echo "File is not an image.";
		        $uploadOk = 0;
		    }
		}
		// Check if file already exists
		// if (file_exists($path)) {
		//     echo "Sorry, file already exists.";
		//     $uploadOk = 0;
		// }
		// Check file size
		if ($_FILES["profile_pic"]["size"] > 500000) {
		    echo "Sorry, your file is too large.";
		    $uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		    $uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
		    echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
		   move_uploaded_file($tmpname, $path);
		        
		}




	}


	function create_directory($directory_name){

		//check if directory name exists
		//if it doesnt make the directory
		if (!file_exists($directory_name)) {
    mkdir($directory_name, 0777, true);
}



	}







}



?>
