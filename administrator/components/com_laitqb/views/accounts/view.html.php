<?php
use Joomla\CMS\Uri\Uri;

defined('_JEXEC') or die('Invalid Access');


class LaitqbViewAccounts extends JViewLegacy
{
	public function display($tpl=null)
	{

	$QB = QuickbookHelper::getInstance();
	LaitqbHelper::addSubmenu('accounts');
 	//$this->qb = $QB->getQB();
 	
 	$this->account_id = JFactory::getApplication()->input->get('id');

 	 

 	if($this->account_id){
 		$this->detail = $QB->getAccount($this->account_id);
 	}else{

 		$this->detail = new stdClass();
 		$this->detail->Id = 0;
 	}

	        
 		$this->addToolbar();
        parent::display($tpl);
	}


	protected function addToolBar()
	{
		
		$input = JFactory::getApplication()->input;
		$layout = $input->get('layout');
		


		if($layout == 'edit')
		{
			JToolbarHelper::title(JText::_('COM_ACCOUNTS'));
			JToolbarHelper::save('accounts.edit');
		//JToolbarHelper::cancel('accounts.cancel', $isNew ? 'JTOOLBAR_CANCEL' : 'JTOOLBAR_CLOSE');

		}
		else
		{

			JToolbarHelper::title(JText::_('COM_ACCOUNTS'));
			JToolbarHelper::addNew('accounts.edit');
			JToolbarHelper::editList('accounts.edit');
			//JToolbarHelper::deleteList('', 'accounts.delete');
		}

	}

	
}
