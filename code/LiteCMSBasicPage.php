<?php
class LiteCMSBasicPage extends SiteTree {
	
	static $hide_ancestor = 'LiteCMSBasicPage'; //dont show ancestry class
	
	
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
		
		
		$fields->removeByName("ExtraMeta");
		return $fields;
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
	
	function ClearAll(){
		Requirements::clear();
	}
	
}
class LiteCMSBasicPage_Controller extends ContentController {
	
	private static $allowed_actions = array ();
}
