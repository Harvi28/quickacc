<?php  
 require_once JPATH_COMPONENT_ADMINISTRATOR . '/helpers/Quickbook.php';

	//$data = JFactory::getApplication()->input;
	$QB= QuickbookHelper::getInstance();
	$account= $QB->readAccount();
	
?>
<form action="<?php echo JRoute::_('index.php?option=com_laitqb&view=accounts&layout=edit&id='.(int)$this->detail->Id);  ?>" method="post" id="adminForm" name="adminForm">
<table>
    <thead>
        <tr>
            <!-- <th width="7%"><?php echo JText::_('COM_TEST_NUM'); ?></th>-->
               <th width="3%">
                    <?php echo JHtml::_('grid.checkall'); ?>
                </th>  

	            <th width="37%">
	                <?php echo JHtml::_('searchtools.sort','COM_LAITQB_NUMBER','number'); ?>
	            </th>
	            <th width="30%">
	                <?php echo JHtml::_('searchtools.sort', 'COM_LAITQB_NAME', 'name'); ?>
	            </th>
	            <th width="30%">
	                <?php echo JHtml::_('searchtools.sort', 'COM_LAITQB_TYPE', 'type'); ?>
	            </th>
	    </tr>
	</thead> 
	<tbody>
	<?php 
	$i=1;
        foreach ($account as $oneaccount) 
           {
           		$accName = $oneaccount->Name;
        	    $accId = $oneaccount->Id;
                $accType = $oneaccount->AccountType;
                $link = JRoute::_('index.php?option=com_laitqb&view=accounts&layout=edit&id='. (int) $accId);

      
    ?>
        <td>
			<?php 
			echo JHtml::_('grid.id', $i, $oneaccount->Id); 
			?>
		</td>      
    
        <td align="center">
	        <?php 
	       		echo $accId;
	        ?>
        </td>
        <td align="center">
            <a href="<?php echo $link; ?>">
            <?php 
       		    echo $accName;
            ?>
        	</a>
        </td>
        <td align="center">
        <?php 
          echo $accType;
        ?>
        </td>
    </tbody>

<?php  

	}

?>
</table>
<input type="hidden" name="task" value="accounts"/>
    <input type="hidden" name="boxchecked" value="0"/>
    <?php echo JHtml::_('form.token'); ?>
</form>