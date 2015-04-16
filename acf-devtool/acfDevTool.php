<?php
/*
Plugin Name: ACF Dev tool
Description: Плагин програмного апи для ACF
Version: 0.1
Author: DragorWW
*/


class ACFGroup {
    private $acfKey = '';
    private $data = array(
        'id'         => '',
        'title'      => '',
        'fields'     => array(),
        'location'   => array(),
        'menu_order' => 0,
        'options'    => array(
            'position'       => 'normal',
            'layout'         => 'default',
            'hide_on_screen' => array (), // 'the_content', 'discussion', 'custom_fields', 'comments', 'slug', 'author'
        ),
    );
    function __construct($acfKey,$title) {
        $this->data['title'] = $title;
        $this->acfKey = 'acf_'.$acfKey;
    }

    function forPostType($postType = 'post') {
        $this->data['location'][] = array(array (
            'param'    => 'post_type',
            'operator' => '==',
            'value'    => $postType,
            'order_no' => 0,
            'group_no' => 0,
        ));
        return $this;
    }

    function addRawField($name,$label,$required = false, $fieldData) {
        $field = array(
            'key' => $this->acfKey . '_' . $name,
            'label' => $label,
            'name' => $name,
            'required' => $required,
        );
        $field = array_merge($fieldData, $field);

        $this->data['fields'][] = $field;

        return $this;
    }
    function addTextField($name,$label,$required = false) {
        $fieldData = array(
            'type'          => 'text',
            'instructions'  => '',
            'default_value' => '',
            'placeholder'   => '',
            'prepend'       => '',
            'append'        => '',
            'formatting'    => 'none',
            'maxlength'     => '',
        );

        $this->addRawField($name,$label,$required, $fieldData);
        return $this;
    }
    function addImgField($name,$label,$required = false) {
        $fieldData = array(
            'type' => 'image',
            'save_format' => 'object',
            'preview_size' => 'thumbnail',
            'library' => 'all',
        );
        $this->addRawField($name,$label,$required, $fieldData);
        return $this;
    }

    function register() {
        register_field_group($this->data);
    }
}

?>