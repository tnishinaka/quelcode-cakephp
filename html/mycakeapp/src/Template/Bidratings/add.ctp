<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Bidrating $bidrating
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Bidratings'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="bidratings form large-9 medium-8 columns content">
    <?= $this->Form->create($bidrating) ?>
    <fieldset>
        <legend><?= __('Add Bidrating') ?></legend>
        <?php
            echo $this->Form->control('user_id', ['options' => $users]);
            echo $this->Form->control('biderinfo_id');
            echo $this->Form->control('user_judger_id');
            echo $this->Form->control('rating');
            echo $this->Form->control('comment');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
