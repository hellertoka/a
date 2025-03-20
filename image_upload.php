<?php
include('include/functions.php');

define('IMAGE_MEDIUM_DIR', 'uploads/media/');
define('IMAGE_MEDIUM_SIZE', 700);
/*defined settings - start*/
ini_set("memory_limit", "120M");
ini_set('post_max_size', '20M');
ini_set('max_execution_time', 600);

function upload($file){
	global $localhost;

if(isset($file)){
	$output['status']=FALSE;
	set_time_limit(0);
	$allowedImageType = array("image/gif",   "image/jpeg",   "image/pjpeg",   "image/png",   "image/x-png"  );
	
	if ($file["error"] > 0) {
		$output['error']= "Error in File";

	}
	else if (!in_array($file["type"], $allowedImageType)) {
		$output['error']= "You can only upload JPG, PNG and GIF file";
	}
	else if (round($file["size"] / 1024) > 5096) {
		$output['error']= "You can upload file size up to 5 MB";
	} else {
		
		/*create directory with 777 permission if not exist - start*/
		createDir(IMAGE_MEDIUM_DIR);
		/*create directory with 777 permission if not exist - end*/
		$path[0] = $file['tmp_name'];
		$file = pathinfo($file['name']);
		$fileType = $file["extension"];
		$desiredExt='png';
		$fileNameNew = mt_rand(333, 999) . time() . ".$desiredExt";
		$path[2] = IMAGE_MEDIUM_DIR . $fileNameNew;
		$desiredExt='png';
		$fileNameNew = mt_rand(333, 999) . time() . ".$desiredExt";
		

			if (createbig($path[0], $path[2],"$desiredExt", IMAGE_MEDIUM_SIZE, IMAGE_MEDIUM_SIZE,IMAGE_MEDIUM_SIZE)) {
				$output['status'] = TRUE;
				$output['image'] = $path[2];
				return $output;
		}else{
			$output['error'] = "Unable to finalize file upload. Please try again or contact suppor if error persists.";
		}

	}

	return $output;

}
}
?>	