<!DOCTYPE html>
<html>

	<head>
	    <title>Programmes - The Wilberforce Association (SL) UK  - <?php echo $aprogr->title; ?></title>
	    <?php echo $css; ?>
	</head>


<body>

<div class="page-wrapper">


    <!-- Main Header -->
    <?php echo $header; ?>

     <section class="page-title" style="background-image:url(<?php echo base_url() . 'uploads/'.$aprogr->image; ?>)">
        <div class="auto-container">
			<h2>Projects</h2>
			<ul class="bread-crumb clearfix">
				<li><a href="<?php echo base_url(). 'home'; ?>">Home</a></li>
				<li><a href="<?php echo base_url(). 'home'; ?>">Projects</a></li>
				<li><?php echo $aprogr->title; ?> Projects</li>
			</ul>
        </div>
    </section>
    
    
    <!-- End Page Title -->

	<!-- Sidebar Page Container -->
    <div class="sidebar-page-container left-sidebar">
    	<div class="auto-container">
        	<div class="row clearfix">
				
				<!-- Sidebar Side -->
                <div class="sidebar-side col-lg-4 col-md-12 col-sm-12">
                	<aside class="sidebar">

						<!-- Service Widget -->
						<div class="sidebar-widget service-widget">
							<h4 class="sidebar-widget_title">Projects</h4>
							<div class="widget-content">
								<ul class="service-list">
									<?php if(isset($progr)) {
                                        foreach($progr as $row) {?>
                                            <li><a href="<?php echo base_url().'home/aprogramme/'. $row->service_id; ?>" >
                                                <?php echo $row->title; ?></a>
                                            </li>
                                    <?php } } ?> 
								</ul>
							</div>
						</div>

						<!-- Help Widget -->
						<div class="sidebar-widget help-widget">
							<div class="widget-content" style="background-image:url(<?php echo base_url(). 'assetsp/images/help-widget.jpg';?>)">
								<div class="help-widget_icon flaticon-whatsapp"></div>
								<h4 class="help-widget_heading">Follow Us <br> WhatsApp </h4>
								<div class="help-widget_call">Chat Us Anytime <br> <a href="http://wa.me/<?php echo $info->whatsapp; ?>">Chat Us Now</a></div>
							</div>
						</div>

					</aside>
				</div>

				<!-- Content Side -->
                <div class="content-side col-lg-8 col-md-12 col-sm-12">
					<div class="service-detail">
						<div class="service-detail_inner">
							<h2 class="service-detail_title"><?php echo $aprogr->title; ?></h2>
							<div class="service-detail_image">
								<img src="<?php echo base_url() . 'uploads/'.$aprogr->image; ?>" alt="" />
							</div>
							<div class="service-detail_content" style="text-align: justify;">
                            	<?php echo $aprogr->description; ?>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>

	<?php echo $footer; ?>

	</div>

	<div class="scroll-to-top scroll-to-target" data-target="html"><span class="fas fa-arrow-up fa-fw"></span></div>

  		<?php echo $js; ?>

	</body>


</html>
