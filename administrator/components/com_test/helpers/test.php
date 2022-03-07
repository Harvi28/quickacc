<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_helloworld
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * HelloWorld component helper.
 *
 * @param   string  $submenu  The name of the active view.
 *
 * @return  void
 *
 * @since   1.6
 */
abstract class TestHelper extends JHelperContent
{
	/**
	 * Configure the Linkbar.
	 *
	 * @return Bool
	 */

	/*public static function addSubmenu($submenu) 
	{
		JHtmlSidebar::addEntry(
			JText::_('COM_TEST_SUBMENU_TESTS'),
			'index.php?option=com_test',
			$submenu == 'tests'
		);

		
		JHtmlSidebar::addEntry(
			JText::_('COM_TEST_SUBMENU_PRODUCTS'),
			'index.php?option=com_test&view=products&extension=com_test',
			$submenu == 'products'
		);

		// Set some global property
		//$document = JFactory::getDocument();
		//$document->addStyleDeclaration('.icon-48-helloworld ' .
								//		'{background-image: url(../media/com_test/images/tux-48x48.png);}');
		//if ($submenu == 'categories') 
		//{
		//	$document->setTitle(JText::_('COM_TEST_ADMINISTRATION_CATEGORIES'));
		//}
	}*/

	public static function addSubmenu($vName)
	{
		JHtmlSidebar::addEntry(
			JText::_('COM_TEST_SUBMENU_TESTS'),
			'index.php?option=com_test',
			$vName == 'tests'
		);

		JHtmlSidebar::addEntry(
			JText::_('COM_TEST_SUBMENU_PRODUCTS'),
			'index.php?option=com_test&view=products&extension=com_test',
			$vName == 'products'
		);

		
	}

	
}