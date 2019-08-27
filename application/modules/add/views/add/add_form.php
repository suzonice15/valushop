<div class="box-body">


	<div class="form-group <?=form_error('target_url') ? 'has-error' : ''?>">

			<?php if(isset($add->media_id)):   	$media_path = get_media_path($add->media_id);
				?>
				<img  width="100" height="50" src="<?php echo $media_path;?>"/>
			<?php endif;?>

	</div>
	<div class="form-group <?=form_error('adds_title') ? 'has-error' : ''?>">
		<label for="adds_title">Adds Title<span class="required">*</span></label>
		<input  required type="text" class="form-control" name="adds_title" id="adds_title" value="<?php if(isset($add)) { echo $add->adds_title;} ?>">
		<input type="hidden" class="form-control" name="adds_id" id="adds_title" value="<?php if(isset($add)) { echo $add->adds_id;} ?>">
		<input type="hidden" class="form-control" name="media_id"   value="<?php if(isset($add)) { echo $add->media_id;} ?>">
	</div>

	<div class="form-group <?=form_error('adds_link') ? 'has-error' : ''?>">
		<label for="adds_link">Adds URL</label>
		<input type="text" class="form-control" name="adds_link" id="adds_link" value="<?php if(isset($add)) { echo $add->adds_link;} ?>">
	</div>

	<div class="form-group featured-image <?=form_error('media_file') ? 'has-error' : ''?>">
		<label>Media File<span class="required">*</span></label>
		<input  required type="file" class="form-control" name="media_file"/>
	</div>


	<div class="form-group">
		<label for="adds_type">Select Type</label>

		<select  required name="adds_type" class="form-control">

			<option value="home">home </option>
			<option value="sidebar">  Sidebar</option>
			<option value="ad_slider">Ad Slider</option>

		</select>
	</div>
</div>



