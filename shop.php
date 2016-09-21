<div class="content">
	<?php while ($product = mysqli_fetch_object($result)) {	?>
	<div class="item">
		<div class="itemimage"><img src="images/products/<?php echo $product->id ?>.jpg" height="300px" width="300px"/></div>
		<div class="iteminfo">
			<label class="largetext"><b><?php echo $product->name; ?></b></label>
			<p><?php echo $product->description; ?></p>
			<label class="bold">Category: <?php echo $product->category; ?></label><br/><br/>
			<label class="largetext"><b>Price: Rs. <?php echo number_format($product->price,2)?></b></label><br/><br/>
			<label class="bold"><?php echo $product->stock; ?> Items left</label>
			<br/></br>
			<a href="cart.php?id=<?php echo $product->id."&action=back"; ?>"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i>&nbsp;Add to Cart</a>
			</br>
		</div>
	</div>
	<hr style="height:1px; padding:0px; margin:2px;"/>
	<?php } ?>
</div>
