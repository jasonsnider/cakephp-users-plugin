<?php echo $this->element('sidebar'); ?>

<div class="view">
    <h1><?php echo __d('user_groups', 'Admin :: View'); ?></h1>
    <dl>

        <dt><?php echo __d('user_groups', 'ID'); ?></dt>
        <dd><?php echo $user_group['UserGroup']['id']; ?>&nbsp;</dd>

        <dt><?php echo __d('user_groups', 'Alias'); ?></dt>
        <dd><?php echo $user_group['UserGroup']['alias']; ?>&nbsp;</dd>

        <dt><?php echo __d('user_groups', 'name'); ?></dt>
        <dd><?php echo $user_group['UserGroup']['name']; ?>&nbsp;</dd>

        <dt><?php echo __d('user_groups', 'Created'); ?></dt>
        <dd><?php echo $user_group['UserGroup']['created']; ?>&nbsp;</dd>

        <dt><?php echo __d('user_groups', 'Modified'); ?></dt>
        <dd><?php echo $user_group['UserGroup']['modified']; ?>&nbsp;</dd>

    </dl>

    <div class="menu">
        <ul>
            <li><?php echo $this->Html->link('Index', '/admin/user_groups'); ?></li>
            <li><?php echo $this->Html->link('Create', '/admin/user_groups/create'); ?></li>
            <li><?php echo $this->Html->link('Edit', "/admin/user_groups/edit/{$id}"); ?></li>
            <li><?php echo $this->Html->link('Delete', "/admin/user_groups/delete/{$id}", null, 'Are you sure?'); ?></li>
        </ul>
    </div>

</div>