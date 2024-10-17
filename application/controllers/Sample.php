<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Sample extends CI_Controller {


public function index(){
        echo '[
        {
          "name": "Apple",
          "image": "https://via.placeholder.com/145x140",
          "desc": "job description",
          "time": "a",
          "id": 1,
          "status_read": "true",
          "count_new_msg": "",
          "type_msg": "image"
        },
        {
          "name": "Apple",
          "image": "https://via.placeholder.com/145x140",
          "desc": "job description",
          "time": "asd",
          "id": 2,
          "status_read": "false",
          "count_new_msg": "9",
          "type_msg": "text"
        },
        {
          "name": "Apple",
          "image": "https://via.placeholder.com/145x140",
          "desc": "job description",
          "time": "ad",
          "id": 2,
          "status_read": "false",
          "count_new_msg": "",
          "type_msg": "text"
        }
      ]';
}

}

?>
