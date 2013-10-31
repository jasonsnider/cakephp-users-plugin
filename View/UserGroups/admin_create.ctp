<?php echo $this->element('Utilities.sidebar'); ?>
<div class="view">
    <h1><?php echo __d('user_groups', 'Admin :: Create'); ?></h1>
    <div class="menu">
        <ul>
            <li><?php echo $this->Html->link('Index', '/admin/user_groups'); ?></li>
        </ul>
    </div>
    <?php
    echo $this->Form->create('UserGroup');
    echo $this->Form->input('name');
    echo $this->Form->end(__d('user_groups', 'Submit'));
    ?>
</div>

