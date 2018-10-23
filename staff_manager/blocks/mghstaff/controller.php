<?php
namespace Concrete\Package\StaffManager\Block\Mghstaff;
use \Concrete\Core\Block\BlockController;

class Controller extends BlockController {

	protected $btDescription = "Displays a gallery of staff members.";
	protected $btName = "MGH Staff";
	protected $btTable = 'btStaff';
	protected $btInterfaceWidth = "500";
	protected $btInterfaceHeight = "450";

	public function view() {
		$db = \Database::connection();
 		// $sql = 'SELECT * FROM pkgStaffManager ORDER BY RAND() ASC';
		$sql = 'SELECT * FROM pkgStaffManager WHERE displayOnStaff = "1" ORDER BY name ASC';
		$people = $db->query($sql)->fetchAll();
		$this->set('people',$people);
	}

}
