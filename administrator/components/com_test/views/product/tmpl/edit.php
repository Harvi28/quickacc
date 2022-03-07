<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_product
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.formvalidator');


//die();

?>
<form action="<?php echo JRoute::_('index.php?option=com_test&layout=edit&id=' . (int) $this->item->id); ?>" method="post" name="adminForm" id="adminForm" enctype="multipart/form-data">
    

    <div class="form-horizontal">
        <fieldset class="adminform">
            <legend><?php echo JText::_('COM_PRODUCT_PRODUCT_DETAILS'); ?></legend>
            <div class="row-fluid">
                <div class="span6">
                    <?php 
                        foreach($this->form->getFieldset() as $field) {
                            // echo "<pre>";print_r($field->input);
                            // echo $field->name;
                            if($field->name == "jform[image]"){
                                $img = $field->value;
                                // echo "<pre>";
                                // print_r($img);
                                // die("sdf");
                                $root = JURI::root().'images/';
                                echo "<img src='$root$img'/>";
                            }
                            // echo "<pre>";print_r($field);
                            echo $field->renderField();        
                        }
                    ?>
                </div>
            </div>
        </fieldset>
    </div>
    <input type="hidden" name="task" value="product.edit" />
    <?php echo JHtml::_('form.token'); ?>
</form>