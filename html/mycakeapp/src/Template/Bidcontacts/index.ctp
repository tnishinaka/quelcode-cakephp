<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Bidcontact[]|\Cake\Collection\CollectionInterface $bidcontacts
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Bidcontact'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="bidcontacts index large-9 medium-8 columns content">
    <h3><?= __('Bidcontacts') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('biderinfo_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('message') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($bidcontacts as $bidcontact): ?>
            <tr>
                <td><?= $this->Number->format($bidcontact->id) ?></td>
                <td><?= $this->Number->format($bidcontact->biderinfo_id) ?></td>
                <td><?= $bidcontact->has('user') ? $this->Html->link($bidcontact->user->id, ['controller' => 'Users', 'action' => 'view', $bidcontact->user->id]) : '' ?></td>
                <td><?= h($bidcontact->message) ?></td>
                <td><?= h($bidcontact->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $bidcontact->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $bidcontact->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $bidcontact->id], ['confirm' => __('Are you sure you want to delete # {0}?', $bidcontact->id)]) ?>
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
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
