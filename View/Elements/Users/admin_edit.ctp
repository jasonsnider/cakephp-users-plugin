<ul class="nav nav-sidebar">
    <li><?php echo $this->Html->link('Users', '/admin/users/users'); ?></li>
    <li><?php echo $this->Html->link('Edit', "/admin/users/users/edit/{$id}"); ?></li>
	
	<li class="divider"></li>
	<li><a href="#UserDetailsAnchor">User Details</a></li>
	<li><a href="#UserEmailsAnchor">User Emails</a></li>
	<li><a href="#UserGroupsAnchor">User Groups</a></li>
	<li><a href="#UserPrivilegesAnchor">User Privileges</a>
		<ul>
			<?php foreach ($controllers as $controller=>$actions): ?>
				<li><?php echo $this->Html->link($controller, "#{$controller}Anchor"); ?></li>
			<?php endforeach; ?>
		</ul>
	</li>
	<li class="divider"></li>
	<li><a href="#Top">Top</a></li>
</ul>