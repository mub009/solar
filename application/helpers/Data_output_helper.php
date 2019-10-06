<?php
defined('BASEPATH') or exit('No direct script access allowed');

function data_output($statusHeader, $response, $response_type)
{

    $ci = &get_instance();

    $ci->load->library('Format');

    $ci->output->set_status_header($statusHeader);

    if ($response_type == 'json') {

        $ci->Format->to_json($response);

    } elseif ($response_type == 'xml') {

        $ci->Format->to_xml($response);

    } elseif ($response_type == 'html') {

        $ci->Format->to_html($response);

    } elseif ($response_type == 'csv') {

        $ci->Format->to_csv($response);
    } elseif ($response_type == 'serialized') {

        $ci->Format->to_serialized($response);
    }
}
