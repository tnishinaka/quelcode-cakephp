<h2>ユーザー評価</h2>

<?php if ($rating_num === 0) : ?>
    <?= $this->Form->create(
        $bidratings,
        [
            "type" => "post",
            "url" => [
                "controller" => "Rating",
                "action" => "ratingadd"
            ]
        ]
    ); ?>
    <fieldset>
        <legend>評価・コメント</legend>

        <?php
        echo $this->Form->hidden('user_id', ['value' => $data['user_id']]);
        echo $this->Form->hidden('biderinfo_id', ['value' => $data['biderinfo_id']]);
        echo $this->Form->hidden('user_judger_id', ['value' => $data['partner_user_id']]);
        echo $this->Form->select('rating', [1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5]);
        echo $this->Form->textarea('comment', ['rows' => 2]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
<?php else : ?>
    <h2>ご記入ありがとうございました。</h2>
<?php endif; ?>
<h6><?= $this->Html->link(__('<< 受発注情報ページに戻る'), ['controller' => 'Auction', 'action' => 'info', $biderinfo_id]) ?></h6>