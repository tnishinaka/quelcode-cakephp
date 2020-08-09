<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Bidcontact $bidcontact
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Bidcontacts'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="bidcontacts form large-9 medium-8 columns content">
    <?= $this->Form->create($bidcontact) ?>
    <fieldset>
        <legend><?= __('Add Bidcontact') ?></legend>
        <?php
            echo $this->Form->control('biderinfo_id');
            echo $this->Form->control('user_id', ['options' => $users]);
            echo $this->Form->control('message');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
