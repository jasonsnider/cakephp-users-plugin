<?php

/**
 * PrivilegeFixture
 *
 */
class UserPrivilegeFixture extends CakeTestFixture {

    /**
     * Fields
     *
     * @var array
     */
    public $fields = array(
        'id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'primary', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
        'user_id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
        'controller' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
        'action' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
        'allowed' => array('type' => 'boolean', 'null' => false, 'default' => null),
        'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
        'created_user_id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
        'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
        'modified_user_id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
        'indexes' => array(
            'PRIMARY' => array('column' => 'id', 'unique' => 1),
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
            'id' => '50a0edcf-124c-4285-8aff-05437f000007',
            'user_id' => '50a0edcf-d144-4470-ba4e-05437f000007',
            'controller' => 'users_controller',
            'action' => 'admin_edit',
            'allowed' => 1,
            'created' => '2012-11-12 06:38:39',
            'created_user_id' => '00000000-0000-0000-0000-000000000000',
            'modified' => '2012-11-12 06:38:39',
            'modified_user_id' => '00000000-0000-0000-0000-000000000000'
        ),
        array(
            'id' => '50a0edcf-2888-4cde-b160-05437f000007',
            'user_id' => '50a0edcf-d144-4470-ba4e-05437f000007',
            'controller' => 'users_controller',
            'action' => 'admin_view',
            'allowed' => 1,
            'created' => '2012-11-12 06:38:39',
            'created_user_id' => '00000000-0000-0000-0000-000000000000',
            'modified' => '2012-11-12 06:38:39',
            'modified_user_id' => '00000000-0000-0000-0000-000000000000'
        ),
        array(
            'id' => '50a0edcf-30d4-479c-bdf2-05437f000007',
            'user_id' => '50a0edcf-d144-4470-ba4e-05437f000007',
            'controller' => 'user_groups_controller',
            'action' => 'admin_index',
            'allowed' => 1,
            'created' => '2012-11-12 06:38:39',
            'created_user_id' => '00000000-0000-0000-0000-000000000000',
            'modified' => '2012-11-12 06:38:39',
            'modified_user_id' => '00000000-0000-0000-0000-000000000000'
        ),
        array(
            'id' => '50a0edcf-76dc-4b9f-acbe-05437f000007',
            'user_id' => '50a0edcf-d144-4470-ba4e-05437f000007',
            'controller' => 'users_controller',
            'action' => 'admin_index',
            'allowed' => 1,
            'created' => '2012-11-12 06:38:39',
            'created_user_id' => '00000000-0000-0000-0000-000000000000',
            'modified' => '2012-11-12 06:38:39',
            'modified_user_id' => '00000000-0000-0000-0000-000000000000'
        ),
        array(
            'id' => '50a0edcf-ad08-4eeb-9520-05437f000007',
            'user_id' => '50a0edcf-d144-4470-ba4e-05437f000007',
            'controller' => 'users_controller',
            'action' => 'admin_delete',
            'allowed' => 1,
            'created' => '2012-11-12 06:38:39',
            'created_user_id' => '00000000-0000-0000-0000-000000000000',
            'modified' => '2012-11-12 06:38:39',
            'modified_user_id' => '00000000-0000-0000-0000-000000000000'
        ),
        array(
            'id' => '50a0edcf-e5b4-4696-a025-05437f000007',
            'user_id' => '50a0edcf-d144-4470-ba4e-05437f000007',
            'controller' => 'users_controller',
            'action' => 'admin_create',
            'allowed' => 1,
            'created' => '2012-11-12 06:38:39',
            'created_user_id' => '00000000-0000-0000-0000-000000000000',
            'modified' => '2012-11-12 06:38:39',
            'modified_user_id' => '00000000-0000-0000-0000-000000000000'
        ),
        array(
            'id' => '50a0edd0-0644-4e3f-b236-05437f000007',
            'user_id' => '50a0edcf-d144-4470-ba4e-05437f000007',
            'controller' => 'user_groups_controller',
            'action' => 'admin_delete',
            'allowed' => 1,
            'created' => '2012-11-12 06:38:40',
            'created_user_id' => '00000000-0000-0000-0000-000000000000',
            'modified' => '2012-11-12 06:38:40',
            'modified_user_id' => '00000000-0000-0000-0000-000000000000'
        ),
        array(
            'id' => '50a0edd0-178c-40c9-9aba-05437f000007',
            'user_id' => '50a0edcf-d144-4470-ba4e-05437f000007',
            'controller' => 'user_groups_controller',
            'action' => 'admin_edit',
            'allowed' => 1,
            'created' => '2012-11-12 06:38:39',
            'created_user_id' => '00000000-0000-0000-0000-000000000000',
            'modified' => '2012-11-12 06:38:39',
            'modified_user_id' => '00000000-0000-0000-0000-000000000000'
        ),
        array(
            'id' => '50a0edd0-22d8-446b-be12-05437f000007',
            'user_id' => '50a0edcf-d144-4470-ba4e-05437f000007',
            'controller' => 'user_groups_controller',
            'action' => 'admin_view',
            'allowed' => 1,
            'created' => '2012-11-12 06:38:39',
            'created_user_id' => '00000000-0000-0000-0000-000000000000',
            'modified' => '2012-11-12 06:38:39',
            'modified_user_id' => '00000000-0000-0000-0000-000000000000'
        ),
        array(
            'id' => '50a0edd0-2848-47c4-bf28-05437f000007',
            'user_id' => '50a0edcf-d144-4470-ba4e-05437f000007',
            'controller' => 'user_groups_controller',
            'action' => 'admin_create',
            'allowed' => 1,
            'created' => '2012-11-12 06:38:40',
            'created_user_id' => '00000000-0000-0000-0000-000000000000',
            'modified' => '2012-11-12 06:38:40',
            'modified_user_id' => '00000000-0000-0000-0000-000000000000'
        ),
    );

}
