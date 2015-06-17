<?php 

class LiteCMSImage extends Image
{
	static $default_sort = 'Sort ASC';

	static $db = array(
		'Sort' => 'Int'
	);


	static $has_one = array(
		'Page' => 'Page'
	);

}
