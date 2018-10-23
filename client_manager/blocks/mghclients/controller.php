<?php
namespace Concrete\Package\ClientManager\Block\Mghclients;
use \Concrete\Core\Block\BlockController;

class Controller extends BlockController {

	protected $btDescription = "Displays the gallery of the client list.";
	protected $btName = "MGH Clients";
	protected $btTable = 'btClients';
	protected $btInterfaceWidth = "500";
	protected $btInterfaceHeight = "450";

	public function view() {
		$db = \Database::connection();
 		$sql = 'SELECT * FROM pkgClientManager ORDER BY `title` ASC';
		$clients = $db->query($sql)->fetchAll();
		$this->set('clients',$clients);
	}

}
