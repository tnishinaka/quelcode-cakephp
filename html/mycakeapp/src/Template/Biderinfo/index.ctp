<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Biderinfo[]|\Cake\Collection\CollectionInterface $biderinfo
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Biderinfo'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Bidrequests'), ['controller' => 'Bidrequests', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Bidrequest'), ['controller' => 'Bidrequests', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Biditems'), ['controller' => 'Biditems', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Biditem'), ['controller' => 'Biditems', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Bidcontacts'), ['controller' => 'Bidcontacts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Bidcontact'), ['controller' => 'Bidcontacts', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Bidratings'), ['controller' => 'Bidratings', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Bidrating'), ['controller' => 'Bidratings', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="biderinfo index large-9 medium-8 columns content">
    <h3><?= __('Biderinfo') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('bidinfo_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('bidrequest_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('biditem_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('bider_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('bider_address') ?></th>
                <th scope="col"><?= $this->Paginator->sort('bider_tel') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_completed') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_sended') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_received') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($biderinfo as $biderinfo): ?>
            <tr>
                <td><?= $this->Number->format($biderinfo->id) ?></td>
                <td><?= $this->Number->format($biderinfo->bidinfo_id) ?></td>
                <td><?= $biderinfo->has('bidrequest') ? $this->Html->link($biderinfo->bidrequest->id, ['controller' => 'Bidrequests', 'action' => 'view', $biderinfo->bidrequest->id]) : '' ?></td>
                <td><?= $biderinfo->has('biditem') ? $this->Html->link($biderinfo->biditem->name, ['controller' => 'Biditems', 'action' => 'view', $biderinfo->biditem->id]) : '' ?></td>
                <td><?= h($biderinfo->bider_name) ?></td>
                <td><?= h($biderinfo->bider_address) ?></td>
                <td><?= h($biderinfo->bider_tel) ?></td>
                <td><?= h($biderinfo->is_completed) ?></td>
                <td><?= h($biderinfo->is_sended) ?></td>
                <td><?= h($biderinfo->is_received) ?></td>
                <td><?= h($biderinfo->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $biderinfo->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $biderinfo->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $biderinfo->id], ['confirm' => __('Are you sure you want to delete # {0}?', $biderinfo->id)]) ?>
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
