<?php echo $this->element('sidebar'); ?>
<div class="form">
    <h1><?php echo __d('users', 'Edit User'); ?></h1>
    <?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend><?php echo __d('users', 'User Details'); ?></legend>
        <?php
        echo $this->Form->input('id');
        echo $this->Form->input('username');
        echo $this->Form->input('employee', array('disabled' => true));
        echo $this->Form->input('root', array('disabled' => true));
        echo $this->Form->input('protected', array('disabled' => true));
        ?>
    </fieldset>

    <fieldset>
        <legend><?php echo __d('users', 'User Emails'); ?></legend>
        <?php
        for ($i = 0; $i < count($this->data['EmailAddress']); $i++):
            echo $this->Form->input("EmailAddress.{$i}.id");
            echo $this->Form->input("EmailAddress.{$i}.email");
        endfor;

        echo $this->Html->link(
                __d('users', 'Add an Email'), "/admin/email_addresses/create/user/{$this->data['User']['id']}"
        );
        ?>
    </fieldset>


    <fieldset>
        <legend><?php echo __d('users', 'User Settings'); ?></legend>
        <?php
        echo $this->Form->input('UserSetting.id');
        echo $this->Form->input('UserSetting.visibility');
        ?>
    </fieldset>

    <?php echo $this->Form->end(__d('users', 'Submit')); ?>
    <div class="menu">
        <ul>
            <li><?php echo $this->Html->link('Edit', "/users"); ?></li>
            <li><?php echo $this->Html->link('View', "/users/view/{$id}"); ?></li>
        </ul>
    </div>
</div>