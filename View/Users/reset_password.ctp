<?php echo $this->element('sidebar'); ?>
<div class="form">
    <h1><?php echo __d('users', 'Reset Password'); ?></h1>
    <?php
    echo $this->Form->create('User');
    echo $this->Form->input('password');
    echo $this->Form->input('verify_password');
    echo $this->Form->input('username');
    echo $this->Form->input('password_confirmation', array('div' => array('class' => 'input text required')));

    echo $this->Form->end(__d('users', 'Submit'));
    ?>
</div>