<?php

return [
    'permissions' => [
        "Users" => [
            [
                "name" => "users.update",
                "display_name" => "Users Update",
            ],
            [
                "name" => "users.delete",
                "display_name" => "Users Delete",
            ],
        ],
        "dashboard" => [
            [
                "name" => "dashboard.show",
                "display_name" => "Dashboard Show",
            ]
        ],
        "admin" => [
            [
                "name" => "admin.show",
                "display_name" => "Admin show",
            ]
        ],
    ],
    'roles' => [
        "admin" => ["all"],
        "user" => ["users.update", "dashboard.show"],
    ],
];
