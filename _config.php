<?php 
define('LITECMS', basename(dirname(__FILE__)));
SSViewer::set_source_file_comments(false);

CMSMenu::remove_menu_item("CommentAdmin");
CMSMenu::remove_menu_item("ReportAdmin");
CMSMenu::remove_menu_item("SecurityAdmin");
CMSMenu::remove_menu_item("Help");

Object::add_extension('SiteConfig','LiteCMSBaseConfig');
Object::add_extension('LeftAndMain', 'LiteCMS');
Object::add_extension('SiteConfig','LiteCMSMaintenance');
Object::add_extension('Page','LiteCMSMaintenanceController_Decorator');

GD::set_default_quality(100);

LeftAndMain::setApplicationName("LiteCMS");

LeftAndMain::require_css('litecms/css/lite.css');

Image::add_extension('LiteCMSImage');
File::add_extension('LiteCMSAttachment');
