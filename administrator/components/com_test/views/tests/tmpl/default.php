<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_helloworld
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted Access');

JHtml::_('formbehavior.chosen', 'select');

$listOrder     = $this->escape($this->state->get('list.ordering'));
$listDirn      = $this->escape($this->state->get('list.direction'));
?>
<form action="index.php?option=com_test&view=tests" method="post" id="adminForm" name="adminForm">
	<div id="j-sidebar-container" class="span2">
		<?php echo JHtmlSidebar::render(); ?>
	</div>
	<div id="j-main-container" class="span10">
	<div class="row-fluid">
		
	</div>
	<table class="table table-striped table-hover">
		<thead>
		<tr>
			<th width="2%"><?php echo JText::_('COM_TEST_NUM'); ?></th>
			<th width="3%">
				<?php echo JHtml::_('grid.checkall'); ?>
			</th>

			<th width="5%">
				<?php echo JHtml::_('searchtools.sort','COM_TEST_PUBLISHED','published',$listDirn, $listOrder); ?>
			</th>
			<th width="5%">
				<?php echo JHtml::_('searchtools.sort', 'COM_TEST_ID', 'id', $listDirn, $listOrder); ?>
			</th>
			<th width="15%">
				<?php echo JHtml::_('searchtools.sort', 'COM_TEST_TESTS_TITLE', 'catetitle', $listDirn, $listOrder); ?>
			</th>
			<th width="15%">
				<?php echo JHtml::_('searchtools.sort', 'COM_TEST_TESTS_PARENTCAT', 'parentcat', $listDirn, $listOrder); ?>
			</th>
			<th width="15%">
				<?php echo JHtml::_('searchtools.sort', 'COM_TEST_IMAGE', 'image', $listDirn, $listOrder); ?>
			</th>
			<th width="15%">
				<?php echo JHtml::_('searchtools.sort', 'COM_TEST_TESTS_SHORT_DESC', 'short_desc', $listDirn, $listOrder); ?>
			</th>
			<th width="25%">
				<?php echo JHtml::_('searchtools.sort', 'COM_TEST_TESTS_DES', 'des', $listDirn, $listOrder); ?>
			</th>
			
		</tr>
		</thead>
		<tfoot>
			<tr>
				<td colspan="5">
					<?php echo $this->pagination->getListFooter(); ?>
				</td>
			</tr>
		</tfoot>
		<tbody>
			<?php if (!empty($this->items)) : ?>
				<?php foreach ($this->items as $i => $row) : 
					$link = JRoute::_('index.php?option=com_test&task=test.edit&id=' . $row->id);
					//echo "<pre>";
					//print_r($this->items);
					//die();
				?>

					<tr>
						<td>
							<?php echo $this->pagination->getRowOffset($i); ?>
						</td>

						<td>
							<?php echo JHtml::_('grid.id', $i, $row->id); ?>
						</td>

						<td align="center">
							<?php echo JHtml::_('jgrid.published', $row->published, $i, 'tests.', true, 'cb'); ?>
						</td>

						<td align="center">
							<?php echo $row->id; ?>
						</td>
						
						<td align="left">
							<a href="<?php echo $link; ?>" title="<?php echo JText::_('COM_HELLOWORLD_EDIT_HELLOWORLD'); ?>">
							<?php echo $row->catetitle; ?>
							</a>
							<div class="small">
								<?php echo JText::_('JCATEGORY') . ': ' . $this->escape($row->category_title); ?>
							</div>
						</td>
						<td>
							<?php echo $row->parentcat; ?>
						</td>
						
						<td>
							<?php echo $row->image; ?>
						</td>
						<td>
							<?php echo $row->short_desc; ?>
						</td>
						<td>
							<?php echo $row->des; ?>
						</td>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>
		</tbody>
	</table>

	<input type="hidden" name="task" value=""/>
	<input type="hidden" name="boxchecked" value="0"/>
	
	<?php echo JHtml::_('form.token'); ?>
</div>
</form>