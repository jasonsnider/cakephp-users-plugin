<?php if(!empty($data)): ?>
	<table class="table table-bordered table-condensed table-striped table-hover">
		<tr>
			<th><?php echo $this->Paginator->sort('username', 'Username'); ?></th>
			<th><?php echo $this->Paginator->sort('root', 'Root'); ?></th>
			<th><?php echo $this->Paginator->sort('employee', 'Employee'); ?></th>
			<th><?php echo $this->Paginator->sort('protected', 'Protected'); ?></th>
		</tr>
		<?php foreach ($data as $user): ?>
			<tr>
				<td>
					<?php 
					echo $this->Html->link(
							$user['User']['username'], 
							array(
								'admin'=>true,
								'plugin'=>'users',
								'controller'=>'users',
								'action'=>'admin_view',
								0=>$user['User']['id']

							)
					);
					?>
				</td>
				<td><?php echo $user['User']['root'] ? 'Yes' : 'No'; ?></td>
				<td><?php echo $user['User']['employee'] ? 'Yes' : 'No'; ?></td>
				<td><?php echo $user['User']['protected'] ? 'Yes' : 'No'; ?></td>
			</tr>
		<?php endforeach; ?>
	</table>
	<?php echo $this->element('pager'); ?>
<?php else: ?>
	<div class="well well-sm text-center">
		<?php echo __('No users have been created.'); ?>
	</div>
<?php endif; ?>