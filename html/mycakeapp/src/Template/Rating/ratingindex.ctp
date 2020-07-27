<h2>ユーザー一覧</h2>
<table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th class="main" scope="col"><?= $this->Paginator->sort('username') ?></th>
            <th scope="col" class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user) : ?>
            <tr>
                <td><?= h($user->username) ?></td>
                <td class="actions">
                    <?php if (!empty($user->username)) : ?>
                        <?= $this->Html->link(__('View'), ['action' => 'ratingview', $user->id]) ?>
                    <?php endif; ?>
                </td>
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
<h6><?= $this->Html->link(__('<< TOPに戻る'), ['controller' => 'Auction', 'action' => 'index']) ?></h6>
