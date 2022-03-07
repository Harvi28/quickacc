<?php 
defined('_JEXEC') or die('sdf');

$controller = JControllerLegacy::getInstance('Test');
$input = JFactory::getApplication()->input;
$controller->execute($input->getCmd('task'));

$controller->redirect();


?>