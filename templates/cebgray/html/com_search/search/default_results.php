<?php
/**
 * @version		$Id: default_results.php 20244 2011-01-10 10:23:58Z eddieajau $
 * @package		Joomla.Site
 * @subpackage	com_search
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
?>
<p class="pcontent">
	<dl class="search-results<?php echo $this->pageclass_sfx; ?>">
	<?php foreach($this->results as $result) : ?>
		<dt class="result-title">
			<?php echo $this->pagination->limitstart + $result->count.'. ';?>
			<?php if ($result->href) :?>
				<a href="<?php echo JRoute::_($result->href); ?>"<?php if ($result->browsernav == 1) :?> target="_blank"<?php endif;?>>
					<?php echo $this->escape($result->title);?>
				</a>
			<?php else:?>
				<?php echo $this->escape($result->title);?>
			<?php endif; ?>
		</dt>
		<?php if ($result->section) : ?>
			<dd class="result-category">		
				<span class="small<?php echo $this->pageclass_sfx; ?>">
					(<?php echo $this->escape($result->section); ?>)
				</span>
			</dd>
		<?php endif; ?>
		<dd class="result-text">
			<?php echo $result->text; ?>
		</dd>
		<?php if ($this->params->get('show_date')) : ?>
			<dt class="result-created<?php echo $this->pageclass_sfx; ?>">
				<?php echo JText::sprintf('JGLOBAL_CREATED_DATE_ON', $result->created); ?>
			</dt>
		<?php endif; ?>
	<?php endforeach; ?>
	</dl>
	<div class="clr"> </div>
</p>

<div class="pagination">
	<?php echo $this->pagination->getPagesLinks(); ?>
</div>
