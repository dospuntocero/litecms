<?php

//for use as extension on config.yml
//your class:
//  extensions:
//    URLSegmentDecorator

class URLSegmentDecorator extends DataExtension {

	static $db = array(
		'URLSegment' => 'Varchar(255)'
	);

	function onBeforeWrite() {
		$this->owner->URLSegment = singleton('SiteTree')->generateURLSegment($this->owner->Title);
	}

	public function updateCMSFields(FieldList $fields) {
		$fields->removeByName('URLSegment');
	}

}
