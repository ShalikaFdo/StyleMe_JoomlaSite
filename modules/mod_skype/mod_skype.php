<?php
/**
 * @copyright   Copyright (C) 2013 R2H B.V.
 * @license     GNU General Public License version 2 or later;
 */

defined('_JEXEC') or die;

if ($params->def('prepare_content', 1))
{
	JPluginHelper::importPlugin('content');
	$module->content = JHtml::_('content.prepare', $module->content, '', 'mod_skype.content');
}

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

require JModuleHelper::getLayoutPath('mod_skype', $params->get('layout', 'default'));
