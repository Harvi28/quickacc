<?php
/**
 *
 * @package     Joomla.Administrator
 * @subpackage  com_laitqb
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
// Set some global property
$document = JFactory::getDocument();

if (!JFactory::getUser()->authorise('core.manage', 'com_laitqb'))
{
 	throw new Exception(JText::_('JERROR_ALERTNOAUTHOR'));
}

// Require helper file
JLoader::register('LaitQBHelper', JPATH_COMPONENT . '/helpers/laitqb.php');
JLoader::register('DbOperationsHelper', JPATH_COMPONENT . '/helpers/DbOperations.php');
JLoader::register('QuickbookHelper', JPATH_COMPONENT . '/helpers/Quickbook.php');

// Get an instance of the controller prefixed by HelloWorld
$controller = JControllerLegacy::getInstance('laitqb');

// Perform the Request task
$controller->execute(JFactory::getApplication()->input->get('task'));

// Redirect if set by the controller
$controller->redirect();