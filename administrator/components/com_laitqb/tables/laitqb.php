<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_laitqb
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access
defined('_JEXEC') or die('Restricted access');

/**
 * Hello Table class
 *
 * @since  0.0.1
 */
class LaitqbTableQuickbook extends JTable
{

	function __construct(&$db)
	{
		parent::__construct('#__laitqb_quickbook', 'id', $db);
	}

	
}