<h4>発送先</h4>


<?php if ($flag === 0 && intval($biderinfo->is_completed) === 0) : ?>
    <?= $this->Form->create(
        $biderinfo,
        [
            "type" => "post",
            "url" => [
                "controller" => "Auction",
                "action" => "infoadd"
            ]
        ]
    ); ?>
    <fieldset>
        <legend>名前・住所・電話番号</legend>

        <?php
        echo $this->Form->hidden('id', ['value' => $biderinfo->id]);
        echo $this->Form->control('bider_name');
        echo $this->Form->control('bider_address');
        echo $this->Form->control('bider_tel');
        echo $this->Form->hidden('is_completed', ['value' => 1]);
        echo $this->Form->hidden('created', ['value' => date("Y-m-d H:i:s")]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
<?php elseif (intval($biderinfo->is_completed) === 1) : ?>
    <?php
    echo ' 名前 : ';
    echo empty($biderinfo->bider_name) ? '未確定' : $biderinfo->bider_name . '<br>';
    echo ' 住所 : ';
    echo empty($biderinfo->bider_address) ? '未確定' : $biderinfo->bider_address . '<br>';
    echo ' 電話番号 : ';
    echo empty($biderinfo->bider_tel) ? '未確定' : $biderinfo->bider_tel . '<br>';
    ?>
<?php elseif (intval($biderinfo->is_completed) === 1 && $flag === 0) : ?>
    <?=
        $this->Form->postLink(
            '書き直す',
            ['action' => 'rewrite', $biderinfo->id]
        );
    ?>
    <?php echo '<br>'; ?>
<?php endif; ?>

<?php if ($flag === 1 && intval($biderinfo->is_completed) === 1) : ?>
    <?=
        $this->Form->postLink(
            '発送',
            ['action' => 'send', $biderinfo->id]
        );
    ?>
    <?php echo '<br>'; ?>
<?php elseif ($flag === 0 && intval($biderinfo->is_sended) === 1) : ?>
    <?=
        $this->Form->postLink(
            '受取',
            ['action' => 'receive', $biderinfo->id]
        );
    ?>
    <?php echo '<br>'; ?>
<?php endif; ?>

<?php if (intval($biderinfo->is_sended) === 1) : ?>
    <?php echo '発送しました' . '<br>'; ?>
<?php endif; ?>
<?php if (intval($biderinfo->is_received) === 1) : ?>
    <?php echo '受取ました' . '<br><br>'; ?>
    <?=
        $this->Form->create(
            $biderinfo,
            [
                "type" => "post",
                "url" => [
                    "controller" => "Rating",
                    "action" => "ratingadd"
                ]
            ]
        ); ?>
    <?php
    echo $this->Form->hidden('stopper', ['value' => 'stop']);
    echo $this->Form->hidden('biderinfo_id', ['value' => $biderinfo->id]);
    echo $this->Form->hidden('user_id', ['value' => $authuser['id']]);
    echo $this->Form->hidden('partner_user_id', ['value' => $partner_user_id->user_id]);
    ?>
    <?= $this->Form->button(__('ユーザー評価へ進む')) ?>
    <?= $this->Form->end() ?>
<?php endif; ?>

<h3>メッセージ</h3>
<?= $this->Form->create(
    $bidmsg,
    [
        "type" => "post",
        "url" => [
            "controller" => "Auction",
            "action" => "comment"
        ]
    ]
); ?>
<?= $this->Form->hidden('biderinfo_id', ['value' => $biderinfo->id]) ?>
<?= $this->Form->hidden('user_id', ['value' => $authuser['id']]) ?>
<?= $this->Form->textarea('message', ['rows' => 2]); ?>
<?= $this->Form->button('Submit') ?>
<?= $this->Form->end() ?>
<table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th scope="col">送信者</th>
            <th class="main" scope="col">メッセージ</th>
            <th scope="col">送信時間</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!$bidmsg->isEmpty()) : ?>
            <?php foreach ($bidmsg as $msg) : ?>
                <tr>
                    <td><?= h($msg->user->username) ?></td>
                    <td><?= h($msg->message) ?></td>
                    <td><?= h($msg->created) ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else : ?>
            <tr>
                <td colspan="3">※メッセージがありません。</td>
            </tr>
        <?php endif; ?>


    </tbody>
</table>
<h6><?= $this->Html->link(__('<< 一覧に戻る'), ['action' => 'list']) ?></h6>