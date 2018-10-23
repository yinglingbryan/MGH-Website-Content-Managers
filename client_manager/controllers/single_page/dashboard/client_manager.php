<?php
namespace Concrete\Package\ClientManager\Controller\SinglePage\Dashboard;
use Concrete\Core\Page\Controller\DashboardPageController;
use Concrete\Core\Editor\LinkAbstractor;

class ClientManager extends DashboardPageController
{
	
	public function view(){
		
		// Fetch Data
		$db = \Database::connection();
 		$sql = 'SELECT * FROM pkgClientManager ORDER BY `sequence` ASC';
		$data = $db->query($sql)->fetchAll();
		$this->set('data',$data);
		
		// Fetch Selected Data
		if( isset($_GET['edit']) ){
			$sql = 'SELECT * FROM pkgClientManager WHERE bID = '. $_GET["edit"];
			$editData = $db->query($sql)->fetchRow();
			$this->set('editData',$editData);
		}
		
	}	
	
	public function save(){
		
		// Validating
		if( $_POST['photo'] == "0" ){
			$this->redirect('/dashboard/client_manager/?errors=1');
		}

		// Saving
		if( $_POST['title'] == ""){
			$_POST['title'] = "No Title";
		}
		
		$db = \Database::connection();
		$v = array($_POST['title'],$_POST['photo'],$_POST['sequence']);
		$q = "INSERT INTO pkgClientManager (title,photo,sequence) VALUES (?,?,?)";
		$db->execute($q, $v);
		
		// Redirecting
		$this->redirect('/dashboard/client_manager/');
		
	}
	
	public function update(){
		
		// Validating
		if( $_POST['photo'] == "0" ){
			$this->redirect('/dashboard/client_manager/?errors=1');
		}

		// Saving
		if( $_POST['title'] == ""){
			$_POST['title'] = "No Title";
		}
		
		$db = \Database::connection();
		$v = array($_POST['title'],$_POST['photo'],$_POST['sequence'],$_POST['bID']);
		$q = "UPDATE pkgClientManager SET title = ?, photo = ?, sequence = ? WHERE bID = ?";
		$db->execute($q, $v);
		
		// Redirecting
		$this->redirect('/dashboard/client_manager/');
		
	}
	
	public function delete(){
		
		// Deleting
		$db = \Database::connection();
		
		$q = "DELETE FROM pkgClientManager WHERE bID = ?";
		$db->execute($q, $_GET['delete']);
		
		// Redirecting
		$this->redirect('/dashboard/client_manager/');
		
	}

}