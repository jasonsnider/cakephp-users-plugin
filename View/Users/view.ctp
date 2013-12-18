<h1><?php echo __d('users', 'View'); ?></h1>
<ul class="nav nav-pills">
    <li><?php echo $this->Html->link('Index', "/users/users/"); ?></li>
    <li><?php echo $this->Html->link('Edit', "/users/users/edit/"); ?></li>
</ul>

<div class="row">
    <div class="col-md-4">
        <table class="table table-bordered table-condensed table-responsive table-striped">
            <tr>
                <th><?php echo __d('users', 'ID'); ?></th>
                <td><?php echo $user['User']['id']; ?></td>
            </tr>
            <tr>
                <th><?php echo __d('users', 'Username'); ?></th>
                <td><?php echo $user['User']['username']; ?></td>
            </tr>
            <tr>
                <th><?php echo __d('users', 'Created'); ?></th>
                <td><?php echo $user['User']['created']; ?></td>
            </tr>
            <tr>
                <th><?php echo __d('users', 'Modified'); ?></th>
                <td><?php echo $user['User']['modified']; ?></td>
            </tr>
        </table>
    </div>
</div>