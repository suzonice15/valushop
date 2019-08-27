

	<div class="form-group ">
		<label for="category_title">Title<span class="required">*</span></label>
		<input required type="text" id="category_title" class="form-control the_title" name="category_title" value="">
	</div>
	<div class="form-group "> <label for="category_name">Name<span class="required">*</span></label>
		<input  required type="text" class="form-control the_name" id="category_name" name="category_name" value="">
	</div>
	<div class="form-group "> <label for="parent_id">Select Parent</label>
		<select class="form-control select2 " name="parent_id"  >
			<option value="0">--- choose ---</option>
			<?php if(isset($categories)): foreach ($categories as $category):?>
			<option value="<?php echo $category->parent_id;?>"><?php echo $category->category_name;?></option>
			<?php endforeach;endif;?>
			</select>

	</div>

	<div class="form-group featured-image"> <label>Category Icon</label> <input type="file" class="form-control" name="featured_image">

	</div>

	<div class="form-group medium-banner"> <label>Banner Image</label> <input type="file" class="form-control" name="medium_banner">

	</div> <div class="form-group featured-image"> <label>Category Gallery1</label> <input type="file" class="form-control" name="category_gallery1">

	</div>

	<div class="form-group featured-image"> <label>Category Gallery2</label> <input type="file" class="form-control" name="category_gallery2">
	</div>
	<div class="form-group featured-image"> <label>Category Gallery3</label> <input type="file" class="form-control" name="category_gallery3">
	</div>
	<div class="form-group "> <label for="target_url1">Gallery Target URL 01</label> <input type="text" class="form-control" name="target_url1" value="">
	</div>
	<div class="form-group "> <label for="target_url2">Gallery Target URL 02</label> <input type="text" class="form-control" name="target_url2" value="">
	</div>
	<div class="form-group "> <label for="target_url3">Gallery Target URL 03</label> <input type="text" class="form-control" name="target_url3" value="">
	</div>
	<div class="form-group "> <label for="rank_order">Rank Order</label> <input type="text" class="form-control" name="rank_order" value="">
	</div>
	<div class="form-group medium-banner"> <div class="checkbox"> <label><input type="checkbox" name="top_menu" value="1">Checked as Top Menu</label> </div>
	</div>
	<div class="box box-primary">
		<div class="box-body"> <div class="form-group ">
				<label for="seo_title">SEO Title</label> <input type="text" class="form-control" name="seo_title" id="seo_title" value=""> </div> <div class="form-group "> <label for="seo_meta_title">SEO Meta Title</label> <input type="text" class="form-control" name="seo_meta_title" id="seo_meta_title" value=""> </div> <div class="form-group "> <label for="seo_keywords">SEO Keywords</label> <input type="text" class="form-control" name="seo_keywords" id="seo_keywords" value=""> </div> <div class="form-group "> <label for="seo_content">SEO Content</label> <textarea class="form-control" rows="5" name="seo_content" id="seo_content"></textarea> </div> <div class="form-group "> <label for="seo_meta_content">SEO Meta Content</label> <textarea class="form-control" rows="5" name="seo_meta_content" id="seo_meta_content"></textarea>
			</div> </div> </div>



