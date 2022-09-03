<?php
return [
    '(GET)/' => 'Customers/index',

    '(GET)/customers'        => 'Customers/index',
    '(GET)/customers/list'   => 'Customers/index',
    '(POST)/customers/list'  => 'Customers/index',
    '(GET)/customers/create' => 'Customers/create',
    '(GET)/customers/id'     => 'Customers/view',
    '(POST)/customers/id'    => 'Customers/action_update',
    '(DELETE)/customers/id'  => 'Customers/action_delete',
    '(POST)/customers'       => 'Customers/action_create',
    '(GET)/customers/edit'   => 'Customers/edit',

    '(GET)/loyaltyCards'        => 'LoyaltyCards/index',
    '(GET)/loyaltyCards/list'   => 'LoyaltyCards/index',
    '(GET)/loyaltyCards/create' => 'LoyaltyCards/create',
    '(GET)/loyaltyCards/id'     => 'LoyaltyCards/view',
    '(POST)/loyaltyCards/id'    => 'LoyaltyCards/action_update',
    '(DELETE)/loyaltyCards/id'  => 'LoyaltyCards/action_delete',
    '(POST)/loyaltyCards'       => 'LoyaltyCards/action_create',
    '(GET)/loyaltyCards/edit'   => 'LoyaltyCards/edit',

    '(GET)/orders'      => 'Orders/index',
    '(GET)/orders/list' => 'Orders/index',
    '(GET)/orders/id'   => 'Orders/view',

    '(GET)/dashboard' => 'Dashboard/index',
];