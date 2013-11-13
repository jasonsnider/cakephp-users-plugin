<h1><?php echo __d('email_addresses', 'Admin :: Create'); ?></h1>
<div class="row">
    <div class="col-md-4">
        <?php
        echo $this->Form->create(
            'EmailAddress', 
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
        echo $this->Form->input('model', array('type' => 'hidden'));
        echo $this->Form->input('model_id', array('type' => 'hidden'));
        echo $this->Form->input('email');
        echo $this->Form->submit(
             __d('email_addresses', 'Submit'), 
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
