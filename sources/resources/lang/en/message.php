<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Response Message
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during database transaction for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'read' => [
        '404' => ['status'=>404,'message_type' => 'error', 'message_desc' => 'Data not found!'],
    ],
    'create' => [
        'success' => ['status'=>200,'message_type' => 'success', 'message_desc' => 'Add New Entry Success!'],
        'failed' => ['status'=>400,'message_type' => 'error', 'message_desc' => 'Add New Entry Failed!'],
        'invalid' => ['status'=>400,'message_type' => 'error', 'message_desc' => 'Form Input Invalid!'],
    ],
    'update' => [
        'success' => ['status'=>200,'message_type' => 'success', 'message_desc' => 'Update Entry Success!'],
        'failed' => ['status'=>400,'message_type' => 'error', 'message_desc' => 'Update Entry Failed!'],
        'invalid' => ['status'=>400,'message_type' => 'error', 'message_desc' => 'Form Input Invalid!'],
    ],
    'delete' => [
        'success' => ['status'=>200,'message_type' => 'success', 'message_desc' => 'Delete Entry Success!'],
        'failed' => ['status'=>400,'message_type' => 'error', 'message_desc' => 'Delete Entry Failed!'],
    ],
    'param' => [
        'success' => ['status'=>200,'message_type' => 'success', 'message_desc' => 'Parameter Set Success!'],
        'failed' => ['status'=>400,'message_type' => 'error', 'message_desc' => 'Parameter Set Failed!'],
    ],
    'unauthorized' => [
        'status'=>503,
        'message_type' => 'error',
        'message_desc' => 'Unauthorize!',
        'data'  => [],
        'draw'  => ':draw',
        'error' => "Unauthorize !",
        'recordsFiltered' => 0,
        'recordsTotal'    => 0,
    ],
    'empty' => [
        'status'=>200,
        'data'  => [],
        'draw'  => ':draw',
        'recordsFiltered' => 0,
        'recordsTotal'    => 0,
    ],

];
