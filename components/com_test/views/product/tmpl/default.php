<?php  

// echo "<pre>";
// print_r($this->item->id);
// die("sdfffw");

	$img = $this->item->image;
    $root = JURI::root().'images/'.$img;

?>

<div class="main" style="column-count: 2;">
	<div class="img" width="30%">
		<img src="<?php echo $root; ?>" width="400px" height="400px">
	</div>
	<div class="deta" width="70%" style="background-color: #f0f0f0;height: 400px;">
		<div class="tit">
			<?php echo $this->item->title; ?>
		</div>
		<div class="quan">
			<?php echo $this->item->quantity; ?>
		</div>
	</div>
</div>

