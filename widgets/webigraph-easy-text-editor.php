<?php

/**
 * Webigraph Easy text editor
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


class Webigraph_Easy_Text_Editor extends Widget_Base
{

	public function get_name() {
		return 'webigraph-addons-for-elementor';
	}

	public function get_title() {
		return __( 'Easy Text Editor', 'webigraph-addons-for-elementor' );
	}

 

	public function get_icon() {
		return 'webigraph-text-editor';
	}

	public function get_categories() {
		return array('webigraph-addons');
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_editor',
			[
				'label' => __( 'Text Editor', 'webigraph-addons-for-elementor' ),
			]
		);

		$this->add_control(
			'webigraph_text_separately',[
				'label' => __( 'All Text Togather Edit ', 'webigraph-addons-for-elementor' ),
				'type' => Controls_Manager::SELECT,
				'options'		=> [
					'default'		=> __('Yes', 'webigraph-addons-for-elementor'),
					'notcustom'		=> __('No', 'webigraph-addons-for-elementor')
				],
				'default'		=> 'default',			 
			]
		);

		$this->add_control(
			'webigraph_easy_editor',
			[
				'label' => '',
				'type' => Controls_Manager::WYSIWYG,
				'default' => __( 'I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'elementor' ),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_para_style',
			[
				'label' => __( 'Paragraph Editor', 'webigraph-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'webigraph_text_separately' => 'default',
				],
			]
		);

		$this->add_responsive_control(
			'p_webigraph_align',
			[
				'label' => __( 'Alignment', 'webigraph-addons-for-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'webigraph-addons-for-elementor' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'webigraph-addons-for-elementor' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'webigraph-addons-for-elementor' ),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => __( 'Justified', 'webigraph-addons-for-elementor' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .webigraph-easy-text-edit p' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'webigraph_typography_p',
				'label' => __( 'Typography', 'webigraph-addons-for-elementor' ),
				'scheme' => Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .webigraph-easy-text-edit p',
			]
		);


		$this->add_control(
			'p_webigraph_text_color',
			[
				'label' => __( 'Text Color', 'webigraph-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .webigraph-easy-text-edit p' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Schemes\Color::get_type(),
					'value' => Schemes\Color::COLOR_3,
				],
			]
		);

		

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'p_webigraph_text_shadow',
				'label' => __( 'Text Shadow', 'webigraph-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .webigraph-easy-text-edit p',
			]
		);

		$this->end_controls_section();

		

		$this->start_controls_section(
			'section_heading_style',
			[
				'label' => __( 'Heading Editor', 'webigraph-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'webigraph_text_separately' => 'default',
				],
			]
		);

		$this->start_controls_tabs(
			'style_tabs'
		);

		$this->start_controls_tab(
			'style_h1_tab',
			[
				'label' => __( 'h1', 'webigraph-addons-for-elementor' ),
			]
		);

		$this->add_responsive_control(
			'h1_webigraph_align',
			[
				'label' => __( 'Alignment', 'webigraph-addons-for-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'webigraph-addons-for-elementor' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'webigraph-addons-for-elementor' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'webigraph-addons-for-elementor' ),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => __( 'Justified', 'webigraph-addons-for-elementor' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .webigraph-easy-text-edit h1' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'webigraph_typography_h1',
				'label' => __( 'Typography', 'webigraph-addons-for-elementor' ),
				'scheme' => Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .webigraph-easy-text-edit h1',
			]
		);


		$this->add_control(
			'h1_webigraph_text_color',
			[
				'label' => __( 'Text Color', 'webigraph-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .webigraph-easy-text-edit h1' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Schemes\Color::get_type(),
					'value' => Schemes\Color::COLOR_3,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'h1_webigraph_text_shadow',
				'label' => __( 'Text Shadow', 'webigraph-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .webigraph-easy-text-edit h1',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'style_h2_tab',
			[
				'label' => __( 'h2', 'plugin-name' ),
			]
		);

		$this->add_responsive_control(
			'h2_webigraph_align',
			[
				'label' => __( 'Alignment', 'webigraph-addons-for-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'webigraph-addons-for-elementor' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'webigraph-addons-for-elementor' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'webigraph-addons-for-elementor' ),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => __( 'Justified', 'webigraph-addons-for-elementor' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .webigraph-easy-text-edit h2' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'webigraph_typography_h2',
				'label' => __( 'Typography', 'webigraph-addons-for-elementor' ),
				'scheme' => Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .webigraph-easy-text-edit h2',
			]
		);


		$this->add_control(
			'h2_webigraph_text_color',
			[
				'label' => __( 'Text Color', 'webigraph-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .webigraph-easy-text-edit h2' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Schemes\Color::get_type(),
					'value' => Schemes\Color::COLOR_3,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'h2_webigraph_text_shadow',
				'label' => __( 'Text Shadow', 'webigraph-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .webigraph-easy-text-edit h2',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'style_h3_tab',
			[
				'label' => __( 'h3', 'plugin-name' ),
			]
		);

		$this->add_responsive_control(
			'h3_webigraph_align',
			[
				'label' => __( 'Alignment', 'webigraph-addons-for-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'webigraph-addons-for-elementor' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'webigraph-addons-for-elementor' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'webigraph-addons-for-elementor' ),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => __( 'Justified', 'webigraph-addons-for-elementor' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .webigraph-easy-text-edit h3' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'webigraph_typography_h3',
				'label' => __( 'Typography', 'webigraph-addons-for-elementor' ),
				'scheme' => Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .webigraph-easy-text-edit h3',
			]
		);


		$this->add_control(
			'h3_webigraph_text_color',
			[
				'label' => __( 'Text Color', 'webigraph-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .webigraph-easy-text-edit h3' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Schemes\Color::get_type(),
					'value' => Schemes\Color::COLOR_3,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'h3_webigraph_text_shadow',
				'label' => __( 'Text Shadow', 'webigraph-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .webigraph-easy-text-edit h3',
			]
		);



		$this->end_controls_tab();


		$this->start_controls_tab(
			'style_h4_tab',
			[
				'label' => __( 'h4', 'plugin-name' ),
			]
		);

		$this->add_responsive_control(
			'h4_webigraph_align',
			[
				'label' => __( 'Alignment', 'webigraph-addons-for-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'webigraph-addons-for-elementor' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'webigraph-addons-for-elementor' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'webigraph-addons-for-elementor' ),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => __( 'Justified', 'webigraph-addons-for-elementor' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .webigraph-easy-text-edit h4' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'webigraph_typography_h4',
				'label' => __( 'Typography', 'webigraph-addons-for-elementor' ),
				'scheme' => Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .webigraph-easy-text-edit h4',
			]
		);


		$this->add_control(
			'h4_webigraph_text_color',
			[
				'label' => __( 'Text Color', 'webigraph-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .webigraph-easy-text-edit h4' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Schemes\Color::get_type(),
					'value' => Schemes\Color::COLOR_3,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'h4_webigraph_text_shadow',
				'label' => __( 'Text Shadow', 'webigraph-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .webigraph-easy-text-edit h4',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'style_h5_tab',
			[
				'label' => __( 'h5', 'plugin-name' ),
			]
		);

		$this->add_responsive_control(
			'h5_webigraph_align',
			[
				'label' => __( 'Alignment', 'webigraph-addons-for-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'webigraph-addons-for-elementor' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'webigraph-addons-for-elementor' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'webigraph-addons-for-elementor' ),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => __( 'Justified', 'webigraph-addons-for-elementor' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .webigraph-easy-text-edit h5' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'webigraph_typography_h5',
				'label' => __( 'Typography', 'webigraph-addons-for-elementor' ),
				'scheme' => Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .webigraph-easy-text-edit h5',
			]
		);


		$this->add_control(
			'h5_webigraph_text_color',
			[
				'label' => __( 'Text Color', 'webigraph-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .webigraph-easy-text-edit h5' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Schemes\Color::get_type(),
					'value' => Schemes\Color::COLOR_3,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'h5_webigraph_text_shadow',
				'label' => __( 'Text Shadow', 'webigraph-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .webigraph-easy-text-edit h5',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'style_h6_tab',
			[
				'label' => __( 'h6', 'plugin-name' ),
			]
		);

		$this->add_responsive_control(
			'h6_webigraph_align',
			[
				'label' => __( 'Alignment', 'webigraph-addons-for-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'webigraph-addons-for-elementor' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'webigraph-addons-for-elementor' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'webigraph-addons-for-elementor' ),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => __( 'Justified', 'webigraph-addons-for-elementor' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .webigraph-easy-text-edit h6' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'webigraph_typography_h6',
				'label' => __( 'Typography', 'webigraph-addons-for-elementor' ),
				'scheme' => Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .webigraph-easy-text-edit h6',
			]
		);


		$this->add_control(
			'h6_webigraph_text_color',
			[
				'label' => __( 'Text Color', 'webigraph-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .webigraph-easy-text-edit h6' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Schemes\Color::get_type(),
					'value' => Schemes\Color::COLOR_3,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'h6_webigraph_text_shadow',
				'label' => __( 'Text Shadow', 'webigraph-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .webigraph-easy-text-edit h6',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_section();


		$this->end_controls_section();

		
		$this->start_controls_section(
			'section_preformatted_style',
			[
				'label' => __( 'Preformatted Editor', 'webigraph-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'webigraph_text_separately' => 'default',
				],
			]
		);

		$this->add_responsive_control(
			'pre_webigraph_align',
			[
				'label' => __( 'Alignment', 'webigraph-addons-for-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'webigraph-addons-for-elementor' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'webigraph-addons-for-elementor' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'webigraph-addons-for-elementor' ),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => __( 'Justified', 'webigraph-addons-for-elementor' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .webigraph-easy-text-edit pre' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'webigraph_typography_pre',
				'label' => __( 'Typography', 'webigraph-addons-for-elementor' ),
				'scheme' => Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .webigraph-easy-text-edit pre',
			]
		);


		$this->add_control(
			'pre_webigraph_text_color',
			[
				'label' => __( 'Text Color', 'webigraph-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .webigraph-easy-text-edit pre' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Schemes\Color::get_type(),
					'value' => Schemes\Color::COLOR_3,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'pre_webigraph_text_shadow',
				'label' => __( 'Text Shadow', 'webigraph-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .webigraph-easy-text-edit pre',
			]
		);

		$this->end_controls_section();
		


		$this->start_controls_section(
			'section_all_text_editor',
			[
				'label' => __( 'Text Editor', 'webigraph-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'webigraph_text_separately' => 'notcustom',
				],
			]
		);

		

		$this->add_responsive_control(
			'all_webigraph_align',
			[
				'label' => __( 'Alignment', 'webigraph-addons-for-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'webigraph-addons-for-elementor' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'webigraph-addons-for-elementor' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'webigraph-addons-for-elementor' ),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => __( 'Justified', 'webigraph-addons-for-elementor' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .webigraph-easy-text-edit' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'webigraph_typography_all',
				'label' => __( 'Typography', 'webigraph-addons-for-elementor' ),
				'scheme' => Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .webigraph-easy-text-edit',
			]
		);


		$this->add_control(
			'all_webigraph_text_color',
			[
				'label' => __( 'Text Color', 'webigraph-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .webigraph-easy-text-edit' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Schemes\Color::get_type(),
					'value' => Schemes\Color::COLOR_3,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'all_webigraph_text_shadow',
				'label' => __( 'Text Shadow', 'webigraph-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .webigraph-easy-text-edit',
			]
		);

		$this->end_controls_section();


	}

	protected function render() {

		$editor_content = $this->get_settings( 'webigraph_easy_editor' );

		$editor_content = $this->parse_text_editor( $editor_content );

		$this->add_render_attribute( 'webigraph_easy_editor', 'class', [ 'webigraph-easy-text-edit', 'elementor-clearfix' ] );

		$this->add_inline_editing_attributes( 'webigraph_easy_editor', 'advanced' );
		?>

	 	<div <?php echo $this->get_render_attribute_string( 'webigraph_easy_editor' ); ?>><?php echo $editor_content; ?></div>
	 	<?php 
	}

	public function render_plain_content() {		
		echo $this->get_settings( 'webigraph_easy_editor' );
	}

	protected function _content_template() {
		?>
		<#
		view.addRenderAttribute( 'webigraph_easy_editor', 'class', [ 'webigraph-easy-text-edit', 'elementor-clearfix' ] );

		view.addInlineEditingAttributes( 'webigraph_easy_editor', 'advanced' );
		#>
		<div {{{ view.getRenderAttributeString( 'webigraph_easy_editor' ) }}}>{{{ settings.webigraph_easy_editor }}}</div>
		<?php
	}
}