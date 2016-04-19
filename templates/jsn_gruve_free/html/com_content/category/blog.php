<?php
// no direct access
defined('_JEXEC') or die('Restricted access');

// Load template framework
if (!defined('JSN_PATH_TPLFRAMEWORK')) {
	require_once JPATH_ROOT . '/plugins/system/jsntplframework/jsntplframework.defines.php';
	require_once JPATH_ROOT . '/plugins/system/jsntplframework/libraries/joomlashine/loader.php';
}

$app 		= JFactory::getApplication();
$template 	= $app->getTemplate();
$jsnUtils   = JSNTplUtils::getInstance();

if ($jsnUtils->isJoomla3()):
	JHtml::addIncludePath(JPATH_COMPONENT.'/helpers');
	JHtml::_('behavior.caption');
else :
	JHtml::addIncludePath(JPATH_COMPONENT.'/helpers');
endif;
?>
<?php if ($jsnUtils->isJoomla3()): ?>
	<div class="blog<?php echo $this->pageclass_sfx;?>">
		<?php if ($this->params->get('show_page_heading', 1)) : ?>
			<div class="page-header">
				<h1> <?php echo $this->escape($this->params->get('page_heading')); ?> </h1>
			</div>
		<?php endif; ?>

		<?php if ($this->params->get('show_category_title', 1) or $this->params->get('page_subheading')) : ?>
			<h2> <?php echo $this->escape($this->params->get('page_subheading')); ?>
				<?php if ($this->params->get('show_category_title')) : ?>
				<span class="subheading-category"><?php echo $this->category->title;?></span>
				<?php endif; ?>
			</h2>
		<?php endif; ?>

		<?php if ($this->params->get('show_tags', 1) && !empty($this->category->tags->itemTags)) : ?>
			<?php $this->category->tagLayout = new JLayoutFile('joomla.content.tags'); ?>
			<?php echo $this->category->tagLayout->render($this->category->tags->itemTags); ?>
		<?php endif; ?>

		<?php if ($this->params->get('show_description', 1) || $this->params->def('show_description_image', 1)) : ?>
			<div class="category-desc clearfix">
				<?php if ($this->params->get('show_description_image') && $this->category->getParams()->get('image')) : ?>
					<img src="<?php echo $this->category->getParams()->get('image'); ?>"/>
				<?php endif; ?>
				<?php if ($this->params->get('show_description') && $this->category->description) : ?>
					<?php echo JHtml::_('content.prepare', $this->category->description, '', 'com_content.category'); ?>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<?php if (empty($this->lead_items) && empty($this->link_items) && empty($this->intro_items)) : ?>
			<?php if ($this->params->get('show_no_articles', 1)) : ?>
				<p><?php echo JText::_('COM_CONTENT_NO_ARTICLES'); ?></p>
			<?php endif; ?>
		<?php endif; ?>

		<?php $leadingcount = 0; ?>
		<?php if (!empty($this->lead_items)) : ?>
			<div class="items-leading clearfix">
				<?php foreach ($this->lead_items as &$item) : ?>
					<div class="leading-<?php echo $leadingcount; ?><?php echo $item->state == 0 ? ' system-unpublished' : null; ?>">
						<?php
							$this->item = &$item;
							echo $this->loadTemplate('item');
						?>
					</div>
				<?php $leadingcount++; ?>
				<?php endforeach; ?>
			</div><!-- end items-leading -->
		<?php endif; ?>
	
		<?php
		$introcount = (count($this->intro_items));
		$counter = 0;
		?>

		<?php if (!empty($this->intro_items)) : ?>
		<?php foreach ($this->intro_items as $key => &$item) : ?>
			<?php $rowcount = ((int) $key % (int) $this->columns) + 1; ?>
			<?php if ($rowcount == 1) : ?>
				<?php $row = $counter / $this->columns; ?>
				<div class="items-row cols-<?php echo (int) $this->columns;?> <?php echo 'row-'.$row; ?> row-fluid clearfix">
				<?php endif; ?>
					<div class="span<?php echo round((12 / $this->columns));?>">
						<div class="item column-<?php echo $rowcount;?><?php echo $item->state == 0 ? ' system-unpublished' : null; ?>">
							<?php
							$this->item = &$item;
							echo $this->loadTemplate('item');
						?>
						</div><!-- end item -->
						<?php $counter++; ?>
					</div><!-- end span -->
					<?php if (($rowcount == $this->columns) or ($counter == $introcount)) : ?>
				</div><!-- end row -->
			<?php endif; ?>
		<?php endforeach; ?>
		<?php endif; ?>

		<?php if (!empty($this->link_items)) : ?>
			<div class="items-more">
			<?php echo $this->loadTemplate('links'); ?>
		</div>
		<?php endif; ?>

		<?php if (!empty($this->children[$this->category->id])&& $this->maxLevel != 0) : ?>
			<div class="cat-children">
				<?php if ($this->params->get('show_category_heading_title_text', 1) == 1) : ?>
					<h3> <?php echo JTEXT::_('JGLOBAL_SUBCATEGORIES'); ?> </h3>
				<?php endif; ?>
				<?php echo $this->loadTemplate('children'); ?> 
			</div>
		<?php endif; ?>
		<?php if (($this->params->def('show_pagination', 1) == 1  || ($this->params->get('show_pagination') == 2)) && ($this->pagination->get('pages.total') > 1)) : ?>
		<div class="pagination">
			<?php echo $this->pagination->getPagesLinks(); ?>
			<?php  if ($this->params->def('show_pagination_results', 1)) : ?>
			<p class="counter jsn-pageinfo"> <?php echo $this->pagination->getPagesCounter(); ?> </p>
			<?php endif; ?>
		</div>
	<?php  endif; ?>
</div>
<?php else: ?>
	<div class="blog<?php echo $this->pageclass_sfx;?>">
<?php if ($this->params->get('show_page_heading')) : ?>
	<h1>
		<?php echo $this->escape($this->params->get('page_heading')); ?>
	</h1>
	<?php endif; ?>

	<?php if ($this->params->get('show_category_title', 1) or $this->params->get('page_subheading')) : ?>
	<h2>
		<?php echo $this->escape($this->params->get('page_subheading')); ?>
		<?php if ($this->params->get('show_category_title')) : ?>
			<span class="subheading-category"><?php echo $this->category->title;?></span>
		<?php endif; ?>
	</h2>
	<?php endif; ?>




<?php if ($this->params->get('show_description', 1) || $this->params->def('show_description_image', 1)) : ?>
	<div class="category-desc">
	<?php if ($this->params->get('show_description_image') && $this->category->getParams()->get('image')) : ?>
		<img src="<?php echo $this->category->getParams()->get('image'); ?>"/>
	<?php endif; ?>
	<?php if ($this->params->get('show_description') && $this->category->description) : ?>
		<?php echo JHtml::_('content.prepare', $this->category->description, '', 'com_content.category'); ?>
	<?php endif; ?>
	<div class="clr"></div>
	</div>
<?php endif; ?>

<?php if (empty($this->lead_items) && empty($this->link_items) && empty($this->intro_items)) : ?>
	<?php if ($this->params->get('show_no_articles', 1)) : ?>
		<p><?php echo JText::_('COM_CONTENT_NO_ARTICLES'); ?></p>
	<?php endif; ?>
<?php endif; ?>

<?php $leadingcount=0 ; ?>
<?php if (!empty($this->lead_items)) : ?>
<div class="items-leading">
	<?php foreach ($this->lead_items as &$item) : ?>
		<div class="leading-<?php echo $leadingcount; ?><?php echo $item->state == 0 ? ' system-unpublished' : null; ?>">
			<?php
				$this->item = &$item;
				echo $this->loadTemplate('item');
			?>
		</div>
		<?php
			$leadingcount++;
		?>
	<?php endforeach; ?>
</div>
<?php endif; ?>
<?php
	$introcount=(count($this->intro_items));
	$counter=0;
?>
<?php if (!empty($this->intro_items)) : ?>

	<?php foreach ($this->intro_items as $key => &$item) : ?>
	<?php
		$key= ($key-$leadingcount)+1;
		$rowcount=( ((int)$key-1) %	(int) $this->columns) +1;
		$row = $counter / $this->columns ;

		if ($rowcount==1) : ?>
	<div class="items-row cols-<?php echo (int) $this->columns;?> <?php echo 'row-'.$row ; ?> row-fluid">
	<?php endif; ?>
	<div class="item column-<?php echo $rowcount;?><?php echo $item->state == 0 ? ' system-unpublished' : null; ?> span<?php echo round((12 / $this->columns));?>">
		<?php
			$this->item = &$item;
			echo $this->loadTemplate('item');
		?>
	</div>
	<?php $counter++; ?>
	<?php if (($rowcount == $this->columns) or ($counter ==$introcount)): ?>
				<span class="row-separator"></span>
				</div>

			<?php endif; ?>
	<?php endforeach; ?>


<?php endif; ?>

<?php if (!empty($this->link_items)) : ?>

	<?php echo $this->loadTemplate('links'); ?>

<?php endif; ?>


	<?php if (!empty($this->children[$this->category->id])&& $this->maxLevel != 0) : ?>
		<div class="cat-children">
		<?php if ($this->params->get('show_category_heading_title_text', 1) == 1) : ?>
		<h3>
		<?php echo JTEXT::_('JGLOBAL_SUBCATEGORIES'); ?>
		</h3>
		<?php endif; ?>
			<?php echo $this->loadTemplate('children'); ?>
		</div>
	<?php endif; ?>

<?php if (($this->params->def('show_pagination', 1) == 1  || ($this->params->get('show_pagination') == 2)) && ($this->pagination->get('pages.total') > 1)) : ?>
		<div class="pagination">
			<?php echo $this->pagination->getPagesLinks(); ?>
			<?php  if ($this->params->def('show_pagination_results', 1)) : ?>
				<p class="counter jsn-pageinfo">
						<?php echo $this->pagination->getPagesCounter(); ?>
				</p>

			<?php endif; ?>
		</div>
<?php  endif; ?>

</div>	
<?php endif; ?>
