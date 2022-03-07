<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * HelloWorld Model
 *
 * @since  0.0.1
 */
class ProductModelProduct extends JModelAdmin
{
		protected $item;

		//protected $messages;

	protected function populateState()
	{
		// Get the message id
		$jinput = JFactory::getApplication()->input;
		$id     = $jinput->get('id', 1, 'INT');
		$this->setState('message.id', $id);

		// Load the parameters.
		$this->setState('params', JFactory::getApplication()->getParams());
		parent::populateState();
	}
	public function getTable($type = 'Product', $prefix = 'ProductTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}

	public function getItem()
	{
		if (!isset($this->item)) 
		{
			$id    = $this->getState('message.id');
			$db    = JFactory::getDbo();
			$query = $db->getQuery(true);
			$query->select('*')
				  ->from('jsvcz_product as h')
				  ->where('h.id=' . (int)$id);
			$db->setQuery((string)$query);
		
			if ($this->item = $db->loadObject()) 
			{
				// Load the JSON string
				$params = new JRegistry;
				$params->loadString($this->item->params, 'JSON');
				$this->item->params = $params;

				// Merge global params with item params
				$params = clone $this->getState('params');
				$params->merge($this->item->params);
				$this->item->params = $params;
			}
		}
		return $this->item;
	}
}