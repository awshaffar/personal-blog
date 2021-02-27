<?php defined('_JEXEC') or die; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<jdoc:include type="head" />
	<link rel="stylesheet" type="text/css" href="<?php echo $this->baseurl ?>/templates/cebgray/css/template.css" />
	<?php
	if($this->direction == 'rtl') : ?>
	<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/cebgray/css/template_rtl.css" type="text/css" />
	<?php endif; ?>
</head>
<body class="contentpane">
	<div id="all">
	<div id="main">
		<jdoc:include type="message" />
		<jdoc:include type="component" />
		</div>
	</div>
</body>
</html>
