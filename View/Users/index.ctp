<h1>Users</h1>
<div class="row">
    <div class="col-md-12">
        <?php if(!empty($data)): ?>
            <table class="table table-bordered table-condensed table-striped table-hover">
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
        <?php else: ?>
            <div class="well well-sm text-center">
                <?php echo __('No users have been created.'); ?>
            </div>
        <?php endif; ?>
    </div>
</div>