<!DOCTYPE html> 
<html lang="es">
<head>
  <title>.:: Purwo Hadi Web App ::.</title>
  <meta charset="utf-8">
  <link href="<?php echo base_url(); ?>assets/css/admin/global.css" rel="stylesheet" type="text/css">
  	<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/css/menu.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/css/shadowbox.css">
    
	<script type="text/javascript" src="<?=base_url();?>assets/js/jquery.js"></script>
	<script type="text/javascript" src="<?=base_url();?>assets/js/function.js"></script>
	<script type="text/javascript" src="<?=base_url();?>assets/js/shadowbox.js"></script>
	<script type='text/javascript'> 
		Shadowbox.init({ 
		overlayColor: "#000", 
		overlayOpacity: "0.6", 
		 displayNav: true,
	}); 


</script> 
</head>
<body>
<div id="wrap">
	<header>
		<div class="inner relative">
			<a class="logo" href="#"><br><br></a>
			
			<nav id="navigation">
				<ul id="main-menu">
					<li class="current-menu-item">
                        <a href="<?php echo base_url(); ?>admin/home">Home</a>
                    </li>
					<li>
	          			<a href="<?php echo base_url(); ?>admin/buku">Buku</a>
	       			 </li>
					
					<li class="parent">
						<a href="#">Member</a>
						<ul class="sub-menu">
							<li><a href="#"><i class="icon-wrench"></i> Anggota</a></li>
							<li><a href="#"><i class="icon-wrench"></i> petugas</a></li>
						</ul>
					<li>
					<a href="<?php echo base_url(); ?>/index.php/user/logout">Logout</a></li>
				</ul>
			</nav>
			<div class="clear"></div>
		</div>
	</header>	
</div>    
