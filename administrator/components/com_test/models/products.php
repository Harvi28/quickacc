<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_Product
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * ProductList Model
 *
 * @since  0.0.1
 */
class TestModelProducts extends JModelList
{
	//die("sdf");
	/**
	 * Method to build an SQL query to load the list data.
	 *
	 * @return      string  An SQL query
	 */
	protected function getListQuery()
	{
		//die("sdf");
		// Initialize variables.
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);

		// Create the base select statement.
		$query->select('*')
                ->from($db->quoteName('jsvcz_product'));
        //echo "<pre>";
        //print_r($query);
        //die();

		return $query;
	}
}