<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  Templates.myproject1
 *
 * @copyright   Copyright (C) 2013 Telerik Student All rights reserved.
 * @license     GNU General Public License version 2 or later
 */

defined('_JEXEC') or die;

// Add JavaScript Frameworks
JHtml::_('bootstrap.framework');

// Load optional Bootstrap bugfixes
JHtmlBootstrap::loadCss($includeMaincss = true);

$app = JFactory::getApplication();
$sitename = $app->getCfg('sitename');
$url = $this->baseurl;
$menu = $app->getMenu();
$backgr = '';
$paragraph = '';
if($menu->getActive() == $menu->getDefault() && 
	 $this->countModules('sidebar-a') && $this->countModules('sidebar-b')) : 	
		$backgr = 'background: #f5f5f5 url('.$url.'/templates/myproject1/images/colbg.png) repeat-y;';		
elseif ($menu->getActive() == $menu->getDefault() && ($this->countModules('sidebar-a') or $this->countModules('sidebar-b'))
or $menu->getActive() !== $menu->getDefault() && $this->countModules('sidebar-b')) :
	$backgr = 'background: #f5f5f5 url('.$url.'/templates/myproject1/images/page-colbg.png) repeat-y;';
endif;	

if($menu->getActive() !== $menu->getDefault()): 				
	$paragraph = '#content p {
		text-align: justify;
	}'; 
endif;	

?>
	
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <jdoc:include type="head" />
  <!-- HTML5 shim for IE backwards compatibility -->
    <!--[if lt IE 9]>
      <script src="<?php echo $url ?>/media/jui/js/html5.js"></script>
      <![endif]-->
      <link href='http://fonts.googleapis.com/css?family=Lato:400,700,900' rel='stylesheet' type='text/css'>
      <link rel="stylesheet" href="templates/myproject1/css/custom.css" type="text/css">  
		<style type="text/css">	  
		<?php 
		echo '#main {'.$backgr.'background-size: 100%;}'.
			$paragraph.'
		@media (max-width: 767px) {
			#main {background: #f5f5f5;}
		}	
		';
		// Template color
		if ($this->params->get('templateColor'))
		{
			echo 
				'body {
					background-color: '.$this->params->get('templateBackgroundColor').';
				}
				a, a:link, a:visited {
					color: '.$this->params->get('templateColor').';
				}';
	    } ?>
		</style> 	  

</head>

<body>

	<div class="container-fluid"> <!-- #wrapper -->
	
		<!-- >> Toolbar-L / Toolbar-R -->
		<div class="row-fluid" role="complementary">		
			
			<?php if ($this->countModules('toolbar-r')): ?>
			<div class="span6 navbar">
			<?php else : ?>
			<div class="span12 navbar">
			<?php endif; ?> 
			<!-- Logo file or site title param -->
				<a class="brand" href="<?php $url; ?>">
				<?php if ($this->params->get('logoFile')):
					$logo = '<img src="'. JURI::root() . $this->params->get('logoFile') .'" alt="'. $sitename .'" />';
				?>
				<?php echo $logo;?> <?php if ($this->params->get('sitedescription')) { echo '<div class="site-description">'. htmlspecialchars($this->params->get('sitedescription')) .'</div>'; } ?> 			
				<?php else: echo $sitename;?>
				<?php endif; ?>
			</a>				
				<jdoc:include type="modules" name="toolbar-l" style="html5" /> 
			</div>							

			<?php if ($this->countModules('toolbar-r')): ?>
			<div class="span6" id="slogan">
				<jdoc:include type="modules" name="toolbar-r" style="html5" /> 
			</div>
			<?php endif; ?>	
		    		    		
		</div>  
    <!-- << Toolbar-L / Toolbar-R --> 
	
	
	<!-- >> Header / Navigation -->	
    <!-- >> Headerbar -->

	<?php if($menu->getActive() == $menu->getDefault()): ?>	
		<div id="header" class="row-fluid">		
			<div class="span12">
			<?php if ($this->countModules('banner')): ?>
				<jdoc:include type="modules" name="banner" style="html5" /> 
			<?php else : ?>	
			<img src="templates/myproject1/images/headerimg.jpg" width="100%" alt=""><!-- header image -->
			<?php endif; ?>
			</div>	
		</div>
	<?php endif; ?>	
		<div class="row-fluid">
			<nav class="span12 navbar" role="navigation">
				<div class="navbar-inner"> 
					<!-- .btn-navbar is used as the toggle for collapsed navbar content -->
					<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>
					<div class="nav-collapse collapse">
						<jdoc:include type="modules" name="headerbar" style="html5" />
					</div>
				</div> 
			</nav>
		</div>	

		<!-- << Headerbar -->

		<!-- >> Main Content and Sidebar  -->    
		
	<!-- >> Feature / Search -->
	<?php if ($this->countModules('feature')): ?>
	<div class="row-fluid">   
        <div class="span12">
          <jdoc:include type="modules" name="feature" style="html5" />
          <!-- Search .navbar-search -->
        </div>
	</div>
    <?php endif; ?>	
	<!-- << Feature / Search -->
		
		<div class="row-fluid" id="main" role="main">
		
        <?php if($menu->getActive() !== $menu->getDefault()): ?>				
			<?php if ($this->countModules('sidebar-b')): ?>
				<div class="span9" id="content">		
			<?php else : ?>			
				<div class="span12" id="content">
			<?php endif; ?>	
				<jdoc:include type="message" />
				<jdoc:include type="component" /> 
				</div>	
			<?php if ($this->countModules('sidebar-b')): ?>
				<div class="span3" id="sidebar-b">					
					<jdoc:include type="modules" name="sidebar-b" style="html5" />
				</div>	
			<?php endif; ?>					

		<?php else : 
			if ($this->countModules('sidebar-a') && $this->countModules('sidebar-b')) : ?>
				<div class="span6" id="content">		
				
		<?php else :
			if ($this->countModules('sidebar-a') or $this->countModules('sidebar-b')) : ?>			
				<div class="span9" id="content">
				<?php else : ?>		
					<div class="span12" id="content">				
				<?php endif; ?>	<!-- sidebar-a or sidebar-b -->	
			<?php endif; ?><!-- sidebar-a && sidebar-b -->
			<jdoc:include type="message" />
			<jdoc:include type="component" /> 
			</div>
			<?php if ($this->countModules('sidebar-a')): ?>
			<div class="span3" id="sidebar-a">					
				<jdoc:include type="modules" name="sidebar-a" style="html5" />
			</div>
			<?php endif; ?>
			<?php if ($this->countModules('sidebar-b')): ?>
			<div class="span3" id="sidebar-b">					
				<jdoc:include type="modules" name="sidebar-b" style="html5" />
			</div>	
			<?php endif; ?>			
			
		<?php endif; ?>	<!-- end home page if -->

		</div><!-- row fluid -->

			
		<!-- << Main Content and Sidebar  -->
  
	<!-- >> Footer  -->
    <div class="row-fluid" role="complementary">
        <!-- >> Footer a-d  -->
			<footer id="footer-area">
			<?php if ($this->countModules('footer-a and footer-b and footer-c and footer-d')): ?>			
				<div class="span3"><jdoc:include type="modules" name="footer-a" style="html5" /></div>
				<div class="span3"><jdoc:include type="modules" name="footer-b" style="html5" /></div>
				<div class="span3"><jdoc:include type="modules" name="footer-c" style="html5" /></div>
				<div class="span3"><jdoc:include type="modules" name="footer-d" style="html5" /></div>			
			<?php elseif ($this->countModules('footer-a and footer-b and footer-c')): ?>
				<div class="span4"><jdoc:include type="modules" name="footer-a" style="html5" /></div>
				<div class="span4"><jdoc:include type="modules" name="footer-b" style="html5" /></div>
				<div class="span4"><jdoc:include type="modules" name="footer-c" style="html5" /></div>
			<?php elseif ($this->countModules('footer-a and footer-b')): ?>
				<div class="span6"><jdoc:include type="modules" name="footer-a" style="html5" /></div>
				<div class="span6"><jdoc:include type="modules" name="footer-b" style="html5" /></div>
			<?php elseif ($this->countModules('footer-a')): ?>
				<div class="span12"><jdoc:include type="modules" name="footer-a" style="html5" /></div>
			<?php endif; ?>				
			</footer>	
        <!-- << Footer a-d  -->
    </div>
	<!-- << End Footer -->
  
	<!-- >> Debug -->
		<jdoc:include type="modules" name="debug" style="html5" />
	<!-- << Debug -->

	</div> <!-- #wrapper -->    

</body>

</html>