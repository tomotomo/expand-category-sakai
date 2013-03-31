#ライセンス
WordpressなんでGPS2です。

#利用規約
http://www.webopixel.net/wordpress/436.html
こちらの記事に書いてあったことを丸コピしただけなので
制作した本人も理解してないところが多々あります。
利用は自己責任でお願いします。
あんまり拡散されても迷惑なので、利用は自己責任でお願いします。
大切なことなので2回書きました。

今のところwordpress.orgに上げるつもりはありません。


#設置サンプル


## 例1　サイドバーに表示
sidebar.php
{code}
			<aside class="widget">
			<?php
			if ($category = get_the_category()) {
				foreach ($category as $value) {
					$cat_data = get_option('cat_'.intval($value->term_id));
					print_r($cat_data['extra_text']);
				}

			}
			?>
			</aside>
{/code}

## 例2　うまい使い方を考えてください