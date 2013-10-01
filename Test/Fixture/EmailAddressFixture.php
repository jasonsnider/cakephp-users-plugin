<?php

/**
 * EmailAddressFixture
 *
 */
class EmailAddressFixture extends CakeTestFixture {

    /**
     * Fields
     *
     * @var array
     */
    public $fields = array(
        'id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'primary', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
        'email' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 256, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
        'model' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
        'model_id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'collate' => 'latin1_swedish_ci', 'comment' => 'Set to 1 if the person is an employee, privileged user', 'charset' => 'latin1'),
        'verified' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
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
            'id' => '50a53634-d5c0-454e-872e-24037f000009',
            'email' => 'jason@example.com',
            'model' => 'User',
            'model_id' => '50a0edcf-d144-4470-ba4e-05437f000007',
            'verified' => 0,
            'created_user_id' => '50a0edcf-d144-4470-ba4e-05437f000007',
            'modified' => '2012-11-15 12:36:36',
            'modified_user_id' => '50a0edcf-d144-4470-ba4e-05437f000007'
        ),
        array(
            'id' => '50a53643-8754-4a0c-8021-058e7f000009',
            'email' => 'bob@example.com',
            'model' => 'User',
            'model_id' => '50a0ee00-4c1c-4f1c-b352-0f237f000007',
            'verified' => 0,
            'created_user_id' => '50a0edcf-d144-4470-ba4e-05437f000007',
            'modified' => '2012-11-15 12:36:51',
            'modified_user_id' => '50a0edcf-d144-4470-ba4e-05437f000007'
        ),
        array(
            'id' => '50a53651-4908-42a6-b3b6-13d97f000009',
            'email' => 'sally@example.com',
            'model' => 'User',
            'model_id' => '50a0ee0c-1e44-4869-b1e9-0f247f000007',
            'verified' => 0,
            'created_user_id' => '50a0edcf-d144-4470-ba4e-05437f000007',
            'modified' => '2012-11-15 12:37:05',
            'modified_user_id' => '50a0edcf-d144-4470-ba4e-05437f000007'
        ),
    );

}
