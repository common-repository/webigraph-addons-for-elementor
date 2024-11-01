<?php

/**
 * Webigraph multi inline heading for elementor
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
use Elementor\Core\Schemes;


class Webigraph_Multi_Heading extends Widget_Base
{
	public function get_name() {
		return 'webigraph-addons-multi-heading';
	}

	public function get_title() {
		return __( 'Multi Heading', 'webigraph-addons-multi-heading' );
	}

	public function get_icon() {
		return 'webigraph-multi-heading';
	}

	public function get_categories() {
		return array('webigraph-addons' );
	}

	 

	protected function _register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Content', 'webigraph-addons-multi-heading' ),
				'tab'	=> Controls_Manager::TAB_CONTENT,
			]
		);

				$this->add_responsive_control('webigraph_multi_heading_align',
			[
				'label'             => __( 'Multi Heading Alignment', 'webigraph-addons-multi-heading' ),
				'type'              => Controls_Manager::CHOOSE,
				'options'           => [
					'flex-start'    => [
						'title' => __( 'Left', 'webigraph-addons-multi-heading' ),
						'icon'  => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'webigraph-addons-multi-heading' ),
						'icon'  => 'fa fa-align-center',
					],
					'flex-end' => [
						'title' => __( 'Right', 'webigraph-addons-multi-heading' ),
						'icon'  => 'fa fa-align-right',
					],
				],
				'default' => 'flex-start',
                'selectors'         => [
                    '{{WRAPPER}} .webigraph-multi-heading' => 'justify-content: {{VALUE}}','-webkit-justify-content:{{VALUE}}',
                ],
				
			]
		);

		$this->add_responsive_control(
			'space_left',
			[
				'label' => __( 'Spacing', 'webigraph-addons-multi-heading' ),
				'type' => Controls_Manager::SLIDER,
				'condition'     => [                       
                        'webigraph_multi_heading_align' => 'flex-start',
                                          
                    ],
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
					'{{WRAPPER}} .webigraph-multi-heading-item' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);



		$this->add_responsive_control(
			'space_center',
			[
				'label' => __( 'Spacing', 'webigraph-addons-multi-heading' ),
				'type' => Controls_Manager::SLIDER,
				'condition'     => [                       
                        'webigraph_multi_heading_align' => 'center', 
                                          
                    ],
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
					'{{WRAPPER}} .webigraph-multi-heading-item' => 'margin-right: {{SIZE}}{{UNIT}}; margin-left: {{SIZE}}{{UNIT}};', 
				],
			]
		);

		$this->add_responsive_control(
			'space_right',
			[
				'label' => __( 'Spacing', 'webigraph-addons-multi-heading' ),
				'type' => Controls_Manager::SLIDER,
				'condition'     => [                       
                        'webigraph_multi_heading_align' => 'flex-end', 
                                          
                    ],
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
					'{{WRAPPER}} .webigraph-multi-heading-item' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'webigraph_text', [
				'label' => __( 'Title', 'webigraph-addons-multi-heading' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Heading', 'webigraph-addons-multi-heading' ),
				'default' => __( 'Heading', 'webigraph-addons-multi-heading' ),
			]
		);	

		$repeater->add_control(
            'webigraph_typograph_switcher',
            [
                'label'         => __('Typograph', 'webigraph-addons-multi-heading'),
                'type'          => Controls_Manager::SWITCHER,               
                
            ]
        );


		$repeater->add_control(
			'webigraph_text_fontfamily', [
				'label' => __('Font', 'webigraph-addons-multi-heading'),                 
				'type' => Controls_Manager::SELECT,	 			 
				'options'       => [
					'"Arial", Sans-serif'  => __('Arial', 'webigraph-addons-multi-heading'),
					'"Tahoma", Sans-serif'  => __('Tahoma', 'webigraph-addons-multi-heading'),
					'"Verdana", Sans-serif'  => __('Verdana', 'webigraph-addons-multi-heading'),
					'"Times New Roman", Sans-serif'  => __('Times New Roman', 'webigraph-addons-multi-heading'),
					'"Trebuchet MS", Sans-serif'  => __('Trebuchet MS', 'webigraph-addons-multi-heading'),
                    '"Georgia", Sans-serif'  => __('Georgia', 'webigraph-addons-multi-heading'),
                ],
                'condition'     => [                                    
                        'webigraph_typograph_switcher'  => 'yes',                        
                    ],
                'selectors' => [
					' {{WRAPPER}} {{CURRENT_ITEM}}' => 'font-family: {{VALUE}}',					 
				],				
			]
		);		

		

		 $repeater->add_control(
			'webigraph_text_size', [
				'label' => __('Title size', 'webigraph-addons-multi-heading'),
                'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem', 'vw' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 200,
					],
					'vw' => [
						'min' => 0.1,
						'max' => 10,
						'step' => 0.1,
					],
				],
				'condition'     => [                                    
                        'webigraph_typograph_switcher'  => 'yes',                        
                    ],
                'selectors' => [
					' {{WRAPPER}} {{CURRENT_ITEM}}' => 'font-size: {{SIZE}}{{UNIT}}',
					 
				],				
			]
		);

		foreach ( array_merge( [ 'normal', 'bold' ], range( 100, 900, 100 ) ) as $weight ) {
			$typo_weight_options[ $weight ] = ucfirst( $weight );
		}

		$repeater->add_control(
			'webigraph_text_weight', [
				'label' => __('Weight', 'webigraph-addons-multi-heading'),                 
				'type' => Controls_Manager::SELECT,			 
				'options' => $typo_weight_options,
				'condition'     => [                                    
                        'webigraph_typograph_switcher'  => 'yes',                        
                    ],
                'selectors' => [
					' {{WRAPPER}} {{CURRENT_ITEM}}' => 'font-weight: {{VALUE}}',					 
				],				
			]
		);

		$repeater->add_control(
			'webigraph_text_transform', [
				'label' => __('Transform', 'webigraph-addons-multi-heading'),                 
				'type' => Controls_Manager::SELECT,			 
				'default' => 'none',				 
				'options'       => [
                    'uppercase'  => __('Uppercase', 'webigraph-addons-multi-heading'),
                    'lowercase'  => __('Lowercase', 'webigraph-addons-multi-heading'),
                 	'capitalize' => __('Capitalize', 'webigraph-addons-multi-heading'),
                  	'none'       => __('Normal', 'webigraph-addons-multi-heading'),
                ],
                'condition'     => [                                    
                        'webigraph_typograph_switcher'  => 'yes',                        
                    ],
                'selectors' => [
					' {{WRAPPER}} {{CURRENT_ITEM}}' => 'text-transform: {{VALUE}}',					 
				],				
			]
		);

		$repeater->add_control(
			'webigraph_text_Style', [
				'label' => __('Style', 'webigraph-addons-multi-heading'),                 
				'type' => Controls_Manager::SELECT,			 
				'default' => 'none',				 
				'options'       => [
                    'normal'  => __('Normal', 'webigraph-addons-multi-heading'),
                    'italic'  => __('Italic', 'webigraph-addons-multi-heading'),                 	 
                  	'none'    => __('None', 'webigraph-addons-multi-heading'),
                ],
                'condition'     => [                                    
                        'webigraph_typograph_switcher'  => 'yes',                        
                    ],
                'selectors' => [
					' {{WRAPPER}} {{CURRENT_ITEM}}' => 'font-style: {{VALUE}}',					 
				],				
			]
		);

		$repeater->add_control(
			'webigraph_text_decoration', [
				'label' => __('Decoration', 'webigraph-addons-multi-heading'),                 
				'type' => Controls_Manager::SELECT,			 
				'default' => 'none',				 
				'options'       => [
                    'underline'  => __('Underline', 'webigraph-addons-multi-heading'),
                    'overline'  => __('Overline', 'webigraph-addons-multi-heading'),
                    'line-through'  => __('Line Through', 'webigraph-addons-multi-heading'),                 	 
                  	'none'    => __('None', 'webigraph-addons-multi-heading'),
                ],
                'condition'     => [                                    
                        'webigraph_typograph_switcher'  => 'yes',                        
                    ],
                'selectors' => [
					' {{WRAPPER}} {{CURRENT_ITEM}}' => 'text-decoration: {{VALUE}}',					 
				],				
			]
		);

		$repeater->add_control(
			'webigraph_letter_spacing', [
				'label' => __('Letter Spacing', 'webigraph-addons-multi-heading'),                 
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -5,
						'max' => 10,
						'step' => 0.1,
					],
				],	
				'condition'     => [                                    
                        'webigraph_typograph_switcher'  => 'yes',                        
                    ],		
                'selectors' => [
					' {{WRAPPER}} {{CURRENT_ITEM}}' => 'letter-spacing: {{SIZE}}{{UNIT}}',				 
				],				
			]
		);

		 

		$repeater->start_controls_tabs(
			'text_styles'
		);

		$repeater->start_controls_tab(
			'style_text_tab',
			[
				'label' => __( 'Normal', 'webigraph-addons-multi-heading' ),
			]
		);

        $repeater->add_control(
			'webigraph_text_color', [
				'label' => __('Title Color', 'webigraph-addons-multi-heading'),
                'type' => Controls_Manager::COLOR,
                'default' => '#000',
                'selectors' => [
					' {{WRAPPER}} {{CURRENT_ITEM}}' => 'color: {{VALUE}}',
					' {{WRAPPER}} {{CURRENT_ITEM}} a' => 'color: {{VALUE}}',
				],				
			]
		);

		$repeater->add_control(
			'webigraph_text_bgcolor', [
				'label' => __('Title Background Color', 'webigraph-addons-multi-heading'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
					' {{WRAPPER}} {{CURRENT_ITEM}}' => 'background-color: {{VALUE}}',
					' {{WRAPPER}} {{CURRENT_ITEM}} a' => 'background-color: {{VALUE}}',							
				],				 
			]
		);

		$repeater->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'webigraph_text_shadow',
				'label' => __( 'Text Shadow', 'webigraph-addons-multi-heading' ),
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}',
			]
		);

		$repeater->end_controls_tab();

		$repeater->start_controls_tab(
			'text_hover_style',
			[
				'label' => __( 'Hover', 'webigraph-addons-multi-heading' ),
			]
		);

		$repeater->add_control(
			'webigraph_text_color_hover', [
				'label' => __('Title Color', 'webigraph-addons-multi-heading'),
                'type' => Controls_Manager::COLOR,
                'default' => '#000',
                'selectors' => [
					' {{WRAPPER}} {{CURRENT_ITEM}}:hover' => 'color: {{VALUE}}',
					' {{WRAPPER}} {{CURRENT_ITEM}}:hover a' => 'color: {{VALUE}}',
				],				
			]
		);

		$repeater->add_control(
			'webigraph_text_bgcolor_hover', [
				'label' => __('Title Background Color', 'webigraph-addons-multi-heading'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
					' {{WRAPPER}} {{CURRENT_ITEM}}:hover' => 'background-color: {{VALUE}}',		
					' {{WRAPPER}} {{CURRENT_ITEM}}:hover a' => 'background-color: {{VALUE}}',				
				],				 
			]
		);

		$repeater->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'webigraph_text_shadow_hover',
				'label' => __( 'Text Shadow', 'webigraph-addons-multi-heading' ),
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}:hover',
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
            'webigraph_link_switcher',
            [
                'label'         => __('Add Link', 'webigraph-addons-multi-heading'),
                'type'          => Controls_Manager::SWITCHER,
                'description'   => __('Enable or disable link','webigraph-addons-multi-heading'),
                
            ]
        );

        
		$repeater->add_control(
			'webigraph_link', [
				'label' => __( 'Enter Link', 'webigraph-addons-multi-heading' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'webigraph-addons-multi-heading' ),
				'show_external' => true,
				'default' => [
				'url' => '',
				'is_external' => false,
				'nofollow' => false,
				],  
				'condition'     => [                                    
                        'webigraph_link_switcher'  => 'yes',                        
                 ],
			]
		);

		$repeater->add_control(
			'hr',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		$repeater->add_control(
            'webigraph_icon_switcher',
            [
                'label'         => __('Icon', 'webigraph-addons-multi-heading'),
                'type'          => Controls_Manager::SWITCHER,
                'description'   => __('Enable or disable icon','webigraph-addons-multi-heading'),
                
            ]
        );

        $repeater->add_control(
            'webigraph_icon_selection',
            [
                'label'             => __('Icon', 'webigraph-addons-multi-heading'),
                'type'              => Controls_Manager::ICONS,    
                'fa4compatibility'  => 'webigraph_text_icon_selections',            
                'default' => [
                    'value'     => '',
                    'library'   => '',
                ],
                'condition'         => [
                    'webigraph_icon_switcher'  => 'yes',
                ],               
            ]
        );

        $repeater->start_controls_tabs(
			'icon_style_tabs',
			[
			'condition'         => [
                    'webigraph_icon_switcher'  => 'yes',
                ],  
            ]
		);

		$repeater->start_controls_tab(
			'icon_normal_style',
			[
				'label' => __( 'Normal', 'webigraph-addons-multi-heading' ),
			]

		);

        $repeater->add_control(
			'webigraph_icon_color', [
				'label' => __('Icon Color', 'webigraph-addons-multi-heading'),
                'type' => Controls_Manager::COLOR,
                'default' => '#000',
                'selectors' => [
					' {{WRAPPER}} {{CURRENT_ITEM}} i' => 'color: {{VALUE}}',
					'{{WRAPPER}} {{CURRENT_ITEM}} svg, {{WRAPPER}} {{CURRENT_ITEM}} svg' => 'fill: {{VALUE}};',
				],
				'condition' => [                                    
                        'webigraph_icon_switcher'  => 'yes',                        
                 ],
			]
		);

		$repeater->add_control(
			'webigraph_icon_bgcolor', [
				'label' => __('Icon Background Color', 'webigraph-addons-multi-heading'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
					' {{WRAPPER}} {{CURRENT_ITEM}} i' => 'background-color: {{VALUE}}',
					' {{WRAPPER}} {{CURRENT_ITEM}} svg' => 'background-color: {{VALUE}}',
				],
				'condition' => [                                    
                        'webigraph_icon_switcher'  => 'yes',                        
                 ],
			]
		);

		$repeater->end_controls_tab();

		$repeater->start_controls_tab(
			'icon_style_hover_tab',
			[
				'label' => __( 'Hover', 'webigraph-addons-multi-heading' ),
			]
		);

		$repeater->add_control(
			'webigraph_icon_color_hover', [
				'label' => __('Icon Color', 'webigraph-addons-multi-heading'),
                'type' => Controls_Manager::COLOR,
                'default' => '#000',
                'selectors' => [
					' {{WRAPPER}} {{CURRENT_ITEM}}:hover i' => 'color: {{VALUE}}',
					'{{WRAPPER}} {{CURRENT_ITEM}}:hover svg, {{WRAPPER}} {{CURRENT_ITEM}}:focus svg' => 'fill: {{VALUE}};',
				],
				'condition' => [                                    
                        'webigraph_icon_switcher'  => 'yes',                        
                 ],
			]
		);

		$repeater->add_control(
			'webigraph_icon_bgcolor_hover', [
				'label' => __('Icon Background Color ', 'webigraph-addons-multi-heading'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
					' {{WRAPPER}} {{CURRENT_ITEM}}:hover i' => 'background-color: {{VALUE}}',
					' {{WRAPPER}} {{CURRENT_ITEM}}:hover svg' => 'background-color: {{VALUE}}',
				],
				'condition' => [                                    
                        'webigraph_icon_switcher'  => 'yes',                        
                 ],
			]
		);

		$repeater->end_controls_tab();

		$repeater->end_controls_tabs();



        $repeater->add_control('webigraph_icon_position', 
            [
                'label'         => __('Icon Position', 'webigraph-addons-multi-heading'),
                'type'          => Controls_Manager::SELECT,
                'default'       => 'before',
                'options'       => [
                    'before'        => __('Before', 'webigraph-addons-multi-heading'),
                    'after'         => __('After', 'webigraph-addons-multi-heading'),
                ],
                'condition'     => [                                    
                        'webigraph_icon_switcher'  => 'yes',                        
                  ],
                'label_block'   => true,                
            ]
        );

        $repeater->add_responsive_control('webigraph_button_icon_size',
            [
                'label'         => __('Icon Size', 'webigraph-addons-multi-heading'),
                'type'          => Controls_Manager::SLIDER,
                'condition'     => [                                    
                        'webigraph_icon_switcher'  => 'yes',                        
                    ],
                'selectors'     => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} i' => 'font-size: {{SIZE}}px',
                    '{{WRAPPER}} {{CURRENT_ITEM}} svg' => 'width: {{SIZE}}px; height: {{SIZE}}px'
                ]
            ]
        );


        $repeater->add_responsive_control('webigraph_button_icon_before_spacing',
                [
                    'label'         => __('Icon Spacing', 'webigraph-addons-multi-heading'),
                    'type'          => Controls_Manager::SLIDER,
                    'condition'     => [                        
                        'webigraph_icon_position' => 'before',  
                        'webigraph_icon_switcher'  => 'yes',                      
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
                    'label'         => __('Icon Spacing', 'webigraph-addons-multi-heading'),
                    'type'          => Controls_Manager::SLIDER,
                    'condition'     => [                       
                        'webigraph_icon_position' => 'after', 
                        'webigraph_icon_switcher'  => 'yes',                        
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


        $repeater->add_control(
			'webigraph_header_size',
			[
				'label' => __( 'HTML Tag', 'webigraph-addons-multi-heading' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'div' => 'div',
					'span' => 'span',
					'p' => 'p',
				],
				'default' => 'h2',
			]
		);


		$repeater->add_responsive_control('webigraph_text_align',
			[
				'label'             => __( 'Text Alignment', 'webigraph-addons-multi-heading' ),
				'type'              => Controls_Manager::CHOOSE,
				'options'           => [
					'flex-start'    => [
						'title' => __( 'Left', 'webigraph-addons-multi-heading' ),
						'icon'  => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'webigraph-addons-multi-heading' ),
						'icon'  => 'fa fa-align-center',
					],
					'flex-end' => [
						'title' => __( 'Right', 'webigraph-addons-multi-heading' ),
						'icon'  => 'fa fa-align-right',
					],
				],
				'default' => 'center',
                'selectors'         => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'justify-content: {{VALUE}}','-webkit-justify-content:{{VALUE}}',
                ],
				
			]
		);

		$repeater->add_control(
            'webigraph_more_settings_switcher',
            [
                'label'         => __('More Settings', 'webigraph-addons-multi-heading'),
                'type'          => Controls_Manager::SWITCHER,               
                
            ]
        );

		$repeater->add_responsive_control(
			'webigraph_width',
			[
				'label' => __( 'Width', 'webigraph-addons-multi-heading' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'condition'     => [                                    
                        'webigraph_more_settings_switcher'  => 'yes',                        
                  ],
				
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'width: {{SIZE}}%;',
				],
			]
		);

		$repeater->add_responsive_control(
				'webigraph_text_padding',
				[
					'label' => __( 'Text Padding', 'webigraph-addons-multi-heading' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'condition'     => [                                    
                        'webigraph_more_settings_switcher'  => 'yes',                        
                  	],
					'selectors' => [
						'{{WRAPPER}} {{CURRENT_ITEM}}' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
		

		$repeater->add_control(
			'webigraph_text_radius',
			[
				'label' => __( 'Text Radius', 'webigraph-addons-multi-heading' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'condition'     => [                                    
                        'webigraph_more_settings_switcher'  => 'yes',                        
                 ],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$repeater->add_responsive_control(
				'webigraph_icon_padding',
				[
					'label' => __( 'Icon Padding', 'webigraph-addons-multi-heading' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'condition'     => [                                    
                        'webigraph_more_settings_switcher'  => 'yes',   
                        'webigraph_icon_switcher'  => 'yes',                     
                  	],                  	
					'selectors' => [
						'{{WRAPPER}} {{CURRENT_ITEM}} i, {{WRAPPER}} {{CURRENT_ITEM}} svg' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$repeater->add_control(
			'webigraph_icon_radius',
			[
				'label' => __( 'Icon Radius', 'webigraph-addons-multi-heading' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'condition'     => [                                    
                        'webigraph_more_settings_switcher'  => 'yes',  
                        'webigraph_icon_switcher'  => 'yes',                      
                 ],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} i, {{WRAPPER}} {{CURRENT_ITEM}} svg' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);




		$this->add_control(
			'webigraph_heading_list',
			[
				'label' => __( 'Title List', 'webigraph-addons-multi-heading' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(), 
				'default' => [
					[
						'text' => __( 'title 1', 'webigraph-addons-multi-heading' ),
						
					],
					[
						'text' => __( 'title 2', 'webigraph-addons-multi-heading' ),
						
					],
				],
				'title_field' => '{{{ webigraph_text }}}',
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		<div class="webigraph-multi-heading">
		<?php foreach ( $settings['webigraph_heading_list'] as $index => $item ) :  

			$migrated = isset( $item['__fa4_migrated']['webigraph_icon_selection'] );
            $is_new = empty( $item['webigraph_text_icon_selections'] ) && Icons_Manager::is_migration_allowed();

             
            if ( ! empty ( $item['webigraph_icon_selection'] ) ) {
                $this->add_render_attribute( 'icon', 'class', $item['webigraph_icon_selection'] );
                $this->add_render_attribute( 'icon', 'aria-hidden', 'true' );
            }

			echo '<'.$item['webigraph_header_size'].' class="webigraph-multi-heading-item elementor-repeater-item-' . $item['_id'] . '">';?>
			<?php if ($item['webigraph_icon_switcher'] === 'yes' && $item['webigraph_icon_position'] === 'before' ) {				
					  if ( $is_new || $migrated ) :
						Icons_Manager::render_icon( $item['webigraph_icon_selection'], [ 'aria-hidden' => 'true' ] );
					else : ?>
						<i <?php echo $this->get_render_attribute_string( 'icon' ); ?>></i>
					<?php endif;  
				}  ?>
			<?php if ($item['webigraph_link_switcher'] === 'yes') {
						$target = $item['webigraph_link']['is_external'] ? ' target="_blank"' : '';
                        $nofollow = $item['webigraph_link']['nofollow'] ? ' rel="nofollow"' : '';
                    echo '<a href="'.$item['webigraph_link']['url'].'"  ' . $target . $nofollow . '>'.$item['webigraph_text'].' </a>';
			}else{
					echo $item['webigraph_text'];
			} ?>
			<?php if ($item['webigraph_icon_switcher'] === 'yes' && $item['webigraph_icon_position'] === 'after' ) { 				
					  if ( $is_new || $migrated ) :
						Icons_Manager::render_icon( $item['webigraph_icon_selection'], [ 'aria-hidden' => 'true' ] );
					else : ?>
						<i <?php echo $this->get_render_attribute_string( 'icon' ); ?>></i>
					<?php endif;  
				}  ?>
		<?php	echo '</'.$item['webigraph_header_size'].'>' ?>
		<?php endforeach; ?>
		</div>
		<?php

	}

	protected function _content_template() {

		?>
        <div class="webigraph-multi-heading">

        <#    
        
        if ( settings.webigraph_heading_list ) {
            _.each( settings.webigraph_heading_list, function( item, index ) {
             
				var iconHTML = elementor.helpers.renderIcon( view, item.webigraph_icon_selection, { 'aria-hidden': true }, 'i' , 'object' ),
				migrated = elementor.helpers.isIconMigrated( item, 'webigraph_icon_selection' );          
     
            
            #>

            <{{ item.webigraph_header_size }} class="webigraph-multi-heading-item elementor-repeater-item-{{ item._id }}">  

            <# if(item.webigraph_icon_switcher === 'yes' && item.webigraph_icon_position === 'before'){ #>
	            <# if ( ( migrated || ! settings.icon ) && iconHTML.rendered ) { #>
	                    {{{ iconHTML.value }}}
	                <# } else { #>
	                    <i class="{{ settings.icon }}" aria-hidden="true"></i>
	              <# } #>
             <# } #>				  
			<# if (item.webigraph_link_switcher === 'yes') {
					var target = item.webigraph_link.is_external ? ' target="_blank"' : '';
			    	var nofollow = item.webigraph_link.nofollow ? ' rel="nofollow"' : '';   #>
			    <a href="{{ item.webigraph_link.url }}"  {{ target }} {{ nofollow }}> {{ item.webigraph_text }} </a>
			<# }else{ #>
					{{ item.webigraph_text }} 
			<# } #>

			<# if(item.webigraph_icon_switcher === 'yes' && item.webigraph_icon_position === 'after'){ #>
			<# if ( ( migrated || ! settings.icon ) && iconHTML.rendered ) { #>
			        {{{ iconHTML.value }}}
			    <# } else { #>
			        <i class="{{ settings.icon }}" aria-hidden="true"></i>
			  <# } #>
			<# } #>


			 
			</{{ item.webigraph_header_size }} >                   
             
            <#
            });
        }
        #>
                 
            </div>
        <?php
    }
		
	

}