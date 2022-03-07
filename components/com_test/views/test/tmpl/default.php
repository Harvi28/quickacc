<?php  
defined('_JEXEC') or die('sdf');
//die("asd");
?>
<form>
<thead>
	<tr>
		<th>
			<?php echo JText::_('COM_CATEGORY_ID'); ?>
		</th>
		<th>
			<?php echo JText::_('COM_CATEGORY_TITLE'); ?>
		</th>
	</tr>
</thead>
<tbody>	
	<?php if(!empty($this->items)) : ?>
	<?php foreach($this->items as $i => $row) :?> 
		<tr>
			<td>
				<?php echo $row->id; ?>
			</td>
		
			<td>
				<?php echo $row->catetitle; ?>
			</td>
		</tr>
	<?php endforeach; ?>
<?php endif; ?>
</tbody>	
</form>	
	

	