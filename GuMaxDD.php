<?php
/*
 * ----------------------------------------------------------------------------
 * 'GuMaxDD' style sheet for CSS2-capable browsers.
 *       Loosely based on the monobook style
 *
 * @Version 1.5.2
 * @Author Paul Y. Gu, <gu.paul@gmail.com>
 * @Copyright paulgu.com 2007 - http://www.paulgu.com/
 * @License: GPL (http://www.gnu.org/copyleft/gpl.html)
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 59 Temple Place - Suite 330, Boston, MA 02111-1307, USA.
 * http://www.gnu.org/copyleft/gpl.html
 * ----------------------------------------------------------------------------
 */

if( !defined( 'MEDIAWIKI' ) )
    die( -1 );

/**
 * Inherit main code from SkinTemplate, set the CSS and template filter.
 * @todo document
 * @ingroup Skins
 */
class SkinGuMaxDD extends SkinTemplate {
	/** Using GuMaxDD */
	var $skinname = 'gumaxdd', $stylename = 'gumaxdd',
		$template = 'GuMaxDDTemplate', $useHeadElement = true;

	function setupSkinUserCss( OutputPage $out ) {
		global $wgHandheldStyle;

		parent::setupSkinUserCss( $out );


		// Append to the default screen common & print styles...
		$out->addStyle( 'gumaxdd/gumax_main.css', 'screen' );
		if( $wgHandheldStyle ) {
			// Currently in testing... try 'chick/main.css'
			$out->addStyle( $wgHandheldStyle, 'handheld' );
		}

		$out->addStyle( 'gumaxdd/IE50Fixes.css', 'screen', 'lt IE 5.5000' );
		$out->addStyle( 'gumaxdd/IE55Fixes.css', 'screen', 'IE 5.5000' );
		$out->addStyle( 'gumaxdd/IE60Fixes.css', 'screen', 'IE 6' );
		$out->addStyle( 'gumaxdd/IE70Fixes.css', 'screen', 'IE 7' );

		$out->addStyle( 'gumaxdd/rtl.css', 'screen', '', 'rtl' );
		$out->addStyle( 'gumaxdd/gumax_print.css', 'print' );
	}
}

/**
 * @todo document
 * @ingroup Skins
 */
class GuMaxDDTemplate extends BaseTemplate {
	var $skin;
	/**
	 * Template filter callback for GuMaxDD skin.
	 * Takes an associative array of data set from a SkinTemplate-based
	 * class, and a wrapper for MediaWiki's localization database, and
	 * outputs a formatted page.
	 *
	 * @access private
	 */
	function execute() {
		$this->skin = $this->data['skin'];

		// Suppress warnings to prevent notices about missing indexes in $this->data
		wfSuppressWarnings();

		$this->html( 'headelement' );
?><div id="gumax-page">
	<!--///===== Drop Down menu script =====///-->

	<!--/// no need for mediawiki 1.17.0 and up
	<script type="<?php $this->text('jsmimetype') ?>" src="<?php $this->text('stylepath') ?>/<?php $this->text('stylename') ?>/scripts/jquery-1.4.2.min.js?<?php echo $GLOBALS['wgStyleVersion'] ?>"></script>
	    ///-->

	<!--/// click style
	<script type="<?php $this->text('jsmimetype') ?>" src="<?php $this->text('stylepath') ?>/<?php $this->text('stylename') ?>/scripts/jquery.droppy-0.1.2.js?<?php echo $GLOBALS['wgStyleVersion'] ?>"></script>
	<script type="<?php $this->text('jsmimetype') ?>">jQuery(document).ready( function($){  $(function(){ $('#gumax-nav').droppy({trigger: 'click'}); })  } );</script>
	    ///-->

	<!--/// auto style ///-->
	<script type="<?php $this->text('jsmimetype') ?>" src="<?php $this->text('stylepath') ?>/<?php $this->text('stylename') ?>/scripts/jquery.droppy.js?<?php echo $GLOBALS['wgStyleVersion'] ?>"></script>
	<script type="<?php $this->text('jsmimetype') ?>">jQuery(document).ready( function($){  $(function(){ $('#gumax-nav').droppy({speed: 10}); })  } );</script>

	<!--///===== End of Drop Down menu =====///-->


	<div id="gumax-header">

		<div id="gumax-p-login">
			<?php $this->personalLoginBox(); ?>
		</div> <!-- end of Login Tools -->

		<div id="gumax-p-logo">
			<?php $this->logoBox(); ?>
		</div> <!-- end of gumax-p-logo -->

		<?php $this->searchBox(); ?>

	</div> <!-- ///// end of gumax-header ///// -->

	<div style="clear:both"></div>


	<div id="gumax-p-navigation">
		<?php $this->mainNavigationBox(); ?>
	</div> <!-- end of Navigation Menu -->

	<div style="clear:both"></div>

	<!-- gumax-content-actions -->
	<div id="gumax-content-actions">
		<?php $this->contentActionBox(false); ?>
	</div>
	<!-- end of gumax-content-actions -->

	<div class="gumax-p-navigation-spacer"></div>

	<!-- gumax-article-picture -->
	<?php $this->articlePictureBox(); ?>
	<!-- end of gumax-article-picture -->

	<!-- gumax-content-body -->
	<?php $this->GuMaxMainContentBox(); ?>
	<!-- end of gumax-content-body -->


	<div class="gumax-footer-spacer"></div>


	<div id="gumax-footer">

		<!-- personal specia tools  -->
		<?php $this->wikiSpecialToolBox(); ?>
		<!-- end of personal specia tools  -->

		<!-- gumax-f-message -->
		<?php $this->articleMessageBox(); ?>
		<!-- end of gumax-f-message -->

		<?php $this->html('bottomscripts'); /* JS call to runBodyOnloadHook */ ?>

	</div> <!-- ///// end of gumax-footer ///// -->


	<!-- gumax-f-list -->
	<?php $this->siteCreditBox(); ?>
	<!-- end of gumax-f-list -->


</div> <!-- ===== end of gumax-page ===== -->

	<div style="clear:both"></div>

	<div id="gumax_page_spacer"></div>


<?php $this->html('reporttime') ?>
<?php if ( $this->data['debug'] ): ?>
<!-- Debug output:
<?php $this->text( 'debug' ); ?>
-->
<?php endif; ?>

</body></html>



	
<?php
	wfRestoreWarnings();

	} // end of execute() method



	/* ======================================== FUNCTIONS ======================================= */


	/*************************************************************************************************/
	function logoBox() {
?>
	<div id="p-logo">
		<a style="background-image: url(<?php $this->text('logopath') ?>);" <?php
			?>href="<?php echo htmlspecialchars($this->data['nav_urls']['mainpage']['href'])?>"   ></a>
	</div>
	<script type="<?php $this->text('jsmimetype') ?>"> if (window.isMSIE55) fixalpha(); </script>
<?php
	}



	/*************************************************************************************************/
	function searchBox( $menu = false ) {

		if ($menu) { ?>
			<li class=""><span>
			<form action="<?php $this->text('searchaction') ?>" id="searchform"><div>
			<input id="searchInput" name="search" type="text"<?php   
			if( isset( $this->data['search'] ) ) {
				?> value="<?php $this->text('search') ?>"
<?php 		} ?> />
			<input type='submit' name="go" class="searchButton" id="searchGoButton"	value="<?php $this->msg('searcharticle') ?>"   />&nbsp;
			<input type='submit' name="fulltext" class="searchButton" id="mw-searchButton" value="<?php $this->msg('searchbutton') ?>"   />
			</div></form>
			</span></li>
<?php		return;
		}
?>

	<div id="gumax-p-search">
		<!--h5><label for="searchInput"><?php $this->msg('search') ?></label></h5-->
		<div id="gumax-searchBody">
			<form action="<?php $this->text('searchaction') ?>" id="searchform"><div>
				<input id="searchInput" name="search" type="text"<?php   
					if( isset( $this->data['search'] ) ) {
						?> value="<?php $this->text('search') ?>"<?php } ?> />
				<input type='submit' name="go" class="searchButton" id="searchGoButton"	value="<?php $this->msg('searcharticle') ?>"   />&nbsp;
				<input type='submit' name="fulltext" class="searchButton" id="mw-searchButton" value="<?php $this->msg('searchbutton') ?>"   />
			</div></form>
		</div>
	</div>
<?php
	}



	/*************************************************************************************************/
	function toolbox( $menu = false ) {

	if (!$menu) {
?>
	<div class="portlet" id="p-tb">
		<h5><?php $this->msg('toolbox') ?></h5>
		<div class="pBody">
			<ul>
<?php	}


		if($this->data['notspecialpage']) { ?>
				<li id="t-whatlinkshere"><a href="<?php
				echo htmlspecialchars($this->data['nav_urls']['whatlinkshere']['href'])
				?>"   ><?php $this->msg('whatlinkshere') ?></a></li>
<?php
			if( $this->data['nav_urls']['recentchangeslinked'] ) { ?>
				<li id="t-recentchangeslinked"><a href="<?php
				echo htmlspecialchars($this->data['nav_urls']['recentchangeslinked']['href'])
				?>"   ><?php $this->msg('recentchangeslinked') ?></a></li>
<?php 		}
		}
		if(isset($this->data['nav_urls']['trackbacklink'])) { ?>
			<li id="t-trackbacklink"><a href="<?php
				echo htmlspecialchars($this->data['nav_urls']['trackbacklink']['href'])
				?>"   ><?php $this->msg('trackbacklink') ?></a></li>
<?php 	}
		if($this->data['feeds']) { ?>
			<li id="feedlinks"><?php foreach($this->data['feeds'] as $key => $feed) {
					?><span id="feed-<?php echo Sanitizer::escapeId($key) ?>"><a href="<?php
					echo htmlspecialchars($feed['href']) ?>"   ><?php echo htmlspecialchars($feed['text'])?></a>&nbsp;</span>
					<?php } ?></li><?php
		}

		foreach( array('contributions', 'log', 'blockip', 'emailuser', 'upload', 'specialpages') as $special ) {

			if($this->data['nav_urls'][$special]) {
				?><li id="t-<?php echo $special ?>"><a href="<?php echo htmlspecialchars($this->data['nav_urls'][$special]['href'])
				?>"   ><?php $this->msg($special) ?></a></li>
<?php		}
		}

		if(!empty($this->data['nav_urls']['print']['href'])) { ?>
				<li id="t-print"><a href="<?php echo htmlspecialchars($this->data['nav_urls']['print']['href'])
				?>"   ><?php $this->msg('printableversion') ?></a></li><?php
		}

		if(!empty($this->data['nav_urls']['permalink']['href'])) { ?>
				<li id="t-permalink"><a href="<?php echo htmlspecialchars($this->data['nav_urls']['permalink']['href'])
				?>"   ><?php $this->msg('permalink') ?></a></li><?php
		} elseif ($this->data['nav_urls']['permalink']['href'] === '') { ?>
				<li id="t-ispermalink"   ><?php $this->msg('permalink') ?></li><?php
		}


		wfRunHooks( 'GuMaxDDTemplateToolboxEnd', array( &$this ) );
		wfRunHooks( 'SkinTemplateToolboxEnd', array( &$this ) );

		if (!$menu) {
?>
			</ul>
		</div>
	</div>
<?php
		}
	}



	/*************************************************************************************************/
	function languageBox() {

		if( $this->data['language_urls'] ) {
?>
	<div id="p-lang" class="portlet">
		<h5><?php $this->msg('otherlanguages') ?></h5>
		<div class="pBody">
			<ul>
<?php		foreach($this->data['language_urls'] as $langlink) { ?>
				<li class="<?php echo htmlspecialchars($langlink['class'])?>"><?php
				?><a href="<?php echo htmlspecialchars($langlink['href']) ?>"><?php echo $langlink['text'] ?></a></li>
<?php		} ?>
			</ul>
		</div>
	</div>
<?php
		} else {
?>
			<li class="">This page does not have language versions</li>
<?php
		}
	}



	/*************************************************************************************************/
	function customBox( $bar, $cont ) {
?>
	<div class='generated-sidebar portlet' id='p-<?php echo Sanitizer::escapeId($bar) ?>'   >
		<h5><?php $out = wfMsg( $bar ); if (wfEmptyMsg($bar, $out)) echo $bar; else echo $out; ?></h5>
		<div class='pBody'>
<?php   if ( is_array( $cont ) ) { ?>
			<ul>
<?php 			foreach($cont as $key => $val) { ?>
				<li id="<?php echo Sanitizer::escapeId($val['id']) ?>"<?php
					if ( $val['active'] ) { ?> class="active" <?php }
				?>><a href="<?php echo htmlspecialchars($val['href']) ?>"   ><?php echo htmlspecialchars($val['text']) ?></a></li>
<?php			} ?>
			</ul>
<?php   } else {
			# allow raw HTML block to be defined by extensions
			print $cont;
		}
?>
		</div>
	</div>
<?php
	}



	/*************************************************************************************************/
	function mainNavigationBox() {
		$sidebar = $this->data['sidebar'];
		if ( !isset( $sidebar['SEARCH'] ) ) $sidebar['SEARCH'] = true;
		if ( !isset( $sidebar['TOOLBOX'] ) ) $sidebar['TOOLBOX'] = true;
		if ( !isset( $sidebar['LANGUAGES'] ) ) $sidebar['LANGUAGES'] = true;
		if ( !isset( $sidebar['ACTIONS'] ) ) $sidebar['ACTIONS'] = true;
 ?>
 	<ul id="gumax-nav">
<?php 	foreach ($this->data['sidebar'] as $bar => $cont) {
			switch ($bar) {
			case 'SEARCH':
				$txtOut = wfMsg('search');
				break;
			case 'TOOLBOX':
				$txtOut = wfMsg('toolbox');
				break;
			case 'LANGUAGES':
				$txtOut = wfMsg('otherlanguages');
				break;
			case 'ACTIONS':
				$txtOut = wfMsg('views');
				break;
			default:
				$out = wfMsg( $bar );
				if (wfEmptyMsg($bar, $out))
					$txtOut = $bar;
				else
					$txtOut = $out;
			} ?>
			<li><a id="gumax-nav-heading" href="#"><?php print $txtOut; ?>  &raquo;</a>
<?php
			# XXX JaTu fix
			if ( $bar == 'SEARCH' ) { ?>
			<ul>
<?php			$this->searchBox(true); ?>
			</ul>
<?php		} elseif ( $bar == 'TOOLBOX' ) { ?>
			<ul>
<?php			$this->toolbox(true); ?>
			</ul>
<?php		} elseif ( $bar == 'LANGUAGES' ) { ?>
 			<ul>
<?php			$this->languageBox(); ?>
			</ul>
<?php		} elseif ( $bar == 'ACTIONS' ) { ?>
 			<ul>
<?php			$this->contentActionBox(true); ?>
			</ul>
<?php		} else {
				# XXX JaTu fix ends
				if ( is_array( $cont ) ) { ?>
				<ul>
<?php 				foreach($cont as $key => $val) { ?>
 					<li id="<?php echo Sanitizer::escapeId($val['id']) ?>"<?php
 						if ( $val['active'] ) { ?> class="active" <?php }
 						?>><a href="<?php echo htmlspecialchars($val['href']) ?>"   ><?php echo htmlspecialchars($val['text']) ?></a></li>
<?php				} ?>
				<li><p style="margin:0; padding: 7px 0;"></p></li>
 				</ul>
<?php   		} else {
 				# allow raw HTML block to be defined by extensions
 				//print $cont;
				}
			}
?>
			</li>
<?php	} ?>
	</ul>
<?php
	}


	/*************************************************************************************************/
	function personalLoginBox() {
?>
	<!--li><a href="#"><?php //$this->msg('personaltools') ?>My Accounts</a-->
		<ul>
<?php 		foreach($this->data['personal_urls'] as $key => $item) { ?>
			<li id="pt-<?php echo Sanitizer::escapeId($key) ?>"<?php
				if ($item['active']) { ?> class="active"<?php } ?>><a href="<?php
			echo htmlspecialchars($item['href']) ?>"   <?php
			if(!empty($item['class'])) { ?> class="<?php
			echo htmlspecialchars($item['class']) ?>"<?php } ?>><?php
			echo htmlspecialchars($item['text']) ?></a></li>
<?php		} ?>
		</ul>
	<!--/li-->
<?php
	}



	/*************************************************************************************************/
	function contentActionBox( $menu = false ) {
		global $wgUser;
		$skin = $wgUser->getSkin();
?>
<?php 	if(!$menu) { ?>
		<ul>
<?php 	} ?>
<?php	foreach($this->data['content_actions'] as $key => $tab) {
				echo '
			 <li id="ca-' . Sanitizer::escapeId($key).'"';
				if( $tab['class'] ) {
					echo ' class="'.htmlspecialchars($tab['class']).'"';
				}
				echo'><a href="'.htmlspecialchars($tab['href']).'"';
				# We don't want to give the watch tab an accesskey if the
				# page is being edited, because that conflicts with the
				# accesskey on the watch checkbox.  We also don't want to
				# give the edit tab an accesskey, because that's fairly su-
				# perfluous and conflicts with an accesskey (Ctrl-E) often
				# used for editing in Safari.

				echo '>'.htmlspecialchars($tab['text']).'</a></li>';
			} ?>

<?php 	if(!$menu) { ?>
		</ul>
<?php 	} ?>

<?php
	}



	/*************************************************************************************************/
	function articlePictureBox() {
?>
<?php
		$pageClasses = preg_split("/[\s]+/", $this->data['pageclass']); /* echo $this->data['pageclass']; */
		foreach($pageClasses as $item){ if(strpos($item, "page-") !== false){ $page_class = $item; /* echo $page_class; */ } }

		$file_ext_collection = array('.jpg', '.gif', '.png');
		$found = false;
		foreach ($file_ext_collection as $file_ext)
		{
			$gumax_article_picture_file = $this->data['stylepath'] . '/' . $this->data['stylename'] . '/images/pages/' . $page_class . $file_ext;
			if (file_exists( $_SERVER['DOCUMENT_ROOT'] . '/' .$gumax_article_picture_file)) {
				$found = true;
				break;
			} else {
				$gumax_article_picture_file = $this->data['stylepath'] . '/' . $this->data['stylename'] . '/images/pages/' . 'page-Default.gif'; // default site logo
				if( file_exists( $_SERVER['DOCUMENT_ROOT'] . '/' . $gumax_article_picture_file) ) {
					$found = true;
				}
			}
		}
		if($found) { ?>
			<div id="gumax-article-picture">
				<a style="background-image: url(<?php echo $gumax_article_picture_file ?>);" <?php
					?>href="<?php echo htmlspecialchars( $GLOBALS['wgTitle']->getLocalURL() )?>" <?php
					?>title="<?php $this->data['displaytitle']!=""?$this->html('title'):$this->text('title') ?>"></a>
			</div>
			<div class="gumax-article-picture-spacer"></div>
<?php
		}
	}



	/*************************************************************************************************/
	function mainContentBox() {
?>
	<div id="gumax-content-body">
	<div class="gumax-firstHeading"><?php $this->html('title') ?></div>
	<div class="visualClear"></div>
    <!-- content -->
    <div id="content">
        <a name="top" id="top"></a>
        <?php if($this->data['sitenotice']) { ?><div id="siteNotice"><?php $this->html('sitenotice') ?></div><?php } ?>
        <div id= "bodyContent" class="gumax-bodyContent">
            <h3 id="siteSub"><?php $this->msg('tagline') ?></h3>
            <div id="contentSub"><?php $this->html('subtitle') ?></div>
            <?php if($this->data['undelete']) { ?><div id="contentSub2"><?php $this->html('undelete') ?></div><?php } ?>
            <?php if($this->data['newtalk'] ) { ?><div class="usermessage"><?php $this->html('newtalk')  ?></div><?php } ?>
            <?php if($this->data['showjumplinks']) { ?><div id="jump-to-nav"><?php $this->msg('jumpto') ?> <a href="#column-one"><?php $this->msg('jumptonavigation') ?></a>, <a href="#searchInput"><?php $this->msg('jumptosearch') ?></a></div><?php } ?>
            <!-- start content -->
            <?php $this->html('bodytext') ?>
            <?php if($this->data['catlinks']) { $this->html('catlinks'); } ?>
            <!-- end content -->
            <div class="visualClear"></div>
        </div>
    </div>
    <!-- end of content -->
    </div>
	<!-- end of gumax-content-body -->

<?php
	}




	/*************************************************************************************************/
	function GuMaxMainContentBox() {
?>
	<div id="gumax-content-body">
		<div class="gumax-firstHeading"><?php $this->html('title') ?></div>
		<div class="visualClear"></div>
		<!-- content -->
		<div id="content">
			<a name="top" id="top"></a>
			<?php if($this->data['sitenotice']) { ?><div id="siteNotice"><?php $this->html('sitenotice') ?></div><?php } ?>
			<div id= "bodyContent" class="gumax-bodyContent">
				<h3 id="siteSub"><?php $this->msg('tagline') ?></h3>
				<div id="contentSub"><?php $this->html('subtitle') ?></div>
				<?php if($this->data['undelete']) { ?><div id="contentSub2"><?php $this->html('undelete') ?></div><?php } ?>
				<?php if($this->data['newtalk'] ) { ?><div class="usermessage"><?php $this->html('newtalk')  ?></div><?php } ?>
				<?php if($this->data['showjumplinks']) { ?><div id="jump-to-nav"><?php $this->msg('jumpto') ?> <a href="#column-one"><?php $this->msg('jumptonavigation') ?></a>, <a href="#searchInput"><?php $this->msg('jumptosearch') ?></a></div><?php } ?>
				<!-- start content -->
				<?php $this->html('bodytext') ?>
				<?php if($this->data['catlinks']) { $this->html('catlinks'); } ?>
				<!-- end content -->
				<div class="visualClear"></div>
			</div> <!-- end of bodyContent -->
		</div> <!-- end of content -->
	</div> <!-- end of gumax-content-body -->


<?php
	}




	/*************************************************************************************************/
	function mainContentTopBottomBorderBox() {
?>
	<!-- content border -->
	<table class="gumax-content-table" width="100%" border="0" cellpadding="0" cellspacing="0"><tr>
	<td class="gumax-content-td-topleft"></td>
	<td class="gumax-content-td-center">
	<!-- content border -->

	<div id="gumax-content-body">
	<div class="gumax-firstHeading"><?php $this->html('title') ?></div>
	<div class="visualClear"></div>
    <!-- content -->
    <div id="content">
        <a name="top" id="top"></a>
        <?php if($this->data['sitenotice']) { ?><div id="siteNotice"><?php $this->html('sitenotice') ?></div><?php } ?>
        <div id= "bodyContent" class="gumax-bodyContent">
            <h3 id="siteSub"><?php $this->msg('tagline') ?></h3>
            <div id="contentSub"><?php $this->html('subtitle') ?></div>
            <?php if($this->data['undelete']) { ?><div id="contentSub2"><?php $this->html('undelete') ?></div><?php } ?>
            <?php if($this->data['newtalk'] ) { ?><div class="usermessage"><?php $this->html('newtalk')  ?></div><?php } ?>
            <?php if($this->data['showjumplinks']) { ?><div id="jump-to-nav"><?php $this->msg('jumpto') ?> <a href="#column-one"><?php $this->msg('jumptonavigation') ?></a>, <a href="#searchInput"><?php $this->msg('jumptosearch') ?></a></div><?php } ?>
            <!-- start content -->
            <?php $this->html('bodytext') ?>
            <?php if($this->data['catlinks']) { $this->html('catlinks'); } ?>
            <!-- end content -->
            <div class="visualClear"></div>
        </div>
    </div>
    <!-- end of content -->

    </div>
	<!-- end of gumax-content-body -->

	<!-- content border -->
	</td><td class="gumax-content-td-topright"></td>
	</tr></table>
	<!-- content border -->

<?php
	}



	/*************************************************************************************************/
	function wikiSpecialToolBox() {
?>

		<div id="gumax-special-tools">
			<ul>
	<?php
		if($this->data['notspecialpage']) { ?>
				<li id="t-whatlinkshere"><a href="<?php
				echo htmlspecialchars($this->data['nav_urls']['whatlinkshere']['href'])
				?>"><?php $this->msg('whatlinkshere') ?></a></li>
	<?php
			if( $this->data['nav_urls']['recentchangeslinked'] ) { ?>
				<li id="t-recentchangeslinked"><a href="<?php
				echo htmlspecialchars($this->data['nav_urls']['recentchangeslinked']['href'])
				?>"><?php $this->msg('recentchangeslinked') ?></a></li>
	<?php 		}
		}
		if(isset($this->data['nav_urls']['trackbacklink'])) { ?>
			<li id="t-trackbacklink"><a href="<?php
				echo htmlspecialchars($this->data['nav_urls']['trackbacklink']['href'])
				?>"><?php $this->msg('trackbacklink') ?></a></li>
	<?php 	}
		if($this->data['feeds']) { ?>
			<li id="feedlinks"><?php foreach($this->data['feeds'] as $key => $feed) {
					?><span id="feed-<?php echo htmlspecialchars($key) ?>"><a href="<?php
					echo htmlspecialchars($feed['href']) ?>"><?php echo htmlspecialchars($feed['text'])?></a>&nbsp;</span>
					<?php } ?></li><?php
		}

		foreach( array('contributions', 'blockip', 'emailuser', 'upload', 'specialpages') as $special ) {

			if($this->data['nav_urls'][$special]) {
				?><li id="t-<?php echo $special ?>"><a href="<?php echo htmlspecialchars($this->data['nav_urls'][$special]['href'])
				?>"><?php $this->msg($special) ?></a></li>
	<?php		}
		}

		if(!empty($this->data['nav_urls']['print']['href'])) { ?>
				<li id="t-print"><a href="<?php echo htmlspecialchars($this->data['nav_urls']['print']['href'])
				?>"><?php $this->msg('printableversion') ?></a></li><?php
		}

		if(!empty($this->data['nav_urls']['permalink']['href'])) { ?>
				<li id="t-permalink"><a href="<?php echo htmlspecialchars($this->data['nav_urls']['permalink']['href'])
				?>"><?php $this->msg('permalink') ?></a></li><?php
		} elseif ($this->data['nav_urls']['permalink']['href'] === '') { ?>
				<li id="t-ispermalink"><?php $this->msg('permalink') ?></li><?php
		}

		wfRunHooks( 'GuMaxDDTemplateToolboxEnd', array( &$this ) );
		wfRunHooks( 'SkinTemplateToolboxEnd', array( &$this ) );
	?>
			</ul>
		</div>

<?php
	}



	/*************************************************************************************************/
	function articleMessageBox() {
?>

		<div id="gumax-article-message">
			<?php if($this->data['lastmod']) { ?><span id="f-lastmod"><?php $this->html('lastmod') ?></span>
			<?php } ?><?php if($this->data['viewcount']) { ?><span id="f-viewcount"><?php  $this->html('viewcount') ?> </span>
			<?php } ?>
		</div>

<?php
	}



	/*************************************************************************************************/
	function siteCreditBox() {
?>

		<div id="gumax-credit-list">
			<ul>
				<?php
						$footerlinks = array(
							'numberofwatchingusers', 'credits',
							'privacy', 'about', 'disclaimer', 'tagline',
						);
						foreach( $footerlinks as $aLink ) {
							if( isset( $this->data[$aLink] ) && $this->data[$aLink] ) {
				?>				<li id="<?php echo$aLink?>"><?php $this->html($aLink) ?></li>
				<?php 		}
						}
				?>
				<li id="f-poweredby"><a href="http://mediawiki.org"  target="_blank">Powered by MediaWiki</a></li>
				<li id="f-designedby"><a href="http://paulgu.com"  target="_blank">Designed by Paul Gu</a></li>
			</ul>
		</div>

<?php
	}



	/*************************************************************************************************/


} // end of class
?>
