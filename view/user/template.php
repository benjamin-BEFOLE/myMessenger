<!DOCTYPE html>
<html>
	<?php  
		require_once $head;
	?>
	<body>
		<div class="l-home-wrap">
			<div class="l-home-wrap-left">
				<?php
					require_once $header;
					require_once $discussion;
					require_once $contact;
					require_once $newContact;
				?>
			</div>
			<div class="l-home-wrap-right">
				<?php
					require_once $discussionScreen;
					require_once $footer;
				?>
			</div>
		</div>
	</body>
</html>