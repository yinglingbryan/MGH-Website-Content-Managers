<?php

namespace Concrete\Package\StaffManager;
use Concrete\Core\Package\Package;
use Concrete\Core\Page\Single as SinglePage;
use Concrete\Core\Block\BlockType\BlockType;

defined('C5_EXECUTE') or die("Access Denied.");

class Controller extends Package
{
	protected $pkgHandle = 'staff_manager';
	protected $appVersionRequired = '5.7.1';
	protected $pkgVersion = '1.1.1';

	public function getPackageDescription()
	{
		return t("A simple manager for MGH staff.");
	}

	public function getPackageName()
	{
		return t("Staff Manager");
	}

	public function view() {
   		$html = Loader::helper('html');
 	}

	public function install()
	{
		$pkg = parent::install();
		SinglePage::add('/dashboard/staff_manager', $pkg);
		BlockType::installBlockTypeFromPackage('mghstaff', $pkg);
	}

}
