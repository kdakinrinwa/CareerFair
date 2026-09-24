<!DOCTYPE html>
<html>

	<head>
	    <title><?php echo $page->pagetitle; ?> - The Wilberforce Association (SL) UK </title>
	    <?php echo $css; ?>
	</head>


<body>

<div class="page-wrapper">
	
    <!-- Preloader -->
    <div class="preloader"></div>

    <!-- Main Header -->
    <?php echo $header; ?>

	<!-- Page Title -->
    
    <section class="page-title" style="background-image:url(<?php echo base_url() . 'uploads/'.$page->pageheadimg.'.jpg'; ?>)">
        <div class="auto-container">
			<h2><?php echo $page->menutext; ?></h2>
			<ul class="bread-crumb clearfix">
				<li><a href="<?php echo base_url(). 'home'; ?>">Home</a></li>
				<li><?php echo $page->pagetitle; ?></li>
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
							<h4 class="sidebar-widget_title">Programmes</h4>
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

						<div class="sidebar-widget_two post-widget">
							<div class="widget-content">
								<h4 class="sidebar-widget_title">Events</h4>
								<?php if(isset($event)) {
                                    foreach($event as $row) {?> 
									<div class="post">
										<div class="thumb">
											<a href="<?php echo site_url('home/viewevent').'/'. $row->newsid; ?>">
											<img src="<?php echo base_url().'uploads/'.$row->thumbnail; ?>" alt=""></a>
										</div>
										<h6>
											<a href="<?php echo site_url('home/viewevent').'/'. $row->newsid; ?>">
												<?php echo $row->title; ?>
											</a>
										</h6>
										<div class="post-date">
											<?php echo strftime('%d',strtotime($row->eventday)) ; ?>  
											<span> <?php echo substr(strftime('%B',strtotime($row->eventday)), 0,3) ; ?></span> 
											<?php echo substr(strftime('%Y',strtotime($row->eventday)), 0,4) ; ?>
										</div>
									</div>
								<?php } } ?> 

							</div>
						</div>
					</aside>
				</div>

				<!-- Content Side -->
                <div class="content-side col-lg-8 col-md-12 col-sm-12">
					<div class="service-detail">
						<div class="service-detail_inner">
							<h2 class="service-detail_title"><?php echo $page->menutext; ?></h2>
							<div class="service-detail_content" style="text-align: justify;">
                            	<?php echo $page->pagebody; ?>
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
