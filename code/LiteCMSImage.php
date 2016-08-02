<?php 

class LiteCMSImage extends DataExtension
{
    public static $default_sort = 'Sort ASC';

    public static $db = array(
        'Sort' => 'Int'
    );


    public static $has_one = array(
        'Page' => 'Page'
    );
}
