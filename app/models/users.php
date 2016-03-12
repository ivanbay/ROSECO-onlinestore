<?php

class users {

    public function listUsers() {
        $users = DB::table('users')
                ->join('users_info', 'users.id', '=', 'users_info.user_id')
                ->get();

        return $users;
    }

    public function getUser($id) {
        $users = DB::table('users')
                ->join('users_info', 'users.id', '=', 'users_info.user_id')
                ->where('users.id', $id)
                ->first();

        return $users;
    }

    public function newUser() {
        $fname = Input::get('fname');
        $mname = Input::get('mname');
        $lname = Input::get('lname');
        $address = Input::get('address');
        $username = Input::get('username');
        $password = Input::get('password');
        $usertype = Input::get('usertype');
        $email = Input::get('email');
        $newsletter = Input::has('newsletter_chk') ? '1' : '0';
        $activation_token = md5(uniqid(rand(), true));

        try {

            $user_id = DB::table('users')
                    ->insertGetId(
                    array(
                        'username' => $username,
                        'password' => Hash::make($password),
                        'user_role' => $usertype,
                        'activation_token' => $activation_token,
                    )
            );

            DB::table('users_info')
                    ->insert(
                            array(
                                'user_id' => $user_id,
                                'fname' => $fname,
                                'mname' => $mname,
                                'lname' => $lname,
                                'address' => $address,
                                'email' => $email,
                                'send_newsletter' => $newsletter
                            )
            );
            
            
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function activate_user($token) {
        try {
            DB::table('users')->where('activation_token', $token)->update(array('activated' => '1'));
        } catch (Exception $e) {
            return false;
        }

        return true;
    }

}
