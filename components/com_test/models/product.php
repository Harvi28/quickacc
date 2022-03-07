<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * HelloWorld Model
 *
 * @since  0.0.1
 */
class TestModelProduct extends JModelItem
{
		protected $item;

		protected function getListQuery()
		{
			$db    = JFactory::getDbo();
			$query = $db->getQuery(true);
			$query->select('id')
                ->from($db->quoteName('jsvcz_product'));

            return $query;

		}

		public function getItem($id = null)
		{
			$id = JFactory::getApplication()->input->get('id');
			// echo "<pre>";print_r($id);die;
			$db    = JFactory::getDbo();
			$query = $db->getQuery(true);
			$query->select('*')
                ->from($db->quoteName('jsvcz_product'));
			$query->where('id = '.$id);
            $db->setQuery((string)$query);
            // echo $query;die;
		
			$this->item = $db->loadObject();

            return $this->item;
		}


	
}
//public function getTable($type = 'Product'id $prefix = 'TestTable', $config = array())
	// {
	// 	//die("sdsf");
	// 	return JTable::getInstance($type, $prefix, $config);
	// }

	// /**
	//  * Method to get the record form.
	//  *
	//  * @param   array    $data      Data for the form.
	//  * @param   boolean  $loadData  True if the form is to load its own data (default case), false if not.
	//  *
	//  * @return  mixed    A JForm object on success, false on failure
	//  *
	//  * @since   1.6
	//  */
	// public function getForm($data = array(), $loadData = true)
	// {
	// 	//die("sdsf");
	// 	// Get the form.
	// 	$form = $this->loadForm('com_test.product','product',array('control' => 'jform','load_data' => $loadData));
	// 	//echo "<pre>";
	// 	//print_r($form);
	// 	//die("sdf");

	// 	if (empty($form))
	// 	{
	// 		//die("sdf");
	// 		return false;
	// 	}

	// 	return $form;
	// }

	// /**
	//  * Method to get the data that should be injected in the form.
	//  *
	//  * @return  mixed  The data for the form.
	//  *
	//  * @since   1.6
	//  */
	// protected function loadFormData()
	// {
	// 	//die("sdf");
	// 	// Check the session for previously entered form data.
	// 	$data = JFactory::getApplication()->getUserState(
	// 		'com_test.edit.product.data',
	// 		array()
	// 	);

	// 	//echo "<pre>";
	// 	//print_r($data);
	// 	//die();

	// 	if (empty($data))
	// 	{
	// 		//die();
	// 		$data = $this->getItem();
	// 		//echo "<pre>";
	// 		//print_r($data);
	// 		//die("sssdf");
	// 	}

	// 	return $data;
	// }
