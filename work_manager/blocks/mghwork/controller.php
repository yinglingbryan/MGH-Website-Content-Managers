<?php
namespace Concrete\Package\WorkManager\Block\Mghwork;
use \Concrete\Core\Block\BlockController;

class Controller extends BlockController {

	protected $btDescription = "Displays a gallery of work members.";
	protected $btName = "MGH Work";
	protected $btTable = 'btWork';
	protected $btInterfaceWidth = "500";
	protected $btInterfaceHeight = "450";

	public function on_start() {
		// Fetch All Projects - Needed For Editor
		$db = \Database::connection();
 		$sql = 'SELECT * FROM pkgWorkManager ORDER BY `name` ASC';
		$projects = $db->query($sql)->fetchAll();
		$this->set('projects',$projects);
		
		// Fetch All Categories - Needed For Editor & Block View
		$db = \Database::connection();
 		$sql = 'SELECT * FROM pkgWorkCategoriesManager ORDER BY `name` ASC';
		$categories = $db->query($sql)->fetchAll();
		$this->set('categories',$categories);
	}
	
	public function view(){
		// Fetch Current Project
		$db = \Database::connection();
 		$sql = 'SELECT * FROM pkgWorkManager WHERE `bID` = "'.$this->project.'"';
		$currentProject = $db->query($sql)->fetchRow();
		$this->set('currentProject',$currentProject);
	}

}
