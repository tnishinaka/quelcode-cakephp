<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Biderinfo $biderinfo
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Biderinfo'), ['action' => 'edit', $biderinfo->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Biderinfo'), ['action' => 'delete', $biderinfo->id], ['confirm' => __('Are you sure you want to delete # {0}?', $biderinfo->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Biderinfo'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Biderinfo'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Bidrequests'), ['controller' => 'Bidrequests', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Bidrequest'), ['controller' => 'Bidrequests', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Biditems'), ['controller' => 'Biditems', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Biditem'), ['controller' => 'Biditems', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Bidcontacts'), ['controller' => 'Bidcontacts', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Bidcontact'), ['controller' => 'Bidcontacts', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Bidratings'), ['controller' => 'Bidratings', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Bidrating'), ['controller' => 'Bidratings', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="biderinfo view large-9 medium-8 columns content">
    <h3><?= h($biderinfo->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Bidrequest') ?></th>
            <td><?= $biderinfo->has('bidrequest') ? $this->Html->link($biderinfo->bidrequest->id, ['controller' => 'Bidrequests', 'action' => 'view', $biderinfo->bidrequest->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Biditem') ?></th>
            <td><?= $biderinfo->has('biditem') ? $this->Html->link($biderinfo->biditem->name, ['controller' => 'Biditems', 'action' => 'view', $biderinfo->biditem->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Bider Name') ?></th>
            <td><?= h($biderinfo->bider_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Bider Address') ?></th>
            <td><?= h($biderinfo->bider_address) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Bider Tel') ?></th>
            <td><?= h($biderinfo->bider_tel) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($biderinfo->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Bidinfo Id') ?></th>
            <td><?= $this->Number->format($biderinfo->bidinfo_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($biderinfo->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Completed') ?></th>
            <td><?= $biderinfo->is_completed ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Sended') ?></th>
            <td><?= $biderinfo->is_sended ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Received') ?></th>
            <td><?= $biderinfo->is_received ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Bidcontacts') ?></h4>
        <?php if (!empty($biderinfo->bidcontacts)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Biderinfo Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Message') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($biderinfo->bidcontacts as $bidcontacts): ?>
            <tr>
                <td><?= h($bidcontacts->id) ?></td>
                <td><?= h($bidcontacts->biderinfo_id) ?></td>
                <td><?= h($bidcontacts->user_id) ?></td>
                <td><?= h($bidcontacts->message) ?></td>
                <td><?= h($bidcontacts->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Bidcontacts', 'action' => 'view', $bidcontacts->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Bidcontacts', 'action' => 'edit', $bidcontacts->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Bidcontacts', 'action' => 'delete', $bidcontacts->id], ['confirm' => __('Are you sure you want to delete # {0}?', $bidcontacts->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Bidratings') ?></h4>
        <?php if (!empty($biderinfo->bidratings)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Biderinfo Id') ?></th>
                <th scope="col"><?= __('User Judger Id') ?></th>
                <th scope="col"><?= __('Rating') ?></th>
                <th scope="col"><?= __('Comment') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($biderinfo->bidratings as $bidratings): ?>
            <tr>
                <td><?= h($bidratings->id) ?></td>
                <td><?= h($bidratings->user_id) ?></td>
                <td><?= h($bidratings->biderinfo_id) ?></td>
                <td><?= h($bidratings->user_judger_id) ?></td>
                <td><?= h($bidratings->rating) ?></td>
                <td><?= h($bidratings->comment) ?></td>
                <td><?= h($bidratings->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Bidratings', 'action' => 'view', $bidratings->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Bidratings', 'action' => 'edit', $bidratings->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Bidratings', 'action' => 'delete', $bidratings->id], ['confirm' => __('Are you sure you want to delete # {0}?', $bidratings->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
