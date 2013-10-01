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
    '/admin/groups', 
    array(
        'prefix' => 'admin',
        'plugin' => 'Users',
        'controller' => 'Groups',
        'action' => 'index'
    )
);

Router::connect(
    '/admin/groups/:action', 
    array(
        'prefix' => 'admin',
        'plugin' => 'Users',
        'controller' => 'Groups'
    )
);

Router::connect(
    '/admin/groups/:action/*',
    array(
        'prefix' => 'admin',
        'plugin' => 'Users',
        'controller' => 'Groups'
    )
);