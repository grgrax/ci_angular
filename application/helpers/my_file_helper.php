<?php

function file_helper_init(){
	$config['upload_path']="uploads/files/";
	$config['upload_pic_path']=$config['upload_path']."pics/";
	$config['upload_vdo_path']=$config['upload_path']."vdos/";
}

function get_upload_file_path(){
	return $path=base_url()."uploads/files/";
}

function get_upload_pic_path(){
	return $path=get_upload_file_path()."pics/";
}

function get_upload_video_path(){
	return $path=get_upload_file_path()."videos/";
}

function get_relative_upload_file_path(){
	return "./uploads/files/pics/";
}

function get_relative_upload_video_path(){
	return "./uploads/files/videos/";
}

function upload_picture($path=null,$file_input_name=null){
	$ci=& get_instance();
	if($path && $file_input_name){
		$config['upload_path'] = $path;
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '1000';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
		$ci->load->library('upload', $config);
		if (!$ci->upload->do_upload($file_input_name))
		{
			$data['error']=$ci->upload->display_errors();
			throw new Exception("Could not upload picture <hr/>".$data['error']);
		}
		else{
			$data['success'] = array('upload_data' => $ci->upload->data());
		}			
	}
}
// new
function upload_image($param_config=null){
	$ci=& get_instance();
	// show_pre($param_config);
	// if(is_array($param_config) && array_key_exists('file_input_name', $param_config) && $param_config['file_input_name']){
	$upload_path=get_relative_upload_file_path();
	if(isset($param_config['upload_path']) && $param_config['upload_path']){
		$upload_path.=$param_config['upload_path'];
	}
	$config['upload_path'] = $upload_path;
	$config['allowed_types'] = isset($param_config['allowed_types'])?$param_config['allowed_types']:'gif|jpg|png';
	$config['max_size'] = isset($param_config['max_size'])?$param_config['max_size']:'1000';
	$config['max_width'] = isset($param_config['max_width'])?$param_config['max_width']:'1024';
	$config['max_height'] = isset($param_config['max_height'])?$param_config['max_height']:'768';
	$ci->load->library('upload', $config);
	// show_pre($config);
		// die;
	if (!$ci->upload->do_upload($param_config['file_input_name']))
	{
		$data['error']=$ci->upload->display_errors();
	}
	else{
		$data['success'] = array('upload_data' => $ci->upload->data());
	}
		// show_pre($data);
	return $data;		
}


function upload_multiple_picture($path=null,$file_input_name=null){
	$ci=& get_instance();
	if($path && $file_input_name){
		$config['upload_path'] = $path;
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '1000';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
		$ci->load->library('upload', $config);

		$to_be_uploaded=0;
		foreach ($_FILES['photos']['name'] as $photo) {
			if($photo){
				$pics['photos'][]=$photo;
				$to_be_uploaded++;
			}
		}
		show_pre($pics);
		$uploaded=0;
		foreach ($pics['photos'] as $key=>$pic) {
			echo $pic;
			echo "<hr/>";
			if (!$ci->upload->do_upload('photos[]'))
			{
				$data['error'][]=$ci->upload->display_errors();
			}
			else{
				$data['success'] = array('upload_data' => $ci->upload->data());
				$uploaded++;
			}	
		}
		show_pre($data);
		exit;
		if($to_be_uploaded!=$uploaded){
			$data['errors']=$data['error'];		
		}
	}
}

function upload_video($path=null,$file_input_name=null){
	$ci=& get_instance();
	if($path && $file_input_name){
		$config['upload_path'] = $path;
		$config['allowed_types'] = 'mp3|mp4|3gp|flv';
		$config['max_size']	= '25000';
		/*$config['max_width']  = '1024';
		$config['max_height']  = '768';
		*/
		$ci->load->library('upload', $config);
		if ( ! $ci->upload->do_upload($file_input_name))
		{
			$data['error']=$ci->upload->display_errors();
			throw new Exception("Could not upload video <hr/>".$data['error']);
		}
		else{
			$data['success'] = array('upload_data' => $ci->upload->data());
		}			
	}
}

function is_picture_exists($pic){
	if($pic){
		$path=get_upload_pic_path();
		$file=$path.$pic;
		return $file;
		// die;
		echo $file;
		if(file_exists($file)){			
			echo "found";
		}else{
			echo "not found";
		}
		die;
		return false;
	}
}

function is_video_exists($pic){
	if($pic){
		$path=get_upload_video_path();
		$file=$path.$pic;
		return $file;
		if(file_exists($file)){
			return $file;
		}
		else
			echo "nf";
		// return false;
	}
}

function is_article_picture_exists($pic){
	if($pic){
		$path=get_upload_pic_path().'/articles/';
		$file=$path.$pic;
		return $file;
		if(file_exists($file)){
			return $file;
		}
		return false;
	}
}

//api version
function is_picture_exists_api($pic){
	if($pic){
		return $pic;
		if(file_exists($pic)){
			return $pic;
		}
		return false;
	}
}
//api version
function upload_file($path=null,$file_input_name=null){
	$ci=& get_instance();
	if($path && $file_input_name){
		$config['upload_path'] = $path;
		$config['allowed_types'] = 'pdf|doc|txt';
		$config['max_size']	= '1000';
		// $config['max_width']  = '1024';
		// $config['max_height']  = '768';
		$ci->load->library('upload', $config);
		if (!$ci->upload->do_upload($file_input_name))
		{
			$data['error']=$ci->upload->display_errors();
			throw new Exception("Could not upload file <hr/>".$data['error']);
		}
		else{
			$data['success'] = array('upload_data' => $ci->upload->data());
		}			
	}
}

//image labels
function img_label(){
	?>
	<br>
	<ul>
		<li><b>Type: </b> gif | jpg | png </li>
		<li><b>Size: </b> < 1mb </li>
		<li><b>Dimension: </b> 1024 X 768 </li>
	</ul>
	<?php
}


function get_folder_files($config=null){
	try {
		$response['success']=false;
		
		if(!$config or !is_array($config))
			throw new Exception("Error Processing Request", 1);
		if(!isset($config['path']))
			throw new Exception("No config: path", 1);
		if(!isset($config['file_types']))
			throw new Exception("No config: file_types", 1);
		
		$path=$config['path'];
		$file_types=$config['file_types'];

		$dir = FCPATH.$path;
		$files=array();
		if (is_dir($dir)){
			if ($dh = opendir($dir)){
				while (($file = readdir($dh)) !== false){
					if($file!='.' && $file!='..' && !is_dir($file)){
						$ext = pathinfo($path.'/'.$file, PATHINFO_EXTENSION);
						//get as per file_type
						if(in_array($ext,$file_types)){
							$files[filemtime($path.'/'.$file)] = $file;							
						}
					}
				}
			}
			closedir($dh);
		}
		else{
			throw new Exception("$path ( folder ) does not exits", 1);
		}
		rsort($files);
		if(count($files)==0)
			throw new Exception("No files on ( folder ) $path", 1);			
		// show_pre($files);
		// die;
		$response['success']=true;
		$response['data']=$files;		
	} catch (Exception $e) {
		$response['data']=$e->getMessage();		
	}
	return $response;
}
?>