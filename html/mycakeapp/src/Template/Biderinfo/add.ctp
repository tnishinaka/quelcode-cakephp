<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Biderinfo $biderinfo
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Biderinfo'), ['action' => 'index']) ?></li>
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
<div class="biderinfo form large-9 medium-8 columns content">
    <?= $this->Form->create($biderinfo) ?>
    <fieldset>
        <legend><?= __('Add Biderinfo') ?></legend>
        <?php
            echo $this->Form->control('bidinfo_id');
            echo $this->Form->control('bidrequest_id', ['options' => $bidrequests]);
            echo $this->Form->control('biditem_id', ['options' => $biditems]);
            echo $this->Form->control('bider_name');
            echo $this->Form->control('bider_address');
            echo $this->Form->control('bider_tel');
            echo $this->Form->control('is_completed');
            echo $this->Form->control('is_sended');
            echo $this->Form->control('is_received');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
