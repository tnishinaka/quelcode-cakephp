<h2>落札情報</h2>
<ul>
    <?php if ($result1 !== 0) : ?>
        <li>
            <?= h($result1) ?>
        </li>
    <?php else : ?>
        <?php foreach ($biderinfo_bider as $bidinfo) : ?>
            <li>
                <?= $this->Html->link($bidinfo->biditem->name, ['action' => 'info', $bidinfo->biderinfo->id]); ?>
            </li>
        <?php endforeach; ?>
    <?php endif ?>
</ul>
<h2>出品情報</h2>
<ul>
    <?php if ($result2 !== 0) : ?>
        <li>
            <?= h($result2) ?>
        </li>
    <?php else : ?>
        <?php foreach ($bideritems as $item) : ?>
            <li>
                <?= $this->Html->link($item->biditem->name, ['action' => 'info', $item->biderinfo->id]); ?>
            </li>
        <?php endforeach; ?>
    <?php endif ?>
</ul>
<h6><?= $this->Html->link(__('<< TOPに戻る'), ['action' => 'index']) ?></h6>
