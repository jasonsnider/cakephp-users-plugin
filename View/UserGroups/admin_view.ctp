<div class="view">
    <h2><?php echo __d('user_groups', 'Admin :: View'); ?></h2>
    <div class="menu">
        <ul>
            <li><?php echo $this->Html->link('Index', '/admin/user_groups'); ?></li>
            <li><?php echo $this->Html->link('Create', '/admin/users/user_groups/create'); ?></li>
            <li><?php echo $this->Html->link('Edit', "/admin/users/user_groups/edit/{$id}"); ?></li>
            <li><?php echo $this->Html->link('Delete', "/admin/users/user_groups/delete/{$id}", null, 'Are you sure?'); ?></li>
        </ul>
    </div>
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
    
</div>