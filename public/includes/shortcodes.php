<?php

class aesopStoriesShortcodes{

	public function __construct(){

		add_shortcode('aesop_stories_break', array($this,'shortcode_breaker'));
	}

	public function shortcode_breaker( $atts, $content = null ) {

		$defaults = array(
			'img' => '',
			'height' => '50px'
		);
		$atts = shortcode_atts($defaults, $atts);
		$out = sprintf('<hr class="aesop-stories-hr" style="border:none;background:url(\'%s\') no-repeat center center;height:%s" />',$atts['img'],$atts['height']);

		return $out;
	}
}
new aesopStoriesShortcodes;