<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <h1><?php echo __d('users', 'Reset Password'); ?></h1>
        <p class="alert alert-info">
            If you haven't received instructions for reseting your password, check your email's spam
            and junk folder, or try <a href="/users/users/reset_password_request/">resending your request.</a>
        </p>
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
        echo $this->Form->input('password');
        echo $this->Form->input('verify_password', array('type'=>'password'));
        echo $this->Form->input('username');
        echo $this->Form->input('password_confirmation');

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
