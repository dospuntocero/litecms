<?php 

	class LiteCMSMaintenance extends DataExtension{

		static $db = array(
			'Maintenance' => 'Boolean'
		);

		public function updateCMSFields(FieldList $fields) {
			$fields->addFieldToTab("Root.Main", $mantcb = new CheckboxField('Maintenance',_t('Maintenance.MAINTENANCE',"Put the site into maintenance mode?")),"Title");
		}
	}

	class LiteCMSMaintenanceController_Decorator extends SiteTreeExtension{

		function ClearReq(){Requirements::clear();}

		public function contentcontrollerInit($controller) {
			if (!Member::currentUser()) {
				$this->checkMaintenance();
				Requirements::clear();
			}
		}

		public function checkMaintenance(){
			$checkHomeForMaintenance = SiteConfig::current_site_config();
			if($checkHomeForMaintenance->Maintenance == 1){
				if ($this->owner->URLSegment != 'Security') {
					Requirements::clear();
					$view = new SSViewer(array('MaintenanceView'));
					echo $view->process(_t('Maintenance.MESSAGE',"Site under maintenance"));
					exit;
				}
			}
		}
	}