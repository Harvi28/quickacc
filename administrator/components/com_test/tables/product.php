<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_Product
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
// No direct access
defined('_JEXEC') or die('Restricted access');

/**
 * Hello Table class
 *
 * @since  0.0.1
 */
class TestTableProduct extends JTable
{
	/**
	 * Constructor
	 *
	 * @param   JDatabaseDriver  &$db  A database connector object
	 */
	function __construct(&$db)
	{
		parent::__construct('jsvcz_product', 'id', $db);
	}

}