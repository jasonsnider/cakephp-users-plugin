<?php echo $this->element('Utilities.sidebar'); ?>

<div class="view">
    <h1><?php echo __d('users', 'View'); ?></h1>
    <div class="menu">
        <ul>
            <li><?php echo $this->Html->link('Index', "/users/users/"); ?></li>
            <li><?php echo $this->Html->link('Edit', "/users/users/edit/"); ?></li>
        </ul>
    </div>
    <dl>

        <dt><?php echo __d('users', 'ID'); ?></dt>
        <dd><?php echo $user['User']['id']; ?>&nbsp;</dd>

        <dt><?php echo __d('users', 'Username'); ?></dt>
        <dd><?php echo $user['User']['username']; ?>&nbsp;</dd>

        <dt><?php echo __d('users', 'Created'); ?></dt>
        <dd><?php echo $user['User']['created']; ?>&nbsp;</dd>

        <dt><?php echo __d('users', 'Modified'); ?></dt>
        <dd><?php echo $user['User']['modified']; ?>&nbsp;</dd>

    </dl>

</div>