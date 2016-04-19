/**
 * @version     $Id$
 * @package     JSNExtension
 * @subpackage  JSNTPLFramework
 * @author      JoomlaShine Team <support@joomlashine.com>
 * @copyright   Copyright (C) 2012 JoomlaShine.com. All Rights Reserved.
 * @license     GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * Websites: http://www.joomlashine.com
 * Technical Support:  Feedback - http://www.joomlashine.com/contact-us/get-support.html
 */

var JSNMegamenu = {
		init: function()
		{		
			
		},
		
		setMegamenuSubmenuPosition: function(enableRTL)
		{

			if (document.getElementById('jsn-tpl-megamenu') == null) return false;
			
			// Get all parents
			parents = document.getElements('ul.jsn-tpl-megamenu > li.megamenu-fixed-width');
			
			if (!parents.length) return;
						
			var placeMegamenuSubmenu = function(parent) {
				var maxSize = window.getSize();
				var submenu = parent.getChildren('ul');
				var farLeft = parent.getPosition().x;
				if (submenu.length)
				{	
					submenu.each(function(ul) {
						var width = ul.getStyle('width').toInt();
						if (farLeft + width > maxSize.x)
						{						
							if (width < farLeft)
							{
								parent.addClass('jsn-submenu-flipback');
							}
						}
					});
				}
				
			};
						
			resizeMegamenuSubmenuHandler = function() {
				parents.each(function(parent) {
					
					parent.removeClass('jsn-submenu-flipback');
					placeMegamenuSubmenu(parent);
				});
			};
			
			// Handle window resize event
			window.addEvent('resize', function() {
				
				placeMegamenuSubmenu.timer && clearTimeout(placeMegamenuSubmenu.timer);
				placeMegamenuSubmenu.timer = setTimeout(resizeMegamenuSubmenuHandler, 500);
			});

			// Place all submenus
			resizeMegamenuSubmenuHandler();
		}
};