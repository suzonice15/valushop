<section id="mpart" class="contactpage">
	<div class="container">
		<ul class="breadcrumb">
			<li><a href="<?=base_url()?>">Home</a>/</li>
			<li class="active">Contact Us</li>
		</ul>
		<div class="row mt40"> 
			<?php
			$email_form = '<form method="post" action="#">
				<div class="form-group">
					<div class="inputGroupContainer">
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
							<input type="text" class="form-control field-name" name="name" placeholder="Name*"/>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="inputGroupContainer">
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
							<input type="text" class="form-control field-phone" name="phone" placeholder="Phone*"/>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="inputGroupContainer">
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-book"></i></span>
							<input type="text" class="form-control field-subject" name="subject" placeholder="Subject*"/>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="inputGroupContainer">
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
							<textarea class="form-control field-message" name="message" placeholder="Message*"></textarea>
						</div>
					</div>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-default form-control">Send <span class="glyphicon glyphicon-send"></span></button>
				</div>
			</form>';
			
			$contact_html = $page_content;
			
			//echo  $email_form;
			?>
		</div>
	</div>
</section>

<div class="container">
<div class="row text-center ">
<div class="col-lg-12 col-md-12 col-sm-12 col-12 ">
	<nav class="text-center">
		<div class="nav nav-tabs" id="nav-tab" role="tablist">
			<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Contact Us</a>
			<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Email Us</a>
			<a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Call Us</a>
			<a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-location" role="tab" aria-controls="nav-contact" aria-selected="false">Location</a>
		</div>
	</nav>
	<div class="tab-content" id="nav-tabContent">
		<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">


			<h2 class="mt-4"> kalerhaat.com</h2>


			<p>236/2 West Nakhalpara
			Tejgoan, Dhaka-1215</p>

		</div>
		<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">

			<form method="post" action="#">
				<div class="col-md-6 text-center">
				<div class="form-group">
					<div class="inputGroupContainer">
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
							<input type="text" class="form-control field-name" name="name" placeholder="Name*">
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="inputGroupContainer">
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
							<input type="text" class="form-control field-phone" name="phone" placeholder="Phone*">
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="inputGroupContainer">
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-book"></i></span>
							<input type="text" class="form-control field-subject" name="subject" placeholder="Subject*">
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="inputGroupContainer">
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
							<textarea class="form-control field-message" name="message" placeholder="Message*"></textarea>
						</div>
					</div>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-default form-control">Send <span class="glyphicon glyphicon-send"></span></button>
				</div>
				</div>
			</form>

		</div>

		<div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">

			Call Us


			info@kalerhaat.com
			Support: 01816-771191
			Sales:01942-555666
			Hotline:01796-000007


		</div>
		<div class="tab-pane fade" id="nav-location" role="tabpanel" aria-labelledby="nav-location-tab">

			<iframe style="border: 0;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3650.4060704517337!2d90.35303631498238!3d23.804155184562926!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c0e739c94d33%3A0xc45e8fc22eac24f3!2sHimel+Shop!5e0!3m2!1sen!2sbd!4v1498031264477" allowfullscreen="" width="1000" height="450" frameborder="0"></iframe>

		</div>
	</div>
</div>

</div>
</div>
