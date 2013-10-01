<?php echo $this->element('sidebar'); ?>
<div class="index">
    <h1><?php echo __d('group', 'Admin :: Groups'); ?></h1>
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
            <th><?php echo $this->Paginator->sort('username', 'Groupname'); ?></th>
            <th><?php echo $this->Paginator->sort('employee', 'Employee'); ?></th>
            <th>Actions</th>
        </tr>
        <?php foreach ($groups as $group): ?>
            <tr>
                <td><?php echo $group['Group']['alias']; ?></td>
                <td><?php echo $group['Group']['name']; ?></td>
                <td class="actions">
                    <?php
                    echo $this->Html->link(
                            'view', "/admin/groups/view/{$group['Group']['id']}"
                    );

                    echo $this->Html->link(
                            'edit', "/admin/groups/edit/{$group['Group']['id']}"
                    );

                    echo $this->Html->link(
                            'delete', "/admin/groups/delete/{$group['Group']['id']}", null, 'Are you sure?'
                    );
                    ?> 
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <?php echo $this->element('pager'); ?>
    <div class="menu">
        <ul>
            <li><?php echo $this->Html->link('Create', '/admin/groups/create'); ?></li>
        </ul>
    </div>
</div>