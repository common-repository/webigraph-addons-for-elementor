<?php

/**
 * Webigraph Modal Box
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


class Webigraph_Modal_box extends Widget_Base
{

	public function get_name() {
		return 'webigraph-addons-modal-box';
	}

	public function get_title() {
		return __( 'Modal Box', 'webigraph-addons-modal-box' );
	}

	public function get_script_depends()
    {
        return [
        	'webigraph-jquery-351' ,
            'webigraph-modal-js', 

        ];
    }
 

	public function get_icon() {
		return 'webigraph-modalbox';
	}

	public function get_categories() {
		return array('webigraph-addons');
	}

	 

	protected function _register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'webigraph-addons-modal-box' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
            'webigraph_visible_switcher',
            [
                'label'         => __('On Page load', 'webigraph-addons-modal-box'),
                'type'          => Controls_Manager::SWITCHER,
                'description'    => __('if you want when Open the Page, this time show/open this modal box, So click the switch'),           
                
            ]
        );

        $this->add_control(
            'webigraph_button_diplay_hidden',
            [
                'label'         => __('Button Hidden', 'webigraph-addons-modal-box'),
                'type'          => Controls_Manager::SWITCHER,
                'condition' => [
					'webigraph_visible_switcher' => 'yes',
				],                            
                
            ]
        );

		$this->add_control(
			'webigraph_button_text',
			[
				'label' => __( 'Button Text', 'webigraph-addons-modal-box' ),
				'type' => 	Controls_Manager::TEXT,
				'default' => __( 'Button Text', 'webigraph-addons-modal-box' ),
				'placeholder' => __( 'Type your text here', 'webigraph-addons-modal-box' ),
			]
		);

		$this->add_control(
			'webigraph_modal_title',
			[
				'label' => __( 'Modal Title', 'webigraph-addons-modal-box' ),
				'type' => 	Controls_Manager::TEXT,
				'default' => __( 'Modal Title', 'webigraph-addons-modal-box' ),
				'placeholder' => __( 'Type your title here', 'webigraph-addons-modal-box' ),
			]
		);

		$this->add_control(
			'webigraph_modal_body',
			[
				'label' => __( 'Modal Body', 'webigraph-addons-modal-box' ),
				'type' => Controls_Manager::WYSIWYG,
				'default' => __( 'Modal Body', 'webigraph-addons-modal-box' ),				
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'webigraph_modal_options',
			[
				'label' => __( 'Modal Options', 'webigraph-addons-modal-box' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'webigraph_button_icon',
			[
                'label'             => __('Icon', 'webigraph-addons-modal-box'),
                'type'              => Controls_Manager::ICONS,    
                'fa4compatibility'  => 'icon',            
                'default' => [
					'value' => '',
					'library' => '',
				],
                                
            ]
		);

		$this->add_control(
			'webigraph_button_icon_align',
			[
				'label' => __( 'Icon Position', 'webigraph-addons-modal-box' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'left',
				'options' => [
					'left' => __( 'Before', 'webigraph-addons-modal-box' ),
					'right' => __( 'After', 'webigraph-addons-modal-box' ),
				],
				
			]
		);

		$this->add_control(
			'webigraph_button_icon_spacing',
			[
				'label' => __( 'Icon Spacing', 'webigraph-addons-modal-box' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .webigraph-modal-trigger .webigraph-aling-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .webigraph-modal-trigger .webigraph-aling-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control('webigraph_button_icon_size',
            [
                'label'         => __('Icon Size', 'webigraph-addons-modal-box'),
                'type'          => Controls_Manager::SLIDER,
                 
                'selectors'     => [
                    '{{WRAPPER}} .webigraph-modal-trigger .webigraph-button-icon i' => 'font-size: {{SIZE}}px',
                    '{{WRAPPER}} .webigraph-modal-trigger .webigraph-button-icon svg' => 'width: {{SIZE}}px; height: {{SIZE}}px'
                ]
            ]
        );	

		$this->end_controls_section();


		$this->start_controls_section(
			'section_modal_button_style',
			[
				'label' => __( 'Modal Button', 'webigraph-addons-modal-box' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'webigraph_button_text_typography',
				'label' => __( 'Button Typography', 'webigraph-addons-modal-box' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .webigraph-modal-trigger',
			]
		);

		$this->add_responsive_control('webigraph_button_align',
			[
				'label'             => __( 'Button Alignment', 'webigraph-addons-modal-box' ),
				'type'              => Controls_Manager::CHOOSE,
				'options'           => [
					'flex-start'    => [
						'title' => __( 'Left', 'webigraph-addons-modal-box' ),
						'icon'  => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'webigraph-addons-modal-box' ),
						'icon'  => 'fa fa-align-center',
					],
					'flex-end' => [
						'title' => __( 'Right', 'webigraph-addons-modal-box' ),
						'icon'  => 'fa fa-align-right',
					],
				],
				'default' => 'flex-start',
                'selectors'         => [
                    '{{WRAPPER}} .wge-modal-popup' => 'align-items: {{VALUE}}','-webkit-justify-content:{{VALUE}}',
                ],
				
			]
		);

		
		$this->add_responsive_control(
			'webigraph_button_width',
			[
				'label' => __( 'Width', 'webigraph-addons-modal-box' ),
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
					'{{WRAPPER}} .webigraph-modal-trigger' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);	

		$this->start_controls_tabs(
			'style_button_tabs'
		);

		

		$this->start_controls_tab(
			'style_button_normal_tab',
			[
				'label' => __( 'Normal', 'webigraph-addons-modal-box' ),
			]
		);

		$this->add_control(
			'button_text_color', [
				'label' => __('Text Color', 'webigraph-addons-modal-box'),
                'type' => Controls_Manager::COLOR,                
                'selectors' => [
					' {{WRAPPER}} .webigraph-modal-trigger' => 'color: {{VALUE}}',
				],
				 
			]
		);

		

		$this->add_control(
			'button_color', [
				'label' => __('Background Color', 'webigraph-addons-modal-box'),
                'type' => Controls_Manager::COLOR,                 
                'selectors' => [
					'{{WRAPPER}} .webigraph-modal-trigger' => 'background-color: {{VALUE}}',
				],				 
			]
		);


		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow',
				'label' => __( 'Button Shadow', 'webigraph-addons-modal-box' ),
				'selector' => '{{WRAPPER}} .webigraph-modal-trigger',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'button_border',
				'selector' => '{{WRAPPER}} .webigraph-modal-trigger',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label' => __( 'Border Radius', 'webigraph-addons-modal-box' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .webigraph-modal-trigger' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		

		
		$this->end_controls_tab();

		$this->start_controls_tab(
			'style_button_hover_tab',
			[
				'label' => __( 'Hover', 'webigraph-addons-modal-box' ),
			]
		);

		$this->add_control(
			'button_text_color_hover', [
				'label' => __('Text Color', 'webigraph-addons-modal-box'),
                'type' => Controls_Manager::COLOR,                
                'selectors' => [
					' {{WRAPPER}} .webigraph-modal-trigger:hover' => 'color: {{VALUE}}',
				],
				 
			]
		);

		

		$this->add_control(
			'button_color_hover', [
				'label' => __('Background Color', 'webigraph-addons-modal-box'),
                'type' => Controls_Manager::COLOR,                 
                'selectors' => [
					'{{WRAPPER}} .webigraph-modal-trigger:hover' => 'background-color: {{VALUE}}',
				],				 
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_shadow_hover',
				'label' => __( 'Button Shadow', 'webigraph-addons-modal-box' ),
				'selector' => '{{WRAPPER}} .webigraph-modal-trigger:hover',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'button_button_border_hover',
				'selector' => '{{WRAPPER}} .webigraph-modal-trigger:hover',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'button_border_radius_hover',
			[
				'label' => __( 'Border Radius', 'webigraph-addons-modal-box' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .webigraph-modal-trigger:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_modal_icon_style',
			[
				'label' => __( 'Button Icon', 'webigraph-addons-modal-box' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);


		$this->start_controls_tabs(
			'icon_style_tabs'
			 
		);

		$this->start_controls_tab(
			'icon_normal_style',
			[
				'label' => __( 'Normal', 'webigraph-addons-modal-box' ),
			]

		);

        $this->add_control(
			'webigraph_icon_color', [
				'label' => __('Icon Color', 'webigraph-addons-modal-box'),
                'type' => Controls_Manager::COLOR,                
                'selectors' => [
					' {{WRAPPER}} .webigraph-modal-trigger .webigraph-button-icon i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .webigraph-modal-trigger .webigraph-button-icon svg' => 'fill: {{VALUE}};',
				],
				
			]
		);

		$this->add_control(
			'webigraph_icon_bgcolor', [
				'label' => __('Icon Background Color', 'webigraph-addons-modal-box'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
					' {{WRAPPER}} .webigraph-modal-trigger .webigraph-button-icon i' => 'background-color: {{VALUE}}',
					' {{WRAPPER}} .webigraph-modal-trigger .webigraph-button-icon svg' => 'background-color: {{VALUE}}',
				],
				 
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'icon_style_hover_tab',
			[
				'label' => __( 'Hover', 'webigraph-addons-modal-box' ),
			]
		);

		$this->add_control(
			'webigraph_icon_color_hover', [
				'label' => __('Icon Color', 'webigraph-addons-modal-box'),
                'type' => Controls_Manager::COLOR,                
                'selectors' => [
					' {{WRAPPER}} .webigraph-modal-trigger:hover .webigraph-button-icon i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .webigraph-modal-trigger:hover .webigraph-button-icon svg, {{WRAPPER}} {{CURRENT_ITEM}}:focus svg' => 'fill: {{VALUE}};',
				],
				 
			]
		);

		$this->add_control(
			'webigraph_icon_bgcolor_hover', [
				'label' => __('Icon Background Color ', 'webigraph-addons-modal-box'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
					' {{WRAPPER}} .webigraph-modal-trigger:hover .webigraph-button-icon i' => 'background-color: {{VALUE}}',
					' {{WRAPPER}} .webigraph-modal-trigger:hover .webigraph-button-icon svg' => 'background-color: {{VALUE}}',
				],
				 
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

        $this->add_responsive_control(
				'webigraph_icon_padding',
				[
					'label' => __( 'Icon Padding', 'webigraph-addons-modal-box' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					 
					'selectors' => [
						'{{WRAPPER}} .webigraph-modal-trigger .webigraph-button-icon i, {{WRAPPER}} .webigraph-modal-trigger .webigraph-button-icon svg' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		

		$this->add_control(
			'webigraph_icon_radius',
			[
				'label' => __( 'Icon Radius', 'webigraph-addons-modal-box' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				 
				'selectors' => [
					'{{WRAPPER}} .webigraph-modal-trigger .webigraph-button-icon i, {{WRAPPER}} .webigraph-modal-trigger .webigraph-button-icon svg' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->end_controls_section();


		$this->start_controls_section(
			'webigraph_modal_box_section',
			[
				'label' => __( 'Modal', 'webigraph-addons-modal-box' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);


		$this->add_responsive_control(
			'webigraph_modal_box_width',
			[
				'label' => __( 'Modal Box Width (%)', 'webigraph-addons-modal-box' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'desktop_default' => [
					'size' => 50,
					 
				],
				'tablet_default' => [
					'size' => 70,
					 
				],
				'mobile_default' => [
					'size' => 90,					 
				],
				
				'selectors' => [
					'{{WRAPPER}} .wge-modal-window' => 'width: {{SIZE}}%;',
				],
			]
		);	

		$this->add_responsive_control(
			'webigraph_modal_box_height',
			[
				'label' => __( 'Modal Box Height', 'webigraph-addons-modal-box' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'desktop_default' => [
					'size' => 50,
					 
				],
				'tablet_default' => [
					'size' => 60,
					 
				],
				'mobile_default' => [
					'size' => 70,
					 
				],
				
				'selectors' => [
					'{{WRAPPER}} .webigraph-modal-content-body' => 'max-height: {{SIZE}}vh;',
				],
			]
		);

		$this->add_control(
			'webigraph_modal_bgcolor', [
				'label' => __('Modal Background Color', 'webigraph-addons-modal-box'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
					' {{WRAPPER}} .wge-modal-wrapper' => 'background-color: {{VALUE}}',					 
				],
				 
			]
		);


		$this->add_control(
			'webigraph_modal_window_bgcolor', [
				'label' => __('Modal Box Background Color', 'webigraph-addons-modal-box'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
					' {{WRAPPER}} .wge-modal-window' => 'background-color: {{VALUE}}',					 
				],
				 
			]
		);

		$this->add_control(
			'webigraph_modal_box_radius',
			[
				'label' => __( 'Modal Box Radius', 'webigraph-addons-modal-box' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				 
				'selectors' => [
					'{{WRAPPER}} .wge-modal-window' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .webigraph-modal-header' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} 0{{UNIT}} 0{{UNIT}};',
					'{{WRAPPER}} .webigraph-modal-content-body' => 'border-radius: 0{{UNIT}} 0{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'webigraph_modal_box_shadow',
				'label' => __( 'Modal Box Shadow', 'webigraph-addons-modal-box' ),
				'selector' => '{{WRAPPER}} .wge-modal-window',
			]
		);

		$this->add_control(
			'webigraph_modal_box_motion_speed',
			[
				'label' => __( 'Modal box open and show motion speed', 'webigraph-addons-modal-box' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 1,
				],
				'range' => [
					'px' => [
						'min' => 0.1,
						'max' => 10,
						'step' => 0.1,
					],
				],	
				'default' => [
					'size' => 0.5,					 
				],			 
				'selectors' => [
					'{{WRAPPER}} .wge-modal-wrapper' => 'transition: all {{SIZE}}s ease-in-out  ',
					'{{WRAPPER}} .wge-modal-window' => 'transition: {{SIZE}}s ease-in-out all  ',
				],
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'webigraph_modal_box_header_section',
			[
				'label' => __( 'Modal Header', 'webigraph-addons-modal-box' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'webigraph_modal_header_typography',
				'label' => __( 'Typography', 'webigraph-addons-modal-box' ),
				'scheme' => Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .webigraph-modal-header span',
			]
		);

		$this->add_control(
			'webigraph_modal_header_color', [
				'label' => __('Color', 'webigraph-addons-modal-box'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
					' {{WRAPPER}} .webigraph-modal-header' => 'color: {{VALUE}}',					 
				],
				 
			]
		);


		$this->add_control(
			'webigraph_modal_header_bgcolor', [
				'label' => __('Background Color', 'webigraph-addons-modal-box'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
					' {{WRAPPER}} .webigraph-modal-header' => 'background-color: {{VALUE}}',					 
				],
				 
			]
		);

		$this->add_control(
			'webigraph_modal_header_padding',
			[
				'label' => __( 'Padding', 'webigraph-addons-modal-box' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				 
				'selectors' => [
					'{{WRAPPER}} .webigraph-modal-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',					 
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'webigraph_modal_header_border',
				'label' => __( 'Border', 'webigraph-addons-modal-box' ),
				'selector' => '{{WRAPPER}} .webigraph-modal-header',
			]
		);



		$this->end_controls_section();


		$this->start_controls_section(
			'webigraph_modal_box_content_section',
			[
				'label' => __( 'Modal Content Body', 'webigraph-addons-modal-box' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'webigraph_modal_content_typography',
				'label' => __( 'Typography', 'webigraph-addons-modal-box' ),
				'scheme' => Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .webigraph-modal-content-body',
			]
		);

		$this->add_responsive_control(
			'webigraph_align_content',
			[
				'label' => __( 'Alignment', 'webigraph-addons-modal-box' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'webigraph-addons-modal-box' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'webigraph-addons-modal-box' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'webigraph-addons-modal-box' ),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => __( 'Justified', 'webigraph-addons-modal-box' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .webigraph-modal-content-body' => 'text-align: {{VALUE}};',
				],
			]
		);

		

		$this->add_control(
			'webigraph_modal_content_color', [
				'label' => __('Color', 'webigraph-addons-modal-box'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
					' {{WRAPPER}} .webigraph-modal-content-body' => 'color: {{VALUE}}',					 
				],
				 
			]
		);


		$this->add_control(
			'webigraph_modal_content_bgcolor', [
				'label' => __('Background Color', 'webigraph-addons-modal-box'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
					' {{WRAPPER}} .webigraph-modal-content-body' => 'background-color: {{VALUE}}',					 
				],
				 
			]
		);

		$this->add_control(
			'webigraph_modal_contant_padding',
			[
				'label' => __( 'Padding', 'webigraph-addons-modal-box' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				 
				'selectors' => [
					'{{WRAPPER}} .webigraph-modal-content-body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',					 
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_modal_box_close_style',
			[
				'label' => __( 'Modal Close Button', 'webigraph-addons-modal-box' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);


		$this->start_controls_tabs(
			'close_button_style_tabs'
			 
		);

		$this->start_controls_tab(
			'close_button_normal_style',
			[
				'label' => __( 'Normal', 'webigraph-addons-modal-box' ),
			]

		);

        $this->add_control(
			'webigraph_close_button_color', [
				'label' => __('Color', 'webigraph-addons-modal-box'),
                'type' => Controls_Manager::COLOR,                
                'selectors' => [
					' {{WRAPPER}} .webigraph-close-modal-button' => 'color: {{VALUE}}',
					 
				],
				
			]
		);

		$this->add_control(
			'webigraph_close_button_bgcolor', [
				'label' => __('Background Color', 'webigraph-addons-modal-box'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
					' {{WRAPPER}} .webigraph-close-modal-button' => 'background-color: {{VALUE}}',
					 
				],
				 
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'close_button_style_hover_tab',
			[
				'label' => __( 'Hover', 'webigraph-addons-modal-box' ),
			]
		);

		$this->add_control(
			'webigraph_close_button_color_hover', [
				'label' => __('Color', 'webigraph-addons-modal-box'),
                'type' => Controls_Manager::COLOR,                
                'selectors' => [
					' {{WRAPPER}} .webigraph-close-modal-button:hover::before' => 'color: {{VALUE}} ',				 
				],
				 
			]
		);

		$this->add_control(
			'webigraph_close_button_bgcolor_hover', [
				'label' => __('Background Color ', 'webigraph-addons-modal-box'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
					' {{WRAPPER}} .webigraph-close-modal-button:hover' => 'background-color: {{VALUE}}',
					 
				],
				 
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();        

        $this->add_responsive_control(
				'webigraph_close_button_padding',
				[
					'label' => __( 'Padding', 'webigraph-addons-modal-box' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					 
					'selectors' => [
						'{{WRAPPER}} .webigraph-close-modal-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		

		$this->add_control(
			'webigraph_close_button_radius',
			[
				'label' => __( 'Radius', 'webigraph-addons-modal-box' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				 
				'selectors' => [
					'{{WRAPPER}} .webigraph-close-modal-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->end_controls_section();	 


	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( $settings['webigraph_visible_switcher'] === 'yes' ) {
			$this->add_render_attribute( 'modalwrapper', 'class', [ 'wge-modal-wrapper', 'visible' ] );
			$this->add_render_attribute( 'modalwindow', 'class', [ 'wge-modal-window', 'visible' ] );
		}else{
			$this->add_render_attribute( 'modalwrapper', 'class', [ 'wge-modal-wrapper' ] );
			$this->add_render_attribute( 'modalwindow', 'class', [ 'wge-modal-window'] );
		}

		

		if ( $settings['webigraph_button_diplay_hidden'] === 'yes' ) {
			$this->add_render_attribute( 'modaltrigger', 'class', [ 'webigraph-modal-trigger-hidden'] );
		}else{
			$this->add_render_attribute( 'modaltrigger', 'class', [ 'webigraph-modal-trigger' ] );
		}

		echo '<div class="wge-modal-popup"> 
		 <button onclick="wgeModalBoxOpenFunction(this)" '. $this->get_render_attribute_string( 'modaltrigger' ).' data-modal-id="'.$this->get_id().' " >';
		  echo  $this->render_button_text();
		 echo '</button>   
		    <div '. $this->get_render_attribute_string( 'modalwrapper' ).' id="modalwp-'.$this->get_id().'"> 
		        <section '. $this->get_render_attribute_string( 'modalwindow' ).' id="modal-'.$this->get_id().'">
		          <header class="webigraph-modal-header">
		              <span>' . $settings['webigraph_modal_title'] . '</span>
		              <div class="webigraph-close-modal-button" id="wgeclosemodalbutton" onclick="wgeModalBoxCloseFunction()"></div>
		          </header>
		          <div class="webigraph-modal-content-body">' . $settings['webigraph_modal_body'] . '</div>
		        </section>       
		    </div>
		</div>';
	 
	}

	protected function render_button_text() {
 

		$settings = $this->get_settings_for_display();

		$migrated = isset( $item['__fa4_migrated']['button_icon_selection'] );
        $is_new = empty( $item['icon'] ) && Icons_Manager::is_migration_allowed();

        if ( ! empty( $settings['icon'] ) ) {
			$this->add_render_attribute( 'icon', 'class', $settings['icon'] );
			$this->add_render_attribute( 'icon', 'aria-hidden', 'true' );
		}

		if ( ! $is_new && empty( $settings['webigraph_button_icon_align'] ) ) {
			$settings['webigraph_button_icon_align'] = $this->get_settings( 'webigraph_button_icon_align' );
		}

		 
		$this->add_render_attribute( [			
			'icon-align' => [
				'class' => [
					'webigraph-button-icon',
					'webigraph-aling-icon-'. $settings['webigraph_button_icon_align'],
				],
			],
			'text' => [
				'class' => 'webigraph-modal-button-text',
			],
		] );

		?>
		 
		<?php if ( ! empty( $settings['icon'] ) || ! empty( $settings['webigraph_button_icon']['value'] ) ) : ?>
			<span <?php echo $this->get_render_attribute_string( 'icon-align' ); ?>>
				<?php if ( $is_new || $migrated ) :
				Icons_Manager::render_icon( $settings['webigraph_button_icon'], [ 'aria-hidden' => 'true' ] );
			else : ?>
				<i <?php echo $this->get_render_attribute_string( 'icon' ); ?>></i>
				<?php endif; ?>
			</span>
		<?php endif; ?>
		<span <?php echo $this->get_render_attribute_string('text') ?>><?php echo $settings['webigraph_button_text'] ?></span>
		 


<?php
	}


	 public function on_import( $element ) {
		return Icons_Manager::on_import_migration( $element, 'icon', 'webigraph_button_icon' );
	}

}

?>