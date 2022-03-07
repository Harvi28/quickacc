<?php  


defined('_JEXEC') or die('Restricted access');

abstract class ProductHelper extends JHelperContent
{

//die();
	public static function addSubmenu($submenu) 
	{
		//die();

		JHtmlSidebar::addEntry(
			JText::_('COM_TEST_SUBMENU_MESSAGES'),
			'index.php?option=com_test',
			$submenu == 'tests'
		);

		
		JHtmlSidebar::addEntry(
			JText::_('COM_TEST_SUBMENU_PRODUCTS'),
			'index.php?option=com_test&view=products&extension=com_test',
			$submenu == 'products'
		);
	}
}
