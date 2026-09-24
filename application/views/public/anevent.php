<!DOCTYPE html>
<html>

	<head>
	    <title>Events - The Wilberforce Association (SL) UK - <?php echo $anevent->title; ?></title>
	    <?php echo $css; ?>
	</head>

<body>

<div class="page-wrapper">
	
    <?php echo $header; ?>
	

	<!-- Page Title -->
    <section class="page-title" style="background-image:url(<?php echo base_url() . 'uploads/'.$anevent->thumbnail; ?>)">
        <div class="auto-container">
			<h2><?php echo $anevent->title; ?></h2>
			<ul class="bread-crumb clearfix">
				<li><a href="<?php echo base_url(). 'home'; ?>">Home</a></li>
				<li><a href="<?php echo base_url(). 'home/events'; ?>">Event</a></li>
				<li><?php echo $anevent->title; ?></li>
			</ul>
        </div>
    </section>
   

	<!-- Sidebar Page Container -->
    <div class="sidebar-page-container">
    	<div class="auto-container">
        	<div class="row clearfix">
				
				<!-- Content Side -->
                <div class="content-side col-lg-8 col-md-12 col-sm-12">
					<div class="blog-classic">

						<!-- News Block -->
						<div class="news-block_one">
							<div class="news-block_one-inner">
								<div class="news-block_one-image">
									<div class="news-block_one-date">
									    <?php echo strftime('%d',strtotime($anevent->eventday)) ; ?> <br /> <span>
										<?php echo substr(strftime('%B',strtotime($anevent->eventday)), 0,3) ; ?></span><br />
										<span style="font-size: 12px;"><?php echo substr(strftime('%Y',strtotime($anevent->eventday)), 0,4) ; ?></span><br />
										</div>
									<a href="#"><img src="<?php echo base_url() . 'uploads/'.$anevent->thumbnail; ?>" alt="" /></a>
									
								</div>
								<div class="news-block_one-content">
									
									<h4 class="news-block_one-heading"><a href="#"><?php echo $anevent->title; ?></a></h4>
									<div class="news-block_one-text"><?php echo $anevent->body; ?></div>
								</div>
							</div>
						</div>

						<!--<?php if(!empty($anevent->videolink)){ ?>-->
						<!--	<div class="video-box">-->
						<!--		<figure class="video-image">-->
						<!--			<img src="<?php echo base_url().'uploads/'.$anevent->thumbnail; ?>" alt="" />-->
						<!--			<a href="https://www.youtube.com/watch?v=<?php echo $anevent->videolink; ?>" class="lightbox-video overlay-box"><span class="fa-solid fa-play fa-fw"><i class="ripple"></i></span></a>-->
						<!--		</figure>-->
						<!--	</div>-->
					 <!-- 	<?php } ?>-->
						
					</div>

				</div>

				<!-- Sidebar Side -->
                <div class="sidebar-side col-lg-4 col-md-12 col-sm-12">
                	<aside class="sidebar padding-left">
						<div class="sidebar-widget_two post-widget">
							<div class="widget-content">
								<h4 class="sidebar-widget_title">Recent Events</h4>
								<?php if(isset($oevent)) {
                                    foreach($oevent as $row) {?> 
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

						<!-- Service Widget -->
						<div class="sidebar-widget_two category-widget">
							<div class="widget-content">
								<h4 class="sidebar-widget_title">Programmes</h4>
								<ul class="service-list_two">
									<?php if(isset($progr)) {
                                        foreach($progr as $row) {?>
                                        <li><a href="<?php echo base_url().'home/aprogramme/'. $row->service_id; ?>"><?php echo $row->title; ?></a></li>
                                    <?php } } ?> 
								</ul>
							</div>
						</div>
					</aside>
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
