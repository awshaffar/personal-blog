<?php defined('_JEXEC') or die('Restricted access');

function sendIECSS()
{
	jimport('joomla.environment.browser');
		
	$browser = &JBrowser::getInstance();
	$art = $browser->getBrowser();
	$ver = (int)$browser->getMajor();
	$ret = '';
	if ($art == 'msie' && ( $ver > 5 && $ver < 9 ) )
	{
		$ret = '<link type="text/css" rel="stylesheet" href="'.JURI::base(true).'/templates/cebgray/css/IE'.$ver.'.css" />';
	}
	return $ret;
}
?>