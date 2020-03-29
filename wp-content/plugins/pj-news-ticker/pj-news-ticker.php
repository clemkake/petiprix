<?php
/*
Plugin Name: PJ News Ticker
Plugin URI:  https://wordpress.org/plugins/pj-news-ticker/
Description: PJ News Ticker is a small plugin that shows your most recent posts in a marquee style.
Version:     1.6
Author:      Paul Jura
Author URI:  http://pauljura.com/
License:     GPL3
License URI: https://www.gnu.org/licenses/gpl-3.0.html
Text Domain: pj-news-ticker
Domain Path: /languages

PJ News Ticker - A basic news ticker for Wordpress
Copyright (C) 2019  Paul Jura

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

define('PJNT_VERSION', '1.6');

/**
 * Static class available for content and admin pages
 */
if (!class_exists('PjNewsTickerHelper'))
{
	class PjNewsTickerHelper
	{
		public static function getVersion()
		{
			return PJNT_VERSION;
		}

		public static function getDefaultOptions()
		{
			return array(
				'num_posts' => 5,
				'post_cat' => '0',
				'post_type' => 'post',
				'show_label' => 'true',
				'label_text' => 'Latest Posts',
				'label_text_colour' => '#ffffff',
				'label_bg_colour' => '#1e73be',
				'ticker_bg_colour' => '#ffffff',
				'no_content_text' => 'There are no matching posts to display...',
				'speed' => 100,
				'size' => '100%',
				'show_excerpt' => 'false',
				'target' => '_self',
				'gap' => 'true',
				'hide_if_empty' => 'false',
			);
		}

		public static function sanitize($input)
		{
			$newInput = self::getDefaultOptions();
			if (isset($input['num_posts'])) $newInput['num_posts'] = intval($input['num_posts']);
			if (isset($input['post_type'])) $newInput['post_type'] = sanitize_text_field($input['post_type']);
			if (isset($input['post_cat'])) {
				if (is_array($input['post_cat'])) {
					$newInput['post_cat'] = array_map('sanitize_text_field', $input['post_cat']);
					if (in_array('0', $newInput['post_cat'])) {
						$newInput['post_cat'] = '0';
					} else {
						$newInput['post_cat'] = join(',', $newInput['post_cat']);
					}
				} else {
					$newInput['post_cat'] = sanitize_text_field($input['post_cat']);
				}
			}
			if (isset($input['show_label']) && in_array($input['show_label'], array('true', 'false'))) $newInput['show_label'] = $input['show_label'];
			if (isset($input['label_text'])) $newInput['label_text'] = sanitize_text_field($input['label_text']);
			if (isset($input['label_text_colour'])) $newInput['label_text_colour'] = self::validateHtmlColour($input['label_text_colour']);
			if (isset($input['label_bg_colour'])) $newInput['label_bg_colour'] = self::validateHtmlColour($input['label_bg_colour']);
			if (isset($input['ticker_bg_colour'])) $newInput['ticker_bg_colour'] = self::validateHtmlColour($input['ticker_bg_colour']);
			if (isset($input['no_content_text'])) $newInput['no_content_text'] = sanitize_text_field($input['no_content_text']);
			if (isset($input['speed'])) $newInput['speed'] = abs(intval($input['speed']));
			if (isset($input['size'])) $newInput['size'] = sanitize_text_field($input['size']);
			if (isset($input['show_excerpt']) && in_array($input['show_excerpt'], array('true', 'false'))) $newInput['show_excerpt'] = $input['show_excerpt'];
			if (isset($input['target']) && in_array($input['target'], array('_self', '_blank'))) $newInput['target'] = sanitize_text_field($input['target']);
			if (isset($input['gap']) && in_array($input['gap'], array('true', 'false'))) $newInput['gap'] = sanitize_text_field($input['gap']);
			if (isset($input['hide_if_empty']) && in_array($input['hide_if_empty'], array('true', 'false'))) $newInput['hide_if_empty'] = sanitize_text_field($input['hide_if_empty']);
			return $newInput;
		}

		public static function validateHtmlColour($input)
		{
			if (preg_match('/^#[a-f0-9]{6}$/i', $input))
			{
				return $input;
			}
			else
			{
				return '#000000';
			}
		}
	}
}

if (is_admin())
{
	require_once(dirname(__FILE__).'/admin/pj-news-ticker-admin.php');
}

if (!class_exists('PjNewsTicker') && !is_admin())
{
	class PjNewsTicker
	{
		private $defaultOptions;

		public function __construct()
		{
			$this->defaultOptions = array_replace(PjNewsTickerHelper::getDefaultOptions(), get_option('pj-news-ticker-options', array()));
			$this->addShortcode();
			add_action('wp_enqueue_scripts', array($this, 'enqueueScripts'));
		}

		protected function addShortCode()
		{
			add_shortcode('pj-news-ticker', array($this, 'renderNewsTicker'));
		}

		public static function enqueueScripts()
		{
			// news ticker js
			wp_enqueue_script('pj-news-ticker', plugins_url('public/js/pj-news-ticker.js', __FILE__), array('jquery'), PjNewsTickerHelper::getVersion());
			// css
			wp_enqueue_style('pj-news-ticker', plugins_url('public/css/pj-news-ticker.css', __FILE__), array(), PjNewsTickerHelper::getVersion());
		}

		public function renderNewsTicker($atts = array(), $content = null)
		{
			// Override default options with the shortcode options
			$atts = array_change_key_case((array)$atts, CASE_LOWER);
			$options = shortcode_atts($this->defaultOptions, $atts);

			// Get the posts
			$postOptions = array(
				'numberposts'	=> $options['num_posts'],
				'category'		=> 0,
				'orderyby'		=> 'date',
				'order'			=> 'DESC',
				'post_type'     => $options['post_type'],
			);
			if (!empty($options['post_cat']))
			{
				$postOptions['category_name'] = $options['post_cat'];
			}
			$posts = get_posts($postOptions);

			// return early if no posts and option to hide is set
			if (count($posts) == 0 && $options['hide_if_empty'] == 'true') {
				return $content;
			}

			// Render the marquee
			if ($options['show_label'] == 'true')
			{
				$content .= '<div class="pjnt-border" style="background-color: '.$options['label_bg_colour'].'; border-color: '.$options['label_bg_colour'].';">';
				$content .= '<div class="pjnt-label" style="color: '.$options['label_text_colour'].'; font-size: '.$options['size'].';">'.$options['label_text'].'</div>';
			}
			$content .= '<div class="pjnt-box" style="background-color: '.$options['ticker_bg_colour'].';">';
			$content .= '<div class="pjnt-content" data-gap="'.$options['gap'].'" data-speed="'.$options['speed'].'" style="font-size: '.$options['size'].';">';
			if (count($posts) == 0)
			{
				$content .= '<span class="pjnt-item">';
				$content .= $options['no_content_text'];
				$content .= '</span>';
			}
			else
			{
				$isFirst = true;
				foreach ($posts as $post)
				{
					$content .= '<span class="pjnt-item">';
					$content .= '<a target="'.$options['target'].'" href="'.get_permalink($post).'">'.get_the_title($post);
					if ($options['show_excerpt'] == 'true') {
						setup_postdata($post);
						$content .= ' - '.get_the_excerpt($post);
					}
					$content .= '</a>';
					$content .= '</span>';
				}
			}
			$content .= '</div>'; // end content
			$content .= '</div>'; // end marquee box
			if ($options['show_label'] == 'true')
			{
				$content .= '</div>'; // end border container
			}
			return $content;
		}
	}

	new PjNewsTicker();
}
