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
            
        <?php
        echo $this->Html->tag('h3', 'Plugins');
        $li = null;
        $plugins = scandir(APP . 'Plugin');
        foreach($plugins as $plugin):

            $loc = Inflector::underscore($plugin); 

            $pluginMain = 
                ROOT . DS . 
                APP_DIR . DS . 
                'Plugin' .  DS . 
                $plugin . DS . 
                'Controller' . DS . 
                "{$plugin}Controller.php";

            if(is_file($pluginMain)):
                if(!in_array($plugin, array('.', '..'))):
                    $li .= $this->Html->tag(
                        'li', 
                        $this->Html->link($plugin, "/{$loc}")
                    );
                endif;
            endif;
        endforeach;

        echo $this->Html->tag('ul', $li);
        ?>
    
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