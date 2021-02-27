<?php
/**
 * @version		$Id: default.php 17130 2010-05-17 05:52:36Z eddieajau $
 * @package		Joomla.Site
 * @subpackage	com_content
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
$app = JFactory::getApplication();
$tmplparams = $app->getTemplate(true)->params;

JHtml::addIncludePath(JPATH_COMPONENT.'/helpers');

?>
<div class="categories-list<?php echo $this->pageclass_sfx;?>">
	<?php if ($this->params->get('show_page_heading', 1)) : ?>
	<h1>
		<?php echo $this->escape($this->params->get('page_heading')); ?>
	</h1>
	<?php endif;
	if ($this->params->get('show_base_description')) : 
		if($this->params->get('categories_description')) :
			echo  JHtml::_('content.prepare',$this->params->get('categories_description'));
		else:
			if ($this->parent->description) : ?>
				<div class="category-desc">
					<?php  echo JHtml::_('content.prepare', $this->parent->description); ?>
				</div>
			<?php endif;
		endif;
	endif;
	echo $this->loadTemplate('items');?>
</div>
