<?php

class User extends CI_Model
{
    public function authenticate($email, $password)
    {
        // get salt

        //$salt = $this->db->select('salt')->get_where('users', array('email' => $email))->row()->salt;
$salt=true;
        if ($salt)
        {
            // hash password with salt and find user

            $hash = sha1($salt.sha1($salt.$password));

            $user = $this->db->select('id')->get_where('users', array(
                'email' => $email,
                'hash' => $hash
            ))->row();

            return $user;
        }

        return false;
    }
}