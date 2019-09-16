<section id="content" class="aboutpage">
	<div class="container">
		<div class="row">
			<div class="col-sm-3">
				<div class="adsbox">
					<?php
					$adds = get_adds();
					if($adds)
					{
						$side_html='<ul>';
						
						foreach($adds as $add)
						{
							$side_html.='<li>
								<a href="'.$add->adds_link.'">
									<img  class="img-fluid" src="'.get_media_path($add->media_id).'">
								</a>
							</li>';
						}
						
						$side_html.='</ul>';
						
						echo $side_html;
					}
					?>
				</div>
			</div>
			<div class="col-sm-9">
				<div class="subheader">
					<ul class="breadcrumb">
						<li><a href="<?=base_url()?>">Home</a>/</li>
						<li class="active"><?=$page_title?></li>
					</ul>
					
					<div class="page-title">
						<h1><?=$page_title?></h1>
					</div>
				</div>
				<article class="txt">
					<?=$page_content?>
				</article>
			</div>
		</div>
	</div>
</section>
