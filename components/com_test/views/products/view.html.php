<?php 

defined('_JEXEC') or die('Restricted access');


class TestViewProducts extends JViewLegacy
{

	
	function display($tpl = null)
	{
		$app = JFactory::getApplication();
		$user = JFactory::getUser();
		$this->items = $this->get('Items');


		//die("grkg");
	parent::display($tpl);

	}
		
}
