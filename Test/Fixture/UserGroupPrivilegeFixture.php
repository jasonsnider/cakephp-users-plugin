<?php

/**
 * UserGroupPrivilegeFixture
 *
 */
class UserGroupPrivilegeFixture extends CakeTestFixture {

    /**
     * Fields
     *
     * @var array
     */
    public $fields = array(
        'id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'primary', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
        'user_group_id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'index', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
        'controller' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
        'action' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
        'allowed' => array('type' => 'boolean', 'null' => false, 'default' => null),
        'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
        'created_user_id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
        'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
        'modified_user_id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
        'indexes' => array(
            'PRIMARY' => array('column' => 'id', 'unique' => 1),
            'model' => array('column' => array('user_group_id', 'controller', 'action'), 'unique' => 0)
        ),
        'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
    );

    /**
     * Records
     *
     * @var array
     */
    public $records = array(
        array(
            'id' => '50a27eaa-0258-4589-8da2-05857f000009',
            'user_group_id' => '50a1c275-8c38-477d-8682-0f247f000007',
            'controller' => 'UserGroupsController',
            'action' => 'admin_delete',
            'allowed' => 1,
            'created' => '2012-11-13 11:08:58',
            'created_user_id' => '50a0edcf-d144-4470-ba4e-05437f000007',
            'modified' => '2012-11-13 11:08:58',
            'modified_user_id' => '50a0edcf-d144-4470-ba4e-05437f000007'
        ),
        array(
            'id' => '50a27eaa-17e8-4052-9844-05857f000009',
            'user_group_id' => '50a1c275-8c38-477d-8682-0f247f000007',
            'controller' => 'UsersController',
            'action' => 'admin_create',
            'allowed' => 1,
            'created' => '2012-11-13 11:08:58',
            'created_user_id' => '50a0edcf-d144-4470-ba4e-05437f000007',
            'modified' => '2012-11-13 11:08:58',
            'modified_user_id' => '50a0edcf-d144-4470-ba4e-05437f000007'
        ),
        array(
            'id' => '50a27eaa-263c-42ef-8cfd-05857f000009',
            'user_group_id' => '50a1c275-8c38-477d-8682-0f247f000007',
            'controller' => 'UserGroupsController',
            'action' => 'admin_create',
            'allowed' => 1,
            'created' => '2012-11-13 11:08:58',
            'created_user_id' => '50a0edcf-d144-4470-ba4e-05437f000007',
            'modified' => '2012-11-13 11:08:58',
            'modified_user_id' => '50a0edcf-d144-4470-ba4e-05437f000007'
        ),
        array(
            'id' => '50a27eaa-5588-4583-bfda-05857f000009',
            'user_group_id' => '50a1c275-8c38-477d-8682-0f247f000007',
            'controller' => 'UserGroupsController',
            'action' => 'admin_index',
            'allowed' => 1,
            'created' => '2012-11-13 11:08:58',
            'created_user_id' => '50a0edcf-d144-4470-ba4e-05437f000007',
            'modified' => '2012-11-13 11:08:58',
            'modified_user_id' => '50a0edcf-d144-4470-ba4e-05437f000007'
        ),
        array(
            'id' => '50a27eaa-66dc-4914-9631-05857f000009',
            'user_group_id' => '50a1c275-8c38-477d-8682-0f247f000007',
            'controller' => 'UsersController',
            'action' => 'admin_delete',
            'allowed' => 1,
            'created' => '2012-11-13 11:08:58',
            'created_user_id' => '50a0edcf-d144-4470-ba4e-05437f000007',
            'modified' => '2012-11-13 11:08:58',
            'modified_user_id' => '50a0edcf-d144-4470-ba4e-05437f000007'
        ),
        array(
            'id' => '50a27eaa-7218-4ccc-84bf-05857f000009',
            'user_group_id' => '50a1c275-8c38-477d-8682-0f247f000007',
            'controller' => 'UserGroupsController',
            'action' => 'admin_edit',
            'allowed' => 1,
            'created' => '2012-11-13 11:08:58',
            'created_user_id' => '50a0edcf-d144-4470-ba4e-05437f000007',
            'modified' => '2012-11-13 11:08:58',
            'modified_user_id' => '50a0edcf-d144-4470-ba4e-05437f000007'
        ),
        array(
            'id' => '50a27eaa-8de8-4579-a96b-05857f000009',
            'user_group_id' => '50a1c275-8c38-477d-8682-0f247f000007',
            'controller' => 'UsersController',
            'action' => 'admin_index',
            'allowed' => 1,
            'created' => '2012-11-13 11:08:58',
            'created_user_id' => '50a0edcf-d144-4470-ba4e-05437f000007',
            'modified' => '2012-11-13 11:08:58',
            'modified_user_id' => '50a0edcf-d144-4470-ba4e-05437f000007'
        ),
        array(
            'id' => '50a27eaa-a5c8-4dc8-a689-05857f000009',
            'user_group_id' => '50a1c275-8c38-477d-8682-0f247f000007',
            'controller' => 'UsersController',
            'action' => 'admin_edit',
            'allowed' => 1,
            'created' => '2012-11-13 11:08:58',
            'created_user_id' => '50a0edcf-d144-4470-ba4e-05437f000007',
            'modified' => '2012-11-13 11:08:58',
            'modified_user_id' => '50a0edcf-d144-4470-ba4e-05437f000007'
        ),
        array(
            'id' => '50a27eaa-df80-405e-b979-05857f000009',
            'user_group_id' => '50a1c275-8c38-477d-8682-0f247f000007',
            'controller' => 'UserGroupsController',
            'action' => 'admin_view',
            'allowed' => 1,
            'created' => '2012-11-13 11:08:58',
            'created_user_id' => '50a0edcf-d144-4470-ba4e-05437f000007',
            'modified' => '2012-11-13 11:08:58',
            'modified_user_id' => '50a0edcf-d144-4470-ba4e-05437f000007'
        ),
        array(
            'id' => '50a27eaa-e7d4-47e2-aaef-05857f000009',
            'user_group_id' => '50a1c275-8c38-477d-8682-0f247f000007',
            'controller' => 'UsersController',
            'action' => 'admin_view',
            'allowed' => 1,
            'created' => '2012-11-13 11:08:58',
            'created_user_id' => '50a0edcf-d144-4470-ba4e-05437f000007',
            'modified' => '2012-11-13 11:08:58',
            'modified_user_id' => '50a0edcf-d144-4470-ba4e-05437f000007'
        ),
    );

}
