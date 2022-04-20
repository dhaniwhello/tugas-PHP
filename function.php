<?php

    class FormField {

        function _construct(){

        }

        

        function form_field( $key, $args, $value = null ) {
            $defaults = array(
                'type'              => 'text',
                'label'             => '',
                'description'       => '',
                'placeholder'       => '',
                'maxlength'         => false,
                'required'          => false,
                'autocomplete'      => false,
                'id'                => $key,
                'class'             => array(),
                'label_class'       => array(),
                'input_class'       => array(),
                'return'            => false,
                'options'           => array(),
                'custom_attributes' => array(),
                'validate'          => array(),
                'default'           => '',
                'autofocus'         => '',
                'priority'          => '',
            );
            
            $args = array_merge( $defaults, $args );
            if ( $args['required'] ) {;
                $args['class'][] = 'validate-required';
                $required        = '&nbsp;<abbr class="required" title="' . 'required' . '">*</abbr>';
                $require        = "required";
            } else {
                $required = '&nbsp;<span class="optional">(' .  'optional' . ')</span>';
                $require        = "";
            }

    
            if ( is_string( $args['label_class'] ) ) {
                $args['label_class'] = array( $args['label_class'] );
            }
    
            if ( is_null( $value ) ) {
                $value = $args['default'];
            }
    
            // Custom attribute handling.
            $custom_attributes         = array();
            $args['custom_attributes'] = array_filter( (array) $args['custom_attributes'], 'strlen' );
    
            if ( $args['maxlength'] ) {
                $args['custom_attributes']['maxlength'] = absint( $args['maxlength'] );
            }
    
            if ( ! empty( $args['autocomplete'] ) ) {
                $args['custom_attributes']['autocomplete'] = $args['autocomplete'];
            }
    
            if ( true === $args['autofocus'] ) {
                $args['custom_attributes']['autofocus'] = 'autofocus';
            }
    
            if ( $args['description'] ) {
                $args['custom_attributes']['aria-describedby'] = $args['id'] . '-description';
            }
    
            if ( ! empty( $args['custom_attributes'] ) && is_array( $args['custom_attributes'] ) ) {
                foreach ( $args['custom_attributes'] as $attribute => $attribute_value ) {
                    $custom_attributes[] =  $attribute  . '="' .  $attribute_value  . '"';
                }
            }
    
            if ( ! empty( $args['validate'] ) ) {
                foreach ( $args['validate'] as $validate ) {
                    $args['class'][] = 'validate-' . $validate;
                }
            }
    
            $field           = '';
            $label_id        = $args['id'];
            $sort            = $args['priority'] ? $args['priority'] : '';
            $field_container = '<p class="form-row %1$s" id="%2$s" data-priority="' .  $sort  . '">%3$s</p>';
    
            switch ( $args['type'] ) {
                
                case 'textarea':
                    $field .= '<textarea name="' .  $key  . '" class="input-text ' .  implode( ' ', $args['input_class'] )  . '" id="' .  $args['id']  . '" placeholder="' .  $args['placeholder']  . '" ' . ( empty( $args['custom_attributes']['rows'] ) ? ' rows="2"' : '' ) . ( empty( $args['custom_attributes']['cols'] ) ? ' cols="5"' : '' ) . implode( ' ', $custom_attributes ) . ' '.$require.'>' .  $value  . '</textarea>';
                    
                    break;
                case 'checkbox':
                    $field = '<label class="checkbox ' . implode( ' ', $args['label_class'] ) . '" ' . implode( ' ', $custom_attributes ) . '>
                            <input type="' .  $args['type']  . '" class="input-checkbox ' .  implode( ' ', $args['input_class'] )  . '" name="' .  $key  . '" id="' .  $args['id']  . '" value="1" ' .  $value . 1 . false  . ' /> ' . $args['label'] . $required . ' '.$require.'</label>';
                    echo $field;
                    break;
                case 'text':
                case 'password':
                case 'datetime':
                case 'datetime-local':
                case 'date':
                case 'month':
                case 'time':
                case 'week':
                case 'number':
                case 'email':
                case 'url':
                case 'tel':
                    $field .= '<input type="' .  $args['type']  . '" class="input-text ' .  implode( ' ', $args['input_class'] )  . '" name="' .  $key  . '" id="' .  $args['id']  . '" placeholder="' .  $args['placeholder']  . '"  value="' .  $value  . '" ' . implode( ' ', $custom_attributes ) . ' '.$require.' />';
                    
                    break;
                    case 'hidden':
                        $field .= '<input type="' .  $args['type']  . '" class="input-hidden ' .  implode( ' ', $args['input_class'] )  . '" name="' .  $key  . '" id="' .  $args['id']  . '" value="' .  $value  . '" ' . implode( ' ', $custom_attributes ) . ' />';
    
                    break;
                case 'select':
                    $field   = '';
                    $options = '';
    
                    if ( ! empty( $args['options'] ) ) {
                        foreach ( $args['options'] as $option_key => $option_text ) {
                            if ( '' === $option_key ) {
                                // If we have a blank option, select2 needs a placeholder.
                                if ( empty( $args['placeholder'] ) ) {
                                    $args['placeholder'] = $option_text ? $option_text : 'Choose an option' ;
                                }
                                $custom_attributes[] = 'data-allow_clear="true"';
                            }
                            $options .= '<option value="' .  $option_key  . '" >' .  $option_text  . '</option>';
                        }
    
                        $field .= '<select name="' .  $key  . '" id="' .  $args['id']  . '" class="select ' .  implode( ' ', $args['input_class'] )  . '" ' . implode( ' ', $custom_attributes ) . ' data-placeholder="' .  $args['placeholder']  . '" '.$require.'>
                                ' . $options . '
                            </select>';
                    }
    
                    
                    break;
                case 'radio':
                    $label_id .= '_' . current( array_keys( $args['options'] ) );
    
                    if ( ! empty( $args['options'] ) ) {
                        foreach ( $args['options'] as $option_key => $option_text ) {
                            $field .= '<input type="radio" class="input-radio ' .  implode( ' ', $args['input_class'] )  . '" value="' .  $option_key  . '" name="' .  $key  . '" ' . implode( ' ', $custom_attributes ) . ' id="' .  $args['id']  . '_' .  $option_key  . '"' .  $value . $option_key . false  . ' '.$require.' />';
                            $field .= '<label for="' .  $args['id']  . '_' .  $option_key  . '" class="radio ' . implode( ' ', $args['label_class'] ) . '">' .  $option_text  . '</label>';
                        }
                    }
                    break;
            }
    
            if ( ! empty( $field ) ) {
                $field_html = '';
    
                if ( $args['label'] && 'checkbox' !== $args['type'] ) {
                    $field_html .= '<label for="' .  $label_id  . '" class="' .  implode( ' ', $args['label_class'] )  . '">' .  $args['label']  . $required . '</label>';
                }
    
                $field_html .= '<span class="woocommerce-input-wrapper">' . $field;
    
                if ( $args['description'] ) {
                    $field_html .= '<span class="description" id="' .  $args['id']  . '-description" aria-hidden="true">' .  $args['description']  . '</span>';
                }
    
                $field_html .= '</span>';
    
                $container_class =  implode( ' ', $args['class'] ) ;
                $container_id    =  $args['id']  . '_field';
                $field           = sprintf( $field_container, $container_class, $container_id, $field_html );
            }
            return $field;
           
        }
        /* function generate args array */
        function generateFrom($args){
            for ($i=0; $i < count($args) ; $i++) { 
                    echo $this->form_field($args[$i]["key"], $args[$i][0], $args[$i]["value"] );
            }
        }


   
    }


    $args = array(
                'type'              => 'select',
                'label'             => 'test form',
                'description'       => '',
                'placeholder'       => 'test form',
                'maxlength'         => false,
                'required'          => true,
                'autocomplete'      => false,
                'class'             => array(),
                'label_class'       => array(),
                'input_class'       => array('ini class'),
                'return'            => false,
                'options'           => array(
                    "cowok" => "cowok",
                    "cewek" => "cewek"
                ),
                'custom_attributes' => array(),
                'validate'          => array(),
                'default'           => '',
                'autofocus'         => '',
                'priority'          => '',
    );
    $args2 = array(
                'type'              => 'text',
                'label'             => 'test form',
                'description'       => '',
                'placeholder'       => 'test form',
                'maxlength'         => false,
                'required'          => false,
                'autocomplete'      => false,
                'class'             => array(),
                'label_class'       => array(),
                'input_class'       => array('ini class'),
                'return'            => false,
                'options'           => array(
                    "cowok" => "cowok",
                    "cewek" => "cewek"
                ),
                'custom_attributes' => array(),
                'validate'          => array(),
                'default'           => '',
                'autofocus'         => '',
                'priority'          => '',
    );
    $args3 = array(
                'type'              => 'month',
                'label'             => 'test form',
                'description'       => '',
                'placeholder'       => 'test form',
                'maxlength'         => false,
                'required'          => false,
                'autocomplete'      => false,
                'class'             => array(),
                'label_class'       => array(),
                'input_class'       => array('ini class'),
                'return'            => false,
                'options'           => array(
                    "cowok" => "cowok",
                    "cewek" => "cewek"
                ),
                'custom_attributes' => array(),
                'validate'          => array(),
                'default'           => '',
                'autofocus'         => '',
                'priority'          => '',
    );
    $args4 = array(
                'type'              => 'password',
                'label'             => 'Password',
                'description'       => '',
                'placeholder'       => 'Password',
                'maxlength'         => false,
                'required'          => true,
                'autocomplete'      => false,
                'class'             => array(),
                'label_class'       => array(),
                'input_class'       => array('ini class'),
                'return'            => false,
                'custom_attributes' => array(),
                'validate'          => array(),
                'default'           => '',
                'autofocus'         => '',
                'priority'          => '',
    );
    /* 
        key = "name", and "id" form input;
    */
    $arg = array(
        array($args, "key"  => "test", "value"  => ""),     
        array($args, "key"  => "test", "value"  => ""),
         array($args2,"key"  => "ya", "value"   => ""), 
         array($args2,"key"  => "ya", "value"   => ""), 
         array($args3,"key"  => "test lagi", "value"  => ""), 
         array($args4,"key"  => "lagi lagi", "value"  => ""),
         array($args4,"key"  => "lagi lagi dan lagi", "value"  => "")
        );
    ?>

    <form action="">
        <?php 
         $test = new FormField();
        $test->generateFrom($arg);
        ?>
        <button type="submit">submit</button>
    </form>
    <?php
    
   
    