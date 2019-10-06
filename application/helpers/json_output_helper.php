<?php
defined('BASEPATH') or exit('No direct script access allowed');

function json_output($statusHeader, $response)
{
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method == 'POST') {

        $obj = new stdClass;
        $obj->statusCode = $statusHeader;
        $obj->data = $response;

        $ci = &get_instance();
        $ci->output->set_content_type('application/json');
        $ci->output->set_status_header(200);
        $ci->output->set_output(json_encode($obj, JSON_PRETTY_PRINT));
    } else {
        $ci = &get_instance();
        $ci->output->set_content_type('application/json');
        $ci->output->set_status_header(200);
        $ci->output->set_output(json_encode(array('statusCode' => 400, 'data' => array('message' => 'Bad request, this method not allowed'))));

    }
}
