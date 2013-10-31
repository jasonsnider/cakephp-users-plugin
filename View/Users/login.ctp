<?php echo $this->element('Utilities.sidebar'); ?>
<div class="view">
    <h2><?php echo __d('users', 'Login'); ?></h2>
    <?php
    echo $this->Form->create('User');
    echo $this->Form->input('username');
    echo $this->Form->input('password');
    echo $this->Html->link(__d('users', 'Forgot Password?'), '/users/users/reset_password_request');
    echo $this->Form->end(__d('users', 'Submit'));
    ?>
</div>

