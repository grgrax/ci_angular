<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


function show_pre($arry = Null)
{
	if ($arry) {
		echo "<pre>";
		print_r($arry);
		echo "</pre>";
	}
}

$config['project']='CI-Angular';

/* End of file cms_config.php */
/* Location: ./application/config/cms_config.php */