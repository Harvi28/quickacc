<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_helloworld
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.formvalidator');

//die("fgd");
?>


<form action="<?php echo JRoute::_('index.php?option=com_test&layout=edit&id='. (int) $this->item->id);  ?>" method="post" name="adminForm" id="adminForm">


    <div class="form-horizontal">
        <?php foreach ($this->form->getFieldsets() as $name => $fieldset): ?>
            <fieldset class="adminform">
                <legend><?php echo JText::_($fieldset->label); ?></legend>
                <div class="row-fluid">
                    <div class="span6">
                        <?php foreach ($this->form->getFieldset($name) as $field): ?>
                            <?php  
                                if($field->name == "jform[image]")
                                {
                                    $img = $field->value;
                                     $root = JURI::root();
                                echo "<img src='$root$img'/>";


                                }
                            ?>
                            <div class="control-group">
                                <div class="control-label"><?php echo $field->label; ?></div>
                                <div class="controls"><?php echo $field->input; ?></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </fieldset>
        <?php endforeach; ?>
    </div>
    <input type="hidden" name="task" value="test.edit" />
    <?php echo JHtml::_('form.token'); ?>
</form>


