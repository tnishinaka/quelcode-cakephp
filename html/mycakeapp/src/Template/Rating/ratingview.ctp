<h2>ユーザー評価詳細</h2>

<?php if (empty($avg_data)) : ?>
    <h3>データがありません。</h3>
<?php else : ?>
    <p>平均評価 : <?php echo $avg_data ?></p>
    <?php var_dump($bidratings); ?>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('rating') ?></th>
                <th scope="col"><?= $this->Paginator->sort('username') ?></th>
                <th class="main" scope="col"><?= $this->Paginator->sort('comment') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($bidratings as $bidrating) : ?>
                <tr>
                    <td><?= h($bidrating['rating']) ?></td>
                    <td><?= h($bidrating['username']) ?></td>
                    <td><?= h($bidrating['comment']) ?></td>
                    <td><?= h($bidrating['created']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
    </div>
    <h6><?= $this->Html->link(__('<< 一覧に戻る'), ['controller' => 'Rating', 'action' => 'ratingindex']) ?></h6>
<?php endif; ?>