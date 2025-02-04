<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Elementor_Title_Widget extends \Elementor\Widget_Base {

    public function get_name(): string {
        return 'title';
    }

    public function get_title(): string {
        return esc_html__( 'Title', 'elementor-title-widget' );
    }

    public function get_icon(): string {
        return 'eicon-editor-h1';
    }

    public function get_categories(): array {
        return [ 'basic' ];
    }

    public function get_keywords(): array {
        return [ 'title', 'text', 'heading' ];
    }

    protected function register_controls(): void {
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Content', 'elementor-title-widget' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'btitle',
            [
                'label'       => esc_html__( 'Title', 'elementor-title-widget' ),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'placeholder' => esc_html__( 'Enter your title', 'elementor-title-widget' ),
                'default'     => esc_html__( 'Add Your Heading [Text] Here', 'elementor-title-widget' ),
            ]
        );

        $this->add_control(
            'header_size',
            [
                'label'   => esc_html__( 'HTML Tag', 'elementor-title-widget' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
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

        $this->add_responsive_control(
            'align',
            [
                'label'     => esc_html__( 'Alignment', 'elementor-title-widget' ),
                'type'      => \Elementor\Controls_Manager::CHOOSE,
                'options'   => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'elementor-title-widget' ),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'elementor-title-widget' ),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'elementor-title-widget' ),
                        'icon'  => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => esc_html__( 'Justified', 'elementor-title-widget' ),
                        'icon'  => 'eicon-text-align-justify',
                    ],
                ],
                'default'   => '',
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .tf--title' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
          'heading_link',
          [
              'label'       => esc_html__( 'Link', 'elementor-title-widget' ),
              'type'        => \Elementor\Controls_Manager::URL,
              'options'     => [ 'url', 'is_external', 'nofollow' ],
              'default'     => [
                  'url'         => '',
                  'is_external' => true,
                  'nofollow'    => true,
              ],
              'label_block' => true,
          ]
      );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style',
            [
                'label' => esc_html__( 'Title', 'elementor-title-widget' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__( 'Text Color', 'elementor-title-widget' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tf--title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'typography',
                'selector' => '{{WRAPPER}} .tf--title',
            ]
        );
        $this->add_group_control(
          \Elementor\Group_Control_Text_Stroke::get_type(),
          [
               'name'     => 'text_stroke',
               'selector' => '{{WRAPPER}} .tf--title',
          ]
     );

     $this->add_group_control(
          \Elementor\Group_Control_Text_Shadow::get_type(),
          [
               'name'     => 'text_shadow',
               'selector' => '{{WRAPPER}} .tf--title',
          ]
     );

  

        $this->end_controls_section();
    }

    protected function render(): void {
        $settings = $this->get_settings_for_display();

        if ( empty( $settings['btitle'] ) ) {
            return;
        }

        // Validate tag selection
        $allowed_tags = [ 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'div', 'span', 'p' ];
        $tag = in_array( $settings['header_size'], $allowed_tags ) ? $settings['header_size'] : 'h2';

        
         // Create the link wrapper if a URL is provided
         $link_open = '';
         $link_close = '';

         if ( ! empty( $settings['heading_link']['url'] ) ) {
          $this->add_link_attributes( 'heading_link', $settings['heading_link'] );
          $link_open = '<a ' . $this->get_render_attribute_string( 'heading_link' ) . '>';
          $link_close = '</a>';
      }


     printf(
            '<%1$s class="tf--title">%2$s%3$s%4$s</%1$s>',
            esc_html( $tag ),
            $link_open,
            esc_html( $settings['btitle'] ),
            $link_close
        );
    }
}
