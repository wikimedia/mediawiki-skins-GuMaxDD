<?php
/**
 * ----------------------------------------------------------------------------
 * 'GuMaxDD' style sheet for CSS2-capable browsers.
 *       Loosely based on the monobook style
 *
 * @Version 1.6
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

if ( !defined( 'MEDIAWIKI' ) ) {
	die( -1 );
}

/**
 * @ingroup Skins
 */
class GuMaxDDTemplate extends BaseTemplate {
	/**
	 * Template filter callback for GuMaxDD skin.
	 * Takes an associative array of data set from a SkinTemplate-based
	 * class, and a wrapper for MediaWiki's localization database, and
	 * outputs a formatted page.
	 */
	public function execute() {
?><div id="gumax-page">
	<div id="gumax-header">

		<div id="gumax-p-login">
			<?php $this->personalLoginBox(); ?>
		</div> <!-- end of Login Tools -->

		<div id="gumax-p-logo">
			<?php $this->logoBox(); ?>
		</div> <!-- end of gumax-p-logo -->

		<?php $this->searchBox(); ?>

	</div> <!-- ///// end of gumax-header ///// -->

	<div class="visualClear"></div>

	<div id="gumax-p-navigation">
		<?php $this->mainNavigationBox(); ?>
	</div> <!-- end of Navigation Menu -->

	<div class="visualClear"></div>

	<!-- gumax-content-actions -->
	<div id="gumax-content-actions">
		<?php $this->contentActionBox( false ); ?>
	</div>
	<!-- end of gumax-content-actions -->

	<div class="gumax-p-navigation-spacer"></div>

	<!-- gumax-article-picture -->
	<?php $this->articlePictureBox(); ?>
	<!-- end of gumax-article-picture -->

	<!-- gumax-content-body -->
	<?php $this->getMainContentBox(); ?>
	<!-- end of gumax-content-body -->

	<div class="gumax-footer-spacer"></div>

	<div id="gumax-footer">
		<!-- personal special tools  -->
		<?php $this->renderToolbox(); ?>
		<!-- end of personal special tools  -->

		<!-- gumax-f-message -->
		<?php $this->getArticleMessageBox(); ?>
		<!-- end of gumax-f-message -->
	</div> <!-- ///// end of gumax-footer ///// -->

	<!-- gumax-f-list -->
	<?php $this->siteCreditBox(); ?>
	<!-- end of gumax-f-list -->

</div> <!-- ===== end of gumax-page ===== -->

	<div class="visualClear"></div>

	<div id="gumax_page_spacer"></div>
<?php
	} // end of execute() method

	/* ======================================== FUNCTIONS ======================================= */

	/*************************************************************************************************/
	function logoBox() {
?>
	<div id="p-logo">
		<a style="background-image: url(<?php $this->text( 'logopath' ) ?>);" <?php
			?>href="<?php echo htmlspecialchars( $this->data['nav_urls']['mainpage']['href'] ) ?>"></a>
	</div>
<?php
	}

	/*************************************************************************************************/
	/**
	 * @suppress PhanRedundantCondition Phan dislikes the "if $menu append '-menu' to IDs" code
	 * @param bool $menu Append "-menu" to the <form> element ID?
	 * @return void
	 */
	function searchBox( $menu = false ) {
		if ( $menu ) { ?>
			<li>
			<form action="<?php $this->text( 'searchaction' ) ?>" id="searchform<?php echo ( $menu ? '-menu' : '' ) ?>"><div>
			<?php
				echo $this->makeSearchInput( [ 'id' => 'searchInput' . ( $menu ? '-menu' : '' ) ] );
				echo $this->makeSearchButton( 'go', [
					'id' => 'searchGoButton' . ( $menu ? '-menu' : '' ),
					'class' => 'searchButton',
					'value' => $this->getMsg( 'searcharticle' )->text()
				] );
				echo $this->makeSearchButton( 'fulltext', [
					'id' => 'mw-searchButton' . ( $menu ? '-menu' : '' ),
					'class' => 'searchButton',
					'value' => $this->getMsg( 'searchbutton' )->text()
				] );
			?>
			</div></form>
			</li>
<?php		return;
		}
?>

	<div id="gumax-p-search">
		<!--h5><label for="searchInput"><?php $this->msg( 'search' ) ?></label></h5-->
		<div id="gumax-searchBody">
			<form action="<?php $this->text( 'searchaction' ) ?>" id="searchform">
				<div>
				<?php
					echo $this->makeSearchInput( [ 'id' => 'searchInput' ] );
					echo $this->makeSearchButton( 'go', [
						'id' => 'searchGoButton',
						'class' => 'searchButton',
						'value' => $this->getMsg( 'searcharticle' )->text()
					] );
					echo $this->makeSearchButton( 'fulltext', [
						'id' => 'mw-searchButton',
						'class' => 'searchButton',
						'value' => $this->getMsg( 'searchbutton' )->text()
					] );
				?>
				</div>
			</form>
		</div>
	</div>
<?php
	}

	/*************************************************************************************************/
	function toolbox( $menu = false ) {
		if ( !$menu ) {
?>
	<div class="portlet" id="p-tb">
		<h5><?php $this->msg( 'toolbox' ) ?></h5>
		<div class="pBody">
			<ul>
<?php	}

		foreach ( $this->data['sidebar']['TOOLBOX'] as $key => $tbitem ) {
			// ashley 24 October 2020: quick 'n' dirty duplicate ID fix
			if ( isset( $tbitem['id'] ) && $tbitem['id'] ) {
				$tbitem['id'] = $tbitem['id'] . '-nav-menu';
			}
			echo $this->makeListItem( $key, $tbitem );
		}

		if ( !$menu ) {
?>
			</ul>
		</div>
	</div>
<?php
		}
	}

	/*************************************************************************************************/
	function languageBox( $menu = false ) {
		if ( $this->data['language_urls'] ) {
			if ( !$menu ) {
?>
	<div id="p-lang" class="portlet">
		<h5><?php $this->msg( 'otherlanguages' ) ?></h5>
		<div class="pBody">
			<ul>
<?php		}

			foreach ( $this->data['language_urls'] as $key => $langlink ) {
				echo $this->makeListItem( $key, $langlink );
			}

			if ( !$menu ) {
?>
			</ul>
		</div>
	</div>
<?php
			}
		} else {
?>
			<li><?php echo $this->msg( 'gumaxdd-no-languages' ) ?></li>
<?php
		}
	}

	/*************************************************************************************************/
	function customBox( $bar, $cont ) {
		$portletAttribs = [
			'class' => 'generated-sidebar portlet',
			'id' => Sanitizer::escapeIdForAttribute( "p-$bar" ),
			'role' => 'navigation'
		];
		$tooltip = Linker::titleAttrib( "p-$bar" );
		if ( $tooltip !== false ) {
			$portletAttribs['title'] = $tooltip;
		}
		echo '	' . Html::openElement( 'div', $portletAttribs );
		$msg = $this->getSkin()->msg( $bar );
?>

		<h5><?php echo htmlspecialchars( $msg->exists() ? $msg->text() : $bar ); ?></h5>
		<div class="pBody">
<?php	if ( is_array( $cont ) ) { ?>
			<ul>
<?php 			foreach ( $cont as $key => $val ) {
					echo $this->makeListItem( $key, $val );
				}
?>
			</ul>
<?php	} else {
			// allow raw HTML block to be defined by extensions (such as NewsBox)
			echo $cont;
		}
?>
		</div>
	</div>
<?php
	}

	/*************************************************************************************************/
	function mainNavigationBox() {
		$sidebar = $this->data['sidebar'];

		if ( !isset( $sidebar['SEARCH'] ) ) {
			$sidebar['SEARCH'] = true;
		}

		if ( !isset( $sidebar['TOOLBOX'] ) ) {
			$sidebar['TOOLBOX'] = true;
		}

		if ( !isset( $sidebar['LANGUAGES'] ) ) {
			$sidebar['LANGUAGES'] = true;
		}

		if ( !isset( $sidebar['ACTIONS'] ) ) {
			$sidebar['ACTIONS'] = true;
		}

		// @todo FIXME: do not render "in other languages" box for NS_SPECIAL
		// $isSpecial = $this->getSkin()->getTitle()->inNamespace( NS_SPECIAL );
?>
 	<ul id="gumax-nav">
<?php 	foreach ( $this->data['sidebar'] as $bar => $cont ) {
			switch ( $bar ) {
				case 'SEARCH':
					$txtOut = wfMessage( 'search' )->escaped();
					break;
				case 'TOOLBOX':
					$txtOut = wfMessage( 'toolbox' )->escaped();
					break;
				case 'LANGUAGES':
					$txtOut = wfMessage( 'otherlanguages' )->escaped();
					break;
				case 'ACTIONS':
					$txtOut = wfMessage( 'views' )->escaped();
					break;
				default:
					$out = wfMessage( $bar );
					if ( $out->isDisabled() ) {
						$txtOut = $bar;
					} else {
						$txtOut = $out->escaped();
					}
				}
?>
			<li><a class="gumax-nav-heading gumax-nav-heading-<?php echo mb_strtolower( Sanitizer::escapeIdForAttribute( $bar ) ) ?>" href="#"><?php echo $txtOut; ?> &raquo;</a>
<?php
			# XXX JaTu fix
			if ( $bar == 'SEARCH' ) { ?>
			<ul class="gumax-nav-box gumax-nav-search-box">
<?php			$this->searchBox( true ); ?>
			</ul>
<?php		} elseif ( $bar == 'TOOLBOX' ) { ?>
			<ul class="gumax-nav-box gumax-nav-toolbox">
<?php			$this->toolbox( true ); ?>
			</ul>
<?php		} elseif ( $bar == 'LANGUAGES' ) { ?>
 			<ul class="gumax-nav-box gumax-nav-language-box">
<?php			$this->languageBox( true ); ?>
			</ul>
<?php		} elseif ( $bar == 'ACTIONS' ) { ?>
 			<ul class="gumax-nav-box gumax-nav-content-action-box">
<?php			$this->contentActionBox( true ); ?>
			</ul>
<?php		} else {
				# XXX JaTu fix ends
				if ( is_array( $cont ) ) { ?>
				<ul class="gumax-nav-box gumax-nav-custom-box">
<?php 				foreach ( $cont as $key => $val ) {
						echo $this->makeListItem( $key, $val );
					}
					// @todo FIXME: move the inline CSS from the next line into a CSS file
?>
					<li><p style="margin: 0; padding: 7px 0;"></p></li>
				</ul>
<?php			} else {
					// allow raw HTML block to be defined by extensions
					echo $cont;
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
<?php 		foreach ( $this->getPersonalTools() as $key => $item ) {
				// Unset Echo icons' text so that it doesn't "bleed" into the icons
				// @todo FIXME: there _has_ to be a way to do this via CSS... --ashley, 24 October 2020
				// Answer: it's called "text-indent: -9999px;", as per /extensions/Echo/modules/nojs/mw.echo.badge.less
				// Hmm, but it doesn't seem to be working here? Weeeeeeird.
				// --ashley, 18 December 2020
				if (
					isset( $item['id'] ) &&
					$item['id'] &&
					in_array( $item['id'], [ 'pt-notifications-alert', 'pt-notifications-notice' ] )
				) {
					$item['links'][0]['text'] = '';
				}
				echo $this->makeListItem( $key, $item );
			}
?>
		</ul>
	<!--/li-->
<?php
	}

	/*************************************************************************************************/
	function contentActionBox( $menu = false ) {
		if ( !$menu ) {
			echo '<ul>';
		}

		foreach ( $this->data['content_actions'] as $key => $tab ) {
			echo $this->makeListItem( $key, $tab );
		}

		if ( !$menu ) {
			echo '</ul>';
		}
	}

	/*************************************************************************************************/
	function articlePictureBox() {
		$title = $this->getSkin()->getTitle();

		$page_class = false;
		$pageClasses = preg_split( '/[\s]+/', $this->getSkin()->getPageClasses( $title ) );

		foreach ( $pageClasses as $item ) {
			if ( strpos( $item, 'page-' ) !== false ) {
				$page_class = $item;
			}
		}

		if ( !$page_class ) {
			return;
		}

		$file_ext_collection = [ '.jpg', '.gif', '.png' ];
		$found = false;
		$stylepath =  $this->getSkin()->getConfig()->get( 'StylePath' ) . '/GuMaxDD/resources/';
		foreach ( $file_ext_collection as $file_ext ) {
			$gumax_article_picture_file = $stylepath . '/images/pages/' . $page_class . $file_ext;
			if ( file_exists( $_SERVER['DOCUMENT_ROOT'] . '/'  . $gumax_article_picture_file ) ) {
				$found = true;
				break;
			} else {
				$gumax_article_picture_file = $stylepath . '/images/pages/page-Default.gif'; // default site logo
				if ( file_exists( $_SERVER['DOCUMENT_ROOT'] . '/' . $gumax_article_picture_file ) ) {
					$found = true;
				}
			}
		}

		if ( $found ) { ?>
			<div id="gumax-article-picture">
				<a style="background-image: url(<?php echo $gumax_article_picture_file ?>);" <?php
					?>href="<?php echo htmlspecialchars( $title->getLocalURL() )?>" <?php
					?>title="<?php $this->html( 'title' ) ?>"></a>
			</div>
			<div class="gumax-article-picture-spacer"></div>
<?php
		}
	}

	/*************************************************************************************************/
	function getMainContentBox() {
?>
	<div id="gumax-content-body">
		<?php if ( $this->data['sitenotice'] ) { ?><div id="siteNotice"><?php $this->html( 'sitenotice' ) ?></div><?php } ?>
		<?php echo $this->getIndicators(); ?>
		<div class="gumax-firstHeading"><?php $this->html( 'title' ) ?></div>
		<div class="visualClear"></div>
		<!-- content -->
		<div id="content" class="mw-body-primary">
			<a id="top"></a>
			<div id="bodyContent" class="gumax-bodyContent mw-body">
				<h3 id="siteSub"><?php $this->msg( 'tagline' ) ?></h3>
				<div id="contentSub"><?php $this->html( 'subtitle' ) ?></div>
				<?php if ( $this->data['undelete'] ) { ?><div id="contentSub2"><?php $this->html( 'undelete' ) ?></div><?php } ?>
				<?php if ( $this->data['newtalk'] ) { ?><div class="usermessage"><?php $this->html( 'newtalk' ) ?></div><?php } ?>
				<div id="jump-to-nav" class="mw-jump">
				<?php $this->msg( 'jumpto' ) ?>
					<a href="#mw-navigation"><?php $this->msg( 'jumptonavigation' ) ?></a><?php $this->msg( 'comma-separator' ) ?>
					<a href="#gumax-p-search"><?php $this->msg( 'jumptosearch' ) ?></a>
				</div>
				<!-- start content -->
				<?php $this->html( 'bodytext' ) ?>
				<?php if ( $this->data['catlinks'] ) { $this->html( 'catlinks' ); } ?>
				<!-- end content -->
				<?php if ( $this->data['dataAfterContent'] ) { $this->html( 'dataAfterContent' ); } ?>
				<div class="visualClear"></div>
			</div> <!-- end of bodyContent -->
		</div> <!-- end of content -->
	</div> <!-- end of gumax-content-body -->
<?php
	}

	/*************************************************************************************************/
	function renderToolbox() {
?>
		<div id="gumax-special-tools">
			<ul>
<?php
		foreach ( $this->data['sidebar']['TOOLBOX'] as $key => $tbItem ) {
			echo $this->makeListItem( $key, $tbItem );
		}
?>
			</ul>
		</div>
<?php
	}

	/*************************************************************************************************/
	function getArticleMessageBox() {
?>
		<div id="gumax-article-message">
			<?php if ( $this->data['lastmod'] ) { ?><span id="f-lastmod"><?php $this->html( 'lastmod' ) ?></span>
			<?php } ?><?php if ( $this->data['viewcount'] ) { ?><span id="f-viewcount"><?php $this->html( 'viewcount' ) ?></span>
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
				$footerLinks = [
					'numberofwatchingusers', 'credits',
					'privacy', 'about', 'disclaimer', 'tagline',
				];
				foreach ( $footerLinks as $aLink ) {
					if ( isset( $this->data[$aLink] ) && $this->data[$aLink] ) {
				?>		<li id="<?php echo $aLink ?>"><?php $this->html( $aLink ) ?></li>
				<?php }
				}

				$skin = $this->getSkin();
				$footerIcons = $this->get( 'footericons' );
				unset( $footerIcons['copyright'] );
				foreach ( $footerIcons as $blockName => $footerIcons ) {
					echo '<li id="f-' . htmlspecialchars( $blockName ) . '">';
					foreach ( $footerIcons as $icon ) {
						// Copyright icon array can be empty
						// Trying to generate an icon from such an array generates this E_NOTICE on MW 1.35:
						// PHP Notice:  Undefined index: alt in <path to MW>/includes/skins/Skin.php on line 1007
						if ( !empty( $icon ) ) {
							echo $skin->makeFooterIcon( $icon, 'withoutImage' );
						}
					}
					echo '</li>';
				}
				?>
			</ul>
		</div>
<?php
	}

} // end of class
