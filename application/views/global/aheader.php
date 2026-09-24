<div class="navbar-inner">
	<div class="container-fluid">
		<!-- BEGIN LOGO -->
		<a class="brand" href="#">
		<img src="<?php echo base_url() . 'assetsa/img/logonew.png'; ?>" alt="logo" />
		</a>
		<!-- END LOGO -->
		<!-- BEGIN RESPONSIVE MENU TOGGLER -->
		<a href="javascript:;" class="btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse">
		<img src="<?php echo base_url() . 'assetsa/img/menu-toggler.png'; ?>" alt="" />
		</a>          
		<!-- END RESPONSIVE MENU TOGGLER -->            
		<!-- BEGIN TOP NAVIGATION MENU -->              
		<ul class="nav pull-right">
			<!-- BEGIN USER LOGIN DROPDOWN -->

			<li class="dropdown user">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
				Welcome <?php echo $this->session->userdata('surname'); ?>
				<img alt="" src="<?php echo base_url() . 'uploads/'.$this->session->userdata('image').'.jpg'; ?>" width=29px height=29px />
				<i class="icon-angle-down"></i>
				</a>
				<ul class="dropdown-menu">
					<li class="divider"></li>
					<li><a href="<?php echo base_url() . 'admin/changepass'; ?>"><i class="icon-lock"></i> Change Password</a></li>
					<li class="divider"></li>
					<li><a href="<?php echo base_url() . 'admin/signout'; ?>"><i class="icon-key"></i> Log Out</a></li>
				</ul>
			</li>
			<!-- END USER LOGIN DROPDOWN -->
		</ul>
		<!-- END TOP NAVIGATION MENU --> 
	</div>
</div>