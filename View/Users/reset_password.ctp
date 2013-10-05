<?php echo $this->element('sidebar'); ?>
<div class="form">
    <p>If you haven't received instructions for reseting your password, check your email's spam
    and junk folder, or try <a href="/users/reset_password_request">resending your request.</a></p>
    
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