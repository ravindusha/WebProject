<?php
require 'header.php';
?>

<center>
<div id="">
	<p id="intro" >Looking for professional make-up <br>at an affordable price?</p>
	<p id="description" >Discover the latest beauty at Lovender Cosmetics,<br> explore our unrivaled selection of beauty products,<br> including face make-up and a full range top quality makeup.<br><br><label>Find your favourite make-up, add to cart...<br>We turn your woes into WOWs... on the double!<br><br><a href="viewitems.php?type=all">Shop Now!</a><br><br>Free shipping and return on all orders</label></p>
	<div class="slider" style="z-index:0;">
	<img src="images/slider/01.jpg">
	<img src="images/slider/02.jpg">
	<img src="images/slider/03.jpg">
	<img src="images/slider/04.jpg">
	<img src="images/slider/05.jpg">
	</div>
	<script src="js/jquery.min.js"></script>
	<script src="js/sss.min.js"></script>
	<script>
			$('.slider').sss({
				slideShow:true,
				transition : 1000
			});
</script>

</div>
</center>


<?php
require 'footer.php';
?>