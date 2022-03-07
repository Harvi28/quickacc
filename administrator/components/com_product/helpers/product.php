<?php  


defined('_JEXEC') or die('Restricted access');

abstract class ProductHelper extends JHelperContent
{

	public static function addSubmenu($submenu) 
	{
		JHtmlSidebar::addEntry(
			JText::_('COM_PRODUCT_SUBMENU_MESSAGES'),
			'index.php?option=com_product',
			$submenu == 'products'
		);

		JHtmlSidebar::addEntry(
			JText::_('COM_PRODUCT_SUBMENU_CATEGORIES'),
			'index.php?option=com_categories&view=categories&extension=com_product',
			$submenu == 'categories'
		);
	}
}
