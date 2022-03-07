<?php
defined('_JEXEC') or die('Restricted access');

class LaitqbModelAccounts extends JModelList
{
    public function getTable($type = 'Accounts', $prefix = 'LaitqbTable', $config = array())
    {
        return JTable::getInstance($type, $prefix, $config);
    }

    public function getModel($type = 'Accounts', $prefix = 'LaitqbTable', $config = array('ignore_request' => true))
    {

        $model = parent::getModel($name, $prefix, $config);

        return $model;
    }
    public function getForm($data = array(), $loadData = true)
    {
        //die("sdsf");
        // Get the form.
        $form = $this->loadForm('com_laitqb.accounts','accounts',array('control' => 'jform','load_data' => $loadData));
        //echo "<pre>";
        //print_r($form);
        //die("sdf");

        if (empty($form))
        {
            //die("sdf");
            return false;
        }

        return $form;
    }

    protected function loadFormData()
    {
        // die("sdf");
        // Check the session for previously entered form data.
        $data = JFactory::getApplication()->getUserState(
            'com_laitqb.edit.accounts.data',
            array()
        );

        // echo "<pre>";
        // print_r($data);
        // die();

            // if (empty($data))
            // {
            //     //die();
            //     $data = $this->getItem();
            //     //echo "<pre>";
            //     //print_r($data);
            //     //die("sssdf");
            // }

        return $data;
    }
}