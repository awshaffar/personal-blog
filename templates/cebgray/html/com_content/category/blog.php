<?php
/**
 * @version		$Id: blog.php 17187 2010-05-19 11:18:22Z infograf768 $
 * @package		Joomla.Site
 * @subpackage	com_content
 * @copyright	Copyright (C) 2005 - 2009 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
$app = JFactory::getApplication();
$tmplparams =$app->getTemplate(true)->params;

JHtml::addIncludePath(JPATH_COMPONENT.DS.'helpers');
$cparams =& JComponentHelper::getParams('com_media');

echo (($tmplparams->get('html5')==1) ? '<section class="blog'.$this->pageclass_sfx.'">' : '<div class="blog'.$this->pageclass_sfx.'">');

if ($this->params->get('show_page_heading')!=0 || $this->params->get('show_category_title')) : ?>
	<h1>
	<?php echo $this->escape($this->params->get('page_heading'));
	if ($this->params->get('show_category_title'))
	{
		echo '<span class="subheading-category">'.$this->category->title.'</span>';
	}?>
	</h1>
<?php endif;

if ($this->params->get('show_description', 1) || $this->params->def('show_description_image', 1)) : ?>
	<div class="category-desc">
		<?php if ($this->params->get('show_description_image') && $this->category->getParams()->get('image')) : ?>
		<img src="<?php echo $this->category->getParams()->get('image'); ?>"/>
		<?php endif;
		
		if ($this->params->get('show_description') && $this->category->description) :
			echo JHtml::_('content.prepare', $this->category->description);
		endif; ?>
		<div class="clr"></div>
	</div>
<?php endif;

$leadingcount=0 ;

if (!empty($this->lead_items)) : ?>
<div class="items-leading">
	<?php foreach ($this->lead_items as &$item) : 
		if ( $tmplparams->get('html5')==1) {?>
		<article class="leading-<?php echo $leadingcount; ?><?php echo $item->state == 0 ? 'class="system-unpublished"' : null; ?>">
		<?php } else { ?>
		<div class="leading-<?php echo $leadingcount; ?><?php echo $item->state == 0 ? 'class="system-unpublished"' : null; ?>">
		<?php }
		
		$this->item = &$item;
		echo $this->loadTemplate('item');
		
		echo ( ($tmplparams->get('html5')==1) ? '</article>' : '</div>');
		$leadingcount++;
	endforeach; ?>
</div>
<?php endif;

$introcount=(count($this->intro_items));
$counter=0;

if (!empty($this->intro_items)) : 
	foreach ($this->intro_items as $key => &$item) :
		$key      = ($key-$leadingcount)+1;
		$rowcount = ( ((int)$key-1) %	(int) $this->columns) +1;
		$row      = $counter / $this->columns ;

		if ($rowcount==1) : ?>
		<div class="items-row cols-<?php echo (int) $this->columns;?> <?php echo 'row-'.$row ; ?>">
		<?php endif;
		
		if ( $tmplparams->get('html5')==1) {?>
		<article class="item column-<?php echo $rowcount;?><?php echo $item->state == 0 ? ' system-unpublished' : null; ?>">
		<?php } else { ?>
		<div class="item column-<?php echo $rowcount;?><?php echo $item->state == 0 ? ' system-unpublished' : null; ?>">
		<?php }
		
		$this->item = &$item;
		echo $this->loadTemplate('item');
		echo ( ($tmplparams->get('html5')==1) ? '</article>' : '</div>');
		$counter++;
		
		if (($rowcount == $this->columns) or ($counter ==$introcount)): ?>
		<span class="row-separator"></span>
		</div>
		<?php endif;
	endforeach;
endif;

if (!empty($this->link_items)) : 
	echo $this->loadTemplate('links');
endif;

if (is_array($this->children[$this->category->id]) && count($this->children[$this->category->id]) > 0 && $this->params->get('maxLevel') !=0) : ?>
	<div class="cat-children">
		<h3><?php echo JTEXT::_('JGLOBAL_SUBCATEGORIES'); ?></h3>
		<?php echo $this->loadTemplate('children'); ?>
	</div>
<?php endif;

if (($this->params->def('show_pagination', 1) == 1  || ($this->params->get('show_pagination') == 2)) && ($this->pagination->get('pages.total') > 1)) : ?>
	<div class="pagination">
		<?php  if ($this->params->def('show_pagination_results', 1)) : ?>
			<p class="counter"><?php echo $this->pagination->getPagesCounter(); ?></p>
		<?php endif;
		echo $this->pagination->getPagesLinks(); ?>
	</div>
<?php endif;
echo (($tmplparams->get('html5')==1) ? '</section>' : '</div>');?>