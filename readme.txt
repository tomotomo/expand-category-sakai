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