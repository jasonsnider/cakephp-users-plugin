<?php echo $this->element('sidebar'); ?>
<div class="view">
    <h1><?php echo __d('email_addresses', 'Create'); ?></h1>
    <?php
    echo $this->Form->create('EmailAddress');
    echo $this->Form->input('model', array('type' => 'hidden'));
    echo $this->Form->input('model_id', array('type' => 'hidden'));
    echo $this->Form->input('email');
    echo $this->Form->end(__d('users', 'Submit'));
    ?>
    <div class="menu">
        <ul>
            <li><?php echo $this->Html->link('Index', '/users'); ?></li>
        </ul>
    </div>
</div>

