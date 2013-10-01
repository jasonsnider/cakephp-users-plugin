<?php echo $this->element('sidebar'); ?>
<div class="view">
    <h1><?php echo __d('groups', 'Admin :: Create'); ?></h1>
    <?php
    echo $this->Form->create('Group');
    echo $this->Form->input('name');
    echo $this->Form->end(__d('groups', 'Submit'));
    ?>
    <div class="menu">
        <ul>
            <li><?php echo $this->Html->link('Index', '/admin/groups'); ?></li>
        </ul>
    </div>
</div>

