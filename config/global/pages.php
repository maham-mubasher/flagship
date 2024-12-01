<?php
return array(
    '' => array(
        'title'       => 'Dashboard',
        'description' => '',
        'view'        => 'index',
        'layout'      => array(
            'page-title' => array(
                'description' => true,
                'breadcrumb'  => false,
            ),
        ),
        'assets'      => array(
            'custom'  => array(
                'js' => array(
                    'js/widgets.bundle.js',
                ),
            ),
            'vendors' => array('fullcalendar', 'amcharts', 'amcharts-maps'),
        ),
    ),

    'login'           => array(
        'title'  => 'Login',
        'assets' => array(
            'custom' => array(
                'js' => array(
                    'js/custom/authentication/sign-in/general.js',
                ),
            ),
        ),
        'layout' => array(
            'main' => array(
                'type' => 'blank', // Set blank layout
                'body' => array(
                    'class' => theme()->isDarkMode() ? '' : 'bg-body',
                ),
            ),
        ),
    ),
    'register'        => array(
        'title'  => 'Register',
        'assets' => array(
            'custom' => array(
                'js' => array(
                    'js/custom/authentication/sign-up/general.js',
                ),
            ),
        ),
        'layout' => array(
            'main' => array(
                'type' => 'blank', // Set blank layout
                'body' => array(
                    'class' => theme()->isDarkMode() ? '' : 'bg-body',
                ),
            ),
        ),
    ),
    'forgot-password' => array(
        'title'  => 'Forgot Password',
        'assets' => array(
            'custom' => array(
                'js' => array(
                    'js/custom/authentication/password-reset/password-reset.js',
                ),
            ),
        ),
        'layout' => array(
            'main' => array(
                'type' => 'blank', // Set blank layout
                'body' => array(
                    'class' => theme()->isDarkMode() ? '' : 'bg-body',
                ),
            ),
        ),
    ),

    'products' => array(
        'title' => 'Products',
        'assets' => array(
            'custom' => array(
                'css' => array(
                    'plugins/custom/datatables/datatables.bundle.css',
                ),
                'js'  => array(
                    'plugins/custom/datatables/datatables.bundle.js',
                ),
            ),
        ),
    ),

    'packages' => array(
        'title' => 'Packages',
        'assets' => array(
            'custom' => array(
                'css' => array(
                    'plugins/custom/datatables/datatables.bundle.css',
                ),
                'js'  => array(
                    'plugins/custom/datatables/datatables.bundle.js',
                ),
            ),
        ),
    ),

    'order-supplies' => array(
        'title' => 'Order Supplies',
        'assets' => array(
            'custom' => array(
                'css' => array(
                    'plugins/custom/datatables/datatables.bundle.css',
                ),
                'js'  => array(
                    'plugins/custom/datatables/datatables.bundle.js',
                ),
            ),
        ),
    ),

    'shipments' => array(
        'title' => 'Shipments',
        'assets' => array(
            'custom' => array(
                'css' => array(
                    'plugins/custom/datatables/datatables.bundle.css',
                ),
                'js'  => array(
                    'plugins/custom/datatables/datatables.bundle.js',
                ),
            ),
        ),
        'create' => array(
            'assets' => array(
                'custom' => array(
                    'css' => array(
                        'plugins/custom/datatables/datatables.bundle.css',
                        'plugins/custom/flatpickr/flatpickr.bundle.css',
                    ),
                    'js'  => array(
                        'plugins/custom/datatables/datatables.bundle.js',
                        'plugins/custom/flatpickr/flatpickr.bundle.js',
                    ),
                ),
            ),
        ),
        
    ),

    'shipping' => array(
        'title' => 'Shipments',
        'assets' => array(
            'custom' => array(
                'css' => array(
                    'plugins/custom/datatables/datatables.bundle.css',
                ),
                'js'  => array(
                    'plugins/custom/datatables/datatables.bundle.js',
                ),
            ),
        ),
        '*' => array(
            'assets' => array(
                'custom' => array(
                    'css' => array(
                        'plugins/custom/datatables/datatables.bundle.css',
                        'plugins/custom/flatpickr/flatpickr.bundle.css',
                    ),
                    'js'  => array(
                        'plugins/custom/datatables/datatables.bundle.js',
                        'plugins/custom/flatpickr/flatpickr.bundle.js',
                    ),
                ),
            ),
        ),
        
    ),

    'import-quotes' => array(
        'title' => 'Order Supplies',
        'assets' => array(
            'custom' => array(
                'css' => array(
                    'plugins/custom/datatables/datatables.bundle.css',
                ),
                'js'  => array(
                    'plugins/custom/datatables/datatables.bundle.js',
                ),
            ),
        ),
        'create' => array(
            'assets' => array(
                'custom' => array(
                    'css' => array(
                        'plugins/custom/datatables/datatables.bundle.css',
                        'plugins/custom/flatpickr/flatpickr.bundle.css',
                    ),
                    'js'  => array(
                        'plugins/custom/datatables/datatables.bundle.js',
                        'plugins/custom/flatpickr/flatpickr.bundle.js',
                    ),
                ),
            ),
        )
    ),

    'pickups' => array(
        'title' => 'Schedule Your Pickup',
        'assets' => array(
            'custom' => array(
                'css' => array(
                    'plugins/custom/datatables/datatables.bundle.css',
                ),
                'js'  => array(
                    'plugins/custom/datatables/datatables.bundle.js',
                ),
            ),
        ),
        'create' => array(
            'assets' => array(
                'custom' => array(
                    'css' => array(
                        'plugins/custom/datatables/datatables.bundle.css',
                        'plugins/custom/flatpickr/flatpickr.bundle.css',
                    ),
                    'js'  => array(
                        'plugins/custom/datatables/datatables.bundle.js',
                        'plugins/custom/flatpickr/flatpickr.bundle.js',
                    ),
                ),
            ),
        )
    ),

    'address-groups' => array(
        'title' => 'Address Groups',
        'assets' => array(
            'custom' => array(
                'css' => array(
                    'plugins/custom/datatables/datatables.bundle.css',
                ),
                'js'  => array(
                    'plugins/custom/datatables/datatables.bundle.js',
                ),
            ),
        ),
        '*' => array(
            'addresses' => array(
                'assets' => array(
                    'custom' => array(
                        'css' => array(
                            'plugins/custom/datatables/datatables.bundle.css',
                        ),
                        'js'  => array(
                            'plugins/custom/datatables/datatables.bundle.js',
                        ),
                    ),
                ),
            )
        )
    ),

    'error' => array(
        'error-404' => array(
            'title' => 'Error 404',
        ),
        'error-500' => array(
            'title' => 'Error 500',
        ),
    ),

    'account' => array(
        'overview' => array(
            'title'  => 'Account Overview',
            'view'   => 'account/overview/overview',
            'assets' => array(
                'custom' => array(
                    'js' => array(
                        'js/custom/widgets.js',
                    ),
                ),
            ),
        ),

        'settings' => array(
            'title'  => 'Account Settings',
            'assets' => array(
                'custom' => array(
                    'js' => array(
                        'js/custom/account/settings/profile-details.js',
                        'js/custom/account/settings/signin-methods.js',
                        'js/custom/modals/two-factor-authentication.js',
                    ),
                ),
            ),
        ),
    ),

    'users'         => array(
        'title' => 'User List',

        '*' => array(
            'title' => 'Show User',

            'edit' => array(
                'title' => 'Edit User',
            ),
        ),
    ),
);
