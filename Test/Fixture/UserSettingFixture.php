<?php

/**
 * UserSettingFixture
 *
 */
class UserSettingFixture extends CakeTestFixture {

    /**
     * Fields
     *
     * @var array
     */
    public $fields = array(
        'id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'primary', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
        'user_id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
        'visibility' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'comment' => 'Lets the user define who can view their profile/data', 'charset' => 'latin1'),
        'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
        'created_user_id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
        'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
        'modified_user_id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
        'indexes' => array(
            'PRIMARY' => array('column' => 'id', 'unique' => 1)
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
            'id' => '50a0edd0-b8e4-4f0d-9fa3-05437f000007',
            'user_id' => '50a0edcf-d144-4470-ba4e-05437f000007',
            'visibility' => 'public',
            'created' => '2012-11-12 06:38:40',
            'created_user_id' => '00000000-0000-0000-0000-000000000000',
            'modified' => '2012-11-12 06:38:40',
            'modified_user_id' => '00000000-0000-0000-0000-000000000000'
        ),
        array(
            'id' => '50a0ee00-2d38-4e87-823c-0f237f000007',
            'user_id' => '50a0ee00-4c1c-4f1c-b352-0f237f000007',
            'visibility' => 'public',
            'created' => '2012-11-12 06:39:28',
            'created_user_id' => '00000000-0000-0000-0000-000000000000',
            'modified' => '2012-11-12 06:39:28',
            'modified_user_id' => '00000000-0000-0000-0000-000000000000'
        ),
        array(
            'id' => '50a0ee0c-03ac-4b4b-b85b-0f247f000007',
            'user_id' => '50a0ee0c-1e44-4869-b1e9-0f247f000007',
            'visibility' => 'public',
            'created' => '2012-11-12 06:39:40',
            'created_user_id' => '00000000-0000-0000-0000-000000000000',
            'modified' => '2012-11-12 06:39:40',
            'modified_user_id' => '00000000-0000-0000-0000-000000000000'
        ),
    );

}
