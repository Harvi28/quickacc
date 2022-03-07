<?php
defined('_JEXEC') or die('Restricted access');
class TestModelProducts extends JModelList
{

		protected $items;

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