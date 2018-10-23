<?php
namespace Concrete\Package\WorkManager\Controller\SinglePage\Dashboard\WorkManager;
use Concrete\Core\Page\Controller\DashboardPageController;
use Concrete\Core\Editor\LinkAbstractor;

class Categories extends DashboardPageController
{
	
	public function view(){
		
		// Fetch Data
		$db = \Database::connection();
 		$sql = 'SELECT * FROM pkgWorkCategoriesManager ORDER BY `name` ASC';
		$data = $db->query($sql)->fetchAll();
		$this->set('data',$data);
		
		// Fetch Selected Data
		if( isset($_GET['edit']) ){
			$sql = 'SELECT * FROM pkgWorkCategoriesManager WHERE bID = '. $_GET["edit"];
			$editData = $db->query($sql)->fetchRow();
			$this->set('editData',$editData);
		}
				
	}	
	
	public function save(){

		// Saving
		if( $_POST['name'] == ""){
			$_POST['name'] = "Empty Category";
		}
		
		$db = \Database::connection();
		$v = array($_POST['name']);
		$q = "INSERT INTO pkgWorkCategoriesManager (name) VALUES (?)";
		$db->execute($q,$v);
		
		// Redirecting
		$this->redirect('/dashboard/work_manager/categories');
		
	}
	
	public function update(){
		
		// Updating
		if( $_POST['name'] == ""){
			$_POST['name'] = "Empty Category";
		}
		
		$db = \Database::connection();
		$v = array($_POST['name'],$_POST['bID']);
		$q = "UPDATE pkgWorkCategoriesManager SET name = ? WHERE bID = ?";
		$db->execute($q,$v);
		
		// Redirecting
		$this->redirect('/dashboard/work_manager/categories');
		
	}
	
	public function delete(){
		
		// Deleting
		$db = \Database::connection();
		
		$q = "DELETE FROM pkgWorkCategoriesManager WHERE bID = ?";
		$db->execute($q, $_GET['delete']);
		
		// Redirecting
		$this->redirect('/dashboard/work_manager/categories');
		
	}

}