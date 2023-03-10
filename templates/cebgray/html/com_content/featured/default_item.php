<?php
/**
 * @version		$Id: default_item.php 17816 2010-06-21 13:03:17Z dextercowley $
 * @package		Joomla.Site
 * @subpackage	com_content
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

// Create a shortcut for params.
$canEdit = $this->item->params->get('access-edit');
$params  = &$this->item->params;
$app     = JFactory::getApplication();
$templateparams = $app->getTemplate(true)->params;

/*if ($templateparams->get('html5')!=1)
{
	require(JPATH_BASE.'/components/com_content/views/featured/tmpl/default_item.php');
	//evtl. ersetzen durch JPATH_COMPONENT.'/views/...'
} else {*/
	JHtml::addIncludePath(JPATH_COMPONENT.DS.'helpers');
	
	if ($this->item->state == 0) : ?>
	<div class="system-unpublished">
	<?php endif;
	
	if ($params->get('show_title')) : ?>
	<h2 class="article-title">
		<?php if ($params->get('link_titles') && $params->get('access-view')) : ?>
			<a href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid)); ?>"><?php echo $this->escape($this->item->title); ?></a>
		<?php else : ?>
			<?php echo $this->escape($this->item->title); ?>
		<?php endif; ?>
	</h2>
	<?php endif;
	if ($params->get('show_print_icon') || $params->get('show_email_icon') || $canEdit) : ?>
		<ul class="actions">
			<?php if ($params->get('show_print_icon')) : ?>
			<li class="print-icon">
				<?php echo JHtml::_('icon.print_popup', $this->item, $params); ?>
			</li>
			<?php endif; ?>
			<?php if ($params->get('show_email_icon')) : ?>
			<li class="email-icon">
				<?php echo JHtml::_('icon.email', $this->item, $params); ?>
			</li>
			<?php endif; ?>
	
			<?php if ($canEdit) : ?>
			<li class="edit-icon">
				<?php echo JHtml::_('icon.edit', $this->item, $params); ?>
			</li>
			<?php endif; ?>
		</ul>
		<?php endif;
	?>
	<div class="clr pcontent">
		<?php 
		if (!$params->get('show_intro')) : 
			echo $this->item->event->afterDisplayTitle;
		endif;
		
		echo $this->item->event->beforeDisplayContent;
	
		if ( ($params->get('show_author'))          || ($params->get('show_category')) || 
			 ($params->get('show_create_date'))     || ($params->get('show_modify_date')) || 
			 ($params->get('show_publish_date'))    || ($params->get('show_parent_category')) || ($params->get('show_hits'))) : ?>
			<dl class="article-info">
				<dt class="article-info-term"><?php  echo JText::_('COM_CONTENT_ARTICLE_INFO'); ?></dt>
		<?php endif;
	
		if ($params->get('show_parent_category')) : ?>
			<dd class="parent-category-name">
				<?php 
				$title = $this->escape($this->item->parent_title);
				$title = ($title) ? $title : JText::_('JGLOBAL_UNCATEGORISED');
				$url   = '<a href="' . JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->parent_slug)) . '">' . $title . '</a>';
				if ($params->get('link_parent_category') AND $this->item->parent_slug) :
					echo JText::sprintf('COM_CONTENT_PARENT', $url);
				else :
					echo JText::sprintf('COM_CONTENT_PARENT', $title);
				endif; ?>
			</dd>
		<?php endif;
	
		if ($params->get('show_category')) : ?>
			<dd class="category-name">
				<?php 
				$title = $this->escape($this->item->category_title);
				$title = ($title) ? $title : JText::_('JGLOBAL_UNCATEGORISED');
				$url   = '<a href="'.JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->catslug)).'">'.$title.'</a>';
				if ($params->get('link_category') AND $this->item->catslug) :
					echo JText::sprintf('COM_CONTENT_CATEGORY', $url);
				else :
					echo JText::sprintf('COM_CONTENT_CATEGORY', $title);
				endif; ?>
			</dd>
		<?php endif;
	
		if ($params->get('show_create_date')) : ?>
			<dd class="create">
			<?php echo JText::sprintf('COM_CONTENT_CREATED_DATE_ON', JHTML::_('date',$this->item->created, JText::_('DATE_FORMAT_LC2'))); ?>
			</dd>
		<?php endif;
	
		if ($params->get('show_modify_date')) : ?>
			<dd class="modified">
			<?php echo JText::sprintf('COM_CONTENT_LAST_UPDATED', JHTML::_('date',$this->item->modified, JText::_('DATE_FORMAT_LC2'))); ?>
			</dd>
		<?php endif;
	
		if ($params->get('show_publish_date')) : ?>
			<dd class="published">
			<?php echo JText::sprintf('COM_CONTENT_PUBLISHED_DATE', JHTML::_('date',$this->item->publish_up, JText::_('DATE_FORMAT_LC2'))); ?>
			</dd>
		<?php endif;
	
		if ($params->get('show_author') && !empty($this->item->author )) : ?>
		<dd class="createdby"> 
			<?php $author =  $this->item->author; ?>
			<?php $author = ($this->item->created_by_alias ? $this->item->created_by_alias : $author);?>
	
				<?php if (!empty($this->item->contactid ) &&  $params->get('link_author') == true) :
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
	
		if (($params->get('show_author')) || ($params->get('show_category')) || ($params->get('show_create_date')) || ($params->get('show_modify_date')) || 
		    ($params->get('show_publish_date')) || ($params->get('show_parent_category')) || ($params->get('show_hits'))) : ?>
 			</dl>
		<?php endif;
		
		echo $this->item->introtext;
		
		if ($params->get('show_readmore') && $this->item->readmore) :
			if ($params->get('access-view')) :
				$link = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid));
			else :
				$menu = JSite::getMenu();
				$active = $menu->getActive();
				$itemId = $active->id;
				$link1 = JRoute::_('index.php?option=com_users&view=login&Itemid=' . $itemId);
				$returnURL = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid));
				$link = new JURI($link1);
				$link->setVar('return', base64_encode($returnURL));
			endif;
		?>
		<p class="readmore">
			<a href="<?php echo $link; ?>">
				<?php if (!$params->get('access-view')) :
					echo JText::_('COM_CONTENT_REGISTER_TO_READ_MORE');
				elseif ($readmore = $this->item->alternative_readmore) :
					echo $readmore;
					echo JHTML::_('string.truncate', ($this->item->title), $params->get('readmore_limit'));
				elseif ($params->get('show_readmore_title', 0) == 0) :
					echo JText::sprintf('COM_CONTENT_READ_MORE_TITLE');	
				else :
					echo JText::_('COM_CONTENT_READ_MORE');
					echo JHTML::_('string.truncate', ($this->item->title), $params->get('readmore_limit'));
				endif; ?></a>
			</p>
		<?php endif;?>
		</div>
	<?php if ($this->item->state == 0) : ?>
	</div>
	<?php endif; ?>
		
	<div class="item-separator"></div>
	<?php echo $this->item->event->afterDisplayContent; ?>
<?php // } ?>
