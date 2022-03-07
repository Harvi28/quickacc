<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  Content.Fields
 *
 * @copyright   (C) 2017 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die();

/**
 * Plug-in to show a custom field in eg an article
 * This uses the {fields ID} syntax
 *
 * @since  3.7.0
 */
class PlgContentRemovewords extends JPlugin
{
	/**
	 * Plugin that shows a custom field
	 *
	 * @param   string  $context  The context of the content being passed to the plugin.
	 * @param   object  &$item    The item object.  Note $article->text is also available
	 * @param   object  &$params  The article params
	 * @param   int     $page     The 'page' number
	 *
	 * @return void
	 *
	 * @since  3.7.0
	 */
	public function onContentPrepare($context, &$item, &$params, $page = 0)
	{
		//die("sdf");
		//$item->text = "lsdfslfjslfjldkjf ldkfj asf ";	
		// echo "<pre>";print_r($item);die;
		//return;
		// echo "<pre>";print_r($item);die;
		// If the item has a context, overwrite the existing one
		// $db = JFactory::getDbo();

		// $query = $db->getQuery(true);
		
			$mixf = $item->text;
			$seval = array('idiot','asshole');
			$reval = 'bd';
			$res = str_replace($seval, $reval, $mixf);
		
		$item->text = $res;
		//echo "<pre>";
		// print_r($res);
		//die("sdf");
		
		
	}
}
