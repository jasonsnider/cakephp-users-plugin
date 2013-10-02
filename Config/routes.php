<?php

Router::connect(
    '/', 
    array(
        'plugin' => 'Users',
        'controller' => 'Users'
    )
);

Router::connect(
    '/admin/users', 
    array(
        'prefix' => 'admin',
        'plugin' => 'Users',
        'controller' => 'Users',
        'action' => 'index'
    )
);

Router::connect(
    '/users/:action', 
    array(
        'plugin' => 'Users',
        'controller' => 'Users'
    )
);

Router::connect(
    '/users/:action/*', 
    array(
        'plugin' => 'Users',
        'controller' => 'Users'
    )
);

Router::connect(
    '/admin/users/:action', 
    array(
        'prefix' => 'admin',
        'plugin' => 'Users',
        'controller' => 'Users'
    )
);

Router::connect(
    '/admin/users/:action/*', 
    array(
        'prefix' => 'admin',
        'plugin' => 'Users',
        'controller' => 'Users'
    )
);

Router::connect(
    '/admin/user_groups', 
    array(
        'prefix' => 'admin',
        'plugin' => 'Users',
        'controller' => 'UserGroups',
        'action' => 'index'
    )
);

Router::connect(
    '/admin/user_groups/:action', 
    array(
        'prefix' => 'admin',
        'plugin' => 'Users',
        'controller' => 'UserGroups'
    )
);

Router::connect(
    '/admin/user_groups/:action/*',
    array(
        'prefix' => 'admin',
        'plugin' => 'Users',
        'controller' => 'UserGroups'
    )
);