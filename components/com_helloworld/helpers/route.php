<?php

defined('_JEXEC') or die;

/**
 * Helloworld Component Helper file for generating the URL Routes
 *
 */
class HelloworldHelperRoute
{
	/**
	 * When the Helloworld message is displayed then there is also shown a map with a Search Here button.
	 * This function generates the URL which the Ajax call will use to perform the search. 
	 * 
	 */
	public static function getAjaxURL()
	{
		if (!JLanguageMultilang::isEnabled())
		{
			return null;
		}
        
		$lang = JFactory::getLanguage()->getTag();
		$app  = JFactory::getApplication();
		$sitemenu= $app->getMenu();
		$thismenuitem = $sitemenu->getActive();

		// if we haven't got an active menuitem, or we're currently on the messages menuitem then just stay there
		if (!$thismenuitem || strpos($thismenuitem->link, "view=category") !== false || $thismenuitem->note == "Ajax")		{
			return null;
		}

		$menuitem = $sitemenu->getItems(array('language','note'), array($lang, "Ajax"));
		if ($menuitem)
		{
			$itemid = $menuitem[0]->id; 
			$url = JRoute::_("index.php?Itemid=$itemid&view=helloworld&format=json");
			return $url;
		}
		else
		{
			return null;
		}
	}

	public static function getHelloworldRoute($id, $catid = 0, $language = 0)
	{
		// Create the link
		$link = 'index.php?option=com_helloworld&view=helloworld&id=' . $id;

		if ((int) $catid > 1)
		{
			$link .= '&catid=' . $catid;
		}

		if ($language && $language !== '*' && JLanguageMultilang::isEnabled())
		{
			$link .= '&lang=' . $language;
		}

		return $link;
	}

	/**
	 * Helper function for generating the URL to a Helloworld Category page
	 * This is needed for the Tags functionality
	 */
	public static function getCategoryRoute($catid, $language = 0)
	{
		if ($catid instanceof JCategoryNode)
		{
			$id = $catid->id;
		}
		else
		{
			$id = (int) $catid;
		}

		if ($id < 1)
		{
			$link = '';
		}
		else
		{
			$link = 'index.php?option=com_helloworld&view=category&id=' . $id;

			if ($language && $language !== '*' && JLanguageMultilang::isEnabled())
			{
				$link .= '&lang=' . $language;
			}
		}

		return $link;
	}
}