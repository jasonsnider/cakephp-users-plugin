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
?>
<fieldset>
	<legend><?php echo __d('user_groups', 'UserGroup Details'); ?></legend>
	<?php
	echo $this->Form->input('id');
	echo $this->Form->input('alias');
	echo $this->Form->input('name');
	?>
</fieldset>

<fieldset>
	<legend><?php echo __d('user_groups', 'UserGroup Privileges'); ?></legend>
	<?php
	foreach ($controllers as $controller => $methods) {

		echo $this->Html->tag('h2', Inflector::humanize(Inflector::underscore($controller)));

		foreach ($methods as $key => $values) {

			$formKey = Inflector::camelize($key);

			if (!empty($values)) {
				//If the user_group has either had this privilege alled of denied, set user_group_privileges.id.
				echo $this->Form->input(
						"UserGroupPrivilege.{$controller}{$formKey}.id", array('value' => $values['id'], 'type' => 'hidden'));
			}

			echo $this->Form->input(
					"UserGroupPrivilege.{$controller}{$formKey}.user_group_id", array('value' => $this->data['UserGroup']['id'], 'type' => 'hidden'));

			echo $this->Form->input(
					"UserGroupPrivilege.{$controller}{$formKey}.controller", array('value' => $controller, 'type' => 'hidden'));

			echo $this->Form->input(
					"UserGroupPrivilege.{$controller}{$formKey}.action", array('value' => $key, 'type' => 'hidden'));

			if (isset($values['allowed'])) {
				$allowed = $values['allowed'];
			} else {
				$allowed = 2;
			}

			echo $this->Form->input(
					"UserGroupPrivilege.{$controller}{$formKey}.allowed", array(
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

<?php
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