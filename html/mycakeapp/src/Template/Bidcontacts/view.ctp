<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Bidcontact $bidcontact
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Bidcontact'), ['action' => 'edit', $bidcontact->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Bidcontact'), ['action' => 'delete', $bidcontact->id], ['confirm' => __('Are you sure you want to delete # {0}?', $bidcontact->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Bidcontacts'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Bidcontact'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="bidcontacts view large-9 medium-8 columns content">
    <h3><?= h($bidcontact->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $bidcontact->has('user') ? $this->Html->link($bidcontact->user->id, ['controller' => 'Users', 'action' => 'view', $bidcontact->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Message') ?></th>
            <td><?= h($bidcontact->message) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($bidcontact->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Biderinfo Id') ?></th>
            <td><?= $this->Number->format($bidcontact->biderinfo_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($bidcontact->created) ?></td>
        </tr>
    </table>
</div>
