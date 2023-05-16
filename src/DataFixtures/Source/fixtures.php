<?php

return [
    'fixtures' => [
        'suites' => [
            'default' => [
                'fixtures' => [
                    'currency' => [
                        'options' => [
                            'currencies' => ['USD', 'PLN', 'HUF']
                        ]
                    ],
                    'channel' => [
                        'options' => [
                            'custom' => [
                                'pl_web_store' => [
                                    'name' => 'PL Web Store',
                                    'code' => 'PL_WEB',
                                    'locales' => ['%locale%'],
                                    'currencies' => ['PLN'],
                                    'enabled' => true,
                                    'hostname' => 'localhost'
                                ],
                                'hun_web_store' => [
                                    'name' => 'Hun Web Store',
                                    'code' => 'HUN_WEB',
                                    'locales' => ['%locale%'],
                                    'currencies' => ['HUF'],
                                    'enabled' => true,
                                    'hostname' => 'localhost'
                                ]
                            ]
                        ]
                    ],
                    'shipping_method' => [
                        'options' => [
                            'custom' => [
                                'ups_eu' => [
                                    'code' => 'ups_eu',
                                    'name' => 'UPS_eu',
                                    'enabled' => true,
                                    'channels' => ['PL_WEB', 'HUN_WEB']
                                ]
                            ]
                        ]
                    ],
                    'payment_method' => [
                        'options' => [
                            'custom' => [
                                'cash_on_delivery_pl' => [
                                    'code' => 'cash_on_delivery_eu',
                                    'name' => 'Cash on delivery_eu',
                                    'channels' => ['PL_WEB']
                                ],
                                'bank_transfer' => [
                                    'code' => 'bank_transfer_eu',
                                    'name' => 'Bank transfer_eu',
                                    'channels' => ['PL_WEB', 'HUN_WEB'],
                                    'enabled' => true
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ]
    ]
];

