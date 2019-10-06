<?php

/**
 * Form validation:
 *
 * @category Form Validation
 * @author   Mubashir
 */
class Formvalidation
{

    /**
     * CodeIgniter instance
     *
     * @var object
     */
    private $_CI;

    /**
     * DO NOT CALL THIS DIRECTLY
     */

    public function __construct()
    {

        // Get the CodeIgniter reference

        $this->_CI = &get_instance();

    }

    /**
     * Check Data is  exists
     *
     * @param: $value is which want to check value
     * @var String
     *
     * @param: $field_name is define table name and table column name then join using for . operator between table name and column name
     * @var String
     */

    public function exists($value = null, $field_name = null)
    {

        if (!empty($value) && !empty($field_name)) {

            $explodedata = explode('.', $field_name);

            if ($this->_CI->Base_Model->query("SELECT * FROM $explodedata[0] WHERE $explodedata[1]='" . $value . "'")) {

                return true;

            } else {
                $this->_CI->form_validation->set_message('data_checking', $value . ' Not exists');
                return false;
            }
        } else {
            $this->_CI->form_validation->set_message('Program Error : Please Check Your param ');
            return false;
        }

    }

}
