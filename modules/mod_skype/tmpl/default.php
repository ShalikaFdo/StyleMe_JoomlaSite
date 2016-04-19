<?php
/**
 * @copyright   Copyright (C) 2013 R2H B.V. All rights reserved.
 * @license     GNU General Public License version 2 or later;
 */

defined('_JEXEC') or die;

$SkypeType = $params->get('skypetype', 'Call');
$SkypeSize = $params->get('skypesize', '32');
$SkypeName = $params->get('skypename');
$SkypeText = $params->get('skypetext');

?>


<div class="custom<?php echo $moduleclass_sfx ?>" <?php if ($params->get('backgroundimage')) : ?> style="background-image:url(<?php echo $params->get('backgroundimage');?>)"<?php endif;?> >
    <style>
    .skypebutton img {
        margin: 10px 0 !important;
        padding: 0 !important;
        vertical-align: 0 !important;
    }
    .skypebutton a, .skypebutton a:link, .skypebutton a:visited, .skypebutton a:hover {
        display: block !important;
    }
    ul#dropdown_SkypeButton_Dropdown_<?php echo $SkypeName; ?>_1 {
        width: 100px !important;
    }
    ul#dropdown_SkypeButton_Dropdown_<?php echo $SkypeName; ?>_1 >li {
        line-height: 25px;;
    }
    </style>
    
    <?php if (strlen($SkypeText) > 0) { 
      echo $SkypeText;    
    } ?>
    
    <?php if ($SkypeType == "") { 
      echo "No Skype name filled";   
    } else { ?>
       
    <?php if ($SkypeType == "Call") { ?>
        
    <script type="text/javascript" src="http://www.skypeassets.com/i/scom/js/skype-uri.js"></script>
    <div id="SkypeButton_Call_<?php echo $SkypeName ?>_1" class="skypebutton">
    <script type="text/javascript">
    Skype.ui({
      "name": "call",
      "element": "SkypeButton_Call_<?php echo $SkypeName ?>_1",
      "participants": ["<?php echo $SkypeName ?>"],
      "imageSize": <?php echo $SkypeSize ?>
    });
    </script>
    </div>
    
	<?php } elseif ($SkypeType == "Chat") { ?>
    
    <script type="text/javascript" src="http://www.skypeassets.com/i/scom/js/skype-uri.js"></script>
    <div id="SkypeButton_Chat_<?php echo $SkypeName ?>_1" class="skypebutton">
    <script type="text/javascript">
    Skype.ui({
      "name": "chat",
      "element": "SkypeButton_Chat_<?php echo $SkypeName ?>_1",
      "participants": ["<?php echo $SkypeName ?>"],
      "imageSize": <?php echo $SkypeSize ?>
    });
    </script>
    </div>
    
	<?php } else { ?>
    
    <script type="text/javascript" src="http://www.skypeassets.com/i/scom/js/skype-uri.js"></script>
    <div id="SkypeButton_Dropdown_<?php echo $SkypeName ?>_1" class="skypebutton">
    <script type="text/javascript">
    Skype.ui({
      "name": "dropdown",
      "element": "SkypeButton_Dropdown_<?php echo $SkypeName ?>_1",
      "participants": ["<?php echo $SkypeName ?>"],
      "imageSize": <?php echo $SkypeSize ?>
    });
    </script>
    </div>
    <?php } ?>
    <?php } ?>
</div>
