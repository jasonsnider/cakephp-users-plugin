<?php echo $this->element('sidebar'); ?>
<div class="form">
    <h1><?php echo __d('users', 'Reset Password Request'); ?></h1>
    <?php
    echo $this->Form->create('User');
    echo $this->Form->input('username');
    echo $this->Form->end(__d('users', 'Submit'));
    ?>
</div>