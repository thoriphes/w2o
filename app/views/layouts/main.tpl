<div id="wrapper">

	<div id="header">
		This is the header!
	</div>
	
	<div id="leftMenu">
		
		<?php  Application::runController("navigation", "index"); ?>
		
	</div>
	
	<div id="content">
		<?php echo $content; ?>
	</div>
	
</div>