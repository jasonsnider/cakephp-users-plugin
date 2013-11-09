<div class="index">
    <h2><?php echo __d('users', 'Admin :: Users'); ?></h2>
    <div class="menu">
        <ul>
            <li><?php echo $this->Html->link('Create', '/admin/users/users/create'); ?></li>
        </ul>
    </div>
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
            <th><?php echo $this->Paginator->sort('username', 'Username'); ?></th>
            <th><?php echo $this->Paginator->sort('employee', 'Employee'); ?></th>
            <th><?php echo $this->Paginator->sort('protected', 'Protected'); ?></th>
            <th>Actions</th>
        </tr>
        <?php foreach ($data as $user): ?>
            <tr>
                <td><?php echo $user['User']['username']; ?></td>
                <td><?php echo $user['User']['employee'] ? 'Yes' : 'No'; ?></td>
                <td><?php echo $user['User']['protected'] ? 'Yes' : 'No'; ?></td>
                <td class="actions">
                    <?php
                    echo $this->Html->link(
                            'view', 
                            array(
                                'admin'=>true,
                                'plugin'=>false,
                                'controller'=>'users',
                                'action'=>'admin_view',
                                0=>$user['User']['id']
                                
                            )
                            //"/admin/users/users/view/{$user['User']['id']}"
                    );

                    echo $this->Html->link(
                            'edit', "/admin/users/users/edit/{$user['User']['id']}"
                    );

                    echo $this->Html->link(
                            'delete', "/admin/users/users/delete/{$user['User']['id']}", null, 'Are you sure?'
                    );
                    ?> 
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <?php echo $this->element('pager'); ?>
</div>