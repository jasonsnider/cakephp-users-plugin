<h1><?php echo __d('users', 'New Account'); ?></h1>
<ul class="nav nav-pills">
    <li><?php echo $this->Html->link('Index', '/users'); ?></li>
</ul>
<div class="row">
    <div class="col-md-4 col-md-offset-4">
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
        echo $this->Form->input('EmailAddress.0.email');
        echo $this->Form->input('EmailAddress.0.model', array('value' => 'User', 'type' => 'hidden'));
        echo $this->Form->input('password');
        echo $this->Form->input('verify_password', array('type' => 'password'));
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