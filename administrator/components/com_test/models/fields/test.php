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

JFormHelper::loadFieldClass('list');

/**
 * HelloWorld Form Field class for the HelloWorld component
 *
 * @since  0.0.1
 */
class JFormFieldTest extends JFormFieldList
{
	/**
	 * The field type.
	 *
	 * @var         string
	 */
	protected $type = 'Test';

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
		$query->from('jsvcz_category');
		//$query->leftJoin('jsvcz_categories on parentcat=jsvcz_categories.id');
		//echo "<pre>";
		//print_r($query);
		//die("sdfs");
		// Retrieve only published items
		$query->where('jsvcz_category.id = true');
		$db->setQuery((string) $query);
		$messages = $db->loadObjectList();
		$options  = array();


		

		/*if ($messages)
		{
			foreach ($messages as $message)
			{
				$options[] = JHtml::_('select.option', $message->id, $message->title, $messages->image . ($message->parentcat ? ' (' . $message->category . ')' : ''));
			}
		}*/

		if ($messages)
		{
			foreach ($messages as $message)
			{
				$options[] = JHtml::_('select.option', $message->id, $message->catetitle, $messages->image, $messages->parentcat, $messages->short_desc, $messages->des);
			}
		}


		$options = array_merge(parent::getOptions(), $options);

		return $options;
	}
}