<?php echo $this->element('sidebar'); ?>
<div class="form">
    <h1><?php echo __d('groups', 'Admin :: Edit Group'); ?></h1>
    <?php echo $this->Form->create('Group'); ?>
    <fieldset>
        <legend><?php echo __d('groups', 'Group Details'); ?></legend>
        <?php
        echo $this->Form->input('id');
        echo $this->Form->input('alias');
        echo $this->Form->input('name');
        ?>
    </fieldset>

    <fieldset>
        <legend><?php echo __d('groups', 'Group Privileges'); ?></legend>
        <?php
        foreach ($controllers as $controller => $methods) {

            echo $this->Html->tag('h2', Inflector::humanize(Inflector::underscore($controller)));

            foreach ($methods as $key => $values) {

                $formKey = Inflector::camelize($key);

                if (!empty($values)) {
                    //If the group has either had this privilege alled of denied, set group_privileges.id.
                    echo $this->Form->input(
                            "GroupPrivilege.{$controller}{$formKey}.id", array('value' => $values['id'], 'type' => 'hidden'));
                }

                echo $this->Form->input(
                        "GroupPrivilege.{$controller}{$formKey}.group_id", array('value' => $this->data['Group']['id'], 'type' => 'hidden'));

                echo $this->Form->input(
                        "GroupPrivilege.{$controller}{$formKey}.controller", array('value' => $controller, 'type' => 'hidden'));

                echo $this->Form->input(
                        "GroupPrivilege.{$controller}{$formKey}.action", array('value' => $key, 'type' => 'hidden'));

                if (isset($values['allowed'])) {
                    $allowed = $values['allowed'];
                } else {
                    $allowed = 2;
                }

                echo $this->Form->input(
                        "GroupPrivilege.{$controller}{$formKey}.allowed", array(
                    'label' => $key,
                    //'type'=>'radio',
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

    <?php echo $this->Form->end(__d('groups', 'Submit')); ?>

    <div class="menu">
        <ul>
            <li><?php echo $this->Html->link('Index', '/admin/groups'); ?></li>
            <li><?php echo $this->Html->link('Create', '/admin/groups/create'); ?></li>
            <li><?php echo $this->Html->link('Edit', "/admin/groups/view/{$id}"); ?></li>
            <li><?php echo $this->Html->link('Delete', "/admin/groups/delete/{$id}", null, 'Are you sure?'); ?></li>
        </ul>
    </div>

</div>