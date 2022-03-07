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

JFormHelper::loadFieldClass('list');

/**
 * Product Form Field class for the Product component
 *
 * @since  0.0.1
 */
class JFormFieldProduct extends JFormFieldList
{
	//die("sdf");
	/**
	 * The field type.
	 *
	 * @var         string
	 */
	protected $type = 'Product';

	/**
	 * Method to get a list of options for a list input.
	 *
	 * @return  array  An array of JHtml options.
	 */
	protected function getOptions()
	{
		//die("sdf");
		$db    = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select('*');
		$query->from('jsvcz_product');
		$db->setQuery((string) $query);
		$messages = $db->loadObjectList();
		$options  = array();

		if ($messages)
		{
			foreach ($messages as $message)
			{
				$options[] = JHtml::_('select.option', $message->id, $message->title,$message->image,$message->quantity,$message->instock, $message->short_desc, $message->des);
			}
		}

		$options = array_merge(parent::getOptions(), $options);

		return $options;
	}
}