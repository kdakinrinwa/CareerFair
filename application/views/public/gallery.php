<!DOCTYPE html>
<html>

	<head>
	    <title>Pictures - The Wilberforce Association (SL) UK </title>
	    <?php echo $css; ?>
	</head>

<body>

<div class="page-wrapper">
	
    <?php echo $header; ?>

	<!-- Projects One -->
	<section class="projects-one">
		<div class="auto-container">
			<div class="row clearfix">
				
				<?php if(isset($gallery_pics)) {
                    foreach($gallery_pics as $row) {?>
						<div class="gallery-block_one col-lg-4 col-md-6 col-sm-12">
							<div class="gallery-block_one-inner">
								<div class="gallery-block_one-image">
									<img src="<?php echo base_url().'uploads/'.$row->image; ?>" alt="" />
									<div class="gallery-block_one-overlay">
										<div class="gallery-block_one-content">
											
										</div>
									</div>
								</div>
							</div>
						</div>
				<?php } } ?>
		</div>
	</section>
	<!-- End Projects One -->

	<?php echo $footer; ?>

	</div>

	<div class="scroll-to-top scroll-to-target" data-target="html"><span class="fas fa-arrow-up fa-fw"></span></div>

  		<?php echo $js; ?>

	</body>


</html>
