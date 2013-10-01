<?php echo $this->element('sidebar'); ?>

<div class="view">
    <h1><?php echo __d('groups', 'Admin :: View'); ?></h1>
    <dl>

        <dt><?php echo __d('groups', 'ID'); ?></dt>
        <dd><?php echo $group['Group']['id']; ?>&nbsp;</dd>

        <dt><?php echo __d('groups', 'Alias'); ?></dt>
        <dd><?php echo $group['Group']['alias']; ?>&nbsp;</dd>

        <dt><?php echo __d('groups', 'name'); ?></dt>
        <dd><?php echo $group['Group']['name']; ?>&nbsp;</dd>

        <dt><?php echo __d('groups', 'Created'); ?></dt>
        <dd><?php echo $group['Group']['created']; ?>&nbsp;</dd>

        <dt><?php echo __d('groups', 'Modified'); ?></dt>
        <dd><?php echo $group['Group']['modified']; ?>&nbsp;</dd>

    </dl>

    <div class="menu">
        <ul>
            <li><?php echo $this->Html->link('Index', '/admin/groups'); ?></li>
            <li><?php echo $this->Html->link('Create', '/admin/groups/create'); ?></li>
            <li><?php echo $this->Html->link('Edit', "/admin/groups/edit/{$id}"); ?></li>
            <li><?php echo $this->Html->link('Delete', "/admin/groups/delete/{$id}", null, 'Are you sure?'); ?></li>
        </ul>
    </div>

</div>