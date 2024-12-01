<?php
return array(
    '' => array(
        'title'       => 'Dashboard',
        'description' => '#XRS-45670',
        'view'        => 'index',
        'layout'      => array(
            'page-title' => array(
                'description' => false,
                'breadcrumb'  => true,
            ),
        ),
        'assets'      => array(
            'vendors' => array('fullcalendar'),
            'layout'  => array(
                'js' => array(
                    'js/layout/toolbar.js',
                ),
            ),
        ),
    ),

    'address-groups' => array(
        array(
            'title' => 'Address Groups',
            'breadcrumbs' => array(
                '/' => 'Dashboard',
                '' => 'Address Groups'
            )
        ),
        'import' => array(
            'title' => 'Import Addresses',
            'breadcrumbs' => array(
                '/' => 'Dashboard',
                '' => 'Import Addresses'
            )
        ),
    ),
    'products' => array(
        'title' => 'Products',
        ''
    )
);
