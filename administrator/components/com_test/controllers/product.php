<?php  

defined('_JEXEC') or die('Restricted access');


class TestControllerProduct extends JControllerForm
{
    protected $text_prefix = 'COM_TEST_PRODUCT';

  //die("sdf");
  public function __construct($config = array())
    {
        parent::__construct($config);
    }

   //die("sf"); 
}