<!DOCTYPE html>
<html>
<head>

<?php if(isset($this->config->item('page_meta')->page_meta_title) && $this->config->item('page_meta')->page_meta_title !=""){ ?>
	<title><?php echo strtoupper($this->config->item('page_meta')->page_meta_title); ?></title>
	
<?php }else{ ?>
	<title>Educateus</title>
<?php } ?>
<meta name=viewport content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
<meta charset="UTF-8">
<link rel="icon" href="<?php echo base_url(); ?>assets/site/images/favicon.ico" type="image/x-icon">

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/site/css/layout.css">
<link href="<?php echo base_url(); ?>assets/site/css/screen.css" rel="stylesheet"  />



</head>

<body>

<!-- start header -->

<header>
  <div class="top_header">
    <ul>
      <li><img src="<?php echo base_url(); ?>assets/site/images/phone.png" alt=""><a href="tel:<?php echo $this->config->item('phone');?>"><?php echo $this->config->item('phone');?></a></li>
      <li><img src="<?php echo base_url(); ?>assets/site/images/email.png" alt=""><a href="mailto:<?php echo trim($this->config->item('Email'));?>"> <?php echo trim($this->config->item('Email'));?></a></li>
      <li><a href="<?php echo base_url().'exhibitor-register';?>" class="bg">Register as Exhibitor</a></li>
      <li> <a href="javascript:void(0);" class="search bg"><img src="<?php echo base_url(); ?>assets/site/images/search.png" alt=""> Search</a> <span class="search_box">
        <form id="common_search" class="input-group" method="get" action="<?php echo base_url(); ?>search">
		<input type="search" id="common_query" name="query" value="" placeholder="Search.....">
        </span> </li>
		</form>
    </ul>
  </div>
  <div class="bottom_header">
    <div class="logo"><a href="<?php echo $this->config->item('headerLogoUrl1'); ?>"><img src="<?php echo base_url().$this->config->item('headerLogo1'); ?>" alt="Educatus"></a></div>
    <nav>
      <div class="sb-toggle-right  top_click"> <a href="javascript:void(0);">
        <div class="three_line three_line--htx"><span>toggle menu</span> </div>
        </a></div>
      <ul>
	  
	  <?php $menu = $this->common_model->get_header_menu(); 
			foreach($menu as $menus){
			
			if($menus->parent_id == 0){	
	  ?>
			<li><a href="<?php echo $menus->link; ?>"><?php echo $menus->name; ?></a>
			
				<?php $submenu = $this->db->get_where('edu_menu', array('parent_id'=>$menus->id))->result(); 
					
					if(sizeof($submenu)){
					
					$k = 0;
			?>
					<ul class="sub_menu">
					<?php foreach($submenu as $chsp){ ?>
					<li><a href="<?php echo $chsp->link; ?>"><?php echo  $chsp->name; ?></a></li>
					<?php $k++; } ?>
					
				  </ul>
					<?php } ?>
			</li>
			
			
	<?php }
		}	?>
        <!--<li><a href="aboutus.html">about</a></li>
        <li> <a href="exhibitions.html"> Exhibitions </a>
        
        <span class="drop_mrnu"></span>
        
          <ul class="sub_menu">
            <li><a href="kota.html">Kota</a></li>
            <li><a href="#">New Delhi</a></li>
            <li><a href="#"> Jamshedpur</a></li>
            <li><a href="#"> Ranchi</a></li>
            <li><a href="#">Palampur</a></li>
            <li><a href="#">Patna</a></li>
            <li><a href="#"> Chandigarh</a></li>
            <li><a href="#"> Jammu</a></li>
            <li><a href="#"> Srinagar</a></li>
          </ul>
        </li>
        <li><a href="counselling.html"> Counselling</a></li>
        <li><a href="scholarship.html"> Scholarship </a></li>
        <li><a href="news.html"> News </a></li>
        <li><a href="gallery.html"> Gallery </a></li>
        <li><a href="register-online.html"> Register Online </a></li>
        <li><a href="faq.html"> FAQ </a></li>
        <li><a href="international-presence.html"> international presence</a></li>
        <li><a href="contactus.html"> Contact us </a></li>-->
      </ul>
    </nav>
  </div>
</header>

 <div class="socail">
    <ul>
      <li><a href="<?php echo $this->config->item('fbUrl'); ?>"><img src="<?php echo base_url(); ?>assets/site/images/facebook.png" alt=""></a></li>
      <li><a href="<?php echo $this->config->item('twitterUrl'); ?>"><img src="<?php echo base_url(); ?>assets/site/images/twitter.png" alt=""></a></li>
      <li><a href="<?php echo $this->config->item('google_url'); ?>"><img src="<?php echo base_url(); ?>assets/site/images/google_plus.png" alt=""></a></li>
      <li><a href="<?php echo $this->config->item('linkedin_url'); ?>"><img src="<?php echo base_url(); ?>assets/site/images/linkand.png" alt=""></a></li>
    </ul>
  </div>
</section>
<!-- end header --> 