<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Extension of grocery_CRUD
 *
 * A proper way of extending Grocery CRUD
 *
 * @package    	Extension of grocery_CRUD
 * @copyright  	-
 * @license    	-
 * @version    	1.0
 * @author     	-
 */
class Extension_grocery_CRUD extends grocery_CRUD{
    protected $_ci = null;
    protected $addClasses = [];

    public function __construct(){
        parent::__construct();
        $this->_ci = &get_instance();
    }

    protected function getClasses($input,$field_info,&$beginning){
        $pattern = '/(class=)(\'|")(.*?)(\'|")/';
        $allClasses = '';
        $classes = (preg_match($pattern, $input, $matches)) ? $matches[3] . ' ' : ' ';
        $required = ($field_info->required) ? ' required ' : ' ';

        if(!empty($matches)){
            $beginning = str_replace ( $matches[0] , ' ', $beginning);
        }
        if(!empty($this->addClasses[$field_info->name])){
            $allClasses = " class='" . $classes . ' ' . $this->addClasses[$field_info->name] . $required . "'";
        } else {
            $allClasses = " class='" . $classes . $required . "'";
        }

        return $allClasses;
    }

    protected function getRequired($input,$field_info){
        $required = ' ';
        if($field_info->required){
            $required = ' required ';
        }
        return $required;
    }


    protected function getBeginning($input,$field_info){
        $beginning = null;
        switch($field_info->crud_type){
            case false:
            case 'password':
            case 'integer':
            case 'string':
                $beginning = substr($input, 0, -2);
                break;
            case 'text':
                $pattern = '/(<textarea.*?)(>)/';
                $beginning = (preg_match($pattern, $input, $matches)) ? $matches[1] . ' ' : ' ';
                break;
            case 'datetime':
                $pattern = '/(<input.*?)(\/>)/';
                $beginning = (preg_match($pattern, $input, $matches)) ? $matches[1] . ' ' : ' ';
                break;
            case 'date':
                $pattern = '/(<input.*?)(\/>)/';
                $beginning = (preg_match($pattern, $input, $matches)) ? $matches[1] . ' ' : ' ';
                break;
            case 'dropdown':
            case 'enum':
            case 'set':
            case 'multiselect':
            case 'relation':
            case 'relation_n_n':
                $pattern = '/(<select.*?)(>)/';
                $beginning = (preg_match($pattern, $input, $matches)) ? $matches[1] . ' ' : ' ';
                break;
            case 'true_false':
                $pattern = '/(<label><input.*?)(\/>)/';
                $beginning = (preg_match($pattern, $input, $matches)) ? $matches[1] . ' ' : ' ';

            //<label><input id='field-soliciting_donations-true' class='radio-uniform'  type='radio' name='soliciting_donations' value='1'  /> Yes</label> <label><input id='field-soliciting_donations-false' class='radio-uniform' type='radio' name='soliciting_donations' value='0' checked = 'checked' /> No</label>

        }
        return $beginning;
    }

    protected function getEnd($input,$field_info){
        $end = null;
        switch($field_info->crud_type){
            case false:
            case 'password':
            case 'integer':
            case 'string':
                $end = substr($input, -2);
                break;
            case 'text':
                $end = '></textarea>';
                break;
            case 'datetime':
                $end = "/><a class='datetime-input-clear' tabindex='-1'>Clear</a>
		(dd/mm/yyyy) hh:mm:ss";
                break;
            case 'date':
                $end = "/><a class='datepicker-input-clear' tabindex='-1'>Clear</a>
		(dd/mm/yyyy) hh:mm:ss";
                break;
            case 'dropdown':
            case 'enum':
            case 'set':
            case 'multiselect':
            case 'relation':
            case 'relation_n_n':
                $pattern = '/>{1}.*<\/select>/';
                $end = (preg_match($pattern, $input, $matches)) ? $matches[0] . ' ' : ' ';
                break;
            case 'true_false':
                $pattern = '/\/>{1}.*<\/label>/';
                $end = (preg_match($pattern, $input, $matches)) ? $matches[0] . ' ' : ' ';
        }
        return $end;
    }

    protected function addNewExtras($input,$field_info){
        $beginning = $this->getBeginning($input,$field_info);
        $end = $this->getEnd($input,$field_info);
        $allClasses = $this->getClasses($input,$field_info,$beginning);
        $required = $this->getRequired($input,$field_info);

        return preg_replace('/\s+/', ' ',$beginning . $required . $allClasses . $end);
    }

    protected function get_string_input($field_info,$value)
    {
        $input = parent::get_string_input($field_info,$value);
        $input = $this->addNewExtras($input,$field_info);
        return $input;
    }

    protected function get_integer_input($field_info,$value)
    {
        $input = parent::get_integer_input($field_info,$value);
        $input = $this->addNewExtras($input,$field_info);
        return $input;
    }

    protected function get_true_false_input($field_info,$value)
    {
        $input = parent::get_true_false_input($field_info,$value);
        $input = $this->addNewExtras($input,$field_info);
        return $input;
    }

    protected function get_text_input($field_info,$value){
        $input = parent::get_text_input($field_info,$value);
        $input = $this->addNewExtras($input,$field_info);
        return $input;
    }

    protected function get_datetime_input($field_info,$value){
        $input = parent::get_datetime_input($field_info,$value);
        $input = $this->addNewExtras($input,$field_info);
        return $input;
    }

    protected function get_password_input($field_info,$value)
    {
        $input = parent::get_password_input($field_info,$value);
        $input = $this->addNewExtras($input,$field_info);
        return $input;
    }

    protected function get_date_input($field_info,$value){
        $input = parent::get_date_input($field_info,$value);
        $input = $this->addNewExtras($input,$field_info);
        return $input;
    }

    protected function get_dropdown_input($field_info,$value){
        $input = parent::get_dropdown_input($field_info,$value);
        $input = $this->addNewExtras($input,$field_info);
        return $input;
    }

    protected function get_enum_input($field_info,$value){
        $input = parent::get_enum_input($field_info,$value);
        $input = $this->addNewExtras($input,$field_info);
        return $input;
    }

    protected function get_set_input($field_info,$value)
    {
        $input = parent::get_set_input($field_info,$value);
        $input = $this->addNewExtras($input,$field_info);
        return $input;
    }

    protected function get_multiselect_input($field_info,$value)
    {
        $input = parent::get_multiselect_input($field_info,$value);
        $input = $this->addNewExtras($input,$field_info);
        return $input;
    }

    protected function get_relation_input($field_info,$value){
        $input = parent::get_relation_input($field_info,$value);
        $input = $this->addNewExtras($input,$field_info);
        return $input;
    }

    protected function get_relation_n_n_input($field_info_type, $selected_values){
        $input = parent::get_relation_n_n_input($field_info,$value);
        $input = $this->addNewExtras($input,$field_info);
        return $input;
    }

    /**
     *
     * Adds a customized class
     * @param string $field
     * @param string $classes
     *
     */
    public function classes($field,$classes)
    {
        $this->addClasses[$field] = $classes;

        return $this;
    }


}
