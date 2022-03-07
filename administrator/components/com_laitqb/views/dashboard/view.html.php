<?php

defined('_JEXEC') or die('Invalid Access');


class LaitqbViewDashboard extends JViewLegacy
{

    /**
     * Display the view
     */
    public function display($tpl = null)
    {
        $this->form = $this->get('Form');
       // $this->item = $this->get('Item');

        $QB = QuickbookHelper::getInstance();
        $session = JFactory::getSession();

        $this->qb = $QB->getQB();
        // echo "<pre>";print_r($this->form);die;

        $this->authUrl = "#";
        if(empty($this->qb)){
            $this->authUrl = $QB->getauthUrl();
        }
        // $this->qb = $session->get('laitqb.qb', array());

        /*echo $this->authUrl;
        die;*/



        if (!empty($this->get('Errors')) && count($errors = $this->get('Errors'))) {
            JError::raiseError(500, implode('<br />', $errors));

            return false;
        }
        LaitqbHelper::addSubmenu('dashboard');

        $this->addToolbar();
        parent::display($tpl);
        $this->setDocument();
    }



	protected function addToolBar()
	{
		JToolbarHelper::title(JText::_('Quickbook Dashboard'));
		JToolBarHelper::preferences('com_laitqb');
	}


    protected function setDocument()
    {
        $document = JFactory::getDocument();
        $document->setTitle(JText::_('Dashbord - Quickbook'));
        JHtml::_('jquery.framework');
    }

}