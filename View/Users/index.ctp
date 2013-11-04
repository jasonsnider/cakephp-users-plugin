<?php echo $this->element('Utilities.sidebar'); ?>
<div class="index">
    <h2>Users</h2>
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
        </tr>
        <?php foreach ($data as $user): ?>
            <tr>
                <td>
                    <?php
                    echo $this->Html->link(
                        $user['User']['username'], 
                        "/users/users/view/{$user['User']['id']}"
                    );
                    ?> 
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <?php echo $this->element('pager'); ?>
</div>