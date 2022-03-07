<div class="full" style="width: 100%;display: block;">
	<div class="row" style="display: flex;column-gap: 3px;justify-content: space-between;row-gap: 10px;flex-flow: wrap;flex-direction: row;">
		<?php 
		if (!empty($this->items)) :?>
			<?php foreach ($this->items as $i => $row) :?>
				<div class="col-sm-3" style="display: block;box-sizing: border-box;background: #eeeeee;height: 25%;">
					<div class="image" style="height: 55%;">
						
							<?php
							//echo JText::_('COM_PRODUCT_IMAGE'); 
							//echo $row->image; 
							$img = $row->image;
				            $root = JURI::root().'images/'.$img;
				            // echo "<pre>";
				            // print_r($root);
				            // die("sds");

						?>
					<a href="<?php 
						echo JRoute::_('index.php?option=com_test&view=product&id=' . (int) $row->id);
						// echo "<pre>";
						// print_r($this->items);
						// die("sdf");


					 ?>">	
					 <img src="<?php echo $root; ?>" height="150px" width="150px"></a>
					</div>
					<div class="details" style="height: 10%;column-count: 2;">
						<div class="left-title" style="width: 50%;">
							<?php 
								//echo JText::_('COM_PRODUCT_TITLE'); 
								echo $row->title; 
							?>
						</div>
						<div class="rig-quan" >
							<?php 
								//echo JText::_('COM_PRODUCT_QUANTITY'); 
								echo $row->quantity; 
							?>
						</div>
						<div class="shode">
					</div>
				</div>
		<?php endforeach; ?>
			<?php endif; ?>

		<!-- <div class="id2" style="border: box-sizing;display: block;box-sizing: border-box;background: #095197;width: 25%;">
		
		</div>
		<div class="id3" style="border: box-sizing;display: block;box-sizing: border-box;background: #e5e3ad;width: 25%;">
		
		</div>
		<div class="id4" style="border: box-sizing;display: block;box-sizing: border-box;background: #e5e3ad;width: 25%;">
		
		</div> -->
		

	</div>
</div>
	




<!-- <form action="index.php?option=com_test&view=products" method="post" id="adminForm" name="adminForm">
	<div id="j-sidebar-container" class="span2">
			<thead>
				<tr>
					<th width="1%"><?php echo JText::_('COM_PRODUCT_ID'); ?>
					</th>
					<th width="5%"><?php echo JText::_('COM_PRODUCT_TITLE'); ?>
					</th>
					<th width="1%"><?php echo JText::_('COM_PRODUCT_CATEGORY_ID'); ?>
					</th>
					<th width="50%"><?php echo JText::_('COM_PRODUCT_IMAGE'); ?>
					</th>
					<th width="3%"><?php echo JText::_('COM_PRODUCT_QUANTITY'); ?>
					</th>
				</tr>
			</thead>
			<tbody>
				<?php if (!empty($this->items)) : ?>
				<?php foreach ($this->items as $i => $row) :?>
				<tr>
					<td>
					<?php echo $row->id;?>
					</td>
					<td>
						<?php echo $row->title; ?>
					</td>
					<td>
						<?php echo $row->catid; ?>
					</td>
					<td>
						<?php echo $row->image; ?>
					</td>
			
					<td>
						<?php echo $row->quantity; ?>
					</td>
			
				</tr>
				<?php endforeach; ?>
			<?php endif; ?>
		
			</tbody>

</div>
</form> -->

