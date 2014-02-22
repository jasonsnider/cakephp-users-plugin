<?php
/**
 * All models in the Users plugin SHOULD inheirit from this model
 */
App::uses('AppModel', 'Model');

/**
 * All models in the Users plugin SHOULD inheirit from this model
 * @package Users
 */
class UsersAppModel extends AppModel {

    /**
     * Specifies the behaviors invoked by all models
     * @var array 
     */
    public $actsAs = array(
        'Containable'
    );

    /**
     * Checks precondtions and applies pre save logic
     * 
     * - When a password is passed, create a new salt value for that user and hash it with the password to create a hash
     * passwords will never be saved as either plain text or in a password column.
     * 
     * @param array $options
     * @return boolean
     */
    public function beforeSave($options = array()) {

        //Force all model names to tbe classsy all model names
        if (isset($this->data[$this->alias]['model'])) {
            $this->data[$this->alias]['model'] = Inflector::classify($this->data[$this->alias]['model']);
        }

        return true;
    }

    /**
     * Visibility
     * @var array
     */
    public $visibilities = array(
        'public' => array(
            'label' => 'Public',
            '_ref' => 'public',
            '_inactive' => false,
            'category' => '',
            'tags' => array()
        ),
        'protected' => array(
            'label' => 'Protected',
            '_ref' => 'protected',
            '_inactive' => false,
            'category' => '',
            'tags' => array()
        ),
        'private' => array(
            'label' => 'Private',
            '_ref' => 'private',
            '_inactive' => false,
            'category' => '',
            'tags' => array()
        )
    );

    /**
     * Returns a picklist ready array. This list can be flat, categorized or a partial list based on tags.
     * @param array $list
     * @param array $tags
     * @param string $category
     * @param boolean $user_groupedList
     * @return array
     */
    public function getList($list, $tags = null, $category = null, $user_groupedList = false) {
        $options = array();

        //Return a flat list of elements matching specific tags
        if (is_array($tags)) {
            foreach ($tags as $tag) {
                foreach ($list as $option) {
                    if (in_array($tag, $option['tags'])) {
                        if (empty($option['_inactive'])) {
                            $options[$option['_ref']] = $option['label'];
                        }
                    }
                }
            }
            goto end;
        }

        //Return a flat list based on a specific category
        if (!empty($category)) {
            foreach ($list as $key => $values) {
                if ($values['category'] == $category) {
                    $options[$values['_ref']] = $values['label'];
                }
            }
            goto end;
        }

        //Returns a list that is user_grouped by category
        if (!empty($user_groupedList)) {
            foreach ($list as $option) {
                if (empty($option['_inactive'])) {
                    $options[$option['category']][$option['_ref']] = $option['label'];
                }
            }
            goto end;
        }

        //Returns a flat list of all options
        if (!empty($list)) {
            foreach ($list as $key => $values) {
                if (empty($values['_inactive'])) {
                    $options[$key] = $values['label'];
                }
            }
        }
        end:

        return $options;
    }

}
