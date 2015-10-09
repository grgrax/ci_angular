<?php


if (!function_exists('character_limiter')) {
	function my_word_limiter($str, $n = 5, $end_char = '&#8230;')
	{
		return word_limiter(convert_accented_characters($str), $n);
	}
}


if(!function_exists('get_slug')){
	function get_slug($str,$slug='-',$force_lower=TRUE){
		return url_title($str, $slug, $force_lower);
	}
}



//TODO create testimonial helper using hmvc

?>