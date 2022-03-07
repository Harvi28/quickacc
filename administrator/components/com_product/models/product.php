<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * HelloWorld Model
 *
 * @since  0.0.1
 */
class ProductModelProduct extends JModelAdmin
{
		//protected $messages;

	public function getTable($type = 'Product', $prefix = 'ProductTable', $config = array())
	{
		//die("sdsf");
		return JTable::getInstance($type, $prefix, $config);
	}

	/**
	 * Method to get the record form.
	 *
	 * @param   array    $data      Data for the form.
	 * @param   boolean  $loadData  True if the form is to load its own data (default case), false if not.
	 *
	 * @return  mixed    A JForm object on success, false on failure
	 *
	 * @since   1.6
	 */
	public function getForm($data = array(), $loadData = true)
	{
		//die("sdsf");
		// Get the form.
		$form = $this->loadForm('com_product.product','product',array('control' => 'jform','load_data' => $loadData));
		//echo "<pre>";
		//print_r($form);
		//die("sdf");

		if (empty($form))
		{
			//die("sdf");
			return false;
		}

		return $form;
	}

	/**
	 * Method to get the data that should be injected in the form.
	 *
	 * @return  mixed  The data for the form.
	 *
	 * @since   1.6
	 */
	protected function loadFormData()
	{
		//die("sdf");
		// Check the session for previously entered form data.
		$data = JFactory::getApplication()->getUserState(
			'com_product.edit.product.data',
			array()
		);

		//echo "<pre>";
		//print_r($data);
		//die();

		if (empty($data))
		{
			//die();
			$data = $this->getItem();
			//echo "<pre>";
			//print_r($data);
			//die("sssdf");
		}

		return $data;
	}
}