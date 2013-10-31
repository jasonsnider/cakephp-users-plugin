<div class="menu">
    <ul>
        <li><?php echo $this->Html->link('Index', '/admin/users'); ?></li>
        <li><?php echo $this->Html->link('Create', '/admin/users/users/create'); ?></li>
        <li><?php echo $this->Html->link('Edit', "/admin/users/users/edit/{$id}"); ?></li>
        <li><?php echo $this->Html->link('Delete', "/admin/users/users/delete/{$id}", null, 'Are you sure?'); ?></li>
    </ul>
</div>