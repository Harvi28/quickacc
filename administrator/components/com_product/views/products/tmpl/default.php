<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
?>
<form action="index.php?option=com_product&view=products" method="post" id="adminForm" name="adminForm">
	<div id="j-sidebar-container" class="span2">
		<?php echo JHtmlSidebar::render(); ?>
	</div>
	<div id="j-main-container" class="span10">
	<div class="row-fluid">
		
	</div>
	<table class="table table-striped table-hover">
		<thead>
		<tr>
			<th width="1%"><?php echo JText::_('COM_PRODUCT_NUM'); ?></th>
			<th width="2%">
				<?php echo JHtml::_('grid.checkall'); ?>
			</th>
			<th width="7%">
				<?php echo JText::_('COM_PRODUCT_PUBLISHED'); ?>
			</th>
			<th width="10%">
				<?php echo JText::_('COM_PRODUCT_ID'); ?>
			</th>
			<th width="20">
				<?php echo JText::_('COM_PRODUCT_TITLE'); ?>
			</th>
			<th width="30%">
				<?php echo JText::_('COM_PRODUCT_IMAGE'); ?>
			</th>
			<th width="30%">
				<?php echo JText::_('COM_PRODUCT_QUANTITY'); ?>
			</th>
			
		</tr>
		</thead>
		<tfoot>
			<tr>
				<td colspan="8">
					<?php //echo $this->pagination->getListFooter(); ?>
				</td>
			</tr>
		</tfoot>
		<tbody>
			<?php if (!empty($this->items)) : ?>
				<?php foreach ($this->items as $i => $row) :
					//echo "<pre>";
					//print_r($this->items);die; 
					$link = JRoute::_('index.php?option=com_product&task=product.edit&id=' . $row->id);
			?>
					<tr>
						<td>
							<?php echo $this->pagination->getRowOffset($i); ?>
						</td>
						<td>
							<?php echo JHtml::_('grid.id', $i, $row->id); ?>
						</td>
						<td align="center">
							<?php echo JHtml::_('jgrid.published', $row->published, $i, 'products.', true, 'cb'); ?>
						</td>
						<td align="center">
							

							<?php echo $row->id; ?>
						</td>
						<td align="center">
							<a href="<?php echo $link; ?>" title="<?php echo JText::_('COM_PRODUCT_EDIT_PRODUCT'); ?>">
							<?php echo $row->title; ?>
						</td>
						<td align="center">
							<?php echo $row->image; ?>
						</td>
						<td align="center">
							<?php echo $row->quantity; ?>
						</td>
						

					</tr>
				<?php endforeach; ?>
			<?php endif; ?>
		</tbody>
	</table>
	<input type="hidden" name="task" value=""/>
	<input type="hidden" name="boxchecked" value="0"/>
	<?php echo JHtml::_('form.token'); ?>
</form>