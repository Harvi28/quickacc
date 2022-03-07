<?php  

defined('_JEXEC') or die('Restricted access');


class TestControllerProducts extends JControllerAdmin
{
	protected $text_prefix = 'COM_TEST_PRODUCTS';

	public function getModel($name = 'Product', $prefix = 'TestModel', $config = array('ignore_request' => true))
	{
		//die("sdf");	
		$model = parent::getModel($name, $prefix, $config);

		return $model;
	}

}