<?php  
JHtml::_('behavior.formvalidator');

//echo "<pre>";print_r($this->detail);echo "</pre>";

?>


<form  method="post" name="adminForm" id="adminForm">
<table>
    <div>
        <tr>
            <td width="40%">
                <label>Account Name:</label>
            </td>
        
            <td>
                <input type="text" name="acc_name" value="<?php echo isset($this->detail->Name) ? $this->detail->Name : ''; ?>">
            </td>
        </tr>
        <tr>
            <td width="40%"> 
                <label>Account Number:</label>
            </td>
            <td>
                <input type="number" name="acc_num" value="<?php echo isset($this->detail->AcctNum) ? $this->detail->AcctNum : ''; ?>"> 
            </td>
        </tr>
        <tr>
            <td width="40%">
                <label>Account ID:</label>
            </td>
            <td>
                <input type="number" name="acc_id" value="<?php echo isset($this->detail->Id) ? $this->detail->Id : ''; ?>">
            </td>
        </tr>
        <tr>
            <td width="40%">
                <label>Account Type:</label>
            </td>
            <td>
                <input type="number" name="acc_id" value="<?php echo isset($this->detail->AccountType) ? $this->detail->AccountType : ''; ?>">
            </td>
        </tr>
    </div>
</table>
<!-- <input type="hidden" name="task" value="accounts.edit"/> -->
<input type="hidden" name="task" value="save"/>
<input type="hidden" name="boxchecked" value="0"/>
<input type="hidden" name="id" value="<?php echo $this->detail->Id; ?>"/>
    <?php echo JHtml::_('form.token'); ?>


</form>




