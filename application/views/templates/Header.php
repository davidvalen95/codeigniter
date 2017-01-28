<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	
	if($this->session->flashdata()){
		$flashdata 		= $this->session->flashdata(); 
	}elseif(isset($notification)){
		$flashdata = $notification;
	}
	
	$menuHeader		= array("Home"=>base_url(), "Produk"=>base_url()."produk", "Kontak"=>"#");

/*
 * wajib
 * 	title
 * 	description
 * 	active
 * 
 * optional
 * 	script berisi tag load javascript
 * 	noHeader berisi bebas
 */	

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	
	<title><?php echo $title; ?></title>
	<meta name="description" content="<?php echo $description; ?>">
	
	<!--untuk device-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!--<link href="https://fonts.googleapis.com/css?family=Arvo" rel="stylesheet"> -->
	<link href="https://fonts.googleapis.com/css?family=Droid+Sans" rel="stylesheet"> 
	<link href="https://fonts.googleapis.com/css?family=Maven+Pro" rel="stylesheet"> 
	<link rel='stylesheet' type='text/css' href='<?php echo base_url();?>css/normalise.css'>
	<link rel='stylesheet' type='text/css' href='<?php echo base_url();?>css/main.css'>
	<link rel='stylesheet' href='<?php echo base_url()?>css/open-iconic/font/css/open-iconic.css'>
	
	<link rel="stylesheet" type='text/css' href="<?php echo base_url();?>css/allPx.css" media="all and (min-width: 0px)" >
	<link rel="stylesheet" type='text/css' href="<?php echo base_url();?>css/420px.css"  media="all and (max-width: 420px)">
	<link rel="stylesheet" type='text/css' href="<?php echo base_url();?>css/720px.css"  media="all and (max-width: 720px)">
	<link rel="stylesheet" type='text/css' href="<?php echo base_url();?>css/1020px.css"  media="all and (max-width: 1020px)">
	
	<script src='<?php echo base_url();?>javascript/jQuery.js'></script>
	<script src='<?php echo base_url();?>javascript/main.js'></script>
	<script src='<?php echo base_url();?>javascript/responsive.js'></script>
	
	<script src='<?php echo base_url();?>plugin/magnific-popup/jquery.magnific-popup.min.js'></script>
	<link rel='stylesheet' type='text/css' href='<?php echo base_url();?>plugin/magnific-popup/magnific-popup.css'>
	
	<script src='<?php echo base_url();?>plugin/slick/slick.js'></script>
	<link rel='stylesheet' type='text/css' href='<?php echo base_url();?>plugin/slick/slick.css'>
	<link rel='stylesheet' type='text/css' href='<?php echo base_url();?>plugin/slick/slick-theme.css'>
	
	
	<?php if(isset ($script))echo $script;?>
</head>
<body>
	<!--<div id='wrapper'>-->
	<div id='dataGlobal' data-iduser='<?php echo decodeMemory('cookie',"idUser")?>' data-baseurl='<?php echo base_url();?>' ></div>
	<?php if(!isset($noHeader))
		{
		?>
	
	<?php
		if(isset($carousel)){
			echo"
				<div id='information' class='hide1020 container'>
		
				</div> <!--container-->
			";
		}
	?>
	<header id='navbar' class="navbar paddingAll20">
		<div class='group'>
			<a href='<?php echo base_url();?>'><img class='center img' alt='Hasta Sampurna' title='Hasta Sampurna' src='<?php echo base_url();?>image/logo_hasta_navbar.png'></a>
			<ul class=' marginTop30'>
				<?php foreach($menuHeader as $menu => $link){
					$lowerMenu 		= strtolower($menu);
					$class 		= ($lowerMenu == $active ? "active" : "");
					echo "<li><a class=' $class' href='$link'><span>$menu</span></span></a></li>";
				}?>
				
			</ul>
		</div>
		<!--
		<ul class='bottom'>
					<li><a><span>facebook</span></a></li>
					<li><a><span>twitter</span></a></li>
					<li><a><span>Klampis</span></a></li>
				</ul>-->
		
	</header>
	
	<?php
	if(isset($flashdata['messege'])){
		$tipe 		= $flashdata['tipe'];
		$messege	= $flashdata['messege'];
		
		echo"
		<div id='notification' class='$tipe'>
			<div class='container'>
				<div class='innerContainer padding10'>
					$messege
					<span class='oi right option2 closeParent' data-parent='notification' data-glyph='x'></span>
				</div>
			</div>
		</div>
		";
	}
	?>
	<?php } ?>
	<?php if(!isset($noTop)){?>
	<div class='container'>
		<div class='innerContainer'>
			<div class='backgroundAccent padding20'>
				<img class='img center  ' src='<?php echo base_url();?>image/logo-hasta.jpg'>
			</div>
		</div>
		
	</div>
	<?php }?>