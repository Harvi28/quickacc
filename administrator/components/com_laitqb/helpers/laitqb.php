<?php

// No direct access to this file

defined('_JEXEC') or die('Restricted access');

abstract class LaitqbHelper extends JHelperContent {

	public static function addSubmenu($submenu) {

		JHtmlSidebar::addEntry(

			JText::_('Dashboard'),

			'index.php?option=com_laitqb',

			$submenu == 'dashboard'

		);


		JHtmlSidebar::addEntry(

			JText::_('Sync Data'),

			'index.php?option=com_laitqb&view=syncdata',

			$submenu == 'syncdata'

		);

		JHtmlSidebar::addEntry(

			JText::_('Config'),

			'index.php?option=com_laitqb&view=configs',

			$submenu == 'configs'

		);

		JHtmlSidebar::addEntry(

			JText::_('Account'),

			'index.php?option=com_laitqb&view=accounts',

			$submenu == 'accounts'

		);





		// Set some global property

		$document = JFactory::getDocument();

		$document->addStyleDeclaration('.icon-48-helloworld ' .

			'{background-image: url(../media/com_laitqb/images/laitqb.png);}');

		if ($submenu == 'dashboard') {

			$document->setTitle(JText::_('Welcome to Quickbook'));

		}

	}


}