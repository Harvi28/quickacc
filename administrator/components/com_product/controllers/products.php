<?php  

defined('_JEXEC') or die('Restricted access');


class ProductControllerProducts extends JControllerAdmin
{
	public function getModel($name = 'Product', $prefix = 'ProductModel', $config = array('ignore_request' => true))
	{
		//die("sdf");	
		$model = parent::getModel($name, $prefix, $config);

		return $model;
	}

}