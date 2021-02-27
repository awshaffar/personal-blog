<?php
defined('_JEXEC') or die;

jimport( 'joomla.application.module.helper' );

$tmplparams	=  JFactory::getApplication()->getTemplate(true)->params;

if(!$tmplparams->get('html5', 0)): ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php else: 
	echo '<!DOCTYPE html>';
endif; ?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<?php 
	$doc = JFactory::getDocument();
	$language = $doc->language;?>
	<meta name="language" content="<?php echo $language; ?>" />
	<title><?php echo $this->error->getCode(); ?> - <?php echo $this->title; ?></title>
	<?php if ($this->error->getCode()>=400 && $this->error->getCode() < 500) { 	?>
		<link type="text/css" rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/system/css/system.css" />
		<link type="text/css" rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/cebgray/css/template.css" />
		<?php if ($this->direction == 'rtl') : ?>
		<link type="text/css" rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/cebgray/css/template_rtl.css" />
		<?php endif; ?>
		<style type="text/css">
			<!--
			#errorboxbody {margin:30px}
			#errorboxbody h2 {font-weight:normal; font-size:1.5em}
			#searchbox {background:#eee; padding:10px; margin-top:20px; border:solid 1px #ddd}
			-->
		</style>
	<?php } else {
		if (!isset($this->error))
		{
			$this->error = JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
			$this->debug = false; 
		}?>
		<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/system/css/error.css" type="text/css" />
	<?php } ?>
</head>

<body>
	<?php if ($this->error->getCode()>=400 && $this->error->getCode() < 500) { 	?>
	<div id="template">
		<div id="main">
			<div id="logo">
				<?php if ( $tmplparams->get('logo') != '' ) : ?>
				<img src="<?php echo $this->baseurl ?>/images/<?php echo htmlspecialchars($tmplparams->get('logo'));?>" alt="Logo" />
				<?php else : ?>
				<img src="<?php echo $this->baseurl ?>/templates/cebgray/images/logo.png" alt="Logo" />
				<?php endif; ?>
			</div>
			<div id="slogan">
				<?php echo htmlspecialchars($tmplparams->get('sitetitle'));?>
			</div>
			<div class="clr"> </div>
				
			<div id="topnavi">
				<?php echo ( ( ! $tmplparams->get('html5', 0) ) ? '<div id="navwidth">' : '<nav id="navwidth">');
				
				$modules = JModuleHelper::getModules( 'toolbar' );
				foreach ($modules as $module) {
					echo JModuleHelper::renderModule($module, array('style' => 'toolbar'));
				}
				
				echo ( ( ! $tmplparams->get('html5', 0) ) ? '</div>' : '</nav>');?>
			</div>
				
			<div class="clr"> </div>
			<br />
			<?php echo ( ( ! $tmplparams->get('html5', 0) ) ? '<div id="header">' : '<header id="header">');?>
				<div id="inheader"><h1><?php echo htmlspecialchars( $tmplparams->get('sitetitle') );?></h1></div>
			<?php echo ( ( ! $tmplparams->get('html5', 0) ) ? '</div>' : '</header>');?>
			
			<br />
				
			<div id="content_big">
				<div id="errorboxbody">
					<h2>
						<?php echo JText::_('JERROR_AN_ERROR_HAS_OCCURRED'); ?>
						<br />
						<?php echo JText::_('JERROR_LAYOUT_PAGE_NOT_FOUND'); ?>
					</h2>
					<div id="searchbox">
						<p><?php echo JText::_('JERROR_LAYOUT_SEARCH'); ?></p>
						<?php $module = JModuleHelper::getModule( 'search' );
						echo JModuleHelper::renderModule( $module);	?>
						<p><a href="<?php echo $this->baseurl; ?>/index.php" title="<?php echo JText::_('JERROR_LAYOUT_GO_TO_THE_HOME_PAGE'); ?>"><?php echo JText::_('JERROR_LAYOUT_HOME_PAGE'); ?></a></p>	
					</div>
					<p><?php 
						echo $this->error->getCode() ;
						echo $this->error->getMessage();?>
						<br />
						<?php echo JText::_('JERROR_LAYOUT_PLEASE_CONTACT_THE_SYSTEM_ADMINISTRATOR'); ?>
					</p>
				</div>
				<?php if ($this->debug) :
					echo $this->renderBacktrace();
				endif; ?>
			</div>
			<div class="clr"></div>
				
			<div id="contentbottom">
				<!-- Don't remove the link - when you don't want them, please contact us -> ceb-seo.de -->
				<span class="copyright"><?php echo JText::_('TPL_CEBGRAY_POWERED_BY');?> <a href="http://www.ceb-seo.de" title="SEO" target="_blank">CEB-SEO</a></span>
				
				<div class="clr"></div>
			</div>
		</div>
		
		<div id="end"></div>
	</div>
	<?php } else { ?>
	
	<div class="error">
		<div id="outline">
			<div id="errorboxoutline">
				<div id="errorboxheader"> <?php echo $this->title; ?></div>
				<div id="errorboxbody">
					<p><strong><?php echo JText::_('JERROR_LAYOUT_NOT_ABLE_TO_VISIT'); ?></strong></p>
					<ol>
						<li><?php echo JText::_('JERROR_LAYOUT_AN_OUT_OF_DATE_BOOKMARK_FAVOURITE'); ?></li>
						<li><?php echo JText::_('JERROR_LAYOUT_SEARCH_ENGINE_OUT_OF_DATE_LISTING'); ?></li>
						<li><?php echo JText::_('JERROR_LAYOUT_MIS_TYPED_ADDRESS'); ?></li>
						<li><?php echo JText::_('JERROR_LAYOUT_YOU_HAVE_NO_ACCESS_TO_THIS_PAGE'); ?></li>
						<li><?php echo JText::_('JERROR_LAYOUT_REQUESTED_RESOURCE_WAS_NOT_FOUND'); ?></li>
						<li><?php echo JText::_('JERROR_LAYOUT_ERROR_HAS_OCCURRED_WHILE_PROCESSING_YOUR_REQUEST'); ?></li>
					</ol>
					<p><strong><?php echo JText::_('JERROR_LAYOUT_PLEASE_TRY_ONE_OF_THE_FOLLOWING_PAGES'); ?></strong></p>

					<ul>
						<li><a href="<?php echo $this->baseurl; ?>/index.php" title="<?php echo JText::_('JERROR_LAYOUT_GO_TO_THE_HOME_PAGE'); ?>"><?php echo JText::_('JERROR_LAYOUT_HOME_PAGE'); ?></a></li>
						<li><a href="<?php echo $this->baseurl; ?>/index.php?option=com_search" title="<?php echo JText::_('JERROR_LAYOUT_SEARCH_PAGE'); ?>"><?php echo JText::_('JERROR_LAYOUT_SEARCH_PAGE'); ?></a></li>
	
					</ul>

					<p><?php echo JText::_('JERROR_LAYOUT_PLEASE_CONTACT_THE_SYSTEM_ADMINISTRATOR'); ?>.</p>
					<div id="techinfo">
						<p><?php echo $this->error->getMessage(); ?></p>
						<p>
						<?php if ($this->debug) :
							echo $this->renderBacktrace();
						endif; ?>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php } ?>
</body>
</html>
