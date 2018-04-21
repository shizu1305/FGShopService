<?php if ( ! defined('PATH_SYSTEM')) die ('Bad requested!');

class User_Controller extends Base_Controller
{
    /**
    * action login: validate login
    * method: POST
    */
    public function login() {
        $json = [];
        echo "{";
        echo "\"user\":";
        if (isset($_POST["username"]) && isset($_POST["password"])) {
            $username = $_POST["username"];
            //$password = md5($_POST["password"]);
            $password = $_POST["password"];
            $this->model->load('Users');
            $id = $this->model->Users->validate_login($username, $password);
            if ($id != 0) {
                $user = $this->model->Users->findById($id);
                $id_user_type = $user->id_user_type;

                $this->model->load('UserType');
                $user_type = $this->model->UserType->findById($id_user_type);
                $role = $user_type->name_user_type;
                // Set a response code
                var_dump(http_response_code(200));
                array_push($json, [
                    'token' => $user->token,
                    'role' => $role,
                    'data' => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'username' => $user->username,
                        'birthdate' => $user->birthdate,
                        'phone' => $user->phone,
                        'gender' => $user->gender,
                        'identify_number' => $user->identify_number,
                        'wallet' => $user->wallet,
                        'is_social' => $user->is_social,
                        'status' => $user->status,
                    ]
                ]);

            } else {
                /* Login failed */
                // Set a response code
                var_dump(http_response_code(401));
                array_push($json, [
                    'message' => 'Unauthorized'
                ]);
            }
        }
        echo json_encode($json, JSON_UNESCAPED_UNICODE);
        echo "}";
    }

    /**
    * action logout
    * method: GET
    */

    public function logout() {
        if(isset($_GET['token'])) {
            $token = $_GET['token'];
            $this->model->load('Users');
            $id = $this->model->Users->validate_logout($_GET['token']);
            if($id != 0) {
                $this->model->Users->remove_token($id);
                 /*Logout success*/
            } else {
                 /*Logout failed*/
            }
        } else {
            /*Token not exists*/
        }
    }

}
