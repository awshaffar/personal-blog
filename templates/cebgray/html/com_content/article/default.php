<?php
/**
 * @version		$Id: default.php 17137 2010-05-17 07:00:07Z infograf768 $
 * @package		Joomla.Site
 * @subpackage	com_content
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access
defined('_JEXEC') or die;

$app        = JFactory::getApplication();
$tmplparams = $app->getTemplate(true)->params;
JHtml::addIncludePath(JPATH_COMPONENT.DS.'helpers');

// Create shortcut to parameters.
$params = $this->item->params;

if ($tmplparams->get('html5') == 1) :
	require(JPATH_BASE.'/components/com_content/views/article/tmpl/default.php');
	//evtl. ersetzen durch JPATH_COMPONENT.'/views/...'
else :
	JHtml::addIncludePath(JPATH_COMPONENT.DS.'helpers');?>
	
	<<?php echo ( ($tmplparams->get('html5') == 1) ? 'article' : 'div');?> class="item-page<?php echo $this->pageclass_sfx?>">
	
	<?php if ($this->params->get('show_page_heading', 1)) : ?>
		<?php if ($this->params->get('show_page_heading', 1) && $params->get('show_title') && ($tmplparams->get('html5') == 1) ) : ?>
			<hgroup>
		<?php endif; ?>
		<h1>
			<?php echo $this->escape($this->params->get('page_heading')); ?>
		</h1>
	<?php endif;
	
	if ($params->get('show_title')|| $params->get('access-edit') ) : ?>
		<h2 class="article-title">
			<?php echo $this->escape($this->item->title); ?>
		</h2>
	<?php endif;
	if ( $this->params->get('show_page_heading', 1) && $params->get('show_title') && ($tmplparams->get('html5') == 1) ) : ?>
		</hgroup>
	<?php endif;
	
	if ($params->get('access-edit') ||  $params->get('show_print_icon') || $params->get('show_email_icon')) : ?>
		<ul class="actions">
		<?php if (!$this->print) :
			if ($params->get('show_print_icon')) : ?>
			<li class="print-icon"><?php echo JHtml::_('icon.print_popup',  $this->item, $params); ?></li>
			<?php endif;
			
			if ($params->get('show_email_icon')) : ?>
			<li class="email-icon"><?php echo JHtml::_('icon.email',  $this->item, $params); ?></li>
			<?php endif;
			
			if ($this->user->authorise('core.edit', 'com_content.article.'.$this->item->id)) : ?>
			<li class="edit-icon"><?php echo JHtml::_('icon.edit', $this->item, $params); ?></li>
			<?php endif;
		else : ?>
			<li><?php echo JHtml::_('icon.print_screen',  $this->item, $params); ?></li>
		<?php endif; ?>
		</ul>
	<?php endif;?>
	<div class="clr"> </div>
	<?php if (!$params->get('show_intro')) :
		echo $this->item->event->afterDisplayTitle;
	endif;
	
	echo $this->item->event->beforeDisplayContent;
	
	$useDefList = (($params->get('show_author')) || ($params->get('show_category')) || ($params->get('show_parent_category')) || ($params->get('show_create_date')) || ($params->get('show_modify_date')) || ($params->get('show_publish_date')) || ($params->get('show_hits')));
	
	if ($useDefList) : ?>
	<dl class="article-info">
		<dt class="article-info-term"><?php  echo JText::_('COM_CONTENT_ARTICLE_INFO'); ?></dt>
	<?php endif;
	
	if ($params->get('show_parent_category') && $this->item->parent_slug != '1:root') : ?>
		<dd class="parent-category-name">
			<?php 	$title = $this->escape($this->item->parent_title);
					$url = '<a href="'.JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->parent_slug)).'">'.$title.'</a>';?>
			<?php if ($params->get('link_parent_category') AND $this->item->parent_slug) : 
				echo JText::sprintf('COM_CONTENT_PARENT', $url);
			else :
				echo JText::sprintf('COM_CONTENT_PARENT', $title);
			endif; ?>
		</dd>
	<?php endif;
	
	if ($params->get('show_category')) : ?>
		<dd class="category-name">
			<?php 	$title = $this->escape($this->item->category_title);
					$url = '<a href="'.JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->catslug)).'">'.$title.'</a>';?>
			<?php if ($params->get('link_category') AND $this->item->catslug) :
				echo JText::sprintf('COM_CONTENT_CATEGORY', $url);
			else :
				echo JText::sprintf('COM_CONTENT_CATEGORY', $title);
			endif; ?>
		</dd>
	<?php endif;
	
	if ($params->get('show_create_date')) : ?>
		<dd class="create"><?php echo JText::sprintf('COM_CONTENT_CREATED_DATE_ON', JHTML::_('date',$this->item->created, JText::_('DATE_FORMAT_LC2'))); ?></dd>
	<?php endif;
	
	if ($params->get('show_modify_date')) : ?>
		<dd class="modified"><?php echo JText::sprintf('COM_CONTENT_LAST_UPDATED', JHTML::_('date',$this->item->modified, JText::_('DATE_FORMAT_LC2'))); ?></dd>
	<?php endif;
	
	if ($params->get('show_publish_date')) : ?>
		<dd class="published"><?php echo JText::sprintf('COM_CONTENT_PUBLISHED_DATE', JHTML::_('date',$this->item->publish_up, JText::_('DATE_FORMAT_LC2'))); ?></dd>
	<?php endif;
	
	if ($params->get('show_author') && !empty($this->item->author )) : ?>
	<dd class="createdby"> 
		<?php 
		$author =  $this->item->author;
		$author = ($this->item->created_by_alias ? $this->item->created_by_alias : $author);?>

		<?php if (!empty($this->item->contactid ) &&  $params->get('link_author') == true):
			echo JText::sprintf('COM_CONTENT_WRITTEN_BY' , JHTML::_('link',JRoute::_('index.php?option=com_contact&view=contact&id='.$this->item->contactid),$author));
		else :
			echo JText::sprintf('COM_CONTENT_WRITTEN_BY', $author);
		endif; ?>
	</dd>
	<?php endif;
	
	if ($params->get('show_hits')) : ?>
		<dd class="hits">
		<?php echo JText::sprintf('COM_CONTENT_ARTICLE_HITS', $this->item->hits); ?>
		</dd>
	<?php endif;
	if ($useDefList) : ?>
	</dl>
	<?php endif;
	
	if (isset ($this->item->toc)) : 
		echo $this->item->toc;
	endif;
	
	echo $this->item->text;
	echo $this->item->event->afterDisplayContent;
	echo ( ($tmplparams->get('html5') == 1) ? '</article>' : '</div>');?>
<?php endif; ?>