<?php
namespace Concrete\Package\WorkManager\Controller\SinglePage\Dashboard;
use Concrete\Core\Page\Controller\DashboardPageController;
use Concrete\Core\Editor\LinkAbstractor;

class WorkManager extends DashboardPageController
{
	
	public function view(){
		
		// Fetch All Projects
		$db = \Database::connection();
 		$sql = 'SELECT * FROM pkgWorkManager ORDER BY `name` ASC';
		$data = $db->query($sql)->fetchAll();
		$this->set('data',$data);
		
		// Fetch Selected Project
		if( isset($_GET['edit']) ){
			$sql = 'SELECT * FROM pkgWorkManager WHERE bID = '. $_GET["edit"];
			$editData = $db->query($sql)->fetchRow();
			$this->set('editData',$editData);
		}
		
		// Fetch All Categories 
		$db = \Database::connection();
 		$sql = 'SELECT * FROM pkgWorkCategoriesManager ORDER BY `name` ASC';
		$categories = $db->query($sql)->fetchAll();
		$this->set('categories',$categories);
		
	}	
	
	public function save(){
		
		// Validating
		/*
		if( $_POST['asset'] == "0" ){
			$this->redirect('/dashboard/work_manager/?errors=1');
		}
		*/

		// Fallback
		if( $_POST['name'] == ""){
			$_POST['name'] = "";
		}
		
		// Parse Data
		$_POST['category'] = implode(",",$_POST['category']);
		
		$db = \Database::connection();
		$v = array($_POST['name'],$_POST['caption'],$_POST['type'],$_POST['logo'],$_POST['assetType'],$_POST['asset'],$_POST['assetPoster'],$_POST['category'],$_POST['assetLabel']);
		$q = "INSERT INTO pkgWorkManager (name,caption,type,logo,assetType,asset,assetPoster,category,assetLabel) VALUES (?,?,?,?,?,?,?,?,?)";
		$db->execute($q, $v);
		
		// Redirecting
		$this->redirect('/dashboard/work_manager/');
		
	}
	
	public function update(){
		
		// Validating
		/*
		if( $_POST['photo'] == "0" ){
			$this->redirect('/dashboard/work_manager/?errors=1');
		}
		*/

		// Fallback
		if( $_POST['name'] == ""){
			$_POST['name'] = "";
		}
		
		// Parse Data
		$_POST['category'] = implode(",",$_POST['category']);
		
		$db = \Database::connection();
		$v = array($_POST['name'],$_POST['caption'],$_POST['type'],$_POST['logo'],$_POST['assetType'],$_POST['asset'],$_POST['assetPoster'],$_POST['category'],$_POST['assetLabel'],$_POST['bID']);
		$q = "UPDATE pkgWorkManager SET name = ?, caption = ?, type = ?,  logo = ?, assetType = ?, asset = ?, assetPoster = ?, category = ?, assetLabel = ? WHERE bID = ?";
		$db->execute($q, $v);
		
		// Redirecting
		$this->redirect('/dashboard/work_manager/');
		
	}
	
	public function delete(){
		
		// Deleting
		$db = \Database::connection();
		
		$q = "DELETE FROM pkgWorkManager WHERE bID = ?";
		$db->execute($q, $_GET['delete']);
		
		// Redirecting
		$this->redirect('/dashboard/work_manager/');
		
	}

}