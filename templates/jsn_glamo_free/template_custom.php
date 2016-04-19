<?php
$jsnutils	= JSNTplUtils::getInstance();
$doc		= $this->_document;

// Count module instances
$doc->hasRight		= $jsnutils->countModules('right');
$doc->hasLeft		= $jsnutils->countModules('left');
$doc->hasPromo		= $jsnutils->countModules('promo');
$doc->hasPromoLeft	= $jsnutils->countModules('promo-left');
$doc->hasPromoRight	= $jsnutils->countModules('promo-right');
$doc->hasInnerLeft	= $jsnutils->countModules('innerleft');
$doc->hasInnerRight	= $jsnutils->countModules('innerright');

// Define template colors
$doc->templateColors	= array('blue', 'red', 'green', 'violet', 'orange', 'grey');

if (isset($doc->sitetoolsColorsItems))
{
	$this->_document->templateColors = $doc->sitetoolsColorsItems;
}

// Apply K2 style
if ($jsnutils->checkK2())
{
	$doc->addStylesheet($doc->templateUrl . "/ext/k2/jsn_ext_k2.css");
}

// Start generating custom styles
$customCss	= '';

// Process TPLFW v2 parameter
if (isset($doc->customWidth))
{
	if ($doc->customWidth != 'responsive')
	{
		$customCss .= '
	#jsn-page {
		min-width: ' . $doc->customWidth . ';
	}
	#jsn-pos-topbar,
	#jsn-topheader-inner,
	#jsn-header_inner,
	#jsn-menu_inner,
	#jsn-content-top_inner,
	#jsn-content-top-below_inner,
	#jsn-content,
	#jsn-content-bottom_inner,
	#jsn-content-bottom-over_inner,
	#jsn-usermodules3-inner,
	#jsn-bottom_inner,
	#jsn-footer-inner, 
	#template-detail-inner,
	#jsn-blog-promo-inner,
	#extension-detail-inner,
	#jsn-promo_inner {
		width: ' . $doc->customWidth . ';
		min-width: ' . $doc->customWidth . ';
	}';
	}
}

$doc->addStyleDeclaration(trim($customCss, "\n"));
