<h1><?php echo __d('user_groups', 'Admin :: Create'); ?></h1>
<ul class="nav nav-pills">
    <li><?php echo $this->Html->link('Index', '/admin/users/user_groups'); ?></li>
</ul>
<div class="row">
    <div class="col-md-4">
        <?php
        echo $this->Form->create(
            'UserGroup', 
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
        echo $this->Form->input('name');
        echo $this->Form->submit(
             __d('user_groups', 'Submit'), 
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

