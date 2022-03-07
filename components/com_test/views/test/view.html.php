<?php 
defined('_JEXEC') or die('Restricted access');

class TestViewTest extends JViewLegacy
{
	function display($tpl = null)
	{

		$app = JFactory::getApplication();
		$user = JFactory::getUser();
		// $items = $this->get('Items');
		//$state = $this->get('State');
		//die("sdf");	
		$this->items = $this->get('Items');
		// echo "<pre>";
		// print_r($items);
		// die("sdff");
  	if(count($errors = $this->get('Errors')))
        {
        	JLog::add(implode('<br />', $errors), JLog::WARNING,'jerror');

        	return false;

        }
		parent::display($tpl);
	}
}


