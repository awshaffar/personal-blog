<?php defined('_JEXEC') or die;
JHTML::_('behavior.framework', true);

require_once(JPATH_SITE . DS . 'templates' . DS . $this->template . DS . 'functions.php');

if(!$this->params->get('html5', 0)): ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php else: 
	echo '<!DOCTYPE html>';
endif; ?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" >
	<head>
		<jdoc:include type="head" />
		<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/system/css/system.css" type="text/css" />
		<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/cebgray/css/template.css" type="text/css" />
		<?php if ($this->direction == 'rtl') : ?>
		<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/cebgray/css/template_rtl.css" type="text/css" />
		<?php endif; ?>
		<?php echo sendIECSS();?>
	</head>

	<body>
		<div id="template">
			<div id="main">
				<div id="logo">
					<a href="<?php echo JURI::base();?>" title="<?php echo JURI::base();?>">
						<?php if ( $this->params->get('logo') != '' ) : ?>
						<img src="<?php echo $this->baseurl ?>/<?php echo htmlspecialchars($this->params->get('logo'));?>" alt="Logo" />
						<?php else : ?>
						<img src="<?php echo $this->baseurl ?>/templates/cebgray/images/logo.png" alt="Logo" />
						<?php endif; ?>
					</a>
				</div>
				<?php if ( $this->params->get('slogan') != '' ) { ?>
				<div id="slogan">
					<?php echo htmlspecialchars($this->params->get('slogan'));?>
				</div>
				<?php } ?>
				<div class="clr"> </div>
				
				<div id="topnavi">
					<?php echo ( ( ! $this->params->get('html5', 0) ) ? '<div id="navwidth">' : '<nav id="navwidth">');?>
						<jdoc:include type="modules" name="toolbar" headerLevel="3" state="0" />
					<?php echo ( ( ! $this->params->get('html5', 0) ) ? '</div>' : '</nav>');?>
					
					<?php if ( $this->countModules('search') ) { ?>
					<div id="search">
						<jdoc:include type="modules" name="search" />
					</div>
					<?php } ?>
				</div>
				
				<div class="clr"> </div>
				<br />
				<?php echo ( ( ! $this->params->get('html5', 0) ) ? '<div id="header">' : '<header id="header">');?>
					<?php if ( $this->params->get('sitetitle') != '' ) { ?>
					<div id="inheader"><h1><?php echo htmlspecialchars( $this->params->get('sitetitle') );?></h1></div>
					<?php } ?>
				<?php echo ( ( ! $this->params->get('html5', 0) ) ? '</div>' : '</header>');?>
				
				<br />
				<?php if ( $this->countModules('search2') ) { ?>
					<div id="search2" class="flR">
						<jdoc:include type="modules" name="search2" />
					</div>
				<?php } ?>
				
				<?php if ( $this->countModules('breadcrumb') ) { ?>
				<jdoc:include type="modules" name="breadcrumb" />
				<?php } ?>
				<div class="clr sep"> </div>
				<?php if ( $this->countModules('left') ) { ?>
					<div id="leftsidebar">
						<jdoc:include type="modules" name="left" style="xhtml" />
					</div>
				<?php } ?>
				
				<div id="content_<?php echo ( ($this->countModules('left')) ? 'small' : 'big');?>">
				
					<?php if ( $this->getBuffer('message') ) : ?>
					<div class="error">
						<h2><?php echo JText::_('TPL_CEBGRAY_SYSTEM_MESSAGE'); ?></h2>
						<jdoc:include type="message" />
					</div>
					<?php endif; ?>

					<jdoc:include type="component" />
				</div>
				<div class="clr"></div>
				<div id="<?php echo ( ($this->countModules('footerleft + footerright')) ? 'contentbottom' : 'contentbottom_blank');?>">
					<!-- Don't remove the link - when you don't want them, please contact us -> ceb-seo.de -->
					<span class="copyright"><?php echo JText::_('TPL_CEBGRAY_POWERED_BY');?> <a href="http://www.ceb-seo.de" title="SEO" target="_blank">CEB-SEO</a></span>
					<?php if ( $this->countModules('footerleft') ) { ?>
					<div id="contentbottomleft_<?php echo (($this->countModules('footerright')) ? 'small' : 'big');?>" class="flL">
						<jdoc:include type="modules" name="footerleft" style="xhtml" />
					</div>
					<?php } ?>
					
					<?php if ( $this->countModules('footerright') ) { ?>
					<div id="contentbottomright_<?php echo (($this->countModules('footerleft')) ? 'small' : 'big');?>" class="flR">
						<jdoc:include type="modules" name="footerright" style="xhtml" />
					</div>
					<?php } ?>
					<div class="clr"> </div>
				</div>
				<?php 
				if ( $this->countModules('footer') ) {
					echo ( ( ! $this->params->get('html5', 0) ) ? '<div id="footer" class="flR">' : '<footer id="footer" class="flR">');?>
						<jdoc:include type="modules" name="footer" style="xhtml" />
					<?php echo ( ( ! $this->params->get('html5', 0) ) ? '</div>' : '</footer>');?>
					<div class="clr"> </div>
					<?php 
				} ?>
			</div>
		
			<div id="end"></div>
		</div>
		<jdoc:include type="modules" name="debug" />
	</body>
</html>
