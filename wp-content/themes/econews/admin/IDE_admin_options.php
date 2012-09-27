<?php

	/*
		Copyright 2010, idesigneco.com
		http://idesigneco.com
	*/

	// theme specific options

	// checkbox options
	$IDE_checkboxes = array('nav', 'nav_cat', 'sidebar_page', 'sidebar_blog', 'post_author', 'post_fullmeta', 'post_img_resize', 'css_enable',
							'homepage_autoslide', 'post_fullmeta', 'post_strip', 'post_facebook');
	// category list
	$all_cats = get_categories();
	$categories = array('' => '-- None --', '-' => '-- All --');
	if($all_cats) foreach($all_cats as $c) {
		$categories[$c->cat_ID] = $c->cat_name;
	}


	// setup the form fields
	$Form->elements(
		array('name' => 'General stuff', 'id' => 'general'),	// section
		array(
			'logo_url' => array(
				'type' => 'text', 'label' => 'Logo',  'value' => IDE_URL.'images/logo.png',
				'info' => 'Full URL of your logo image (eg: http://site.com/images/logo.png)'
			),
			'favicon_url' => array(
				'type' => 'text', 'label' => 'Favicon',  'value' => IDE_URL.'favicon.ico',
				'info' => 'Full URL of your favicon (eg: http://site.com/favicon.ico). Favicons usually appear in the addressbar of browsers.'
			),
			'nav' => array(
				'type' => 'checkbox', 'label' => 'Navigation menu' , 'value' => 'on',
				'info' => 'Display the page navigation menu in the header?'
			),
			'nav_cat' => array(
				'type' => 'checkbox', 'label' => 'Category navigation menu', 'value' => 'on',
				'info' => 'Display the category list menu below the header?'
			),
			'sidebar_page' => array(
				'type' => 'checkbox', 'label' => 'Page sidebar' , 'value' => 'on',
				'info' => 'Display the sidebar (with widgets and other content) on static pages such as <em>about</em>?'
			),
			'sidebar_blog' => array(
				'type' => 'checkbox', 'label' => 'Blog sidebar' , 'value' => 'on',
				'info' => 'Display the sidebar (with widgets and other content) on your blog, blog archive and other blog pages?'
			),
			'feedurl' => array(
				'type' => 'text', 'label' => 'Feedburner / Feed url', 'value' => get_bloginfo('rss2_url'),
				'info' => 'The URL to your Feedburner page or other feed. If this is left empty, Wordpress\'s RSS feeds will be used for syndication',
			),
			'header_banner' => array(
				'type' => 'textarea', 'label' => 'Header banner ad' , 'value' => '',
				'info' => 'If you want to display a banner ad in the header, paste your banner code here'
			),
			'analytics' => array(
				'type' => 'textarea', 'label' => 'Analytics / Tracking code',
				'info' => 'Paste your Google Analytics or any other tracking code here',
			),
			'affiliate' => array(
				'type' => 'text', 'label' => 'iDesignEco affiliate ID', 'value' => '',
				'info' => 'Your iDesignEco affiliate ID (numerical). Your affiliate ID can be found in the <a href="http://idesigneco.com/members">affiliates area</a>.
						  Specifying your ID here will turn the small iDesignEco logo in the footer of your website to an affiliate link,
						  giving you <a href="http://idesigneco.com/affiliates">referral commissions</a> when people signup via
						  the link.'
			)
		)
	);
	
	$Form->elements(
		array('name' => 'Homepage', 'id' => 'homepage'),	// section
		array(
			'homepage_featured' => array(
				'type' => 'select', 'label' => 'Featured slideshow category',
				'info' => 'Posts from this category will be featured on the homepage as a slideshow',
				'attribs' => array('options' => $categories)
			),
   			'homepage_featured_num' => array(
				'type' => 'text', 'label' => 'Number of featured slideshow posts',  'value' => 4,
				'info' => 'Number of featured posts to display in the slideshow. Default is 4'
			),
			'homepage_autoslide' => array(
				'type' => 'checkbox', 'label' => 'Automatic slideshow', 'value' => 'on',
				'info' => 'Automatically slide the featured posts slideshow at specific intervals?',
			),
			'homepage_banner' => array(
				'type' => 'textarea', 'label' => 'Homepage banner ad' , 'value' => '',
				'info' => 'If you want to display a featured banner ad on the homepage, paste your banner code here'
			),
		)
	);
	
	$Form->elements(
		array('name' => 'Blog posts', 'id' => 'posts'),	// section
		array(
			'post_content' => array(
				'type' => 'select', 'label' => 'Post content',
				'info' => 'On the home page, blog list, archive page etc., show the full post content or excerpts?',
				'attribs' => array('options' => array('' => 'Full post content', 'excerpt' => 'Excerpt'))
			),
			'post_author' => array(
				'type' => 'checkbox', 'label' => 'Author information', 'value' => 'on',
				'info' => 'Show the author\'s name under the post titles?',
			),
			'post_fullmeta' => array(
				'type' => 'checkbox', 'label' => 'Detailed meta information', 'value' => 'on',
				'info' => 'Show detailed meta information under each post? This does not appear on blog lists,
						  but the full page of a blog entries.',
			),
			'post_img_resize' => array(
				'type' => 'checkbox', 'label' => 'Automatic image resizing', 'value' => 'on',
				'info' => 'Try to automatically resize large images in blog posts so they are contained and don\'t overflow.',
			),
			'post_strip' => array(
				'type' => 'checkbox', 'label' => 'Share Strip', 'value' => 'on',
				'info' => 'Show the Facebook / Twitter sharing icons in a strip beside blog posts?',
			),
			'post_facebook' => array(
				'type' => 'checkbox', 'label' => 'Share on Facebook', 'value' => 'on',
				'info' => 'Display Facebook link in the blog post strip?',
			),
			'twitter' => array(
				'type' => 'text', 'label' => 'Twitter username',
				'info' => 'Enter your Twitter username to show the retweet icon in the blog post strip',
			)
		)
	);

	$Form->elements(
		array('name' => 'Styles', 'id' => 'styles'),	// section
		array(
			'css_enable' => array(
				'type' => 'checkbox', 'label' => 'Enable custom styles', 'value' => 'on',
				'info' => 'Enable custom styles specified here and override the default theme style?',
			),
			'css_bodycolor' => array(
				'type' => 'text', 'label' => 'Page background color',  'value' => '',
				'info' => 'Hex color code for page background. eg: #CC0000'
			),
			'css_headercolor' => array(
				'type' => 'text', 'label' => 'Header background color',  'value' => '',
				'info' => 'Hex color code for header background. eg: #CC0000'
			),
			'css_sidebarcolor' => array(
				'type' => 'text', 'label' => 'Sidebar background color',  'value' => '',
				'info' => 'Hex color code for sidebar background. eg: #CC0000'
			),
			'css_sidebarwidgetcolor' => array(
				'type' => 'text', 'label' => 'Sidebar widget background color',  'value' => '',
				'info' => 'Hex color code for sidebar widget background. eg: #CC0000'
			),
			'css_footerbarcolor' => array(
				'type' => 'text', 'label' => 'Footerbar background color',  'value' => '',
				'info' => 'Hex color code for footer background. eg: #CC0000'
			),
			'css_footerwidgetcolor' => array(
				'type' => 'text', 'label' => 'Footerbar widget background color',  'value' => '',
				'info' => 'Hex color code for footerbar widget background. eg: #CC0000'
			),
			'css_textcolor' => array(
				'type' => 'text', 'label' => 'Text color',  'value' => '',
				'info' => 'Hex color code for text. eg: #CC0000'
			),
			'css_linkcolor' => array(
				'type' => 'text', 'label' => 'Link color',  'value' => '',
				'info' => 'Hex color code for text. eg: #CC0000'
			),
			'css_append' => array(
				'type' => 'textarea', 'label' => 'Custom CSS definitions',
				'info' => 'If you want to append custom CSS definitions to the style, paste them here',
			)
		)
	);

	$Form->elements(
		array('name' => 'Help', 'id' => 'help',
			'info' => '
				<ul class="tips">
					<li class="video">
						<a href="#" class="button" id="bt_ecovideo">Watch the '.IDE_NAME.' video</a>
						<div id="ecovideo" title="'.IDE_CODE.'"> </div>
					</li>
					<li><strong>Widgets</strong><br />
						Don\'t forget to add <a href="widgets.php">widgets</a> to the sidebar and footerbar. Especially, the bundled ecoSocial widget!</li>
					<li><strong>Need help?</strong><br />
						If you need help, you can always consult the <a href="http://idesigneco.com/docs/'.IDE_CODE.'_documentation">'.IDE_NAME.' documentation</a>.</li>
				</ul>
			'),	// section
		null
	);

?>