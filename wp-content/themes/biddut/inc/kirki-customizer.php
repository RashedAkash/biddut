<?php


new \Kirki\Panel(
    'panel_id',
    [
        'priority' => 10,
        'title' => esc_html__('Biddut Panel', 'biddut'),
        'description' => esc_html__('Biddut Panel Description.', 'biddut'),
    ]
);

// header_top_section
function header_top_section()
{
    // header_top_bar section 
    new \Kirki\Section(
        'header_top_section',
        [
            'title' => esc_html__('Header Info', 'biddut'),
            'description' => esc_html__('Header Section Information.', 'biddut'),
            'panel' => 'panel_id',
            'priority' => 100,
        ]
    );
    // header_top_bar section 

    new \Kirki\Field\Radio_Image(
        [
            'settings' => 'header_layout_custom',
            'label' => esc_html__('Chose Header Style', 'biddut'),
            'section' => 'header_top_section',
            'priority' => 10,
            'choices' => [
                'header_1' => get_template_directory_uri() . '/inc/img/header/header-1.png',
                'header_2' => get_template_directory_uri() . '/inc/img/header/header-2.png',
                'header_3' => get_template_directory_uri() . '/inc/img/header/header-3.png'
            ],
            'default' => 'header_1',
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'header_topbar_switch',
            'label' => esc_html__('Header Topbar Switch', 'biddut'),
            'description' => esc_html__('Header Topbar switch On/Off', 'biddut'),
            'section' => 'header_top_section',
            'default' => 'off',
            'choices' => [
                'on' => esc_html__('Enable', 'biddut'),
                'off' => esc_html__('Disable', 'biddut'),
            ],
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'header_right_switch',
            'label' => esc_html__('Header Right Switch', 'biddut'),
            'description' => esc_html__('Header Right switch On/Off', 'biddut'),
            'section' => 'header_top_section',
            'default' => 'off',
            'choices' => [
                'on' => esc_html__('Enable', 'biddut'),
                'off' => esc_html__('Disable', 'biddut'),
            ],
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'header_preloader_switch',
            'label' => esc_html__('Header Preloader Switch', 'biddut'),
            'description' => esc_html__('Header Preloader switch On/Off', 'biddut'),
            'section' => 'header_top_section',
            'default' => 'off',
            'choices' => [
                'on' => esc_html__('Enable', 'biddut'),
                'off' => esc_html__('Disable', 'biddut'),
            ],
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'header_search_switch',
            'label' => esc_html__('Header Search Switch', 'biddut'),
            'description' => esc_html__('Header Search switch On/Off', 'biddut'),
            'section' => 'header_top_section',
            'default' => 'off',
            'choices' => [
                'on' => esc_html__('Enable', 'biddut'),
                'off' => esc_html__('Disable', 'biddut'),
            ],
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'header_auth_switch',
            'label' => esc_html__('Header Auth Switch', 'biddut'),
            'description' => esc_html__('Header Auth switch On/Off', 'biddut'),
            'section' => 'header_top_section',
            'default' => 'on',
            'choices' => [
                'on' => esc_html__('Enable', 'biddut'),
                'off' => esc_html__('Disable', 'biddut'),
            ],
        ]
    );


    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'header_backtotop_switch',
            'label' => esc_html__('Header Back to Top Switch', 'biddut'),
            'description' => esc_html__('Header Back to Top switch On/Off', 'biddut'),
            'section' => 'header_top_section',
            'default' => 'off',
            'choices' => [
                'on' => esc_html__('Enable', 'biddut'),
                'off' => esc_html__('Disable', 'biddut'),
            ],
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'header_top_button_switch',
            'label' => esc_html__('Header Top Button On/Off', 'biddut'),
            'description' => esc_html__('Header Top Button switch On/Off', 'biddut'),
            'section' => 'header_top_section',
            'default' => 'off',
            'choices' => [
                'on' => esc_html__('Enable', 'biddut'),
                'off' => esc_html__('Disable', 'biddut'),
            ],
        ]
    );


    new \Kirki\Field\Text(
        [
            'settings' => 'header_button_text',
            'label' => esc_html__('Button Text', 'biddut'),
            'section' => 'header_top_section',
            'default' => esc_html__('MAKE APPOINMENT', 'biddut'),
            'priority' => 10,
        ]
    );

    new \Kirki\Field\URL(
        [
            'settings' => 'header_button_link',
            'label' => esc_html__('Button URL', 'biddut'),
            'section' => 'header_top_section',
            'default' => '#',
            'priority' => 10,
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'header_phone',
            'label' => esc_html__('Phone Number', 'biddut'),
            'section' => 'header_top_section',
            'default' => esc_html__('++99 (786) 8765', 'biddut'),
            'priority' => 10,
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'header_email',
            'label' => esc_html__('Email ID', 'biddut'),
            'section' => 'header_top_section',
            'default' => esc_html__('biddut@support.com', 'biddut'),
            'priority' => 10,
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'header_address',
            'label' => esc_html__('Address Text', 'biddut'),
            'section' => 'header_top_section',
            'default' => esc_html__('76 San Fransisco Street. New York', 'biddut'),
            'priority' => 10,
        ]
    );

    new \Kirki\Field\URL(
        [
            'settings' => 'header_address_link',
            'label' => esc_html__('Address URL', 'biddut'),
            'section' => 'header_top_section',
            'default' => 'https://www.google.com/maps/@36.0758266,-79.4558848,17z',
            'priority' => 10,
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'header_top_time',
            'label' => esc_html__('Header top time', 'biddut'),
            'section' => 'header_top_section',
            'default' => 'Sunday - Friday: 9 am - 8 pm',
            'priority' => 10,
        ]
    );
    new \Kirki\Field\textarea(
        [
            'settings' => 'header_top_menu',
            'label' => esc_html__('Header top menu', 'biddut'),
            'section' => 'header_top_section',
            'default' => esc_html__('#', 'biddut'),
            'priority' => 10,
        ]
    );


}
header_top_section();


// header_side_section
function header_side_section()
{
    // header_top_bar section 
    new \Kirki\Section(
        'header_side_section',
        [
            'title' => esc_html__('Header Side Info', 'biddut'),
            'description' => esc_html__('Header Side Information.', 'biddut'),
            'panel' => 'panel_id',
            'priority' => 110,
        ]
    );
    // header_side_section section 

    // header_side_logo_section 
    new \Kirki\Field\Image(
        [
            'settings' => 'header_side_logo',
            'label' => esc_html__('Header Side Logo', 'biddut'),
            'description' => esc_html__('Header Side Default/Primary Logo Here', 'biddut'),
            'section' => 'header_side_section',
            'default' => get_template_directory_uri() . '/assets/img/logo/white-logo.png',
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'header_side_info_switch',
            'label' => esc_html__('Header Side Info Switch', 'biddut'),
            'description' => esc_html__('Header Side Info switch On/Off', 'biddut'),
            'section' => 'header_side_section',
            'default' => 'off',
            'choices' => [
                'on' => esc_html__('Enable', 'biddut'),
                'off' => esc_html__('Disable', 'biddut'),
            ],
        ]
    );

    new \Kirki\Field\Textarea(
        [
            'settings' => 'header_top_offcanvas_textarea',
            'label' => esc_html__('Offcanvas About Us', 'biddut'),
            'section' => 'header_side_section',
            'default' => esc_html__('Web designing in a powerful way of just not an only professions. We have tendency to believe the idea that smart looking .', 'biddut'),
        ]
    );

    // Contacts Text 
    new \Kirki\Field\Text(
        [
            'settings' => 'header_side_contacts_text',
            'label' => esc_html__('Contacts Text', 'biddut'),
            'section' => 'header_side_section',
            'default' => esc_html__('CONTACT US', 'biddut'),
            'priority' => 10,
        ]
    );

     new \Kirki\Field\Text(
        [
            'settings' => 'header_side_phone',
            'label' => esc_html__('Phone Number', 'biddut'),
            'section' => 'header_top_section',
            'default' => esc_html__('+88 01310-069824', 'biddut'),
            'priority' => 10,
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'header_side_email',
            'label' => esc_html__('Email ID', 'biddut'),
            'section' => 'header_top_section',
            'default' => esc_html__('biddut@support.com', 'biddut'),
            'priority' => 10,
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'header_side_address',
            'label' => esc_html__('Address Text', 'biddut'),
            'section' => 'header_top_section',
            'default' => esc_html__('76 San Fransisco Street. New York', 'biddut'),
            'priority' => 10,
        ]
    );

    new \Kirki\Field\URL(
        [
            'settings' => 'header_side_address_link',
            'label' => esc_html__('Address URL', 'biddut'),
            'section' => 'header_top_section',
            'default' => 'https://www.google.com/maps/@36.0758266,-79.4558848,17z',
            'priority' => 10,
        ]
    );
    new \Kirki\Field\URL(
        [
            'settings' => 'header_side_mailchimp',
            'label' => esc_html__('Shortcode Here', 'biddut'),
            'section' => 'header_top_section',
            'default' => '[contact-form-7 id="a429561" title="Untitled"]',
            'priority' => 10,
        ]
    );


}
header_side_section();

// header_social_section
function header_social_section()
{
    // header_top_bar section 
    new \Kirki\Section(
        'header_social_section',
        [
            'title' => esc_html__('Social Area', 'biddut'),
            'description' => esc_html__('Social URL.', 'biddut'),
            'panel' => 'panel_id',
            'priority' => 120,
        ]
    );
    // header_top_bar section 

    new \Kirki\Field\URL(
        [
            'settings' => 'header_facebook_link',
            'label' => esc_html__('Facebook URL', 'biddut'),
            'section' => 'header_social_section',
            'default' => '#',
            'priority' => 10,
        ]
    );

    new \Kirki\Field\URL(
        [
            'settings' => 'header_twitter_link',
            'label' => esc_html__('Twitter URL', 'biddut'),
            'section' => 'header_social_section',
            'default' => '#',
            'priority' => 10,
        ]
    );

    new \Kirki\Field\URL(
        [
            'settings' => 'header_linkedin_link',
            'label' => esc_html__('Linkedin URL', 'biddut'),
            'section' => 'header_social_section',
            'default' => '#',
            'priority' => 10,
        ]
    );

    new \Kirki\Field\URL(
        [
            'settings' => 'header_instagram_link',
            'label' => esc_html__('Instagram URL', 'biddut'),
            'section' => 'header_social_section',
            'default' => '#',
            'priority' => 10,
        ]
    );

    new \Kirki\Field\URL(
        [
            'settings' => 'header_youtube_link',
            'label' => esc_html__('Youtube URL', 'biddut'),
            'section' => 'header_social_section',
            'default' => '#',
            'priority' => 10,
        ]
    );

    new \Kirki\Field\URL(
        [
            'settings' => 'header_fb_link',
            'label' => esc_html__('Facebook URL', 'biddut'),
            'section' => 'header_social_section',
            'default' => '#',
            'priority' => 10,
        ]
    );

}
header_social_section();

// header_logo_section
function header_logo_section()
{
    // header_logo_section section 
    new \Kirki\Section(
        'header_logo_section',
        [
            'title' => esc_html__('Header Logo', 'biddut'),
            'description' => esc_html__('Header Logo Settings.', 'biddut'),
            'panel' => 'panel_id',
            'priority' => 130,
        ]
    );

    // header_logo_section section 
    new \Kirki\Field\Image(
        [
            'settings' => 'header_logo',
            'label' => esc_html__('Header Logo', 'biddut'),
            'description' => esc_html__('Theme Default/Primary Logo Here', 'biddut'),
            'section' => 'header_logo_section',
            'default' => get_template_directory_uri() . '/assets/img/logo/white-logo.png',
        ]
    );
    new \Kirki\Field\Image(
        [
            'settings' => 'header_secondary_logo',
            'label' => esc_html__('Header Secondary Logo / White', 'biddut'),
            'description' => esc_html__('Theme Secondary Logo Here', 'biddut'),
            'section' => 'header_logo_section',
            'default' => get_template_directory_uri() . '/assets/img/logo/black-logo.png',
        ]
    );
    new \Kirki\Field\Image(
        [
            'settings' => 'header_search_logo',
            'label' => esc_html__('Header Search Logo', 'biddut'),
            'description' => esc_html__('Theme Search Logo Here', 'biddut'),
            'section' => 'header_logo_section',
            'default' => get_template_directory_uri() . '/assets/img/logo/white-logo.png',
        ]
    );

    new \Kirki\Field\Image(
        [
            'settings' => 'preloader_logo',
            'label' => esc_html__('Preloader Icon', 'biddut'),
            'description' => esc_html__('Preloader Icon Logo Here', 'biddut'),
            'section' => 'header_logo_section',
            'default' => get_template_directory_uri() . '/assets/img/logo/preloder.png',
        ]
    );
}
header_logo_section();

// header_logo_section
function header_breadcrumb_section()
{
    // header_logo_section section 
    new \Kirki\Section(
        'header_breadcrumb_section',
        [
            'title' => esc_html__('Breadcrumb', 'biddut'),
            'description' => esc_html__('Breadcrumb Settings.', 'biddut'),
            'panel' => 'panel_id',
            'priority' => 160,
        ]
    );

      

    // header_logo_section section 
    new \Kirki\Field\Image(
        [
            'settings' => 'breadcrumb_image',
            'label' => esc_html__('Breadcrumb Image', 'biddut'),
            'description' => esc_html__('Breadcrumb Image add/remove', 'biddut'),
            'section' => 'header_breadcrumb_section',
        ]
    );

     new \Kirki\Field\Text(
        [
            'settings' => 'breadcrumb_subtitle',
            'label' => esc_html__('Subtitle Text', 'biddut'),
            'section' => 'header_breadcrumb_section',
            'default' => esc_html__('BIDDUT ELCETRIC SERVICE', 'biddut'),
            'priority' => 10,
        ]
    );


    new \Kirki\Field\Color(
        [
            'settings' => 'breadcrumb_bg_color',
            'label' => __('Breadcrumb BG Color', 'biddut'),
            'description' => esc_html__('You can change breadcrumb bg color from here.', 'biddut'),
            'section' => 'header_breadcrumb_section',
            'default' => '#f3fbfe',
        ]
    );

    new \Kirki\Field\Dimensions(
        [
            'settings' => 'breadcrumb_padding',
            'label' => __('Padding', 'exdos'),
            'section' => 'header_breadcrumb_section',
            'responsive' => true,
            'default' => [
                'desktop' => [
                    'padding-top' => '240px',
                    'padding-bottom' => '140px',
                ],
                'tablet' => [
                    'padding-top' => '240px',
                    'padding-bottom' => '140px',
                ],
                'mobile' => [
                    'padding-top' => '190px',
                    'padding-bottom' => '100px',
                ],
            ],
            'output' => [
                [
                    'element' => '.breadcrumb__area',
                    'media_query' => [
                        'desktop' => '@media (min-width: 1024px)',
                        'tablet' => '@media (min-width: 768px) and (max-width: 1023px)',
                        'mobile' => '@media (max-width: 767px)',
                    ],
                ],
            ],
        ]
    );

    new \Kirki\Field\Typography(
        [
            'settings' => 'breadcrumb_typography',
            'label' => esc_html__('Typography Control', 'biddut'),
            'description' => esc_html__('The full set of options.', 'biddut'),
            'section' => 'header_breadcrumb_section',
            'priority' => 10,
            'transport' => 'auto',
            'default' => [
                'font-family' => '',
                'variant' => '',
                'color' => '',
                'font-size' => '',
                'line-height' => '',
                'text-align' => '',
            ],
            'output' => [
                [
                    'element' => '.tpbreadcrumb-title',
                ],
            ],
        ]
    );


}
header_breadcrumb_section();

// header_logo_section
function full_site_typography()
{
    // header_logo_section section 
    new \Kirki\Section(
        'full_site_typography',
        [
            'title' => esc_html__('Typography', 'biddut'),
            'description' => esc_html__('Typography Settings.', 'biddut'),
            'panel' => 'panel_id',
            'priority' => 190,
        ]
    );

    new \Kirki\Field\Typography(
        [
            'settings' => 'biddut_typo_body',
            'label' => esc_html__('Typography Body Text', 'biddut'),
            'description' => esc_html__('Body Typography Control.', 'biddut'),
            'section' => 'full_site_typography',
            'priority' => 10,
            'transport' => 'auto',
            'default' => [
                'font-family' => '',
                'variant' => '',
                'color' => '',
                'font-size' => '',
                'line-height' => '',
                'text-align' => '',
            ],
            'output' => [
                [
                    'element' => 'body',
                ],
            ],
        ]
    );

    new \Kirki\Field\Typography(
        [
            'settings' => 'biddut_typo_h1',
            'label' => esc_html__('Typography Heading 1 Font', 'biddut'),
            'description' => esc_html__('H1 Typography Control.', 'biddut'),
            'section' => 'full_site_typography',
            'priority' => 10,
            'transport' => 'auto',
            'default' => [
                'font-family' => '',
                'variant' => '',
                'color' => '',
                'font-size' => '',
                'line-height' => '',
                'text-align' => '',
            ],
            'output' => [
                [
                    'element' => 'h1',
                ],
            ],
        ]
    );


    new \Kirki\Field\Typography(
        [
            'settings' => 'biddut_typo_h2',
            'label' => esc_html__('Typography Heading 2 Font', 'biddut'),
            'description' => esc_html__('H2 Typography Control.', 'biddut'),
            'section' => 'full_site_typography',
            'priority' => 10,
            'transport' => 'auto',
            'default' => [
                'font-family' => '',
                'variant' => '',
                'color' => '',
                'font-size' => '',
                'line-height' => '',
                'text-align' => '',
            ],
            'output' => [
                [
                    'element' => 'h2',
                ],
            ],
        ]
    );


    new \Kirki\Field\Typography(
        [
            'settings' => 'biddut_typo_h3',
            'label' => esc_html__('Typography Heading 3 Font', 'biddut'),
            'description' => esc_html__('H3 Typography Control.', 'biddut'),
            'section' => 'full_site_typography',
            'priority' => 10,
            'transport' => 'auto',
            'default' => [
                'font-family' => '',
                'variant' => '',
                'color' => '',
                'font-size' => '',
                'line-height' => '',
                'text-align' => '',
            ],
            'output' => [
                [
                    'element' => 'h3',
                ],
            ],
        ]
    );


    new \Kirki\Field\Typography(
        [
            'settings' => 'biddut_typo_h4',
            'label' => esc_html__('Typography Heading 4 Font', 'biddut'),
            'description' => esc_html__('H4 Typography Control.', 'biddut'),
            'section' => 'full_site_typography',
            'priority' => 10,
            'transport' => 'auto',
            'default' => [
                'font-family' => '',
                'variant' => '',
                'color' => '',
                'font-size' => '',
                'line-height' => '',
                'text-align' => '',
            ],
            'output' => [
                [
                    'element' => 'h4',
                ],
            ],
        ]
    );


    new \Kirki\Field\Typography(
        [
            'settings' => 'biddut_typo_h5',
            'label' => esc_html__('Typography Heading 5 Font', 'biddut'),
            'description' => esc_html__('H5 Typography Control.', 'biddut'),
            'section' => 'full_site_typography',
            'priority' => 10,
            'transport' => 'auto',
            'default' => [
                'font-family' => '',
                'variant' => '',
                'color' => '',
                'font-size' => '',
                'line-height' => '',
                'text-align' => '',
            ],
            'output' => [
                [
                    'element' => 'h5',
                ],
            ],
        ]
    );


    new \Kirki\Field\Typography(
        [
            'settings' => 'biddut_typo_h6',
            'label' => esc_html__('Typography Heading 6 Font', 'biddut'),
            'description' => esc_html__('H6 Typography Control.', 'biddut'),
            'section' => 'full_site_typography',
            'priority' => 10,
            'transport' => 'auto',
            'default' => [
                'font-family' => '',
                'variant' => '',
                'color' => '',
                'font-size' => '',
                'line-height' => '',
                'text-align' => '',
            ],
            'output' => [
                [
                    'element' => 'h6',
                ],
            ],
        ]
    );

    new \Kirki\Field\Typography(
        [
            'settings' => 'full_site_typography_settings',
            'label' => esc_html__('Typography Control', 'biddut'),
            'description' => esc_html__('The full set of options.', 'biddut'),
            'section' => 'full_site_typography',
            'priority' => 10,
            'transport' => 'auto',
            'default' => [
                'font-family' => '',
                'variant' => '',
                'color' => '',
                'font-size' => '',
                'line-height' => '',
                'text-align' => '',
            ],
            'output' => [
                [
                    'element' => '.tpbreadcrumb-title',
                ],
            ],
        ]
    );
}
full_site_typography();

// header_logo_section
function footer_layout_section()
{
    // header_logo_section section 
    new \Kirki\Section(
        'footer_layout_section',
        [
            'title' => esc_html__('Footer', 'biddut'),
            'description' => esc_html__('Footer Settings.', 'biddut'),
            'panel' => 'panel_id',
            'priority' => 190,
        ]
    );
    // footer_widget_number section 
    new \Kirki\Field\Select(
        [
            'settings' => 'footer_widget_number',
            'label' => esc_html__('Footer Widget Number', 'biddut'),
            'section' => 'footer_layout_section',
            'default' => '4',
            'placeholder' => esc_html__('Choose an option', 'biddut'),
            'choices' => [
                '1' => esc_html__('1', 'biddut'),
                '2' => esc_html__('2', 'biddut'),
                '3' => esc_html__('3', 'biddut'),
                '4' => esc_html__('4', 'biddut'),
            ],
        ]
    );

    new \Kirki\Field\Radio_Image(
        [
            'settings' => 'footer_layout',
            'label' => esc_html__('Footer Layout Control', 'biddut'),
            'section' => 'footer_layout_section',
            'priority' => 10,
            'choices' => [
                'footer_1' => get_template_directory_uri() . '/inc/img/footer/footer-1.png',
                'footer_2' => get_template_directory_uri() . '/inc/img/footer/footer-2.png',
                'footer_3' => get_template_directory_uri() . '/inc/img/footer/footer-3.png',
            ],
            'default' => 'footer_1',
        ]
    );

    // footer_layout_section section 
    new \Kirki\Field\Image(
        [
            'settings' => 'footer_bg_image',
            'label' => esc_html__('Footer BG Image', 'biddut'),
            'description' => esc_html__('Footer Image add/remove', 'biddut'),
            'section' => 'footer_layout_section',
        ]
    );

    // footer_layout_section section 

    new \Kirki\Field\Color(
        [
            'settings' => 'footer_bg_color',
            'label' => __('Footer BG Color', 'biddut'),
            'description' => esc_html__('You can change footer bg color from here.', 'biddut'),
            'section' => 'footer_layout_section',
            'default' => '#16243e',
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'footer_layout_2_switch',
            'label' => esc_html__('Footer Style 2 Switch', 'biddut'),
            'description' => esc_html__('Footer Style 2 On/Off', 'biddut'),
            'section' => 'footer_layout_section',
            'default' => 'on',
            'choices' => [
                'on' => esc_html__('Enable', 'biddut'),
                'off' => esc_html__('Disable', 'biddut'),
            ],
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'footer_layout_3_switch',
            'label' => esc_html__('Footer Style 3 Switch', 'biddut'),
            'description' => esc_html__('Footer Style 3 On/Off', 'biddut'),
            'section' => 'footer_layout_section',
            'default' => 'on',
            'choices' => [
                'on' => esc_html__('Enable', 'biddut'),
                'off' => esc_html__('Disable', 'biddut'),
            ],
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'footer_copyright_switch',
            'label' => esc_html__('Footer Copyright On/Off', 'biddut'),
            'section' => 'footer_layout_section',
            'default' => true,
            'priority' => 10,
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'footer_copyright',
            'label' => esc_html__('Footer Copyright', 'biddut'),
            'section' => 'footer_layout_section',
            'default' => esc_html__('Copyright &copy; 2024 Theme_Pure. All Rights Reserved', 'biddut'),
            'priority' => 10,
        ]
    );


    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'footer_social_switch',
            'label' => esc_html__('Footer Social On / Off', 'biddut'),
            'section' => 'footer_layout_section',
            'default' => false,
            'priority' => 10,
        ]
    );


    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'footer_bottom_copyright_area_switch',
            'label' => esc_html__('Footer Bottom  Copyright Area On/Off', 'biddut'),
            'section' => 'footer_layout_section',
            'default' => true,
            'priority' => 10,
        ]
    );
    new \Kirki\Field\textarea(
        [
            'settings' => 'footer_bottom_menu',
            'label' => esc_html__('Footer Bottom Menu', 'biddut'),
            'section' => 'footer_layout_section',
            'default' => esc_html__('Footer Bottom menu', 'biddut'),
            'priority' => 10,
        ]
    );
    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'footer_cta_switch',
            'label' => esc_html__('Footer Cta On / Off', 'biddut'),
            'section' => 'footer_layout_section',
            'default' => false,
            'priority' => 10,
        ]
    );

    new \Kirki\Field\text(
        [
            'settings' => 'footer_top_cta_title',
            'label' => esc_html__('Footer Top Cta Title', 'biddut'),
            'section' => 'footer_layout_section',
            'default' => esc_html__('Footer Top Cta Title', 'biddut'),
            'priority' => 10,
        ]
    );

    new \Kirki\Field\textarea(
        [
            'settings' => 'footer_top_cta',
            'label' => esc_html__('Footer Top Cta', 'biddut'),
            'section' => 'footer_layout_section',
            'default' => esc_html__('Footer Top Cta', 'biddut'),
            'priority' => 10,
        ]
    );


}
footer_layout_section();

// blog_section
function blog_section()
{
    // blog_section section 
    new \Kirki\Section(
        'blog_section',
        [
            'title' => esc_html__('Blog Section', 'biddut'),
            'description' => esc_html__('Blog Section Settings.', 'biddut'),
            'panel' => 'panel_id',
            'priority' => 150,
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'biddut_blog_btn_switch',
            'label' => esc_html__('Blog BTN On/Off', 'biddut'),
            'section' => 'blog_section',
            'default' => true,
            'priority' => 10,
        ]
    );

    // blog_section BTN 
    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'biddut_blog_cat',
            'label' => esc_html__('Blog Category Meta On/Off', 'biddut'),
            'section' => 'blog_section',
            'default' => false,
            'priority' => 10,
        ]
    );

    // blog_section Author Meta 
    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'biddut_blog_author',
            'label' => esc_html__('Blog Author Meta On/Off', 'biddut'),
            'section' => 'blog_section',
            'default' => true,
            'priority' => 10,
        ]
    );
    // blog_section Date Meta 
    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'biddut_blog_date',
            'label' => esc_html__('Blog Date Meta On/Off', 'biddut'),
            'section' => 'blog_section',
            'default' => true,
            'priority' => 10,
        ]
    );

    // blog_section Comments Meta 
    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'biddut_blog_comments',
            'label' => esc_html__('Blog Comments Meta On/Off', 'biddut'),
            'section' => 'blog_section',
            'default' => true,
            'priority' => 10,
        ]
    );


    // blog_section Blog BTN text 
    new \Kirki\Field\Text(
        [
            'settings' => 'biddut_blog_btn',
            'label' => esc_html__('Blog Button Text', 'biddut'),
            'section' => 'blog_section',
            'default' => "Read More",
            'priority' => 10,
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'biddut_singleblog_social',
            'label' => esc_html__('Single Blog Social Share', 'biddut'),
            'section' => 'blog_section',
            'default' => false,
            'priority' => 10,
        ]
    );

}
blog_section();


// 404 section
function error_404_section()
{
    // 404_section section 
    new \Kirki\Section(
        'error_404_section',
        [
            'title' => esc_html__('404 Page', 'biddut'),
            'description' => esc_html__('404 Page Settings.', 'biddut'),
            'panel' => 'panel_id',
            'priority' => 150,
        ]
    );


    // 404_section 
    new \Kirki\Field\Text(
        [
            'settings' => 'biddut_error_title',
            'label' => esc_html__('Not Found Title', 'biddut'),
            'section' => 'error_404_section',
            'default' => "Sorry We Can't Find That Page! ",
            'priority' => 10,
        ]
    );

    // 404_section 
    new \Kirki\Field\Text(
        [
            'settings' => 'biddut_error_404',
            'label' => esc_html__('Not Found 404', 'biddut'),
            'section' => 'error_404_section',
            'default' => "404",
            'priority' => 10,
        ]
    );
    // 404_section 
    new \Kirki\Field\Text(
        [
            'settings' => 'biddut_error_text',
            'label' => esc_html__('Not Found 404', 'biddut'),
            'section' => 'error_404_section',
            'default' => "Oops! The page you are looking for does not exist. It might have been moved or deleted.",
            'priority' => 10,
        ]
    );




    // 404_section description
    new \Kirki\Field\Text(
        [
            'settings' => 'biddut_error_link_text',
            'label' => esc_html__('Error Link Text', 'biddut'),
            'section' => 'error_404_section',
            'default' => "Back To Home",
            'priority' => 10,
        ]
    );


}
error_404_section();

// theme color section
function theme_color_section()
{
    new \Kirki\Section(
        'theme_color_section',
        [
            'title' => esc_html__('Theme Color', 'biddut'),
            'description' => esc_html__('Biddut theme color Settings.', 'biddut'),
            'panel' => 'panel_id',
            'priority' => 150,
        ]
    );
    new \Kirki\Field\Color(
        [
            'settings' => 'biddut_color_1',
            'label' => __('Theme Color 1', 'biddut'),
            'description' => esc_html__('this is theme color 1 control.', 'biddut'),
            'section' => 'theme_color_section',
            'default' => '#00A3C3',
        ]
    );
    new \Kirki\Field\Color(
        [
            'settings' => 'biddut_color_2',
            'label' => __('Theme Color 2', 'biddut'),
            'description' => esc_html__('this is theme color 2 control.', 'biddut'),
            'section' => 'theme_color_section',
            'default' => '#16243E',
        ]
    );
    new \Kirki\Field\Color(
        [
            'settings' => 'biddut_gra_color_1',
            'label' => __('Gradient Color 1', 'biddut'),
            'description' => esc_html__('this is theme gradient 1 color control.', 'biddut'),
            'section' => 'theme_color_section',
            'default' => '#004D6E',
        ]
    );
    new \Kirki\Field\Color(
        [
            'settings' => 'biddut_gra_color_2',
            'label' => __('Gradient Color 2', 'biddut'),
            'description' => esc_html__('this is theme gradient 2 color control.', 'biddut'),
            'section' => 'theme_color_section',
            'default' => '#00ACCC',
        ]
    );
    new \Kirki\Field\Color(
        [
            'settings' => 'biddut_body',
            'label' => __('Body Text Color', 'biddut'),
            'description' => esc_html__('this is theme body text color control.', 'biddut'),
            'section' => 'theme_color_section',
            'default' => '#333F4D',
        ]
    );
}
theme_color_section();