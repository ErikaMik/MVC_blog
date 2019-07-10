<?php

namespace App\Helper;

class FormHelper
{

    public function __construct($action, $method, $class)
    {
        $this->html = '<form class="'.$class.'" action="'.$action.'" method="'.$method.'">';
    }
    
    public function addInput($attributes, $label='', $wrapper='', $formtitle='')
    {
        //implementuoti Label
        $html = '';
        $html.= '<h2>'.$formtitle.'</h2><input ';
        foreach ($attributes as $key => $element){
            $html .= ' '.$key.'="'.$element.'"';
        }
        $html .= ' >';
        if($wrapper != ''){
            $html = '<div class="'.$wrapper.'">'.$html.'</div>';
        }
        $this->html .= $html;
        return $this;
    }

    //selectas
    public function addSelect($options, $name, $wrapper='', $label='')
    {
        //implementuoti Label
        $html = '';
        $html.= '<select name="'.$name.'">';
        foreach ($options as $value => $option){
            $html .= '<option value="'.$value.'"';
            $html .= ' >';
            $html .= ucfirst($option);
            $html .= '</options>';
        }
        $html .= '</select>';
        if($wrapper != ''){
            $html = '<div class="'.$wrapper.'">'.$html.'</div>';
        }
        $this->html .= $html;
        return $this;
    }

    //textarea
    public function addTextarea($attributes, $name, $value, $wrapper='', $label='')
    {
        //implementuoti Label
        $html = '';
        $html.= '<textarea name="'.$name.'"';
        foreach ($attributes as $key => $element){
            $html .= ' '.$key.'="'.$element.'"';

        }
        $html .= ' >';
        $html .= $value;
        $html .= '</textarea>';
        if($wrapper != ''){
            $html = '<div class="'.$wrapper.'">'.$html.'</div>';
        }
        $this->html .= $html;
        return $this;
    }


    public function get()
    {
        $this->html .= '</form>';
        return $this->html;
    }

//    public function inputName($name)
//    {
//        $html ='';
//        $this->html .= "<input name='$name'";
//        $this->html .= $html;
//        return $this;
//    }
//
//    public function inputType($type)
//    {
//        $html ='';
//        $html .= " type='$type'";
//        $this->html .= $html;
//        return $this;
//    }
//
//    public function inputPlaceholder($placeholder)
//    {
//        $html ='';
//        $html .= " placeholder='$placeholder'>";
//        $this->html .= $html;
//        return $this;
//    }
//
//    public function inputValue($value)
//    {
//        $html ='';
//        $html .= " value='$value'";
//        $this->html .= $html;
//        return $this;
//    }
//
//    public function formEnd()
//    {
//        $html ='';
//        $html .= "></form>";
//        $this->html .= $html;
//        return $this;
//    }
//
//    public function login()
//    {
//        $this->inputName('email')->inputType('email')->inputPlaceholder('erika@erika.lt');
//        $this->inputName('password')->inputType('password')->inputPlaceholder('Type in password');
//        $this->inputName('registrate')->inputType('submit')->inputValue('submit')->formEnd();
//        return $this->html;
//    }
//
//    public function input()
//    {
//        $array = ['name'=>'email', 'type'=>'email', 'placeholder'=>'email@email'];
//        $html = '';
//        $this->html .= "<input ";
//        $this->html .= $html;
//        foreach ($array as $key => $value){
//            $this->html .= $html;
//        }
//
//    }
}