<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <h1><?php echo __d('users', 'Login'); ?></h1>
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
        echo $this->Form->input('username');
        echo $this->Form->input('password');
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
        echo $this->Html->link(__d('users', 'Forgot Password?'), '/users/users/reset_password_request');
        ?>
    </div>
</div>

