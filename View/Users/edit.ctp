<h1><?php echo __d('users', 'Edit User'); ?></h1>
<ul class="nav nav-pills">
    <li><?php echo $this->Html->link('Index', '/users'); ?></li>
    <li><?php echo $this->Html->link('View', "/users/users/view/{$id}"); ?></li>
</ul>
<div class="row">
    <div class="col-md-4">
        <?php
        echo $this->Form->create(
            'User', 
            array(
                'url'=>$this->here,
                'role'=>'form',
                'inputDefaults'=>array(
                    'div'=>array(
                        'class'=>'form-group'
                    ),
                    'class'=>'form-control',
                    'required'=>false
                )
            )
        );
        ?>
        <fieldset>
            <legend><?php echo __d('users', 'User Details'); ?></legend>
            <?php
            echo $this->Form->input('id');
            echo $this->Form->input('username');
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
                    __d('users', 'Add an Email'), "/admin/users/email_addresses/create/user/{$this->data['User']['id']}"
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

        <?php
        echo $this->Form->submit(
             __d('users', 'Submit'), 
             array(
                 'div'=>array(
                     'class'=>'form-group'
                 ),
                 'class'=>'btn btn-primary btn-block'
             )
         ); 
        echo $this->Form->end();
        ?>
    </div>
</div>