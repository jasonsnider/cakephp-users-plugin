<?php $controller = $this->request->params['controller']; ?>
<?php $action = $this->request->params['action']; ?>
<div class="actions">
    <?php if ($this->Session->check('Auth.User')): ?>
        <h3>Sections</h3>
        <ul>
            <li><?php echo $this->Html->link('Users', '/users'); ?></li>
        </ul>

        <?php if ($this->Session->check('Auth.User.employee')): ?>
            <h3>Admin Sections</h3>
            <ul>
                <li><?php echo $this->Html->link('Users', '/admin/users'); ?></li>
                <li><?php echo $this->Html->link('Groups', '/admin/groups'); ?></li>
            </ul>
        <?php endif; ?>

        <h3>Actions</h3>
        <ul>
            <li><?php echo $this->Html->link('Log Out', '/users/logout'); ?></li>
        </ul>
        
    <?php else: ?>
        <ul>
            <li><?php echo $this->Html->link('Login', '/users/login'); ?></li>
            <li><?php echo $this->Html->link('New Account', '/users/create'); ?></li>
        </ul>
    <?php endif; ?>
</div>