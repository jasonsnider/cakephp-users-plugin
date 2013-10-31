<?php echo $this->element('Utilities.sidebar'); ?>
<div class="form">
    <h2><?php echo __d('users', 'Reset Password Request'); ?></h2>
    <?php
    echo $this->Form->create('User');
    echo $this->Form->input('username');
    echo $this->Form->end(__d('users', 'Submit'));
    ?>
</div>