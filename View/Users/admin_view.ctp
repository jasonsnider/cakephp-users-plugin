<h1><?php echo __d('users', 'Admin :: View'); ?></h1>
<ul class="nav nav-pills">
    <li><?php echo $this->Html->link('Index', '/admin/users/users'); ?></li>
    <li><?php echo $this->Html->link('Edit', "/admin/users/users/edit/{$id}"); ?></li>
</ul>
<div class="row">
    <div class="col-md-4 col-md-offset-4">
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
    </div>
</div>