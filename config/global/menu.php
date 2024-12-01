<?php

return array(
    // Documentation menu
    'documentation' => array(
        // Getting Started
        array(
            'heading' => 'Getting Started',
        ),

        // Overview
        array(
            'title' => 'Overview',
            'path'  => 'documentation/getting-started/overview',
            // 'role' => ['admin'],
            // 'permission' => [],
        ),

        // Build
        array(
            'title' => 'Build',
            'path'  => 'documentation/getting-started/build',
        ),

        array(
            'title'      => 'Multi-demo',
            'attributes' => array("data-kt-menu-trigger" => "click"),
            'classes'    => array('item' => 'menu-accordion'),
            'sub'        => array(
                'class' => 'menu-sub-accordion',
                'items' => array(
                    array(
                        'title'  => 'Overview',
                        'path'   => 'documentation/getting-started/multi-demo/overview',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                    array(
                        'title'  => 'Build',
                        'path'   => 'documentation/getting-started/multi-demo/build',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                ),
            ),
        ),

        // File Structure
        array(
            'title' => 'File Structure',
            'path'  => 'documentation/getting-started/file-structure',
        ),

        // Customization
        array(
            'title'      => 'Customization',
            'attributes' => array("data-kt-menu-trigger" => "click"),
            'classes'    => array('item' => 'menu-accordion'),
            'sub'        => array(
                'class' => 'menu-sub-accordion',
                'items' => array(
                    array(
                        'title'  => 'SASS',
                        'path'   => 'documentation/getting-started/customization/sass',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                    array(
                        'title'  => 'Javascript',
                        'path'   => 'documentation/getting-started/customization/javascript',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                ),
            ),
        ),

        // Dark skin
        array(
            'title' => 'Dark Mode Version',
            'path'  => 'documentation/getting-started/dark-mode',
        ),

        // RTL
        array(
            'title' => 'RTL Version',
            'path'  => 'documentation/getting-started/rtl',
        ),

        // Troubleshoot
        array(
            'title' => 'Troubleshoot',
            'path'  => 'documentation/getting-started/troubleshoot',
        ),

        // Changelog
        array(
            'title'            => 'Changelog <span class="badge badge-changelog badge-light-danger bg-hover-danger text-hover-white fw-bold fs-9 px-2 ms-2">v'.theme()->getVersion().'</span>',
            'breadcrumb-title' => 'Changelog',
            'path'             => 'documentation/getting-started/changelog',
        ),

        // References
        array(
            'title' => 'References',
            'path'  => 'documentation/getting-started/references',
        ),


        // Separator
        array(
            'custom' => '<div class="h-30px"></div>',
        ),

        // Configuration
        array(
            'heading' => 'Configuration',
        ),

        // General
        array(
            'title' => 'General',
            'path'  => 'documentation/configuration/general',
        ),

        // Menu
        array(
            'title' => 'Menu',
            'path'  => 'documentation/configuration/menu',
        ),

        // Page
        array(
            'title' => 'Page',
            'path'  => 'documentation/configuration/page',
        ),

        // Page
        array(
            'title' => 'Add NPM Plugin',
            'path'  => 'documentation/configuration/npm-plugins',
        ),


        // Separator
        array(
            'custom' => '<div class="h-30px"></div>',
        ),

        // General
        array(
            'heading' => 'General',
        ),

        // DataTables
        array(
            'title'      => 'DataTables',
            'classes'    => array('item' => 'menu-accordion'),
            'attributes' => array("data-kt-menu-trigger" => "click"),
            'sub'        => array(
                'class' => 'menu-sub-accordion',
                'items' => array(
                    array(
                        'title'  => 'Overview',
                        'path'   => 'documentation/general/datatables/overview',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                ),
            ),
        ),
    ),

    // Main menu
    'main'          => array(
        //// Dashboard
        array(
            'title' => 'Dashboard',
            'path'  => '',
            'icon'  => theme()->getSvgIcon("demo8/media/icons/duotune/art/art002.svg", "svg-icon-2"),
        ),

//        //// Modules
//        array(
//            'classes' => array('content' => 'pt-8 pb-2'),
//            'content' => '<span class="menu-section text-muted text-uppercase fs-8 ls-1">Modules</span>',
//        ),

        // Account
        array(
            'title'      => 'Shipping Options',
            'icon'       => array(
                'svg'  => theme()->getSvgIcon("demo8/media/icons/duotune/communication/com006.svg", "svg-icon-2"),
                'font' => '<i class="bi bi-person fs-2"></i>',
            ),
            'classes'    => array('item' => 'menu-accordion'),
            'attributes' => array(
                "data-kt-menu-trigger" => "click",
            ),
            'sub'        => array(
                'class' => 'menu-sub-accordion menu-active-bg',
                'items' => array(
                    array(
                        'title'  => 'Manage Shipments',
                        'path'   => 'shipments',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                    array(
                        'title'  => 'New Shipment',
                        'path'   => 'shipments/create',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                    array(
                        'title'  => 'Get Courier Qoute',
                        'path'   => 'shipping/quote',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                    array(
                        'title'  => 'Shipment Summary Report',
                        'path'   => 'shipping/summary',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                ),
            ),
        ),

        array(
            'title' => 'Invoicing',
            'icon'       => array(
                'svg'  => theme()->getSvgIcon("demo8/media/icons/duotune/ecommerce/invoice.svg", "svg-icon-2"),
                'font' => '<i class="bi bi-person fs-2"></i>',
            ),
            'classes'    => array('item' => 'menu-accordion'),
            'attributes' => array(
                "data-kt-menu-trigger" => "click",
            ),
            'sub' => array(
                'class' => 'menu-sub-accordion menu-active-bg',
                'items' => array(
                    array(
                        'title'  => 'Pay Invoices',
                        'path'   => 'invoices/pay',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                    array(
                        'title'  => 'View Invoices',
                        'path'   => 'invoices',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                    array(
                        'title'  => 'Statement',
                        'path'   => 'invoices/statements',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                    array(
                        'title'  => 'Credit Card',
                        'path'   => 'invoices/statements',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                )
            )
        ),

        array(
            'classes' => array('content' => 'pt-8 pb-2'),
            'content' => '<span class="menu-section text-muted text-uppercase fs-8 ls-1">Pickup Options</span>',
        ),
        array(
            'title'  => 'Schedule a Pickup',
            'path'   => 'pickups/create',
            'bullet' => '<span class="bullet bullet-dot"></span>',
        ),
        array(
            'title'  => 'View Your Pickups',
            'path'   => 'pickups',
            'bullet' => '<span class="bullet bullet-dot"></span>',
        ),
        array(
            'classes' => array('content' => 'pt-8 pb-2'),
            'content' => '<span class="menu-section text-muted text-uppercase fs-8 ls-1">Address, Product and Package Books</span>',
        ),
        array(
            'title' => 'Products',
            'path' => 'products',
            'icon'       => array(
                'svg'  => theme()->getSvgIcon("demo8/media/icons/duotune/ecommerce/ecm004.svg", "svg-icon-2"),
                'font' => '<i class="bi bi-person fs-2"></i>',
            ),
        ),

        array(
            'title' => 'Packages',
            'path' => 'packages',
            'icon'       => array(
                'svg'  => theme()->getSvgIcon("demo8/media/icons/duotune/ecommerce/ecm006.svg", "svg-icon-2"),
                'font' => '<i class="bi bi-person fs-2"></i>',
            ),
        ),

        array(
            'title' => 'Address Books',
            'path' => 'address-groups',
            'icon'       => array(
                'svg'  => theme()->getSvgIcon("demo8/media/icons/duotune/communication/com005.svg", "svg-icon-2"),
                'font' => '<i class="bi bi-person fs-2"></i>',
            )
        ),

        array(
            'classes' => array('content' => 'pt-8 pb-2'),
            'content' => '<span class="menu-section text-muted text-uppercase fs-8 ls-1">Contact Us</span>',
        ),
        array(
            'title'  => 'Order Supplies',
            'path'   => 'order-supplies',
            'icon'       => array(
                'svg'  => theme()->getSvgIcon("demo8/media/icons/duotune/general/gen065.svg", "svg-icon-2"),
                'font' => '<i class="bi bi-person fs-2"></i>',
            ),
        ),
        array(
            'title'  => 'Import Quote',
            'path'   => 'import-quotes',
            'icon'       => array(
                'svg'  => theme()->getSvgIcon("demo8/media/icons/duotune/general/gen065.svg", "svg-icon-2"),
                'font' => '<i class="bi bi-person fs-2"></i>',
            ),
        ),
        array(
            'title'  => 'Feedback',
            'path'   => 'feedback',
            'icon'       => array(
                'svg'  => theme()->getSvgIcon("demo8/media/icons/duotune/general/gen016.svg", "svg-icon-2"),
                'font' => '<i class="bi bi-person fs-2"></i>',
            ),
        ),
    ),

    // Horizontal menu
    'horizontal'    => array(
//        // Dashboard
//        array(
//            'title'   => 'Dashboard',
//            'path'    => '',
//            'classes' => array('item' => 'me-lg-1'),
//        ),
    ),
);
