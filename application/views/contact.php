<section id="mpart" class="contactpage">
	<div class="container">
		<ul class="breadcrumb">
			<li><a href="<?=base_url()?>">Home</a></li>
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
			
			$contact_html = $post->post_content;
			
			echo str_replace("[email_form]", $email_form, $contact_html);
			?>
		</div>
	</div>
</section>