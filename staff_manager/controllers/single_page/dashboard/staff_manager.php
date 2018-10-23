<?php
namespace Concrete\Package\StaffManager\Controller\SinglePage\Dashboard;
use Concrete\Core\Page\Controller\DashboardPageController;
use Concrete\Core\Editor\LinkAbstractor;

class StaffManager extends DashboardPageController
{
	
	public function view(){
		
		// Fetch Data
		$db = \Database::connection();
 		$sql = 'SELECT * FROM pkgStaffManager ORDER BY `sequence` ASC';
		$data = $db->query($sql)->fetchAll();
		$this->set('data',$data);
		
		// Fetch Selected Data
		if( isset($_GET['edit']) ){
			$sql = 'SELECT * FROM pkgStaffManager WHERE bID = '. $_GET["edit"];
			$editData = $db->query($sql)->fetchRow();
			$this->set('editData',$editData);
		}
		
	}	
	
	public function save(){
		
		// Validating
		if( $_POST['photo'] == "0" ){
			$this->redirect('/dashboard/staff_manager/?errors=1');
		}

		// Saving
		if( $_POST['title'] == ""){
			$_POST['title'] = "MGH Employee";
		}
		
		$db = \Database::connection();
		$v = array($_POST['name'],$_POST['title'],$_POST['caption'],$_POST['linkedin'],$_POST['twitter'],$_POST['photo'],$_POST['sequence'],$_POST['displayOnStaff']);
		$q = "INSERT INTO pkgStaffManager (name,title,caption,linkedin,twitter,photo,sequence,displayOnStaff) VALUES (?,?,?,?,?,?,?,?)";
		$db->execute($q, $v);
		
		// Redirecting
		$this->redirect('/dashboard/staff_manager/');
		
	}
	
	public function update(){
		
		// Validating
		if( $_POST['photo'] == "0" ){
			$this->redirect('/dashboard/staff_manager/?errors=1');
		}

		// Saving
		if( $_POST['title'] == ""){
			$_POST['title'] = "MGH Employee";
		}
		
		$db = \Database::connection();
		$v = array($_POST['name'],$_POST['title'],$_POST['caption'],$_POST['linkedin'],$_POST['twitter'],$_POST['photo'],$_POST['sequence'],$_POST['displayOnStaff'],$_POST['bID']);
		$q = "UPDATE pkgStaffManager SET name = ?, title = ?, caption = ?, linkedin = ?, twitter = ?, photo = ?, sequence = ?, displayOnStaff = ? WHERE bID = ?";
		$db->execute($q, $v);
		
		// Redirecting
		$this->redirect('/dashboard/staff_manager/');
		
	}
	
	public function delete(){
		
		// Deleting
		$db = \Database::connection();
		
		$q = "DELETE FROM pkgStaffManager WHERE bID = ?";
		$db->execute($q, $_GET['delete']);
		
		// Redirecting
		$this->redirect('/dashboard/staff_manager/');
		
	}

}