<?php

namespace Concrete\Package\WorkManager;
use Concrete\Core\Package\Package;
use Concrete\Core\Page\Single as SinglePage;
use Concrete\Core\Block\BlockType\BlockType;

defined('C5_EXECUTE') or die("Access Denied.");

class Controller extends Package
{
	protected $pkgHandle = 'work_manager';
	protected $appVersionRequired = '5.7.1';
	protected $pkgVersion = '1.1';

	public function getPackageDescription()
	{
		return t("A simple manager for MGH work.");
	}

	public function getPackageName()
	{
		return t("Work Manager");
	}

	public function view() {
   		$html = Loader::helper('html');
 	}

	public function install()
	{
		$pkg = parent::install();
		SinglePage::add('/dashboard/work_manager', $pkg);
		SinglePage::add('/dashboard/work_manager/categories', $pkg);
		BlockType::installBlockTypeFromPackage('mghwork', $pkg);
	}
	
	public function upgrade() {
		parent::upgrade();
	}

}
