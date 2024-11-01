<?php

/**
 * Webigraph Button Group for elementor
 */


namespace WebigraphAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Utils;
use Elementor\Control_Media;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Repeater;
use Elementor\Icons_Manager;

class Webigraph_Button_Group extends Widget_Base
{
    public function get_name() {
        return 'webigraph-addons-button-group';
    }

    public function get_title() {
        return __( 'Buttons Group', 'webigraph-addons-button-group' );
    }

    public function get_icon() {
        return 'webi-icon eicon-dual-button';
    }

    public function get_categories() {
        return array('webigraph-addons' );
    }
    
    public static function get_button_group_sizes() {
        return [
            'xs' => __( 'Extra Small', 'webigraph-addons-button-group' ),
            'sm' => __( 'Small', 'webigraph-addons-button-group' ),
            'md' => __( 'Medium', 'webigraph-addons-button-group' ),
            'lg' => __( 'Large', 'webigraph-addons-button-group' ),
            'xl' => __( 'Extra Large', 'webigraph-addons-button-group' ),
        ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_content',
            [
                'label' => __( 'Buttons Group', 'webigraph-addons-button-group' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

         

        $repeater = new Repeater();

        $repeater->add_control(
            'button_name', [
                'label' => __( 'Name', 'webigraph-addons-button-group' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => __( 'Button Name', 'webigraph-addons-button-group' ),
                'default' => __( 'Button Name', 'webigraph-addons-button-group' ),
            ]
        );

        $repeater->add_control(
            'link', [
                'label' => __( 'Link', 'webigraph-addons-button-group' ),
                'type' => Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', 'webigraph-addons-button-group' ),
                'show_external' => true,
                'default' => [
                'url' => '',
                'is_external' => false,
                'nofollow' => false,
            ]
        ]
        );

        

        $repeater->start_controls_tabs(
            'webigraph_button_style_tabs'
        );

        $repeater->start_controls_tab(
            'webigraph_button_style_tab',
            [
                'label' => __( 'Normal', 'webigraph-addons-button-group' ),
            ]
        );

        $repeater->add_control(
            'button_text_color', [
                'label' => __('Text Color', 'webigraph-addons-button-group'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    ' {{WRAPPER}} {{CURRENT_ITEM}}' => 'color: {{VALUE}}',
                ],
                 
            ]
        );

        

        $repeater->add_control(
            'button_color', [
                'label' => __('Background Color', 'webigraph-addons-button-group'),
                'type' => Controls_Manager::COLOR,
                'default' => '#f94213',
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'background-color: {{VALUE}}',
                ],               
            ]
        );

        $repeater->end_controls_tab();

        $repeater->start_controls_tab(
            'webigraph_button_style_hover_tab',
            [
                'label' => __( 'Hover', 'webigraph-addons-button-group' ),
            ]
        );


        $repeater->add_control(
            'button_text_color_hover', [
            'label' => __('Text Color', 'webigraph-addons-button-group'),
            'type' => Controls_Manager::COLOR,
             
            'selectors' => [
                '{{WRAPPER}} {{CURRENT_ITEM}}:hover, {{WRAPPER}} {{CURRENT_ITEM}}:focus' => 'color: {{VALUE}};',
                
                ],
            ]
        );

        $repeater->add_control(
            'button_color_hover', [
                'label' => __('Background Color', 'webigraph-addons-button-group'),
                'type' => Controls_Manager::COLOR,                
                
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}:hover, {{WRAPPER}} {{CURRENT_ITEM}}:focus' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $repeater->end_controls_tab();

        $repeater->end_controls_tabs();

        $repeater->add_control(
            'hr',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );

        $repeater->add_control(
            'webigraph_more_settings_switcher',
            [
                'label'         => __('More Settings', 'webigraph-addons-button-group'),
                'type'          => Controls_Manager::SWITCHER,               
                
            ]
        );

        $repeater->add_responsive_control(
            'webigraph_button_width',
            [
                'label' => __( 'Width', 'webigraph-addons-button-group' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'condition'     => [                                    
                        'webigraph_more_settings_switcher'  => 'yes',                        
                    ],
                'devices' => [ 'desktop', 'tablet', 'mobile' ],         
                
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'width: {{SIZE}}% !important;',
                ],
            ]
        );       

        $repeater->add_responsive_control(
                'webigraph_button_padding',
                [
                    'label' => __( 'Text Padding', 'webigraph-addons-button-group' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', '%' ],
                    'condition'     => [                                    
                        'webigraph_more_settings_switcher'  => 'yes',                        
                    ],
                    'selectors' => [
                        '{{WRAPPER}} {{CURRENT_ITEM}}' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                    ],
                ]
            );
        

        $repeater->add_control(
            'webigraph_button_radius',
            [
                'label' => __( 'Text Radius', 'webigraph-addons-button-group' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'condition'     => [                                    
                        'webigraph_more_settings_switcher'  => 'yes',                        
                 ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );

         

        $repeater->add_control(
            'button_icon_switcher',
            [
                'label'         => __('Icon', 'webigraph-addons-button-group'),
                'type'          => Controls_Manager::SWITCHER,
                'description'   => __('Enable or disable button icon','webigraph-addons-button-group'),
                
            ]
        );

        $repeater->add_control(
            'button_icon_selection',
            [
                'label'             => __('Icon', 'webigraph-addons-button-group'),
                'type'              => Controls_Manager::ICONS,    
                'fa4compatibility'  => 'webigraph_button_icon_selections',            
                'default' => [
                    'value'     => '',
                    'library'   => '',
                ],
                'condition'         => [
                    'button_icon_switcher'  => 'yes',
                ],               
            ]
        );


        $repeater->start_controls_tabs(
            'webigraph_icon_style_tabs',
            [
                'condition' => [                                    
                        'button_icon_switcher'  => 'yes',                        
                 ],
            ]
        );

        $repeater->start_controls_tab(
            'webigraph_icon_style_tab',
            [
                'label' => __( 'Normal', 'webigraph-addons-button-group' ),
            ]
        );


        $repeater->add_control(
            'webigraph_icon_color', [
                'label' => __('Icon Color', 'webigraph-addons-button-group'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    ' {{WRAPPER}} {{CURRENT_ITEM}} i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} {{CURRENT_ITEM}} svg, {{WRAPPER}} {{CURRENT_ITEM}} svg' => 'fill: {{VALUE}};',
                ],
                'condition' => [                                    
                        'button_icon_switcher'  => 'yes',                        
                 ],
            ]
        );

        $repeater->add_control(
            'webigraph_icon_bgcolor', [
                'label' => __('Icon Background Color', 'webigraph-addons-button-group'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    ' {{WRAPPER}} {{CURRENT_ITEM}} i' => 'background-color: {{VALUE}}',
                    
                ],
                'condition' => [                                    
                        'button_icon_switcher'  => 'yes',                        
                 ],
            ]
        );

        $repeater->end_controls_tab();

        $repeater->start_controls_tab(
            'webigraph_icon_style_hover_tab',
            [
                'label' => __( 'Hover', 'webigraph-addons-button-group' ),
            ]
        );

        $repeater->add_control(
            'webigraph_icon_color_hover', [
                'label' => __('Icon Color Hover', 'webigraph-addons-button-group'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    ' {{WRAPPER}} {{CURRENT_ITEM}}:hover i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} {{CURRENT_ITEM}}:hover svg, {{WRAPPER}} {{CURRENT_ITEM}}:focus svg' => 'fill: {{VALUE}};',
                ],
                'condition' => [                                    
                        'button_icon_switcher'  => 'yes',                        
                 ],
            ]
        );

        $repeater->add_control(
            'webigraph_icon_bgcolor_hover', [
                'label' => __('Icon Background Color Hover', 'webigraph-addons-button-group'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    ' {{WRAPPER}} {{CURRENT_ITEM}}:hover i' => 'background-color: {{VALUE}}',
                ],
                'condition' => [                                    
                        'button_icon_switcher'  => 'yes',                        
                 ],
            ]
        );
        $repeater->end_controls_tab();

        $repeater->end_controls_tabs();


         $repeater->add_control(
            'icon_hr',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );


        $repeater->add_control('webigraph_button_icon_position', 
            [
                'label'         => __('Icon Position', 'webigraph-addons-button-group'),
                'type'          => Controls_Manager::SELECT,
                'default'       => 'before',
                'options'       => [
                    'before'        => __('Before', 'webigraph-addons-button-group'),
                    'after'         => __('After', 'webigraph-addons-button-group'),
                ],
                'condition'     => [                                    
                        'button_icon_switcher'  => 'yes',                        
                  ],
                'label_block'   => true,                
            ]
        );

        $repeater->add_responsive_control('webigraph_button_icon_size',
            [
                'label'         => __('Icon Size', 'webigraph-addons-button-group'),
                'type'          => Controls_Manager::SLIDER,
                'condition'     => [                                    
                        'button_icon_switcher'  => 'yes',                        
                    ],
                'selectors'     => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} i' => 'font-size: {{SIZE}}px',
                    '{{WRAPPER}} {{CURRENT_ITEM}} svg' => 'width: {{SIZE}}px; height: {{SIZE}}px'
                ]
            ]
        );


        $repeater->add_responsive_control('webigraph_button_icon_before_spacing',
                [
                    'label'         => __('Icon Spacing', 'webigraph-addons-button-group'),
                    'type'          => Controls_Manager::SLIDER,
                    'condition'     => [                        
                        'webigraph_button_icon_position' => 'before',  
                        'button_icon_switcher'  => 'yes',                      
                    ],
                    'default'       => [
                        'size'  => 15
                    ],
                    'selectors'     => [
                        '{{WRAPPER}} {{CURRENT_ITEM}} i, {{WRAPPER}} {{CURRENT_ITEM}} svg' => 'margin-right: {{SIZE}}px',
                    ],
                    'separator'     => 'after',
                ]
            );
        
        $repeater->add_responsive_control('webigraph_button_icon_after_spacing',
                [
                    'label'         => __('Icon Spacing', 'webigraph-addons-button-group'),
                    'type'          => Controls_Manager::SLIDER,
                    'condition'     => [                       
                        'webigraph_button_icon_position' => 'after', 
                        'button_icon_switcher'  => 'yes',                        
                    ],
                    'default'       => [
                        'size'  => 15
                    ],
                    'selectors'     => [
                        '{{WRAPPER}} {{CURRENT_ITEM}} i, {{WRAPPER}} {{CURRENT_ITEM}} svg' => 'margin-left: {{SIZE}}px',
                    ],
                    'separator'     => 'after',
                ]
            );

        $repeater->add_responsive_control(
                'webigraph_icon_padding',
                [
                    'label' => __( 'Icon Padding', 'webigraph-addons-modal-box' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', '%' ],
                     'condition'     => [                       
                        'button_icon_switcher'  => 'yes',                      
                    ],
                    'selectors' => [
                        '{{WRAPPER}} {{CURRENT_ITEM}} i, {{WRAPPER}} {{CURRENT_ITEM}} svg' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

        

        $repeater->add_control(
            'webigraph_icon_radius',
            [
                'label' => __( 'Icon Radius', 'webigraph-addons-modal-box' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                 'condition'     => [                       
                        'button_icon_switcher'  => 'yes',                      
                  ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} i, {{WRAPPER}} {{CURRENT_ITEM}} svg' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );   

        $this->add_control(
            'buttonlist',
            [
                'label' => __( 'Buttons Groups', 'webigraph-addons-button-group' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),            
                'default' => [
                    [
                        'button_name' => __( 'Button 1', 'webigraph-addons-button-group' ),
                        'link' => 'https://webigraph.com/',
                        'button_text_color' => '#fff',
                        'button_color' => '#f94213',
                         
                    ],
                    [
                        'button_name' => __( 'Button 2', 'webigraph-addons-button-group' ),
                        'link' => 'https://webigraph.com/',
                        'button_text_color' => '#fff',
                        'button_color' => '#f94213',
                         
                    ],
                ],
                'title_field' => '{{{ button_name }}}',
            ]
        );

        $this->end_controls_section();



        $this->start_controls_section(
            'section_style',
            [
                'label' => __( 'Button', 'webigraph-addons-button-group' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'size',
            [
                'label' => __( 'Size', 'webigraph-addons-button-group' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'sm',
                'options' => self::get_button_group_sizes(),
                'style_transfer' => true,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'webigraph_button_text_typography',
                'label' => __( 'Typography', 'webigraph-addons-button-group' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .webigraph-btn-item',
            ]
        );

        $this->add_responsive_control('webigraph_button_align',
            [
                'label'             => __( 'Buttons Alignment', 'webigraph-addons-button-group' ),
                'type'              => Controls_Manager::CHOOSE,
                'options'           => [
                    'flex-start'    => [
                        'title' => __( 'Left', 'webigraph-addons-button-group' ),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'webigraph-addons-button-group' ),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'flex-end' => [
                        'title' => __( 'Right', 'webigraph-addons-button-group' ),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'default' => 'flex-start',
                'selectors'         => [
                    '{{WRAPPER}} .webigraph-btn-group' => 'justify-content: {{VALUE}}','-webkit-justify-content:{{VALUE}}',
                ],
                
            ]
        );

        $this->add_responsive_control('webigraph_button_text_align',
            [
                'label'             => __( 'Text Alignment', 'webigraph-addons-button-group' ),
                'type'              => Controls_Manager::CHOOSE,
                'options'           => [
                    'flex-start'    => [
                        'title' => __( 'Left', 'webigraph-addons-button-group' ),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'webigraph-addons-button-group' ),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'flex-end' => [
                        'title' => __( 'Right', 'webigraph-addons-button-group' ),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'default' => 'center',
                'selectors'         => [
                    '{{WRAPPER}} .webigraph-btn-item' => 'justify-content: {{VALUE}}','-webkit-justify-content:{{VALUE}}',
                ],
                
            ]
        );

        $this->add_responsive_control(
            'webigraph_button_width',
            [
                'label' => __( 'Width', 'webigraph-addons-button-group' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'devices' => [ 'desktop', 'tablet', 'mobile' ],
                'desktop_default' => [
                    'size' => 20,
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'size' => 30,
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'size' => 40,
                    'unit' => '%',
                ],
                'selectors' => [
                    '{{WRAPPER}} .webigraph-btn-item' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );  


         $this->start_controls_tabs(
            'style_tabs'
        );

        $this->start_controls_tab(
            'style_normal_tab',
            [
                'label' => __( 'Normal', 'webigraph-addons-button-group' ),
            ]
        );


        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_box_shadow',
                'label' => __( 'Box Shadow', 'webigraph-addons-button-group' ),
                'selector' => '{{WRAPPER}} .webigraph-btn-item',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
                'selector' => '{{WRAPPER}} .webigraph-btn-item',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'border_radius',
            [
                'label' => __( 'Border Radius', 'webigraph-addons-button-group' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .webigraph-btn-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        

        
        $this->end_controls_tab();

        $this->start_controls_tab(
            'style_hover_tab',
            [
                'label' => __( 'Hover', 'webigraph-addons-button-group' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_shadow_hover',
                'label' => __( 'Box Shadow', 'webigraph-addons-button-group' ),
                'selector' => '{{WRAPPER}} .webigraph-btn-item:hover',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'button_button_border_hover',
                'selector' => '{{WRAPPER}} .webigraph-btn-item:hover',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'button_border_radius_hover',
            [
                'label' => __( 'Border Radius h', 'webigraph-addons-button-group' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .webigraph-btn-item:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->end_controls_tab();

        $this->end_controls_tabs();

    $this->end_controls_section();

    $this->start_controls_section(
        'icon_style_content',
        [
            'label' => __( 'Icon', 'webigraph-addons-button-group' ),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]
    );
    $this->add_responsive_control('webigraph_button_icon_size',
            [
                'label'         => __('Icon Size', 'webigraph-addons-button-group'),
                'type'          => Controls_Manager::SLIDER,
                'selectors'     => [
                    '{{WRAPPER}} .webigraph-btn-item i' => 'font-size: {{SIZE}}px',
                    '{{WRAPPER}} .webigraph-btn-item svg' => 'width: {{SIZE}}px; height: {{SIZE}}px'
                ]
            ]
        );

    $this->end_controls_section();

    $this->start_controls_section(
            'section_style_content',
            [
                'label' => __( 'More Options', 'webigraph-addons-button-group' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_responsive_control(
            'space_between',
            [
                'label' => __( 'Spacing', 'webigraph-addons-button-group' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'devices' => [ 'desktop', 'tablet', 'mobile' ],
                'desktop_default' => [
                    'size' => 15,
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'size' => 10,
                    'unit' => 'px',
                ],
                'mobile_default' => [
                    'size' => 5,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .webigraph-btn-item' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );



        $this->add_responsive_control(
                'button_padding',
                [
                    'label' => __( 'Padding', 'webigraph-addons-button-group' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .webigraph-btn-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

        $this->add_responsive_control(
                'button_margin',
                [
                    'label' => __( 'Margin', 'webigraph-addons-button-group' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .webigraph-btn-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );



    $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();  
        
        ?> 
        <div class="webigraph-btn-group">
            <?php  foreach ( $settings['buttonlist'] as $index => $item ) : ?>
            
                <?php
                $migrated = isset( $item['__fa4_migrated']['button_icon_selection'] );
                $is_new = empty( $item['webigraph_button_icon_selections'] ) && Icons_Manager::is_migration_allowed();

                 
                if ( ! empty ( $item['button_icon_selection'] ) ) {
                    $this->add_render_attribute( 'icon', 'class', $item['button_icon_selection'] );
                    $this->add_render_attribute( 'icon', 'aria-hidden', 'true' );
                }

                 
            
                    if ( ! $item['link']['url'] ) {                  
                        echo '<a class="webigraph-btn-item elementor-repeater-item-' . $item['_id'] . ' webigraph-btn-'.$settings['size'].' "   href="#" ' . $target . $nofollow . ' >';
                            if ( $item['webigraph_button_icon_position'] === 'before' ) {
                            if ( $item['button_icon_switcher'] === 'yes' ) { ?>
                                <?php if ( $is_new || $migrated ) :
                                    Icons_Manager::render_icon( $item['button_icon_selection'], [ 'aria-hidden' => 'true' ] );
                                else : ?>
                                    <i <?php echo $this->get_render_attribute_string( 'icon' ); ?>></i>
                                <?php endif; ?>                            
                            <?php }  echo ' '.$item['button_name'].'</a>';  
                            }else{
                            echo ' '.$item['button_name'].' ';
                            if ( $item['button_icon_switcher'] === 'yes' ) { ?>
                             <?php if ( $is_new || $migrated ) :
                                    Icons_Manager::render_icon( $item['button_icon_selection'], [ 'aria-hidden' => 'true' ] );
                                else : ?>
                                    <i <?php echo $this->get_render_attribute_string( 'icon' ); ?>></i>
                                <?php endif; ?>   
                            <?php  }
                             echo ' </a>';
                            }
                         
                    } else {        
                        $target = $item['link']['is_external'] ? ' target="_blank"' : '';
                        $nofollow = $item['link']['nofollow'] ? ' rel="nofollow"' : '';     
                        echo '<a class="webigraph-btn-item  elementor-repeater-item-' . $item['_id'] . '  webigraph-btn-'.$settings['size'].'"   href="'.$item['link']['url'].'"  ' . $target . $nofollow . '>'; 
                            if ( $item['webigraph_button_icon_position'] === 'before' ) {
                            if ( $item['button_icon_switcher'] === 'yes' ) { ?>
                                <?php if ( $is_new || $migrated ) :
                                    Icons_Manager::render_icon( $item['button_icon_selection'], [ 'aria-hidden' => 'true' ] );
                                else : ?>
                                    <i <?php echo $this->get_render_attribute_string( 'icon' ); ?>></i>
                                <?php endif; ?>   
                            <?php } echo ' '.$item['button_name'].'</a>';                            
                            }else{
                            echo ' '.$item['button_name'].'';
                            if ( $item['button_icon_switcher'] === 'yes' ) { ?>
                             <?php if ( $is_new || $migrated ) :
                                    Icons_Manager::render_icon( $item['button_icon_selection'], [ 'aria-hidden' => 'true' ] );
                                else : ?>
                                    <i <?php echo $this->get_render_attribute_string( 'icon' ); ?>></i>
                                <?php endif; ?>   
                            <?php  }
                             echo ' </a>';
                            }   
                }
                ?>
            
            <?php endforeach;  ?>
         </div>
        <?php    
        
    }

    protected function _content_template() {
        ?>      

        <div class="webigraph-btn-group"> 

        <#     
        
        if ( settings.buttonlist ) {
            _.each( settings.buttonlist, function( item, index ) {             

            var iconHTML = elementor.helpers.renderIcon( view, item.button_icon_selection, { 'aria-hidden': true }, 'i' , 'object' ),
            migrated = elementor.helpers.isIconMigrated( item, 'button_icon_selection' );     
            
            #>
                <# if(item.webigraph_button_icon_position === 'before'){ #>             
                <# if ( item.link && item.link.url ) { 
                    var target = item.link.is_external ? ' target="_blank"' : '';
                    var nofollow = item.link.nofollow ? ' rel="nofollow"' : '';
                #>
                <a class="webigraph-btn-item elementor-repeater-item-{{ item._id }} webigraph-btn-{{settings.size}}" href="{{item.link.url}}" {{ target }} {{ nofollow }}>
                    <# if(item.button_icon_switcher === 'yes'){ #>
                    <# if ( ( migrated || ! settings.icon ) && iconHTML.rendered ) { #>
                            {{{ iconHTML.value }}}
                        <# } else { #>
                            <i class="{{ settings.icon }}" aria-hidden="true"></i>
                        <# } #>
                        <# } #>
                 {{item.button_name}}</a>
                <# }else{ #>
                    <a class="webigraph-btn-item elementor-repeater-item-{{ item._id }} webigraph-btn-{{settings.size}}"   href="#"  > 
                        <# if(item.button_icon_switcher === 'yes'){ #>
                        <# if ( ( migrated || ! settings.icon ) && iconHTML.rendered ) { #>
                            {{{ iconHTML.value }}}
                        <# } else { #>
                            <i class="{{ item.button_icon_selection }}" aria-hidden="true"></i>
                        <# } #>
                         <# } #>
                     {{item.button_name}}</a>
                <# } #>
                <# }else{ #>
                <# if ( item.link && item.link.url ) { 
                    var target = item.link.is_external ? ' target="_blank"' : '';
                    var nofollow = item.link.nofollow ? ' rel="nofollow"' : '';
                #>
                <a class="webigraph-btn-item elementor-repeater-item-{{ item._id }} webigraph-btn-{{settings.size}}" href="{{item.link.url}}" {{ target }} {{ nofollow }}>
                 {{item.button_name}}
                 <# if(item.button_icon_switcher === 'yes'){ #>
                    <# if ( ( migrated || ! settings.icon ) && iconHTML.rendered ) { #>
                            {{{ iconHTML.value }}}
                        <# } else { #>
                            <i class="{{ settings.icon }}" aria-hidden="true"></i>
                        <# } #>
                    <# } #>
                </a>
                <# }else{ #>
                    <a class="webigraph-btn-item elementor-repeater-item-{{ item._id }} webigraph-btn-{{settings.size}}"   href="#"  >                    
                     {{item.button_name}}
                        <# if(item.button_icon_switcher === 'yes'){ #>
                            <# if ( ( migrated || ! settings.icon ) && iconHTML.rendered ) { #>
                                {{{ iconHTML.value }}}
                            <# } else { #>
                                <i class="{{ item.button_icon_selection }}" aria-hidden="true"></i>
                            <# } #>
                        <# } #>
                    </a>
                <# } #>
              <# } #>                
             
            <#
            });
        }
        #>
                 
            </div>
        <?php
    }
    
}




?>