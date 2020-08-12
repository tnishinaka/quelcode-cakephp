<h2>「<?= $biditem->name ?>」の情報</h2>
<table class="vertical-table">
	<tr>
		<th class="small" scope="row">出品者</th>
		<td><?= $biditem->has('user') ? $biditem->user->username : '' ?></td>
	</tr>
	<tr>
		<th scope="row">商品名</th>
		<td><?= h($biditem->name) ?></td>
	</tr>
	<tr>
		<th scope="row">商品ID</th>
		<td><?= $this->Number->format($biditem->id) ?></td>
	</tr>
	<tr>
		<th scope="row">最低落札価格</th>
		<td><?= $this->Number->format($biditem->lowest_price) ?></td>
	</tr>
	<tr>
		<th scope="row">商品詳細</th>
		<td><?= h($biditem->biditem_info) ?></td>
	</tr>
	<tr>
		<th scope="row">商品画像</th>
		<td><?= $this->Html->image("biditem_images/" . $biditem->biditem_img_path); ?></td>
	</tr>
	<tr>
		<th scope="row">終了時間</th>
		<td><?= h($biditem->endtime) ?></td>
	</tr>
	<tr>
		<th scope="row">終了時間カウントダウン</th>
		<td id="count"></td>
	</tr>
	<tr>
		<th scope="row">投稿時間</th>
		<td><?= h($biditem->created) ?></td>
	</tr>
	<tr>
		<th scope="row"><?= __('終了した？') ?></th>
		<td><?= $biditem->finished ? __('Yes') : __('No'); ?></td>
	</tr>
</table>
<div class="related">
	<h4><?= __('落札情報') ?></h4>
	<?php if (!empty($biditem->bidinfo)) : ?>
		<table cellpadding="0" cellspacing="0">
			<tr>
				<th scope="col">落札者</th>
				<th scope="col">落札金額</th>
				<th scope="col">落札日時</th>
			</tr>
			<tr>
				<td><?= h($biditem->bidinfo->user->username) ?></td>
				<td><?= h($biditem->bidinfo->price) ?>円</td>
				<td><?= h($biditem->endtime) ?></td>
			</tr>
		</table>
	<?php else : ?>
		<p><?= '※落札情報は、ありません。' ?></p>
	<?php endif; ?>
</div>
<div class="related">
	<h4><?= __('入札情報') ?></h4>
	<?php if (!$biditem->finished) : ?>
		<h6><a href="<?= $this->Url->build(['action' => 'bid', $biditem->id]) ?>">《入札する！》</a></h6>
		<?php if (!empty($bidrequests)) : ?>
			<table cellpadding="0" cellspacing="0">
				<thead>
					<tr>
						<th scope="col">入札者</th>
						<th scope="col">金額</th>
						<th scope="col">入札日時</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($bidrequests as $bidrequest) : ?>
						<tr>
							<td><?= h($bidrequest->user->username) ?></td>
							<td><?= h($bidrequest->price) ?>円</td>
							<td><?= $bidrequest->created ?></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		<?php else : ?>
			<p><?= '※入札は、まだありません。' ?></p>
		<?php endif; ?>
	<?php else : ?>
		<p><?= '※入札は、終了しました。' ?></p>
	<?php endif; ?>
</div>
<script>
	var endtime = <?php echo $biditem->endtimecount ?>;
	minus = 0;

	function countdownTimer() {
		var endtime = <?php echo $biditem->endtimecount ?>;
		endtime -= minus;
		if (endtime > 0) {
			var day = Math.floor(endtime / (60 * 60 * 24));
			endtime -= (day * (60 * 60 * 24));
			var hour = Math.floor(endtime / (60 * 60));
			endtime -= (hour * (60 * 60));
			var minutes = Math.floor(endtime / 60);
			endtime -= (minutes * 60);
			var second = Math.floor(endtime);
			insert = '残り' + day + "日" + hour + "時間" + minutes + "分" + second + "秒";
			document.getElementById('count').innerHTML = insert;
			minus = minus + 1;
			refresh();
		} else {
			document.getElementById('count').innerHTML = 'Finish!';
		}
	}
	var refresh = function() {
		setTimeout(countdownTimer, 1000);
	}
	countdownTimer();
</script>
