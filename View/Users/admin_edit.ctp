<?php echo $this->element('sidebar'); ?>
<div class="form">
    <h1><?php echo __d('users', 'Admin :: Edit User'); ?></h1>
    <?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend><?php echo __d('users', 'User Details'); ?></legend>
        <?php
        echo $this->Form->input('id');
        echo $this->Form->input('username');
        echo $this->Form->input('employee');
        echo $this->Form->input('root');
        echo $this->Form->input('protected');
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
        <legend><?php echo __d('users', 'UserGroups'); ?></legend>
        <?php
        $x = 0;
        foreach ($user_groups as $user_group):
            //Current user_groups
            if (isset($user_group['id'])) {
                echo $this->Form->input(
                        "UserGroupUser.{$x}.id", array(
                    'type' => 'hidden',
                    'value' => $user_group['id']
                        )
                );

                echo $this->Form->input(
                        "UserGroupUser.{$x}.member", array(
                    'label' => $user_group['UserGroup']['name'],
                    'type' => 'checkbox',
                    'checked' => true
                        )
                );
            } else {

                //Not currently a member
                echo $this->Form->input(
                        "UserGroupUser.{$x}.member", array(
                    'label' => $user_group['UserGroup']['name'],
                    'type' => 'checkbox'
                        )
                );

                echo $this->Form->input(
                        "UserGroupUser.{$x}.user_group_id", array(
                    'type' => 'hidden',
                    'value' => $user_group['UserGroup']['id']
                        )
                );

                echo $this->Form->input(
                        "UserGroupUser.{$x}.user_id", array(
                    'type' => 'hidden',
                    'value' => $this->data['User']['id']
                        )
                );
            }

            $x++;
        endforeach;
        ?>
    </fieldset>

    <fieldset>
        <legend><?php echo __d('users', 'User Privileges'); ?></legend>
        <?php
        foreach ($controllers as $controller => $methods) {

            echo $this->Html->tag('h2', Inflector::humanize(Inflector::underscore($controller)));

            foreach ($methods as $key => $values) {

                $formKey = Inflector::camelize($key);

                if (!empty($values)) {
                    //If the user_group has either had this privilege alled of denied, set user_group_privileges.id.
                    echo $this->Form->input(
                            "UserPrivilege.{$controller}{$formKey}.id", array('value' => $values['id'], 'type' => 'hidden'));
                }

                echo $this->Form->input(
                        "UserPrivilege.{$controller}{$formKey}.user_group_id", array('value' => $this->data['User']['id'], 'type' => 'hidden'));

                echo $this->Form->input(
                        "UserPrivilege.{$controller}{$formKey}.controller", array('value' => $controller, 'type' => 'hidden'));

                echo $this->Form->input(
                        "UserPrivilege.{$controller}{$formKey}.action", array('value' => $key, 'type' => 'hidden'));

                if (isset($values['allowed'])) {
                    $allowed = $values['allowed'];
                } else {
                    $allowed = 2;
                }

                echo $this->Form->input(
                        "UserPrivilege.{$controller}{$formKey}.allowed", array(
                    'legend' => $formKey,
                    'type' => 'radio',
                    'options' => array(
                        0 => 'deny',
                        1 => 'allow',
                        2 => 'undefined'
                    ),
                    'value' => $allowed
                        )
                );
            }
        }
        ?>
    </fieldset>

    <?php echo $this->Form->end(__d('users', 'Submit')); ?>

    <div class="menu">
        <ul>
            <li><?php echo $this->Html->link('Index', '/admin/users'); ?></li>
            <li><?php echo $this->Html->link('Create', '/admin/users/create'); ?></li>
            <li><?php echo $this->Html->link('Edit', "/admin/users/view/{$id}"); ?></li>
            <li><?php echo $this->Html->link('Delete', "/admin/users/delete/{$id}", null, 'Are you sure?'); ?></li>
        </ul>
    </div>

</div>