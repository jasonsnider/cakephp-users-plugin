<style>
    .menu ul{
        margin:1em 0;
    }
    
    .menu ul li{
        list-style: none;
        display: inline;
    }
</style>
<div class="menu">
    <ul>
        <li><?php echo $this->Html->link('Index', '/admin/users'); ?></li>
        <li><?php echo $this->Html->link('Create', '/admin/users/create'); ?></li>
        <li><?php echo $this->Html->link('Edit', "/admin/users/view/{$id}"); ?></li>
        <li><?php echo $this->Html->link('Delete', "/admin/users/delete/{$id}", null, 'Are you sure?'); ?></li>
        <li><li><?php echo $this->Html->link('Email', "/admin/email_addresses/edit/{$id}"); ?></li></li>
    </ul>
</div>