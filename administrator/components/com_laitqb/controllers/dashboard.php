<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_laitqb
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * HelloWorlds Controller
 *
 * @since  0.0.1
 */
class LaitqbControllerDashboard extends JControllerAdmin
{
	/**
	 * Proxy for getModel.
	 *
	 * @param   string  $name    The model name. Optional.
	 * @param   string  $prefix  The class prefix. Optional.
	 * @param   array   $config  Configuration array for model. Optional.
	 *
	 * @return  object  The model.
	 *
	 * @since   1.6
	 */
	public function getModel($name = 'HelloWorld', $prefix = 'HelloWorldModel', $config = array('ignore_request' => true))
	{
		$model = parent::getModel($name, $prefix, $config);

		return $model;
	}

	public function callBack(){
	    QuickbookHelper::getInstance()->processCode();
	    $link = JRoute::_('index.php?option=com_laitqb');
	    return $this->redirect($link);
    }
    public function clearQbSession(){
        $session = JFactory::getSession();
        $session->clear('laitqb.qb');
//        $link = JRoute::_('index.php?option=com_laitqb&view=dashboard');
//	    $this->redirect($link);;
    }

	public function refreshToken(){

	    die('fas');

    }
}