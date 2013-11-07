<?php echo $this->element('sidebar'); ?>
<div class="view">
    <h2><?php echo __d('users', 'New Account'); ?></h2>
    <?php
    echo $this->Form->create('User');
    echo $this->Form->input('username');
    echo $this->Form->input('EmailAddress.0.email');
    echo $this->Form->input('EmailAddress.0.model', array('value' => 'User', 'type' => 'hidden'));
    echo $this->Form->input('password');
    echo $this->Form->input('verify_password', array('type' => 'password'));
    echo $this->Form->end(__d('users', 'Submit'));
    ?>
</div>

