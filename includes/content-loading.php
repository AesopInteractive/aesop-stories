<div id="aesop-stories-loading"><div class="aesop-stories-loading-inner">
	<?php

		$preloaders = get_post_meta( get_the_ID(), 'aesop_stories_preloaders', false );

		shuffle($preloaders);

		$i = 1;

		foreach($preloaders as $preloader) { $i++;

			echo wpautop($preloader['text']);

			if ($i = 1);break;
		}
	?>
</div></div>