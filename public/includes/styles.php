<?php

class AesopStoriesStyles {

	public function __construct(){
		add_action('wp_head', array($this,'story_styles'));
	}

	public function story_styles(){
		global $post;

		
		$coverlines 	= get_post_meta( get_the_ID(), 'aesop_stories_cover_lines', false);

		$storycovercolor     = get_post_meta(get_the_ID(),'aesop_stories_cover_text_color', true);
		$storybasecolor = get_post_meta(get_the_ID(),'aesop_stories_bg_color', true);
		$storytxtcolor = get_post_meta(get_the_ID(),'aesop_stories_text_color', true);
		$storycovermaskcolor = get_post_meta(get_the_ID(),'aesop_stories_mask_color', true);

		$titlewidth  	= get_post_meta(get_the_ID(),'aesop_stories_title_width', true);
		$maxfontsize    = get_post_meta(get_the_ID(),'aesop_stories_title_size', true) ? get_post_meta(get_the_ID(),'aesop_stories_title_size', true) : 400;

		$basestyles = $storybasecolor || $storytxtcolor;
		$coverstyles = $storycovercolor || $storycovermaskcolor;

		if($coverlines) { ?>
			<!-- Aesop Stories - Slabtext -->
	    	<script>
				jQuery(document).ready(function(){
					stS = "<span class='slabtext'>";
				    stE = "</span>";
					txt = [
						<?php foreach($coverlines as $coverline) { 
							?>"<?php echo $coverline['text'];?>",<?php;
						} ?>
					];

					jQuery('.aesop-story-cover .aesop-story-title').html(stS + txt.join(stE + stS) + stE).slabText();
				});
			</script>
		<?php } else { ?>
			<!-- Aesop Stories - Slabtext -->
			<script>
				jQuery(document).ready(function(){
					jQuery('.aesop-story-cover .aesop-story-title').slabText({maxFontSize:<?php echo $maxfontsize;?>});
				});
			</script>
		<?php }

		if ( $coverstyles ) {
			?>
			<!-- Aesop Stories - Cover Styles -->
			<style>
				<?php if ($storycovercolor) { ?>
					.postid-<?php echo get_the_ID();?> .aesop-story-cover,
					.postid-<?php echo get_the_ID();?> .aesop-story-cover p,
					.postid-<?php echo get_the_ID();?> .aesop-story-cover .aesop-story-title,
					.postid-<?php echo get_the_ID();?> .aesop-story-cover .aesop-story-meta,
					.postid-<?php echo get_the_ID();?> .aesop-story-cover .aesop-story-indicator {
						color: <?php echo $storycovercolor;?> ;
					}
				<?php } ?>
			</style>
			<?php
		}

		if ( $basestyles ) {
			?>
			<!-- Aesop Stories - Base Styles -->
			<style>
				<?php if ($storybasecolor) { ?>
					.postid-<?php echo get_the_ID();?>,
					.postid-<?php echo get_the_ID();?> .aesop-story-entry {
						background: <?php echo $storybasecolor;?> ;
					}
				<?php } ?>
				<?php if ($storytxtcolor) { ?>
					.postid-<?php echo get_the_ID();?> p {
						color: <?php echo $storytxtcolor;?> ;
					}
				<?php } ?>
			</style>
			<?php
		}

		if ($titlewidth) { ?>
			<!-- Aesop Stories - Title Width -->
			<style>
				.postid-<?php echo get_the_ID();?> .block-cover .aesop_stories-cover-title {
					width:<?php echo $titlewidth;?>;
				}
			</style>
		<?php }

	}

}
new AesopStoriesStyles;








