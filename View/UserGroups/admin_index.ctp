<?php if(!empty($user_groups)): ?>
	<table class="table table-bordered table-condensed table-striped table-hover">
		<tr>
			<th><?php echo $this->Paginator->sort('alias', 'Alias'); ?></th>
			<th><?php echo $this->Paginator->sort('name', 'Name'); ?></th>
		</tr>
		<?php foreach ($user_groups as $user_group): ?>
			<tr>
				<td>
					<?php 
					echo $this->Html->link(
						$user_group['UserGroup']['alias'],
						array(
							'admin'=>true,
							'plugin'=>'users',
							'controller'=>'user_groups',
							'action'=>'view',
							0=>$user_group['UserGroup']['id']
						)
					);
					?>
				</td>
				<td><?php echo $user_group['UserGroup']['name']; ?></td>
			</tr>
		<?php endforeach; ?>
	</table>
	<?php echo $this->element('pager'); ?>
<?php else: ?>
	<div class="well well-sm text-center">
		<?php echo __('No groups have been created.'); ?>
	</div>
<?php endif; ?>