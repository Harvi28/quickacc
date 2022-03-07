<?php  


class ProductViewProduct extends JViewLegacy
{
	function display($tpl=null)
	{
		$this->item = $this->get('Item');

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JLog::add(implode('<br />', $errors), JLog::WARNING, 'jerror');

			return false;
		}
		// Display the view
		parent::display($tpl);
	}
}