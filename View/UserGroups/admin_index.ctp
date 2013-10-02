<?php echo $this->element('sidebar'); ?>
<div class="index">
    <h1><?php echo __d('user_group', 'Admin :: UserGroups'); ?></h1>
    <table>
        <caption>
            <?php
            echo $this->Paginator->counter(array(
                'format' => 'Page {:page} of {:pages}, showing {:current} records out of
                         {:count} total, starting on record {:start}, ending on {:end}'
            ));
            ?>
        </caption>
        <tr>
            <th><?php echo $this->Paginator->sort('username', 'UserGroupname'); ?></th>
            <th><?php echo $this->Paginator->sort('employee', 'Employee'); ?></th>
            <th>Actions</th>
        </tr>
        <?php foreach ($user_groups as $user_group): ?>
            <tr>
                <td><?php echo $user_group['UserGroup']['alias']; ?></td>
                <td><?php echo $user_group['UserGroup']['name']; ?></td>
                <td class="actions">
                    <?php
                    echo $this->Html->link(
                            'view', "/admin/user_groups/view/{$user_group['UserGroup']['id']}"
                    );

                    echo $this->Html->link(
                            'edit', "/admin/user_groups/edit/{$user_group['UserGroup']['id']}"
                    );

                    echo $this->Html->link(
                            'delete', "/admin/user_groups/delete/{$user_group['UserGroup']['id']}", null, 'Are you sure?'
                    );
                    ?> 
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <?php echo $this->element('pager'); ?>
    <div class="menu">
        <ul>
            <li><?php echo $this->Html->link('Create', '/admin/user_groups/create'); ?></li>
        </ul>
    </div>
</div>