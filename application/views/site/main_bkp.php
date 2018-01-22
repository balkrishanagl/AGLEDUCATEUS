<div class="grey_strip">
	<div class="wrapper">			
		<p>Registration for Sept'15-Feb'16 Session Closed from 1st August 2015</p>
		<div class="blu_btn"><a href="javascript:void(0);">Register Now</a></div>
	</div>
</div>
<div class="about_box">
	<div class="wrapper">
		<div class="about">
			<h1>About Us</h1>
			<p><?php echo substr($about_data->page_content, 0,689); ?> </p>
			<div class="blu_btn"><a target="_blank" href="<?php echo base_url(); ?>page/about">Know More</a></div>
		</div>
		<div class="right_content">
			<ul>
				<li>
				  <h3><img src="<?php echo base_url();?>assets/site/img/course.png" alt=""> About Course</h3>
				  <div class="content_left">
					<p>Federation of Indian Chambers of Commerce and Industry (FICCI) has started Online Certificate Course on Competition Law & Intellectual Property Rights (IPComp).</p>
				  </div>
				</li>
				<li>
				  <h3><img src="<?php echo base_url();?>assets/site/img/regi.png" alt="">Registration Procedure</h3>
				  <div class="content_left">
					<p>Those interested are required to visit our courses website www.ficciipcourse.in and follow the link for the “Online Certificate Course on Competition Law and IPR” </p>
				  </div>
				</li>
				<li>
				  <h3><img src="<?php echo base_url();?>assets/site/img/eligibilty.png" alt=""> Eligibility</h3>
				  <div class="content_left">
					<p>Online Certificate Course on Intellectual Property Rights & Competition Law (IPComp) is specially designed for Career Aspirants, Practitioners, working Professionals, Students of Law, Business Management, Lawyers Company Secretaries (CS) to acquire relevant professional skills.</p>
				  </div>
				</li>
			</ul>
			<ul>
				<li>
				  <h3><img src="<?php echo base_url();?>assets/site/img/methology.png" alt=""> Course Methodology</h3>
				  <div class="content_left">
					<p>The Conduct of the Online Course would be divided into 2 stages:</p>
					<p><strong>Stage 1:</strong> Study materials will be delivered online as per the schedule.</p>
					<p><strong>Stage 2:</strong> Examination and Issue of certificate after successful completion of course </p>
				  </div>
				</li>
				<li>
				  <h3><img src="<?php echo base_url();?>assets/site/img/rewards.png" alt=""> Rewards</h3>
				  <div class="content_left">
					<p><strong>We offer:</strong></p>
					<ol>
					  <li>Certification on successful completion of the course.</li>
					  <li>Internship opportunity and free participation in all FICCI IP related events.</li>
					  <li>Toppers will be awarded with a prize money.</li>
					</ol>
				  </div>
				</li>
				<li>
				  <h3><img src="<?php echo base_url();?>assets/site/img/fees.png" alt=""> Course Duration and Fees</h3>
				  <div class="content_left">
					<p>Duration: 2 Months</p>
					<p><strong>Fees:</strong></p>
					<p>For students : Rs. 6500/-</p>
					<p>For Industry Professionals : Rs. 8500/-</p>
					<p>For Others : Rs. 8500/-</p>
				  </div>
				</li>
			</ul>
		</div>
	</div>
</div>
<div class="thumbline">
	<ul>
		<li>
			<div class="middle_cont"> <img src="<?php echo base_url();?>assets/site/img/thumb_logo.png" alt="">
				<p class="course">Course</p>
				<p class="cov">Coverage</p>
			</div>
		</li>
		<?php foreach ($course_data as $course_datas) {  ?>
		<li> 
			<img src="<?php echo base_url();?>uploads/course/<?php echo $course_datas->cour_icon; ?>" alt="">
			<span class="blckbg"></span>
			<div class="middle_cont">
				<p class="course"><?php echo $course_datas->cour_abbr_name; ?></p>
				<p class="cov"><?php echo $course_datas->cour_name; ?></p>
			</div>
			<div class="blu_btn"><a href="#">Know More</a></div>
		</li>
		<?php } ?>
		<!-- <li>
			<img src="<?php echo base_url();?>assets/site/img/m2.jpg" alt="">
			<span class="blckbg"></span>
			<div class="middle_cont">
				<p class="course">Module-Ii</p>
				<p class="cov">Competition Law in India</p>
			</div>
			<div class="blu_btn"><a href="#">Know More</a></div>
		</li>
		<li>
			<img src="<?php echo base_url();?>assets/site/img/m3.jpg" alt="">
			<span class="blckbg"></span>
			<div class="middle_cont">
				<p class="course">Module-Iii</p>
				<p class="cov">Anti-Competitive Practices in Regulated Sectors</p>
			</div>
			<div class="blu_btn"><a href="#">Know More</a></div>
		</li>
		<li>
			<img src="<?php echo base_url();?>assets/site/img/m4.jpg" alt="">
			<span class="blckbg"></span>
			<div class="middle_cont">
				<p class="course">Module-Iv</p>
				<p class="cov">International aspects of Competition law</p>
			</div>
			<div class="blu_btn"><a href="#">Know More</a></div>
		</li>
		<li>
			<img src="<?php echo base_url();?>assets/site/img/m5.jpg" alt="">
			<span class="blckbg"></span>
			<div class="middle_cont">
				<p class="course">Module-v</p>
				<p class="cov">Competition law and Intellectual Property Law in Pharmaceutical Sector</p>
			</div>
			<div class="blu_btn"><a href="#">Know More</a></div>
		</li>
		<li>
			<img src="<?php echo base_url();?>assets/site/img/m6.jpg" alt="">
			<span class="blckbg"></span>
			<div class="middle_cont">
				<p class="course">Module-VI</p>
				<p class="cov">Standard Essential Patents (SEP) and FRAND Licensing</p>
			</div>
			<div class="blu_btn"><a href="#">Know More</a></div>
		</li> -->
		<li>
			<div class="middle_cont">
				<a href="#"> View All
					<p><img src="<?php echo base_url();?>assets/site/img/right_arrow.png" alt=""></p>
				</a>
			</div>
		</li>
	</ul>
</div>
<!-- start learn box -->
<div class="learn_box">
  <div class="wrapper">
    <h1>Learn IP & Competition law Online</h1>
    <ul>
      <li> <img src="<?php echo base_url();?>assets/site/img/icon1.png" alt="">
        <h2>About the Course</h2>
        <p>This advance course provides dual benefits of learning Competition Law & IPRs challenges faced by Corporations when they expand in an organic or non-organic manner into new territories, markets and products.</p>
      </li>
      <li> <img src="<?php echo base_url();?>assets/site/img/icon2.png" alt="">
        <h2>Career Assistance</h2>
        <p>This course is designed to advance your technical and professional skills, knowledge and understanding of the IP Protection & Commercialization.</p>
      </li>
      <li> <img src="<?php echo base_url();?>assets/site/img/icon3.png" alt="">
        <h2>Certification</h2>
        <p>We offer certification on successful completion of the course which will add value to your career and enhance your profile.</p>
      </li>
      <li> <img src="<?php echo base_url();?>assets/site/img/icon4.png" alt="">
        <h2>How it works?</h2>
        <p>We provide a research based approach for learning through case studies, video lectures, assignments, discussion forum and work in close consultation with industry leaders and IP experts.</p>
      </li>
    </ul>
  </div>
</div>
<!-- end learn box --> 
<!-- start our latest -->
<div class="news_events">
	<div class="wrapper">
		<h1>Our Latest News & Events</h1>
		<?php
			$i=1;
		 foreach ($event_data as $event) {
			# code...
			if($i==1){
			?>	
			
		<div class="latest_news"> <img src="<?php echo base_url();?>/uploads/event/<?php echo $event->even_featured_image; ?>" alt="">
		  <div class="data">
			<p class="date"><?php echo date('F d, Y',strtotime($event->date)); ?></p>
			<p><?php echo $event->name; ?></p>
			<a href="#">More</a> </div>
		</div>
		<?php }
			$i++;
		} ?>
		<div class="event_list">
		  <ul>
		  <?php
			$i=1;
		 foreach ($event_data as $event) {
			# code...
			if($i!=1){
			?>	
			<li>
			  <div class="thumb"><img src="<?php echo base_url();?>/uploads/event/<?php echo $event->even_featured_image; ?>" alt=""></div>
			  <div class="content">
				<p class="date"><?php echo date('F d, Y',strtotime($event->date)); ?></p>
				<p><?php echo $event->name; ?></p>
				<a href="#">More</a> </div>
			</li>
			<?php }
			$i++;
		} ?>
			
		  </ul>
		</div>
		<div class="subcribe">
			<img src="<?php echo base_url();?>assets/site/img/sub-icon.png" alt="">
			<h3>Subscribe</h3>
			<p>to our newsletter</p>
			<form method="post" action="" id="subscriber">
				<ul>
					<li>
						<input class="form-control" id="name_subscriber" placeholder="Name" type="text" name="name" required>
					</li>
					<li>
						<input class="form-control" id="email_subscriber" type="text" placeholder="Email" name="email" required>
					</li>
					<li>
						<input class="form-control" id="number_subscriber" type="text" placeholder="Contact" name="mobile" required>
					</li>
					<li>
						<input class="btn" type="submit" onclick="submit_subscriber()" value="Subscribe"/>
						<span id="message"></span>
					</li>
				</ul>
			</form>
		</div>
	</div>
</div>
<section class="tesimonials">
	<div class="testi_box">
		<div class="slider_box">
			<h1>Testimonials</h1>
			<div class="pager_slick_outer">
				<div class="pager_slick">
					<div class="slider slider-nav">
					<?php foreach($testimonial_data as $testimonial) { ?>
						<div id="testiImg_<?php echo $testimonial->id; ?>">
							<div class="img_slide"><img src="<?php echo base_url();?>assets/site/img/img1.png" /></div>
						</div>
					<?php } ?>
					</div>
				</div>				
			</div>
			<div class="slider_text slider-for">
			<?php foreach($testimonial_data as $testimonial) { ?>
				<div id="testiDesc_<?php echo $testimonial->id; ?>">
					<p class="test1"><?php echo $testimonial->description; ?></p>
					<p class="name"><?php echo $testimonial->title; ?></p>
					<p class="desg"><?php echo $testimonial->designation; ?></p>
				</div>
			<?php } ?>
			</div>
		</div>
	</div>
</section>