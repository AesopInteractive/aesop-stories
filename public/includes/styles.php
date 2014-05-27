<?php

class AesopStoriesStyles {

	public function __construct(){
		add_action('wp_head', array($this,'story_styles'));
	}

	public function story_styles(){
		global $post;

		$maxfontsize    = get_post_meta(get_the_ID(),'aesop_stories_block_title_size', true) ? get_post_meta(get_the_ID(),'aesop_stories_block_title_size', true) : 400;
		$covertype		= get_post_meta(get_the_ID(),'aesop_stories_article_cover_type', true) ? get_post_meta(get_the_ID(),'aesop_stories_article_cover_type', true) : 'default-cover';

		$coverline1     = get_post_meta(get_the_ID(),'aesop_stories_block_cover_line1', true);
		$coverline2     = get_post_meta(get_the_ID(),'aesop_stories_block_cover_line2', true);
		$coverline3     = get_post_meta(get_the_ID(),'aesop_stories_block_cover_line3', true);
		$coverline4     = get_post_meta(get_the_ID(),'aesop_stories_block_cover_line4', true);
		$coverline5     = get_post_meta(get_the_ID(),'aesop_stories_block_cover_line5', true);

		$coverlines = get_post_meta( get_the_ID(), 'aesop_stories_cover_lines', false);

		$titlecolor     = get_post_meta(get_the_ID(),'aesop_stories_cover_text_color', true);

		$titlewidth  	= get_post_meta(get_the_ID(),'aesop_stories_block_title_width', true);

		$coverwidthstyle = $titlewidth ? sprintf('style="width:%s;"',$titlewidth) : false;


		$opts = get_option('aesop_stories_options') ? get_option('aesop_stories_options') : false;
    	$defaultbg = isset($opts['bg']) ? $opts['bg'] : '#FFFFFF';

    	$storybasecolor = get_post_meta(get_the_ID(),'aesop_stories_article_bg', true);
		$storytxtcolor = get_post_meta(get_the_ID(),'aesop_stories_article_text', true);


		if($coverline1) { ?>
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








