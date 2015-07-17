<?php
class LiteCMSPage extends SiteTree {
	
	static $hide_ancestor = 'LiteCMSPage'; //dont show ancestry class

	private static $many_many = array(
		'Images' => 'Image',
		'Attachments' => 'File',
	);



	private static $many_many_extraFields = array(
		'Images' => array('SortOrder' => 'Int'),
		'Attachments' => array('SortOrder' => 'Int')
	);

	
	public function getCMSFields() {
		$fields = parent::getCMSFields();
		
		//we use ToggleCompositeFields instead of tabs. it looks cleaner and 'lite'

		$fields->addFieldToTab("Root.Main",
		   ToggleCompositeField::create('Options', _t('Page.OPTIONS', 'Options'),
		array(
			CheckboxField::create('ShowInMenus', _t('Page.SHOWREGULARMENU', 'Show in regular Menu')),
			$tabBehaviour = new Tab('Settings',
			new DropdownField(
				"ClassName",
				$this->fieldLabel('ClassName'),
				$this->getClassDropdown()
			),
			$parentTypeSelector = new CompositeField(
				new OptionsetField("ParentType", _t("SiteTree.PAGELOCATION", "Page location"), array(
					"root" => _t("SiteTree.PARENTTYPE_ROOT", "Top-level page"),
					"subpage" => _t("SiteTree.PARENTTYPE_SUBPAGE", "Sub-page underneath a parent page"),
				)),
				$parentIDField = new TreeDropdownField("ParentID", $this->fieldLabel('ParentID'), 'SiteTree', 'ID', 'MenuTitle')
			)
			)
		)
		   )->setHeadingLevel(4),'Metadata');

		$fields->addFieldsToTab("Root.Main", array(
			$imageField = new SortableUploadField('Images', _t('LiteCMSPage.IMAGES',"Images")),
			$imageField = new SortableUploadField('Attachments', _t('LiteCMSPage.ATTACHMENTS',"Attachments"))
		),'Options');


		$fields->removeByName("ExtraMeta");
		return $fields;
	}

	function getImage(){
		$Image = $this->Images();
		if ($Image->First()) {
			return $Image->First();
		} else {
			return null;
		}
	}

	function getExtraImages(){
		$Image = $this->Images();
		$set = new ArrayList();
		$c=1;
		if($Image){
			foreach($Image as $item){
				if($c>1){
					$set->push($item);
				}
				$c++;
			}
			return $set;
		}
		return null;
	}


	public function PrevNextPage($Mode = 'next') {

		if($Mode == 'next') {
			$Direction = "Sort:GreaterThan";
			$Sort = "Sort ASC";
		}
		elseif($Mode == 'prev') {
			$Direction = "Sort:LessThan";
			$Sort = "Sort DESC";
		}
		else{
			return false;
		}

		$PrevNext = SiteTree::get()->filter(array('ParentID' => $this->ParentID,$Direction => $this->Sort))->sort($Sort)->First();

		if ($PrevNext) return $PrevNext;
	}

	public function SortedImages(){
		return $this->Images()->Sort('SortOrder');
	}
	public function SortedAttachments(){
		return $this->Images()->Sort('SortOrder');
	}



}
class LiteCMSPage_Controller extends ContentController {

	private static $allowed_actions = array ();
}
