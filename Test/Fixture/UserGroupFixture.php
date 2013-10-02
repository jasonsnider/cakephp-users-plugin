<?php

/**
 * UserGroupFixture
 *
 */
class UserGroupFixture extends CakeTestFixture {

    /**
     * Fields
     *
     * @var array
     */
    public $fields = array(
        'id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'primary', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
        'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100, 'key' => 'index', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
        'alias' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
        'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
        'created_user_id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
        'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
        'modified_user_id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
        'indexes' => array(
            'PRIMARY' => array('column' => 'id', 'unique' => 1),
            'model' => array('column' => array('name', 'alias'), 'unique' => 0)
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
            'id' => '50a1c275-8c38-477d-8682-0f247f000007',
            'name' => 'Admin',
            'alias' => 'alias',
            'created' => '2012-11-12 21:45:57',
            'created_user_id' => '50a0edcf-d144-4470-ba4e-05437f000007',
            'modified' => '2012-11-13 11:08:58',
            'modified_user_id' => '50a0edcf-d144-4470-ba4e-05437f000007'
        ),
        array(
            'id' => '50a697f7-6840-41eb-9cf6-46977f000009',
            'name' => 'Sales',
            'alias' => 'sales',
            'created' => '2012-11-16 13:45:59',
            'created_user_id' => '50a0edcf-d144-4470-ba4e-05437f000007',
            'modified' => '2012-11-16 13:45:59',
            'modified_user_id' => '50a0edcf-d144-4470-ba4e-05437f000007'
        ),
        array(
            'id' => '50a69854-6eec-43ef-b9c3-2ea37f000009',
            'name' => 'Operations',
            'alias' => 'operations',
            'created' => '2012-11-16 13:47:32',
            'created_user_id' => '50a0edcf-d144-4470-ba4e-05437f000007',
            'modified' => '2012-11-16 13:47:32',
            'modified_user_id' => '50a0edcf-d144-4470-ba4e-05437f000007'
        ),
    );

}
