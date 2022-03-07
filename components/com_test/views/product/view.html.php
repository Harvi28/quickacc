<?php  

defined('_JEXEC') or die('Restricted access');

class TestViewProduct extends JViewLegacy
{
     public function display($tpl=null)
     {
     	//die("sdfgf");
     	//$this->items = $this->get('Items');
     	$this->item= $this->get('Item');
     	// echo "<pre>";
     	// print_r($this->item);
     	// die("kdk");

     	parent::display($tpl);

     }
}

