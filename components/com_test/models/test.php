<?php 
defined('_JEXEC') or die('Restricted access');

class TestModelTest extends JModelList
{

	protected $items;
	//die("fdsd");

	
    public function getListQuery()
    {
    	//die("sddsd");	
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);

		
		$query->select('a.id as id, a.catetitle as catetitle, a.published as published,a.image as image, a.parentcat as parentcat')
			  ->from($db->quoteName('jsvcz_category', 'a'));
		$query->select($db->quoteName('c.title', 'category_title'))
			  ->join('LEFT', $db->quoteName('jsvcz_categories', 'c') . ' ON c.id = a.parentcat');
	 	return $query;
		// echo "<pre>";
		// print_r($query);
		// die("sdff");
  	
		// print_r($items);
		// die("sdff");
  	
	 	// echo "<pre>";
	 	// print_r($query);
	 	// die("fdsds");

    }

	// public function getItems()
	// {
	// 	if(!isset($this->items))
	// 	{
	// 		$id = $this->getState('message.id');
	// 		$db    = JFactory::getDbo();
	// 		$query = $db->getQuery(true);
	// 		// $query->select('a.id as id, a.catetitle as catetitle, a.published as published,a.image as image, a.parentcat as parentcat, c.title as category')
	// 		//   ->from('jsvcz_category', 'a')
	// 		//   ->leftJoin('jsvcz_categories as c ON a.parentcat = c.id')
	// 		//   ->where('a.id=' . (int)$id);
	// 		$query->select('*') 
	// 			  ->from ('jsvcz_category');
	// 		$db->setQuery((string)$query);

	// 	}
	// 	// echo "<pre>";
	// 	// print_r($this->item);
	// 	// die("sdf");
	// 	// 	//return $this->item;
	// }

}

	