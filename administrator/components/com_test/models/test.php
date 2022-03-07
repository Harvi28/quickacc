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

/**
 * HelloWorld Model
 *
 * @since  0.0.1
 */
class TestModelTest extends JModelAdmin
{
	
	public function getTable($type = 'Test', $prefix = 'TestTable', $config = array())
	{
		//die("sddf");
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

		// Get the form.
		$form = $this->loadForm('com_test.test','test',
			array(
				'control' => 'jform',
				'load_data' => $loadData
			)
		);
		if (empty($form))
		{
			return false;
		}

		return $form;
	}

	//public function getItem($pk = null)
	//{
		//$item = parent::getItem($pk);
	//}

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
		$data = JFactory::getApplication()->getUserState('com_test.edit.test.data',array());
		//echo "<pre>";
		//print_r($data);
		//die();

		if (empty($data))
		{
			//print_r($data);
			//die("sdf");
			$data = $this->getItem();
		}
		// echo "<pre>";print_r($data);die;

		return $data;
	}

	function save($data)
 	{
 		// die('sdf');
 		// echo "<pre>";print_r($data);die;
 		// $src = $data['image'];
 		// $file = JFactory::getApplication()->input->media->get('image');
 		jimport('joomla.filesystem.file');
 		//$filename = JFile::makeSafe($file['name']);
        $file = JFactory::getApplication()->input->files->get('jform', array(), 'array');

        DEFINE('DS', DIRECTORY_SEPARATOR); 

		$dest = JPATH_ROOT.DS.'images'.DS.basename($file['image']['name']);
		// echo $file['image']['tmp_name'];die;
		// echo $dest;die;

		// echo "<pre>";
		// print_r($file);
		// die("sssdf");
       if($file['image']['name']){
            if(JFile::upload($file['image']['tmp_name'], $dest))
            {
            	
            	// JRoute::_('index.php?option=com_test&view=products');
            	$data['image'] = basename($file['image']['name']);

            }
		}
            $result = parent::save($data);
        
        return $result;
			
 	}
}