<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Sample extends CI_Controller {


public function index(){
  if($this->input->get('Func')=="LIST_CONTACT"){
        echo '
              {
                "status": 200,
                "message": "Success",
                "data": [
                            {
                              "id": 1,
                              "name": "Brandon",
                              "image": "https://cdn.iconscout.com/icon/free/png-512/avatar-380-456332.png",
                              "position": "Manager"
                            },
                            {
                              "id": 2,
                              "name": "Jhon",
                              "image": "https://cdn.iconscout.com/icon/free/png-256/avatar-370-456322.png",
                              "position": "SPV"
                            },
                            {
                              "id": 3,
                              "name": "Karie",
                              "image": "https://cdn3.iconfinder.com/data/icons/business-avatar-1/512/8_avatar-512.png",
                              "position": "General Manager"
                            },
                            {
                              "id": 4,
                              "name": "Wayan",
                              "image": "https://img.favpng.com/1/23/20/computer-icons-icon-design-download-users-group-png-favpng-5mLyX8nd2maqY1EJhwQMSUJH3.jpg",
                              "position": "CS"

                            }
                      ]
              }
            ';
  }else if($this->input->get('Func')=="GET_EMPLOYEE"){
        echo '
              {
                "status": 200,
                "message": "Success",
                "data": [
                            {
                              "id": 1,
                              "group_name": "Management",
                              "group_pic": "https://cdn.iconscout.com/icon/free/png-512/avatar-380-456332.png",
                              "count_partisipant": "30 person"
                            },
                            {
                              "id": 2,
                              "group_name": "Security",
                              "group_pic": "https://cdn.iconscout.com/icon/free/png-256/avatar-370-456322.png",
                              "count_partisipant": "20 person"
                            },
                            {
                              "id": 3,
                              "group_name": "Front Office",
                              "group_pic": "https://cdn3.iconfinder.com/data/icons/business-avatar-1/512/8_avatar-512.png",
                              "count_partisipant": "20 person"
                            },
                            {
                              "id": 3,
                              "group_name": "Front Office2",
                              "group_pic": "https://cdn3.iconfinder.com/data/icons/business-avatar-1/512/8_avatar-512.png",
                              "count_partisipant": "20 person"
                            }
                      ]
              }
            ';
  }else if($this->input->get('Func')=="GET_EMPLOYEE_IDGROUP"){
        echo '
              {
                "status": 200,
                "message": "Success",
                "data": [
                            {
                              "id": 1,
                              "nick_name": "Jhon",
                              "name": "Jhon Lenon",
                              "photo_pic": "https://cdn.iconscout.com/icon/free/png-512/avatar-380-456332.png",
                              "position": "Manager",
                              "project": "Project Termal",
                              "personal_id": "5108238388383",
                              "work_unit": "Denpasar"
                            },

                            {
                              "id": 2,
                              "nick_name": "Merry",
                              "name": "Merry Liana",
                              "photo_pic": "https://cdn.iconscout.com/icon/free/png-512/avatar-380-456332.png",
                              "position": "Director",
                              "project": "Project Electric",
                              "personal_id": "828173812738273",
                              "work_unit": "Lombok"
                            },

                            {
                              "id": 3,
                              "nick_name": "Michael",
                              "name": "Michael Jackson",
                              "photo_pic": "https://cdn.iconscout.com/icon/free/png-512/avatar-380-456332.png",
                              "position": "HRD",
                              "project": "Smartbiz",
                              "personal_id": "000092929922222",
                              "work_unit": "Kalimantan"
                            }

                      ]
              }
            ';
  }else if($this->input->get('Func')=="GET_TASK"){
        echo '
              {
                "status": 200,
                "message": "Success",
                "data": [
                            {
                              "id": 1,
                              "project_name": "Project A",
                              "projec_desc": "This is project A description! This is project A description! This is project A description! This is project A description!  This is project A description! This is project A description! This is project A description! This is project A description! ",
                              "project_status": "Not Started"
                            },
                            {
                                "id": 1,
                                "project_name": "Project B",
                                "projec_desc": "This is project A description!",
                                "project_status": "Ongoing"
                            },
                            {
                                "id": 1,
                                "project_name": "Project C",
                                "projec_desc": "This is project A description!",
                                "project_status": "Finished"
                            },
                            {
                                "id": 1,
                                "project_name": "Project D",
                                "projec_desc": "This is project A description!",
                                "project_status": "Overdue"
                            }

                      ]
              }
            ';
  }else if($this->input->get('Func')=="LIST_INBOX"){
          echo '
                {
                  "status": 200,
                  "message": "Success",
                  "data": [
                              {
                                "name": "Brandon",
                                "image": "https://cdn.iconscout.com/icon/free/png-512/avatar-380-456332.png",
                                "desc": "job description",
                                "time": "Today,10.13",
                                "id": 1,
                                "status_read": true,
                                "count_new_msg": "",
                                "type_msg": "image",
                                "is_group": false
                              },
                              {
                                "name": "Jhon",
                                "image": "https://cdn.iconscout.com/icon/free/png-256/avatar-370-456322.png",
                                "desc": "job description",
                                "time": "Today,10.13",
                                "id": 2,
                                "status_read": false,
                                "count_new_msg": "10",
                                "type_msg": "text",
                                "is_group": false
                              },
                              {
                                "name": "Karie",
                                "image": "https://cdn3.iconfinder.com/data/icons/business-avatar-1/512/8_avatar-512.png",
                                "desc": "job description",
                                "time": "Today,10.13",
                                "id": 2,
                                "status_read": true,
                                "count_new_msg": "",
                                "type_msg": "text",
                                "is_group": false
                              },
                              {
                                "name": "This Is Chat Group!",
                                "image": "https://img.favpng.com/1/23/20/computer-icons-icon-design-download-users-group-png-favpng-5mLyX8nd2maqY1EJhwQMSUJH3.jpg",
                                "desc": "job description",
                                "time": "Today,10.13",
                                "id": 2,
                                "status_read": true,
                                "count_new_msg": "",
                                "type_msg": "text",
                                "is_group": true,
                                "data_group":
                                    {
                                      "id_group": "1",
                                      "group_name": "Morning Glory",
                                      "date_create": "2020-01-03",
                                      "create_who":"Jhon",
                                      "id_user":"1"
                                    }

                              }
                        ]
                }
              ';
    } else if($this->input->get('Func')=="CHAT_ROOM"){
          echo '{
                  "status": 200,
                  "message": "Success",
                  "data": [
                              {
                                "name": "Jhon",
                                "image": "none",
                                "text": "hi, My Name is Jhon. You?",
                                "date": "2020-01-03",
                                "time": "08:09",
                                "id_chat": 1,
                                "is_sender": true,
                                "is_first": true
                              },
                              {
                                "name": "Jhon",
                                "image": "none",
                                "text": "and How Are you?",
                                "date": "2020-01-03",
                                "time": "08:09",
                                "id_chat": 1,
                                "is_sender": true,
                                "is_first": false
                              },
                              {
                                "name": "Brandon",
                                "image": "none",
                                "text": "My Name is Brandon, this my dog!",
                                "date": "2020-01-03",
                                "time": "08:10",
                                "id_chat": 2,
                                "is_sender": false,
                                "is_first": true
                              },
                              {
                                "name": "Brandon",
                                "image": "none",
                                "text": "Cute right?",
                                "date": "2020-01-03",
                                "time": "08:10",
                                "id_chat": 2,
                                "is_sender": false,
                                "is_first": false
                              },
                              {
                                "name": "Brandon",
                                "image": "https://www.nicepng.com/png/detail/137-1376393_happy-dog-png-dog-christmas-wishes-christmas-card.png",
                                "text": "",
                                "date": "2020-01-03",
                                "time": "08:10",
                                "id_chat": 3,
                                "is_sender": false,
                                "is_first": false
                              },
                              {
                                "name": "Jhon",
                                "image": "https://www.nicepng.com/png/detail/137-1376393_happy-dog-png-dog-christmas-wishes-christmas-card.png",
                                "text": "",
                                "date": "2020-01-03",
                                "time": "08:10",
                                "id_chat": 3,
                                "is_sender": true,
                                "is_first": true
                              }

                        ]
                }';
    }else if($this->input->get('Func')=="CHAT_ROOM_GROUP"){
          echo '{
                  "status": 200,
                  "message": "Success",
                  "data": [
                              {
                                "name": "Jhon",
                                "image": "none",
                                "text": "hi, Welcome this group. Introduce your self",
                                "date": "2020-06-03",
                                "time": "08:09",
                                "id_chat": 1,
                                "is_sender": true,
                                "is_first": true
                              },
                              {
                                "name": "Jhon",
                                "image": "none",
                                "text": "I Jhon",
                                "date": "2020-06-03",
                                "time": "08:09",
                                "id_chat": 2,
                                "is_sender": true,
                                "is_first": false
                              },
                              {
                                "name": "Jhon",
                                "image": "https://www.bali.com/media/image/1618/kuta400.jpg",
                                "text": "",
                                "date": "2020-06-03",
                                "time": "08:10",
                                "id_chat": 5,
                                "is_sender": true,
                                "is_first": false
                              },
                              {
                                "name": "Jhon",
                                "image": "https://www.bali.com/media/image/1618/kuta400.jpg",
                                "text": "",
                                "date": "2020-06-03",
                                "time": "08:10",
                                "id_chat": 5,
                                "is_sender": true,
                                "is_first": true
                              },

                              {
                                "name": "Brandon",
                                "image": "none",
                                "text": "Iam Brandon 123",
                                "date": "2020-06-03",
                                "time": "08:10",
                                "id_chat": 3,
                                "is_sender": false,
                                "is_first": true
                              },
                              {
                                "name": "Brandon",
                                "image": "none",
                                "text": "Welcome too. Im here now! In Kuta",
                                "date": "2020-06-03",
                                "time": "08:10",
                                "id_chat": 4,
                                "is_sender": false,
                                "is_first": false
                              },
                              {
                                "name": "Brandon",
                                "image": "https://www.bali.com/media/image/1618/kuta400.jpg",
                                "text": "",
                                "date": "2020-06-03",
                                "time": "08:10",
                                "id_chat": 5,
                                "is_sender": false,
                                "is_first": false
                              },
                              {
                                "name": "Karie",
                                "image": "none",
                                "text": "My name Karie",
                                "date": "2020-06-04",
                                "time": "08:10",
                                "id_chat": 4,
                                "is_sender": false,
                                "is_first": true
                              },
                              {
                                "name": "Jakson",
                                "image": "none",
                                "text": "My name Jakson",
                                "date": "2020-06-04",
                                "time": "08:10",
                                "id_chat": 4,
                                "is_sender": false,
                                "is_first": true
                              },
                              {
                                "name": "Joly",
                                "image": "https://www.bali.com/media/image/1618/kuta400.jpg",
                                "text": "",
                                "date": "2020-06-03",
                                "time": "08:10",
                                "id_chat": 5,
                                "is_sender": false,
                                "is_first": true
                              }

                        ]
                }';
    }else if($this->input->get('Func')=="LIST_HISTORY_LEAVE_SUBMISSION"){
          echo '
                {
                  "status": 200,
                  "message": "Success",
                  "data": [
                              {
                                "id": 1,
                                "kategory": "Sick Leave",
                                "periode": "21-24 March 2019",
                                "action": "Waiting Status HRD",
                                "date": "15/03"
                              },
                              {
                                "id": 2,
                                "kategory": "Unpaid Leave",
                                "periode": "21-24 March 2019",
                                "action": "Waiting Status HRD",
                                "date": "15/03"
                              },
                              {
                                "id": 3,
                                "kategory": "Sick Leave",
                                "periode": "21-24 March 2019",
                                "action": "Waiting Status HRD",
                                "date": "15/03"
                              }

                        ]
                }
              ';
    }else if($this->input->get('Func')=="LIST_LEAVE_SETTING"){
          echo '
                {
                  "status": 200,
                  "message": "Success",
                  "data": [
                              {
                                "id": 1,
                                "name": "Sick Leave"
                              },
                              {
                                "id": 2,
                                "name": "Unpaid Leave"
                              },
                              {
                                "id": 3,
                                "name": "Marriage Leave"
                              },
                              {
                                "id": 4,
                                "name": "Annual Leave"
                              }

                        ]
                }
              ';
    }else if($this->input->post('Func')=="UPLOAD"){

      $config = array(
        'upload_path' => "./assets/upload/test/",
        'allowed_types' => "jpg|png|jpeg",
        'overwrite' => TRUE,
        'max_size' => "2048000"
        );

        $this->load->library('upload', $config);

        if($this->upload->do_upload("file"))
        {
          $data = array('status'=>true,'message'=>'File Uploaded Success!','data' => $this->upload->data());
          $res = $this->upload->data();
          echo json_encode($data);
        }
        else
        {
          $data = array('status'=>false,'message'=>'File Uploaded Failed!','data' => $this->upload->display_errors());
          echo 	json_encode($data);
        }

    }

}

}

?>
