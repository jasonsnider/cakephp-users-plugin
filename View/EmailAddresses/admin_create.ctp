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
echo $this->Form->input('referer', array('type' => 'hidden'));
echo $this->Form->input('email');
echo $this->Form->submit(
	 __d('email_addresses', 'Submit'), 
	 array(
		 'div'=>array(
			 'class'=>'form-group'
		 ),
		 'class'=>'btn btn-default'
	 )
 ); 
echo $this->Form->end();
