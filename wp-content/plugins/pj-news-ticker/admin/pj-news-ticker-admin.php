<?php

if (!class_exists('PjNewsTickerAdmin'))
{
	class PjNewsTickerAdmin
	{
		private $options;

		public function __construct()
		{
			add_action('admin_init', array($this, 'initSettings'));
			add_action('admin_menu', array($this, 'addOptionsPage'));
			add_action('admin_enqueue_scripts', array($this, 'loadStyles'));
		}

		public function loadStyles()
		{
			wp_enqueue_script('wp-color-picker');
			wp_enqueue_style('wp-color-picker');
			wp_enqueue_script('pj-news-ticker-admin', plugins_url('js/pj-news-ticker-admin.js', __FILE__), array('wp-color-picker'), PjNewsTickerHelper::getVersion());
		}

		public function initSettings()
		{
			// array that holds all the options
			register_setting('pj-news-ticker-group', 'pj-news-ticker-options', array('PjNewsTickerHelper', 'sanitize'));

			// default settings section
			add_settings_section('pjnt-default-settings-section', 'Default Settings', array($this, 'printDefaultSettingsSectionInfo_cb'), 'pj-news-ticker');
			add_settings_field('num_posts', 'Number of Posts', array($this, 'num_posts_cb'), 'pj-news-ticker', 'pjnt-default-settings-section');
			add_settings_field('post_type', 'Post Type', array($this, 'post_type_cb'), 'pj-news-ticker', 'pjnt-default-settings-section');
			add_settings_field('post_cat', 'Category of Posts', array($this, 'post_cat_cb'), 'pj-news-ticker', 'pjnt-default-settings-section');
			add_settings_field('show_label', 'Show Label?', array($this, 'show_label_cb'), 'pj-news-ticker', 'pjnt-default-settings-section');
			add_settings_field('label_text', 'Label Text', array($this, 'label_text_cb'), 'pj-news-ticker', 'pjnt-default-settings-section');
			add_settings_field('label_text_colour', 'Label Text Colour', array($this, 'label_text_colour_cb'), 'pj-news-ticker', 'pjnt-default-settings-section');
			add_settings_field('label_bg_colour', 'Label Background Colour', array($this, 'label_bg_colour_cb'), 'pj-news-ticker', 'pjnt-default-settings-section');
			add_settings_field('ticker_bg_colour', 'Ticker Background Colour', array($this, 'ticker_bg_colour_cb'), 'pj-news-ticker', 'pjnt-default-settings-section');
			add_settings_field('no_content_text', 'No Content Text', array($this, 'no_content_text_cb'), 'pj-news-ticker', 'pjnt-default-settings-section');
			add_settings_field('show_excerpt', 'Show Excerpt?', array($this, 'show_excerpt_cb'), 'pj-news-ticker', 'pjnt-default-settings-section');
			add_settings_field('speed', 'Speed', array($this, 'speed_cb'), 'pj-news-ticker', 'pjnt-default-settings-section');
			add_settings_field('size', 'Font Size', array($this, 'size_cb'), 'pj-news-ticker', 'pjnt-default-settings-section');
			add_settings_field('target', 'Link Target', array($this, 'target_cb'), 'pj-news-ticker', 'pjnt-default-settings-section');
			add_settings_field('gap', 'Gap Between Cycles?', array($this, 'gap_cb'), 'pj-news-ticker', 'pjnt-default-settings-section');
			add_settings_field('hide_if_empty', 'Hide If No Posts?', array($this, 'hide_if_empty_cb'), 'pj-news-ticker', 'pjnt-default-settings-section');
		}

		public function printDefaultSettingsSectionInfo_cb ()
		{
			echo '<p>A News Ticker created with a simple shortcode [pj-news-ticker] will use these default settings.</p>';
			echo '<p>To override individual tickers: <a href="#" id="pjnt-shortcode-help-show">View</a><a href="#" id="pjnt-shortcode-help-hide">Hide</a></p>';
			echo '<div id="pjnt-shortcode-help">';
			echo '[pj-news-ticker<br />';
			echo '&nbsp;&nbsp;num_posts=&quot;5&quot; - Defaults to showing 5 most recent posts, use &quot;-1&quot; for all matching posts<br />';
			echo '&nbsp;&nbsp;post_type=&quot;slug&quot; - Choose the type of post to display, default to &quot;post&quot; for normal posts, or select a custom post type<br />';
			echo '&nbsp;&nbsp;post_cat=&quot;slug&quot; - Choose the slug of a category to limit the posts, use a comma to separate multiple categories, use &quot;0&quot; for all categories (default)<br />';
			echo '&nbsp;&nbsp;show_label=&quot;true&quot; - &quot;true&quot; or &quot;false&quot;, to show a label for the News Ticker<br />';
			echo '&nbsp;&nbsp;label_text=&quot;Latest Posts&quot; - If a label is shown, what text to use<br />';
			echo '&nbsp;&nbsp;label_text_colour=&quot;#ffffff&quot; - If a label is shown, what colour is the text<br />';
			echo '&nbsp;&nbsp;label_bg_colour=&quot;#1e73be&quot; - If a label is shown, what colour is the background<br />';
			echo '&nbsp;&nbsp;ticker_bg_colour=&quot;#ffffff&quot; - What colour is the background for the ticker<br />';
			echo '&nbsp;&nbsp;no_content_text=&quot;No matching posts&quot; - The text to display if no matching posts are found<br />';
			echo '&nbsp;&nbsp;show_excerpt=&quot;false&quot; - &quot;true&quot; or &quot;false&quot;, to show the excerpt for each post<br />';
			echo '&nbsp;&nbsp;speed=&quot;100&quot; - The speed to scroll by, in pixels per second<br />';
			echo '&nbsp;&nbsp;size=&quot;100%&quot; - The size of the text, can be in px, or em, or %<br />';
			echo '&nbsp;&nbsp;target=&quot;_self&quot; - The target for the links, can be _self or _blank<br />';
			echo '&nbsp;&nbsp;gap=&quot;true&quot; - Choose whether to show a gap between cycles of the marquee content, defaults to &quot;true&quot; for classic marquee style, set to &quot;false&quot; for new infinite scrolling style marquee<br />';
			echo '&nbsp;&nbsp;hide_if_empty=&quot;true&quot; - Choose whether to hide the plugin if no matching posts are found, defaults to &quot;false&quot;<br />';
			echo ']';
			echo '</div>';
		}

		public function num_posts_cb()
		{
			$this->renderMenu('num_posts', array(-1 => 'All', 1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5', 10 => '10', 15 => '15', 20 => '20'));
		}

		public function target_cb()
		{
			$this->renderMenu('target', array('_self' => 'Same page (_self)', '_blank' => 'New page (_blank)'));
		}

		public function post_cat_cb()
		{
			$cats = array(0 => 'All');
			$wpCats = get_categories(array('orderby' => 'name', 'order' => 'ASC'));
			foreach ($wpCats as $wpCat)
			{
				$cats[$wpCat->slug] = $wpCat->name;
			}
			$this->renderMenu('post_cat', $cats, true);
		}

		public function post_type_cb()
		{
			$types = array('post' => 'Post');
			$wpTypes = get_post_types(array('public' => true, '_builtin' => false), 'objects', 'and');
			foreach ($wpTypes as $wpType)
			{
				$labels = get_post_type_labels($wpType);
				$types[$wpType->name] = $labels->name;
			}
			$this->renderMenu('post_type', $types);
		}

		public function show_label_cb()
		{
			$this->renderRadioButtons('show_label', array('true' => 'True', 'false' => 'False'));
		}

		public function show_excerpt_cb()
		{
			$this->renderRadioButtons('show_excerpt', array('true' => 'True', 'false' => 'False'));
		}

		public function gap_cb()
		{
			$this->renderRadioButtons('gap', array('true' => 'True', 'false' => 'False'));
		}

		public function hide_if_empty_cb()
		{
			$this->renderRadioButtons('hide_if_empty', array('true' => 'True', 'false' => 'False'));
		}

		public function label_text_cb()
		{
			$this->renderTextField('label_text');
		}

		public function size_cb()
		{
			$this->renderTextField('size');
		}

		public function speed_cb()
		{
			$this->renderTextField('speed');
		}

		public function label_text_colour_cb()
		{
			$this->renderColourPicker('label_text_colour');
		}

		public function label_bg_colour_cb()
		{
			$this->renderColourPicker('label_bg_colour');
		}

		public function ticker_bg_colour_cb()
		{
			$this->renderColourPicker('ticker_bg_colour');
		}

		public function no_content_text_cb()
		{
			$this->renderTextField('no_content_text');
		}

		public function renderMenu($id, $options, $multiple = false)
		{
			printf('<select name="pj-news-ticker-options[%s]%s" %s>', $id, ($multiple ? '[]' : ''), ($multiple ? 'multiple' : ''));
			if (isset($this->options[$id])) {
				if ($multiple) {
					$thisVal = explode(',', $this->options[$id]);
				} else {
					$thisVal = array($this->options[$id]);
				}
			} else {
				$thisVal = array();
			}
			foreach ($options as $value => $label)
			{
				printf('<option value="%s" %s/>%s</option>', $value, in_array((string)$value, $thisVal) ? 'selected="selected" ' : '', $label);
			}
			printf('</select>');
		}

		public function renderRadioButtons($id, $options)
		{
			foreach ($options as $value => $label)
			{
				printf('%s <input type="radio" name="pj-news-ticker-options[%s]" value="%s" %s/>', $label, $id, $value, (isset($this->options[$id]) && $this->options[$id] == $value) ? 'checked ' : '');
			}
		}

		public function renderTextField($id)
		{
			printf('<input type="text" name="pj-news-ticker-options[%s]" value="%s" />', $id, isset( $this->options[$id] ) ? esc_attr($this->options[$id]) : '');
		}

		public function renderColourPicker($id)
		{
			printf('<input type="text" name="pj-news-ticker-options[%s]" value="%s" class="color-field" />', $id, isset($this->options[$id]) ? esc_attr($this->options[$id]) : '' );
		}

		public function addOptionsPage()
		{
			add_submenu_page('options-general.php', 'PJ News Ticker Settings', 'PJ News Ticker', 'manage_options', 'pj-news-ticker', array($this, 'renderOptions') );
		}

		public function renderOptions()
		{
			// check user capabilities
			if (!current_user_can('manage_options'))
			{
				return;
			}

			// check if any settings have been updated
			if (isset($_GET['settings-updated']))
			{
				add_settings_error('pjnt_messages', 'pjnt_message', 'Settings Saved', 'updated');
			}

			// show the options form
			$this->options = array_replace(PjNewsTickerHelper::getDefaultOptions(), get_option('pj-news-ticker-options', array()));
			?>
			<div class="wrap">
				<h1><?php echo esc_html(get_admin_page_title()); ?></h1>
				<form action="options.php" method="post">
				<?php
					// This prints out all hidden setting fields
					settings_fields('pj-news-ticker-group');
					do_settings_sections('pj-news-ticker');
					submit_button('Save Settings');
				?>
				</form>
			</div>
			<?php
		}
	}

	new PjNewsTickerAdmin();
}
