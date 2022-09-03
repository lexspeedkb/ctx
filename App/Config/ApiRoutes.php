<?php
return [
    '(POST)/customers/list'  => 'Customers/list',
    '(GET)/customers/list'   => 'Customers/list',
    '(PUT)/customers/create' => 'Customers/create',
    '(GET)/customers/id'     => 'Customers/getByPrimary',
    '(PUT)/customers/id'     => 'Customers/update',
    '(DELETE)/customers/id'  => 'Customers/delete',

    '(GET)/loyaltyCards/listUnused' => 'LoyaltyCards/listUnused',
    '(GET)/loyaltyCards/list'       => 'LoyaltyCards/list',
    '(PUT)/loyaltyCards/create'     => 'LoyaltyCards/create',
    '(GET)/loyaltyCards/id'         => 'LoyaltyCards/getByPrimary',
    '(PUT)/loyaltyCards/id'         => 'LoyaltyCards/update',
    '(DELETE)/loyaltyCards/id'      => 'LoyaltyCards/delete',

    '(GET)/orders/list' => 'Orders/list',
    '(GET)/orders/id'   => 'Orders/view',

    '(GET)/dashboard' => 'Dashboard/index',
];