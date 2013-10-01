<?php echo $this->element('sidebar'); ?>

<div class="view">
    <h1><?php echo __d('users', 'Admin :: View'); ?></h1>
    <dl>

        <dt><?php echo __d('users', 'ID'); ?></dt>
        <dd><?php echo $user['User']['id']; ?>&nbsp;</dd>

        <dt><?php echo __d('users', 'Username'); ?></dt>
        <dd><?php echo $user['User']['username']; ?>&nbsp;</dd>

        <dt><?php echo __d('users', 'Employee'); ?></dt>
        <dd><?php echo $user['User']['employee'] ? 'Yes' : 'No'; ?>&nbsp;</dd>

        <dt><?php echo __d('users', 'Protected'); ?></dt>
        <dd><?php echo $user['User']['protected'] ? 'Yes' : 'No'; ?>&nbsp;</dd>

        <dt><?php echo __d('users', 'Created'); ?></dt>
        <dd><?php echo $user['User']['created']; ?>&nbsp;</dd>

        <dt><?php echo __d('users', 'Modified'); ?></dt>
        <dd><?php echo $user['User']['modified']; ?>&nbsp;</dd>

    </dl>

    <div class="menu">
        <ul>
            <li><?php echo $this->Html->link('Index', '/admin/users'); ?></li>
            <li><?php echo $this->Html->link('Create', '/admin/users/create'); ?></li>
            <li><?php echo $this->Html->link('Edit', "/admin/users/edit/{$id}"); ?></li>
            <li><?php echo $this->Html->link('Delete', "/admin/users/delete/{$id}", null, 'Are you sure?'); ?></li>
        </ul>
    </div>

</div>