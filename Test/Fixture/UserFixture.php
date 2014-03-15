<?php
/**
 * UserFixture
 *
 */
class UserFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
    public $fields = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'primary', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'username' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'hash' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 128, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'salt' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 128, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'root' => array('type' => 'boolean', 'null' => true, 'default' => '0'),
		'employee' => array('type' => 'boolean', 'null' => true, 'default' => '0', 'comment' => 'Set to 1 if the person is an employee, privileged user'),
		'protected' => array('type' => 'boolean', 'null' => true, 'default' => '0', 'comment' => 'If set to 1 the user cannot be deleted'),
		'password_confirmation' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 36, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'password_confirmation_expiry' => array('type' => 'datetime', 'null' => true, 'default' => null),
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
            'id' => '50a0edcf-d144-4470-ba4e-05437f000007',
            'username' => 'jason',
            'hash' => '80aee85e71523fecdcfd50e2a9439643f8f482c9dd3348fcb19aaec96f587a9642e586fe249fc15b9f579685b9765e3217b60e3a252b90d7ea96c2407ab36f17',
            'salt' => 'd2a934a176873d8d826743efd6906c2a948ea2e03c9652d4fc5a4a0f153e56518b81c3d06b5b6b44e3965c82495870538e5b3485ffca42181b21a74ed6c7b385',
			'root' => 1,
			'employee' => 1,
			'protected' => 1,
			'password_confirmation' => null,
			'password_confirmation_expiry' => null,
            'created' => '2012-11-12 06:38:39',
            'created_user_id' => '00000000-0000-0000-0000-000000000000',
            'modified' => '2012-11-12 06:38:39',
            'modified_user_id' => '00000000-0000-0000-0000-000000000000'
        ),
        array(
            'id' => '50a0ee00-4c1c-4f1c-b352-0f237f000007',
            'username' => 'bob',
            'hash' => '6bd948b2d09ee16187dd4cc47aedfde4f320d03d8519f424fd5d6eeb2772a9a0f6458475c1865e4d1b40c0bb581ff6191f8e417d7b1f10ad9aab7428daebf095',
            'salt' => '33f170e40f727b9aba88e6293a02b79a78659e8a3168f526d923a407e88bf52ff94a6c111551b1ca9873bc0aeb0feabd0b3aa62b8131e23d142c4350baf26f43',
			'root' => 0,
			'employee' => 0,
			'protected' => 0,
			'password_confirmation' => null,
			'password_confirmation_expiry' => null,
            'created' => '2012-11-12 06:39:28',
            'created_user_id' => '00000000-0000-0000-0000-000000000000',
            'modified' => '2012-11-12 06:39:28',
            'modified_user_id' => '00000000-0000-0000-0000-000000000000'
        ),
        array(
            'id' => '50a0ee0c-1e44-4869-b1e9-0f247f000007',
            'username' => 'sally',
            'hash' => '7367b93a89c617656a0cbe2b33fe4279d815da018fa986cd34d773ec66ab1bb67c1c0fb551908e64aeefb0f360ce1927ac9056e341c61df2868331b373c13abc',
            'salt' => '64ffa655c6205a93c81707ec5dedabf60011e222653c2bf2a803dd15d99a4cbcc58dc4b1eea5e5492eb4c7ca9147f98283b9c56d92df127d2193b53b460def75',
			'root' => 0,
			'employee' => 0,
			'protected' => 0,
			'password_confirmation' => null,
			'password_confirmation_expiry' => null,
            'created' => '2012-11-12 06:39:40',
            'created_user_id' => '00000000-0000-0000-0000-000000000000',
            'modified' => '2012-11-12 06:39:40',
            'modified_user_id' => '00000000-0000-0000-0000-000000000000'
        ),
        //A user with a bad salt value
        array(
            'id' => '50a0ee0c-1e44-4869-b1e9-0f247f000000',
            'username' => 'bad-salt',
            'hash' => '1367b93a89c617656a0cbe2b33fe4279d815da018fa986cd34d773ec66ab1bb67c1c0fb551908e64aeefb0f360ce1927ac9056e341c61df2868331b373c13abc',
            'salt' => '64ffa655c6205a93c81707ec5dedabf60011e222653c2bf2a803dd15d99a4cbcc58dc4b1eea5e5492eb4c7ca9147f98283b9c56d92df127d2193b53b460def75',
			'root' => 0,
			'employee' => 0,
			'protected' => 0,
			'password_confirmation' => null,
			'password_confirmation_expiry' => null,
            'created' => '2012-11-12 06:39:40',
            'created_user_id' => '00000000-0000-0000-0000-000000000000',
            'modified' => '2012-11-12 06:39:40',
            'modified_user_id' => '00000000-0000-0000-0000-000000000000'
        ),
    );
}
