<?php
/*
Plugin Name: Expand Category Sakai
Description: Word Bar Sakai 2013/03/30
Author: Tomoyuki Sugita
Author URI: http://tomotomosnippet.blogspot.jp/
Version: 1.0
Text Domain: exc-sakai
 */

/**
 * Original Articla http://www.webopixel.net/wordpress/436.html
 */

$expand_category_sakai = new ExpandCategorySakai();
$expand_category_sakai->execute();

class ExpandCategorySakai {

	/**
	 * plugin text domain 
	 * TODO Make wcm.po
	 */
	const TEXTDOMAIN = 'exc-sakai';
	protected $plugin_url;

	public function execute() {
		$this->plugin_url = plugins_url('', __FILE__);
        add_action('plugins_loaded', array($this, 'plugins_loaded'));
    }

    public function plugins_loaded() {
		// 管理画面のカテゴリ編集画面を拡張
		add_action('edit_category_form_fields', array($this, 'extra_category_fields'));

		// メタデータの保存
		add_action('edited_term', array($this, 'save_extra_category_fileds'));
	}

	public function extra_category_fields($tag) {
		$t_id = $tag->term_id;
		$cat_meta = get_option("cat_$t_id");
		?>
		<tr class="form-field">
			<th><label for="extra_text"><?php _e('Extra text', self::TEXTDOMAIN)?><br />
					<code class="description">(extra_text)</code></label></th>
			<td><textarea name="Cat_meta[extra_text]" id="extra_text" ><?php if (isset($cat_meta['extra_text'])) echo esc_textarea($cat_meta['extra_text']) ?></textarea></td>
		</tr>

		<?php
	}

	function save_extra_category_fileds($term_id) {
		if (isset($_POST['Cat_meta'])) {
			$t_id = $term_id;
			$cat_meta = get_option("cat_$t_id");
			$cat_keys = array_keys($_POST['Cat_meta']);
			foreach ($cat_keys as $key) {
				if (isset($_POST['Cat_meta'][$key])) {
					$cat_meta[$key] = $_POST['Cat_meta'][$key];
				}
			}
			update_option("cat_$t_id", $cat_meta);
		}
	}

}

