<?php
/**
 * Created by PhpStorm.
 * User: nettrac
 * Date: 5/6/19
 * Time: 11:54 AM
 */

namespace App\Lib;


class Form
{
    private $form_id = '';
    private $obj =  [];

    public function __construct($obj = '', $form_id = ''){
        if(is_string($obj)){
            $obj = json_decode($obj);
        }

        //p(json_decode($obj->tabs[0]),1);

        $this->form_id = $form_id;
        $this->obj = (is_array($obj))?(object)$obj:$obj;
    }

    public function generate(){

        if(!isset($this->obj->tabs)){
            return '';
        }

        $div = '<div class="container form-wizard-holder" style="display: none">
        <form method="'.$this->obj->method.'" action="/'.$this->obj->action.'" class="form-horizontal" id="form-wizard" enctype="multipart/form-data">
            <input type="hidden" name="formName" value="'.$this->obj->name.'">
            <input type="hidden" name="tab-count" id="tab-count" value="'.count($this->obj->tabs).'" />
        ';

        if($this->form_id){
            $div .= '<input type="hidden" name="form_id" value="' . $this->form_id . '">';
        }

        $labels = [];

        foreach ($this->obj->tabs as $i => $tab){

            if(isJson($tab)){
                $tab = json_decode($tab);
            }

            //p($tab->fields,1);

            foreach ($tab->fields as $index  => $input){

                $div_class = '<div class="form-group  tab-'.$i.'" >';

                $div .= $div_class;

                $numCol = 10;

                if($input->field_type == 'date'){
                    $numCol = 4;
                }

                $help_block = '';
                $help_block_text = '';
                $header_input = '';
                $append_state = '';
                $put_default_help = true;

                if(isset($input->field_options->description) && $input->field_options->description){
                    $help_block_text = $input->field_options->description;

                    if(isJson($input->field_options->description)){
                        $input->field_options->description = json_decode($input->field_options->description);

                        if(isset($input->field_options->description->footer)){
                            $help_block_text = $input->field_options->description->footer;
                        }

                        if(isset($input->field_options->description->header)){
                            $header_input = $input->field_options->description->header;

                            $header_input = '<h3 style="margin-left: 1%">'.$header_input.'</h3>'.'<input type="hidden" name="Header_h3_'.$index.'" value="'.$header_input.'">';
                        }

                        if(isset($input->field_options->description->append) && $input->field_options->description->append == 'state'){
                            $append_state = ' append-state';
                            $put_default_help = false;
                        }

                        if(isset($input->field_options->description->transform) && $input->field_options->description->transform == 'file'){
                            $input->field_type = 'file';
                            $put_default_help = false;
                        }
                    }

                    if($put_default_help){
                        $help_block = '<span id="" class="help-block"><small>'.$help_block_text.'</small></span>';
                    }
                }

                //die;

                $div .= $header_input;

                $label = $input->label;

                if(!isset($$label)){
                    $$label = 0;
                }else{
                    $$label++;
                }

                $label = $label."|{$$label}";

                if(in_array($label,$labels)){
                    $label = $label.'[]';
                }else{
                    $labels[] = $label;
                }

                $required_field = (($input->required)?"required":"");
                $small_star = (($input->required)?' <span style="color: red">*</span>':"");

                switch ($input->field_type){
                    case 'checkboxes':
                    case 'radio':
                        //$div .= '<label class="col-sm-10">'.$input->label.$small_star.'</label>';
                        $div .= '<label for="staticEmail" class="col-sm-2 col-form-label">'.$input->label.'</label>';
                        $thisType = (($input->field_type == 'checkboxes')?'checkbox':$input->field_type);
                        $div .= '<div class="col-sm-'.$numCol.'">';
                        foreach ($input->field_options->options as $iii => $val){

                            $input_name = $input->label;

                            if($input->field_type == 'checkboxes'){
                                $input_name = $input->label.'['.$iii.']';
                            }

                            $div .= '
                                    <div>      
                                        <input type="'.$thisType.'" name="'.$input_name.'" value="'.$val->label.'" > '.$val->label.'
                                    </div>
                                
                                
                            ';
                        }

                        $input_name = $input->label;

                        if($input->field_type == 'checkboxes'){
                            $input_name = $input->label.'['.$iii.']';
                        }

                        if(isset($input->field_options->include_other_option) && $input->field_options->include_other_option){
                            $div .= '<div>
                                        <input type="'.$thisType.'" name="'.$input_name.'" value="Other"/> Other <input type="text" name="Other '.$input->label.'" />
                                    </div>';
                        }

                        $div .= '</div>';



                        if($help_block){
                            $help_block = '<label class="col-sm-10"><span id="" class="help-block"><small>'.$input->field_options->description->footer.'</small></span></label>';
                        }

                        $div .= $help_block;

                        break;
                    case 'section_break':
                        break;
                    case 'dropdown':

                        $options = "";

                        foreach ($input->field_options->options as $val){
                            $options .= '<option value="'.$val->label.'">'.$val->label.'</option>';
                        }

                        //<script src="https://gist.github.com/mshafrir/2646763.js"></script>

                        $div .= '
                            <label for="staticEmail" class="col-sm-2 col-form-label">'.$input->label.$small_star.'</label>
                            <div class="col-sm-'.$numCol.'">
                                <select rows="8" class="form-control'.$append_state.'" id="'.$input->label.'" name="'.$label.'" '.$required_field.'>'.$options.'</select>
                                '.$help_block.'
                            </div>
                        ';
                        break;
                    case 'paragraph':
                        $div .= '
                            <label for="staticEmail" class="col-sm-2 col-form-label">'.$input->label.$small_star.'</label>
                            <div class="col-sm-'.$numCol.'">
                                <textarea rows="8" class="form-control" id="'.$input->label.'" name="'.$label.'" '.$required_field.'></textarea>
                                '.$help_block.'
                            </div>
                        ';
                        break;
                    default:
                        $div .= '
                            <label for="staticEmail" class="col-sm-2 col-form-label">'.$input->label.$small_star.'</label>
                            <div class="col-sm-'.$numCol.'">
                                <input type="'.$input->field_type.'" style="" class="form-control" id="'.$input->label.'" name="'.$label.'" value="" '.$required_field.'>
                                '.$help_block.'
                                
                            </div>
                        ';
                        break;
                }

                $div .= '</div>';
            }
        }


        $div .= '
                <div class="form-group">
                    <label class="col col-sm-4">
                        <input type="button" value="Back" class="btn btn-primary" id="prev-form-tab" />
                        <input type="button" value="Next" class="btn btn-primary" id="next-form-tab" /> 
                        <input type="button" value="Submit" class="btn btn-primary" style="display: none" id="submit-form" />    
                        <input type="submit" value="Submit" class="btn btn-primary" style="display: none" id="submit-form-real" />    
                    </label>
                </div>
                 
            </form></div>
        ';

        return $div;
    }

    public function input($piece){

    }



}