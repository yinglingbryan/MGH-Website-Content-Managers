<?php

namespace Concrete\Package\ClientManager;
use Concrete\Core\Package\Package;
use Concrete\Core\Page\Single as SinglePage;
use Concrete\Core\Block\BlockType\BlockType;

defined('C5_EXECUTE') or die("Access Denied.");

class Controller extends Package
{
	protected $pkgHandle = 'client_manager';
	protected $appVersionRequired = '5.7.1';
	protected $pkgVersion = '1.0';

	public function getPackageDescription()
	{
		return t("A simple manager for client logos.");
	}

	public function getPackageName()
	{
		return t("Client Manager");
	}

	public function view() {
   		$html = Loader::helper('html');
   		$this->addHeaderItem($html->javascript('jquery.js'));
 	}

	public function install()
	{
		$pkg = parent::install();
		SinglePage::add('/dashboard/client_manager', $pkg);
		BlockType::installBlockTypeFromPackage('mghclients', $pkg);
	}

}
