<?php

class AesopStoriesStyles {

	public function __construct(){
		add_action('wp_head', array($this,'story_styles'));
	}

	public function story_styles(){
		global $post;

		$maxfontsize    = get_post_meta(get_the_ID(),'aesop_stories_block_title_size', true) ? get_post_meta(get_the_ID(),'aesop_stories_block_title_size', true) : 400;
		$coverlines 	= get_post_meta( get_the_ID(), 'aesop_stories_cover_lines', false);

		$titlecolor     = get_post_meta(get_the_ID(),'aesop_stories_cover_text_color', true);
		$titlewidth  	= get_post_meta(get_the_ID(),'aesop_stories_block_title_width', true);

		$coverwidthstyle = $titlewidth ? sprintf('style="width:%s;"',$titlewidth) : false;

    	$storybasecolor = get_post_meta(get_the_ID(),'aesop_stories_article_bg', true);
		$storytxtcolor = get_post_meta(get_the_ID(),'aesop_stories_article_text', true);


		if($coverlines) { ?>
			<!-- Story Cover Slabtext -->
	    	<script>
				jQuery(document).ready(function(){
					stS = "<span class='slabtext'>";
				    stE = "</span>";
					txt = [<?php foreach($coverlines as $coverline) { ?>"<?php echo $coverline['text'];?>",<?php;}?>];

					jQuery('.aesop-story-cover .aesop-story-title').html(stS + txt.join(stE + stS) + stE).slabText({maxFontSize:<?php echo $maxfontsize;?>});
				});
			</script>
		<?php } else { ?>
			<!-- Story Cover Slabtext -->
			<script>
				jQuery(document).ready(function(){
					jQuery('.aesop-story-cover .aesop-story-title').slabText({maxFontSize:<?php echo $maxfontsize;?>});
				});
			</script>
		<?php }

		if ($titlewidth) { ?>
			<!-- Story Title Width Styles -->
			<style>
				.postid-<?php echo get_the_ID();?> .block-cover .aesop_stories-cover-title {
					width:<?php echo $titlewidth;?>;
				}
			</style>
		<?php }

	}

}
new AesopStoriesStyles;








