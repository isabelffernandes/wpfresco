<?php
// Stop direct call
if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) {
	die('Please do not call this page directly.');
}

// is edge mode active?
if ($this->edge_mode['available'] and !empty($this->preferences['edge_mode'])){
	$this->edge_mode['active'] = true;
}

// standalone needs dynamic JS called
if ($page_context == 'tvr-microthemer-preferences.php'){
	echo '<script type="text/javascript">';
	include $this->thisplugindir . '/includes/js-dynamic.php';
	echo '</script>';
}

$this->display_log();

?>

<!-- Edit Preferences -->
<form id="tvr-preferences" name='preferences_form' method="post" autocomplete="off"
	action="admin.php?page=<?php echo $page_context;?>" >
	<?php //wp_nonce_field('tvr_preferences_submit'); ?>
	<input type="hidden" name="tvr_preferences_form" value="1" />
	<?php echo $this->start_dialog('display-preferences', esc_html__('Edit your Microthemer preferences', 'microthemer'), 'medium-dialog',
		array(
			esc_html_x('General', '(General Preferences)', 'microthemer' ),
			esc_html__('Units', 'microthemer'),
			esc_html__('Inactive', 'microthemer')
		)
	); ?>


<div class="content-main dialog-tab-fields">

	<?php
	$tab_count = -1; // start at -1 so ++ can be used for all tabs
	?>

	<!-- Tab 1 (General Preferences) -->
	<div class="dialog-tab-field dialog-tab-field-<?php echo ++$tab_count; ?> hidden show">

		<?php
		//$this->show_me = '<pre>potatoes: '.print_r($this->preferences, true).'</pre>';
		//echo $this->show_me;
        $pref_cats = array(
            'css_sass' => array(
              'label' => __('CSS and Sass', 'microthemer'),
              'items' => array(
	              'css_important' => array(
		              'label' => __('Always add !important to CSS styles', 'microthemer'),
		              'label_no' => '(configure manually)',
		              'explain' => __('Always add the "!important" CSS declaration to CSS styles. This largely solves the issue of having to understand how CSS specificity works. But if you prefer, you can disable this functionality and still apply "!important" on a per style basis by clicking the faint "i\'s" that will appear to the right of every style input.', 'microthemer')
	              ),
	              'allow_scss' => array(
		              'label' => __('Enable Sass (at cost of syncing editor with UI fields)', 'microthemer'),
		              'explain' => __('Enable this option if you want to write raw Sass code in the custom code editors or use Sass variables and mixins etc in the GUI fields. Disable this option if you want the CSS code you write to be interchangeably editable with the GUI fields' , 'microthemer')
	              ),
	              'minify_css' => array(
		              'label' => __('Minify the CSS file Microthemer generates', 'microthemer'),
		              'explain' => __('Microthemer can generate a minified file, min.active-styles.css, and load that instead for a smaller file size and quicker downloading.' , 'microthemer')
	              ),
	              'color_as_hex' => array(
		              'label' => __('Report color in hex values instead of RGB/A'),
		              'explain' => __('By default, Microthemer will report computed CSS color values in RGB/A format. Set this to "Yes" if you prefer the hex format.', 'microthemer')
	              ),
	              'abs_image_paths' => array(
		              'label' => __('Use absolute background image URL paths', 'microthemer'),
		              'explain' => __('If you install WordPres in a sub-directory, setting this to "Yes" can fix issues with image paths.', 'microthemer'),
	              ),

	              /*'server_scss' => array(
		              'label' => __('Compile Sass on the server (usually slower)', 'microthemer'),
		              'explain' => __('Client-side SCSS compilation is a new feature. Enable server-side compilation if you notice any problems with client-side compilation' , 'microthemer')
	              ),*/
	              'global_styles_on_login' => array(
		              'label' => __('Enable global CSS on WordPress login pages', 'microthemer'),
		              'explain' => __('Load Microthemer\'s global active-styles.css file on WordPress login, registration, and forgot password pages' , 'microthemer')
	              ),
              )
            ),
            'wordpress_toolbar' => array(
	            'label' => __('WordPress Toolbar', 'microthemer'),
	            'items' => array(
		            'admin_bar_shortcut' => array(
			            'label' => __('Add a Microthemer shortcut to the WP admin bar', 'microthemer'),
			            'explain' => __('Include a link to the Microthemer interface from the WordPress admin toolbar at the top of every page.', 'microthemer'),
			            //'default' => 'yes'
		            ),
		            'top_level_shortcut' => array(
			            'label' => __('If yes to above, include as a top level link', 'microthemer'),
			            'explain' => __('If you are enabling the Microthemer shortcut in the admin bar, you can either have it as a top level menu link or as a sub-menu item of the main menu.', 'microthemer'),
			            //'default' => 'yes'
		            ),
		            'admin_bar_preview' => array(
			            'label' => __('On site preview, display WP admin bar ', 'microthemer'),
			            'explain' => __('Display the WordPress admin bar at the top of every page in the site preview', 'microthemer')
		            ),
	            )
            ),
            'fonts' => array(
	            'label' => __('Fonts', 'microthemer'),
	            'items' => array(
		            'gfont_subset' => array(
			            'is_text' => 1,
			            'label' => __('Google Font subset URL parameter', 'microthemer'),
			            'explain' => __('You can instruct Google Fonts to include a font subset by entering an URL parameter here. For example "&subset=latin,latin-ext" (without the quotes). Note: Microthemer only generates a Google Font URL if it detects that you have applied Google Fonts in your design.', 'microthemer'),
		            ),
	            )
            ),
            'integrations' => array(
	            'label' => __('Integrations', 'microthemer'),
	            'items' => array(
		            'after_oxy_css' => array(
			            'label' => __('Load Microthemer CSS after Oxygen CSS', 'microthemer'),
			            'explain' => __("Ensure Microthemer's active-styles.css stylesheet loads after Oxygen stylesheets", 'microthemer'),
		            )
	            )
            ),

            'interface' => array(
	            'label' => __('Microthemer Interface', 'microthemer'),
	            'items' => array(
		            'edge_mode' => array(
			            'label' => __('Enable edge mode. ', 'microthemer'),
			            'link' => '<a target="_blank" href="'.$this->edge_mode['edge_forum_url'].'">' . __('Read about/comment here', 'microthemer') .'</a>',
			            'explain' => $this->edge_mode['cta'],
		            ),
		            'preview_url' => array(
			            'is_text' => 1,
			            'input_id' => 'pref-preview-url-input',
			            'label' => __('Frontend preview URL Microthemer should load', 'microthemer'),
			            'explain' => __('Manually specify a link to the page you would like Microthemer to load for editing when it first starts. By default Microthemer will load your home page or the last page you visited. This option is useful if you want to style a page that can\'t be navigated to from the home page or other pages.', 'microthemer')
		            ),
		            'num_history_points' => array(
			            'is_text' => 1,
			            'one_line' => 1,
			            'label' => __('Number of recent revisions to store', 'microthemer'),
			            'explain' => __('Choose how many revisions to store in the Database. The allowed range is 1-300. The default is 50. Saved revisions do not count towards the quota. Nor do pre-upgrade backups.', 'microthemer'),
			            'combobox' => 'num_history_points',
		            ),
		            'tape_measure_slider' => array(
			            'label' => __('Enable tape measure style sliders', 'microthemer'),
			            'explain' => __('The numbers in the tape measure design may be helpful, but it involves dragging left to increase values, which may feel unintuitive', 'microthemer'),

		            ),
		            'dark_editor' => array(
			            'label' => __('Use a dark theme for the custom code editor', 'microthemer'),
			            'explain' => __('If you prefer a dark background when writing CSS code in the custom code editor, set this to yes.' , 'microthemer')
		            ),
		            /*'tooltip_en_prop' => array(
			            'label' => __('Show CSS syntax in property tooltips (english code)', 'microthemer'),
			            'explain' => __("If you want learn valid CSS syntax while you work in Microthemer, set this option to Yes. Seeing the actual CSS property may be particularly useful if you're using a non-english translation", 'microthemer'),
		            ),*/
		            'gzip' => array(
			            'label' => __('Gzip the Microthemer UI page for faster loading', 'microthemer'),
			            'explain' =>__('Having this gzip option enabled will speed up the initial page loading, but you can switch it off if this setting is not compatible with your server.', 'microthemer')
		            ),
		            /*'tooltip_delay' => array(
			            'label' => __('Tooltip delay time (in milliseconds)', 'microthemer'),
			            'explain' => __('Control how long it takes for a Microthemer tooltip to display. Set to "0" for instant, "native" to use the browser default tooltip on hover, or some value like "2000" for a 2 second delay (so it never shows when you don\'t need it to). The default is 500 milliseconds.', 'microthemer')
		            ),*/

	            )
            ),

            'javascript' => array(
	            'label' => __('JavaScript', 'microthemer'),
	            'items' => array(
		            'monitor_js_errors' => array(
			            'label' => __('Monitor general JavaScript errors on your site'),
			            'explain' => __('General JavaScript errors on your site can interfere with Microthemer, and other plugins. Microthemer can check for errors and warn you about them.', 'microthemer')
		            ),
		            'active_scripts_footer' => array(
			            'label' => __('Load the JS you add with Microthemer in the footer'),
			            'explain' => __('Load your active-scripts.js file just before the closing body tag', 'microthemer')
		            ),
		            'active_scripts_deps' => array(
			            'is_text' => 1,
			            'label' => __('List WP script handles your JS depends on'),
			            'explain' => __('If your custom JavaScript depends on a library, enter the library handles (comma separated)', 'microthemer')
		            ),
	            )
            ),

            'legacy' => array(
	            'label' => __('Legacy', 'microthemer'),
	            'items' => array(
		            'first_and_last' => array(
			            'label' => __('Add "first" and "last" classes to menu items', 'microthemer'),
			            'explain' => __('Microthemer can insert "first" and "last" classes on WordPress menus so that you can style the first or last menu items a bit differently from the rest. Note: this only works with "Custom Menus" created on the Appearance > Menus page.', 'microthemer')
		            ),
		            /*'hide_ie_tabs' => array(
			            'label' => __('Hide the legacy Internet Explorer tabs', 'microthemer'),
			            'explain' => __('Microthemer\'s IE tabs are not really needed these days, and so are hidden by default. Set this option to No if you still want them.' , 'microthemer')
		            ),*/
	            )
            ),
            'tools' => array(
	            'label' => __('Tools', 'microthemer'),
	            'items' => array(
		            'manual_recompile_all_css' => array(
			            'label' => __('Regenerate all CSS (can fix certain issues)', 'microthemer'),
			            'explain' => __('If Microthemer encounters an error, this can sometimes fix the issue', 'microthemer')
		            ),
	            )
            ),
        );

		// output
        echo $this->preferences_grid($pref_cats, 'main-preferences-grid');

        ?>

	</div>

    <!-- Tab 2 (CSS Units) -->
    <div class="dialog-tab-field dialog-tab-field-<?php echo ++$tab_count; ?> hidden">

        <ul class="form-field-list css_units">

            <!--<li><span class="reveal-hidden-form-opts link reveal-unit-sets" rel="css-unit-set-opts">
					<?php //esc_html_e('Load a full set of suggested CSS units', 'microthemer'); ?></span></li>-->
			<?php

			$group_key = '';

			$unit_cats = array(
				'all_units' => array(
					'label' => __('All length units', 'microthemer'),
					'items' => array(
						'load_css_unit_sets' => array(
						    'is_text' => 1,
							'one_line' => 1,
							'empty_after' => 1,
							'input_id' => 'css_unit_set',
							'combobox' => 'css_length_units',
							'label' => __('Set ALL length units to:', 'microthemer'),
							'explain' => __('Pixels are easier for beginners. But many consider it best practice to rem units for length properties', 'microthemer')
						)
					)
				)
            );

			// output CSS unit options
			foreach($this->preferences['my_props'] as $prop_group => $array){

				// skip if non-valid or we've removed a property group
				if ($prop_group == 'sug_values' || empty($this->propertyoptions[$prop_group])) continue;

				// loop through default unit props
				if (!empty($this->preferences['my_props'][$prop_group]['pg_props'])){
					$first = true;
					foreach ($this->preferences['my_props'][$prop_group]['pg_props'] as $prop => $arr){

						if (!isset($this->propertyoptions[$prop_group][$prop]['default_unit'])){
							continue;
						}

						unset($units);
						// user doesn't need to set all padding (for instance) individually
                        $factoryUnit = $this->propertyoptions[$prop_group][$prop]['default_unit'];
						$box_model_rel = false;
						$first_in_group = false;
						//$label = $arr['label'];
						$label = $this->propertyoptions[$prop_group][$prop]['label'];

                        if (!empty($this->propertyoptions[$prop_group][$prop]['unit_rel'])){
                            $box_model_rel = $this->propertyoptions[$prop_group][$prop]['unit_rel'];
                        } elseif (!empty($this->propertyoptions[$prop_group][$prop]['rel'])){
							$box_model_rel = $this->propertyoptions[$prop_group][$prop]['rel'];
						}

						if (!empty($this->propertyoptions[$prop_group][$prop]['unit_sub_label'])){
							$first_in_group = $this->propertyoptions[$prop_group][$prop]['unit_sub_label'];
						} elseif (!empty($this->propertyoptions[$prop_group][$prop]['sub_label'])){
							$first_in_group = $this->propertyoptions[$prop_group][$prop]['sub_label'];
						}

						// only output length units
						if ( !isset($arr['default_unit'])
                             or $this->is_non_length_unit($factoryUnit, $prop)
                             or ($box_model_rel and !$first_in_group)
                        ){
							continue;
						}
						// use group sub label if first box model e.g. padding, margin, border width, border radius
						if ($box_model_rel and $first_in_group){
							$label = $first_in_group; // . esc_html__(' (all)', 'microthemer');
						}
						// we don't need position repeated all the time (but no biggy if non-english)
						$label = str_replace(' (Position)', '', $label);

						// output pg group heading if new group
						if ($first){
							// get the label for the property group (can't necessarily rely on $first_in_group)
							foreach ($this->propertyoptions[$prop_group] as $p => $arr){
								$pg_label = !empty($arr['pg_label']) ? $arr['pg_label'] : '';
								break; // only need first
							}
							/*echo
								'<li class="section_title">' . $pg_label . '</li>';*/


							$group_key = strtolower(str_replace(' ', '', $pg_label));
							$unit_cats[$group_key] = array(
								'label' => $pg_label,
								'items' => array()
							);

							$first = false;
						}

						$unit_cats[$group_key]['items']['cssu_'.$prop] = array(
						    'is_text' => 1,
                            'one_line' => 1,
							'prop' => $prop,
							'input_class' => 'custom_css_unit',
							'arrow_class' => 'custom_css_unit',
							'combobox' => 'css_length_units',
							'input_name' => 'tvr_preferences[new_css_units]['.$prop_group.']['.$prop.']',
							'input_value' => $this->preferences['my_props'][$prop_group]['pg_props'][$prop]['default_unit'],
							'label' => $label,
							'explain' => __('Set the default CSS unit for ', 'microthemer') . $label
						);


					}
				}
			}

			// output
			echo $this->preferences_grid($unit_cats, 'css-units-grid');
			?>
        </ul>

    </div>



	<!-- Tab 3 (Inactive) -->
	<div class="dialog-tab-field dialog-tab-field-<?php echo ++$tab_count; ?> hidden">
		<ul class="form-field-list css_units">
			<?php
			// yes no options
			$yes_no = array(
				'clean_uninstall' => array(
					'label' => __('Upon Uninstall, Delete ALL Microthemer Data', 'microthemer'),
					'explain' => __('Microthemer database settings and the contents of the /micro-themes folder are not deleted by default when you uninstall Microthemer. But they can be if you set this option to Yes.', 'microthemer'),
				)
			);
			$this->output_radio_input_lis($yes_no);

			?>
		</ul>

		<div id="functions-php">
			<div class="heading"><?php echo esc_html__('Manually Load Microthemer Styles', 'microthemer'); ?></div>
			<p><?php echo esc_html__('As long as you don\'t set the above option to Yes, you can uninstall Microthemer and still use the customisations you made with it. Simply copy and paste the code below at the bottom of your theme\'s functions.php file. The code will not cause any problems when Microthemer is active. It simply won\'t run. So you can safely paste and forget.', 'microthemer'); ?></p>
			<textarea><?php
				echo esc_html(
					file_get_contents(
						$this->thisplugindir . '/includes/inactive-loading/functions.php-code.txt',
						FILE_USE_INCLUDE_PATH
					)
				);
				?></textarea>
		</div>
	</div>

	<?php
	// standalone needs inline button
	if ($page_context == 'tvr-microthemer-preferences.php'){
		echo $this->dialog_button(esc_html__('Save Preferences', 'microthemer'), 'span', 'save-preferences');
	}
	?>

</div>

<?php echo $this->end_dialog(esc_html__('Save Preferences', 'microthemer'), 'span', 'save-preferences'); ?>
</form>
