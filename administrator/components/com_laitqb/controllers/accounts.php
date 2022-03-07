<?php
//JTable::addIncludePath(__DIR__ . '/../views');
// jimport('joomla.administrator.components.com_laitqb.views.accounts.tmpl.default.php');
require_once JPATH_COMPONENT_ADMINISTRATOR . '/helpers/Quickbook.php';
use QuickBooksOnline\API\DataService\DataService;
use QuickBooksOnline\API\QueryFilter\QueryMessage;
//include('../config.php');
 


defined('_JEXEC') or die('Restricted access');



class LaitqbControllerAccounts extends JControllerAdmin
{
   
        function save()
        {

            $QB = QuickbookHelper::getInstance();
            return $QB->createAccount();
          

        }

        function edit()
        {
             $QB = QuickbookHelper::getInstance();
             $id = JFactory::getApplication()->input->get('id');
             // echo "<pre>";
             // print_r($id);
             // die("kj");
             if($id == 0){
                //die("gf");
                $res = $QB->createAccount();
                ?>
                <div style="background-color: burlywood;">
                    <h1 align="center"> Thank You for creating account!</h1>
                    
                </div>
               <?php  
                
             }else{
                $res = $QB->updateAccount();
                ?>
                <div style="background-color: burlywood;">
                    <h1 align="center"> Thank You </h1>
                    <h3 align="center">Your account has been updated!</h3>
                </div>
                <?php 

             }
        }   
}