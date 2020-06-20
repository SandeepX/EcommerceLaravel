<?php

	function uploadImage($file, $dir, $thumb=null){
	 	$upload_dir = public_path().'/uploads/'.$dir ;
        if(!File::exists($upload_dir)){
            File::makeDirectory($upload_dir,0777,true,true);
        }
        $file_name = ucfirst($dir)."-".date('Ymdhis').rand(0,999).".".$file->getClientOriginalExtension();
        $success = $file->move($upload_dir, $file_name);
        if($success){
           if($thumb){
           		list($width,$height) = explode('x',$thumb);
           		//150x150
           		Image::make($upload_dir."/". $file_name)-> resize($width, $height, function ($constraint) {
                	$constraint->aspectRatio();
            	})-> save($upload_dir.'/Thumb-'.$file_name);
            }
            return $file_name;
        }else{
        	return false;
            }

	}

	function deleteImage($file_name,$dir){
		$upload_dir =public_path().'/uploads/'.$dir;
    if($file_name!=null && file_exists($upload_dir.'/ '.$file_name)){
  		@unlink($upload_dir.'/'. $file_name);
  		@unlink($upload_dir.'/Thumb-'.$file_name);
    }  

	}











?>