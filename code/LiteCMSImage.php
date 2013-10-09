<?php 

class LiteCMSImage extends DataExtension
{
    private static $belongs_many_many = array(
        'Pages' => 'Page'   
    );
}