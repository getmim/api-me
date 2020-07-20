<?php
/**
 * PasswordController
 * @package api-me
 * @version 0.0.1
 */

namespace ApiMe\Controller;

use LibForm\Library\Form;
use LibUser\Library\Fetcher;

class PasswordController extends \Api\Controller
{
    public function changeAction(){
        if(!$this->user->isLogin())
            return $this->resp(401);

        $form = new Form('api-me.password');
        if(!($valid = $form->validate()))
            return $this->resp(422, $form->getErrors());

        $user = Fetcher::getOne(['id'=>$this->user->id]);
        if(!$this->user->verifyPassword($valid->old, $user))
            return $this->resp(400, 'Invalid old password');

        if($valid->new != $valid->retype)
            return $this->resp(400, 'Both new password not match');

        $user_set = [
            'password' => $this->user->hashPassword($valid->new)
        ];

        if(!Fetcher::set($user_set, ['id'=>$user->id]))
            return $this->resp(500, Fetcher::lastError());

        return $this->resp(0, 'success');
    }
}