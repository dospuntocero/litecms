<?php

//for use as extension on config.yml
//your class:
//  extensions:
//    URLSegmentDecorator

class URLSegmentDecorator extends DataExtension
{

    public static $db = array(
        'URLSegment' => 'Varchar(255)'
    );

    public function onBeforeWrite()
    {
        $this->owner->URLSegment = singleton('SiteTree')->generateURLSegment($this->owner->Title);
    }

    public function updateCMSFields(FieldList $fields)
    {
        $fields->removeByName('URLSegment');
    }
}
