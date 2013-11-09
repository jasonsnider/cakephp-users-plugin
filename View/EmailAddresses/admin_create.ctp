<div class="view">
    <h2><?php echo __d('email_addresses', 'Admin :: Create'); ?></h2>
    <div class="menu">
        <ul>
            <li><?php echo $this->Html->link('Index', '/admin/users'); ?></li>
        </ul>
    </div>
    <?php
    echo $this->Form->create('EmailAddress');
    echo $this->Form->input('model', array('type' => 'hidden'));
    echo $this->Form->input('model_id', array('type' => 'hidden'));
    echo $this->Form->input('email');
    echo $this->Form->end(__d('users', 'Submit'));
    ?>
</div>

