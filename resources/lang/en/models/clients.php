<?php

return [
    'singular' => 'Client',
    'plural' => 'Clients',
    'fields' => [
        'id' => 'Id',
        'resto_id' => 'Resto',
        'type' => 'Type',
        'name' => 'Name',
        'card' => 'Card',
        'created_at' => 'Created At',
        'updated_at' => 'Updated At',
        'deleted_at' => 'Deleted At',
        'code' => 'Code',
        'duplicate' => 'Duplicate',
        'progres_id' => 'Progres Id',
    ],
    'types' => [
        1 => 'Student',
        2 => 'Worker',
        3 => 'Para_medical',
    ],
];
