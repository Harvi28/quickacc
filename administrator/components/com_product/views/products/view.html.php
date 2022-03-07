<?php


// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * Products View
 *
 * @since  0.0.1
 */
class ProductViewProducts extends JViewLegacy
{
	function display($tpl = null)
	{
		$app = JFactory::getApplication();
		$context = "product.list.admin.product";
		//die("sdf");
		// Get data from the model
		$this->items		= $this->get('Items');
		$this->pagination	= $this->get('Pagination');
		$this->state			= $this->get('State');

		//echo "<pre>";
		//print_r($this->pagination);
		//die("sdf");


		$this->canDo = JHelperContent::getActions('com_test');

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			throw new Exception(implode("\n", $errors), 500);

			//return false;
		}

		$this->addToolBar();


		// Display the template
		parent::display($tpl);

		$this->setDocument();

	}
	protected function addToolBar()
	{
		JToolbarHelper::title(JText::_('COM_PRODUCT_MANAGER_PRODUCTS'));
		JToolbarHelper::addNew('product.add');
		JToolbarHelper::editList('product.edit');
		JToolbarHelper::deleteList('', 'products.delete');
	}

	protected function setDocument() 
	{
		$document = JFactory::getDocument();
		$document->setTitle(JText::_('COM_PRODUCT_ADMINISTRATION'));
	}
}