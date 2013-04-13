<?php
/*
Plugin Name: Expand Category Sakai
Description: Word Bar Sakai 2013/03/30
Author: Tomoyuki Sugita
Author URI: http://tomotomosnippet.blogspot.jp/
Version: 0.1
Text Domain: expand-category-sakai
*/

/**
 * カテゴリを拡張
 * Original http://www.webopixel.net/wordpress/436.html
 */

// 管理画面のカテゴリ編集画面を拡張
add_action ( 'edit_category_form_fields', 'extra_category_fields');
function extra_category_fields( $tag ) {
    $t_id = $tag->term_id;
    $cat_meta = get_option( "cat_$t_id");
?>
<tr class="form-field">
	<th><label for="extra_text">その他テキスト</label></th>
	<td><textarea name="Cat_meta[extra_text]" id="extra_text" ><?php if(isset ( $cat_meta['extra_text'])) echo esc_html($cat_meta['extra_text']) ?></textarea></td>
</tr>

<?php
}

// メタデータの保存
add_action ( 'edited_term', 'save_extra_category_fileds');
function save_extra_category_fileds( $term_id ) {
    if ( isset( $_POST['Cat_meta'] ) ) {
	   $t_id = $term_id;
	   $cat_meta = get_option( "cat_$t_id");
	   $cat_keys = array_keys($_POST['Cat_meta']);
		  foreach ($cat_keys as $key){
		  if (isset($_POST['Cat_meta'][$key])){
			 $cat_meta[$key] = $_POST['Cat_meta'][$key];
		  }
	   }
	   update_option( "cat_$t_id", $cat_meta );
    }
}
// ここまで
