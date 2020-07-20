<?php
/**
 * ProfileController
 * @package api-me
 * @version 0.0.1
 */

namespace ApiMe\Controller;

use LibFormatter\Library\Formatter;
use LibForm\Library\Form;
use LibUser\Library\Fetcher;

class ProfileController extends \Api\Controller
{
    public function infoAction(){
        if(!$this->user->isLogin())
            return $this->resp(401);

        $user = Fetcher::getOne(['id'=>$this->user->id]);
        $user = Formatter::format('user', $user);

        $this->resp(0, $user);
    }

    public function changeAction(){
        if(!$this->user->isLogin())
            return $this->resp(401);

        $form = new Form('api-me.profile');
        if(!($valid = $form->validate()))
            return $this->resp(422, $form->getErrors());

        if(!Fetcher::set((array)$valid, ['id'=>$this->user->id]))
            return $this->resp(500, Fetcher::lastError());

        return $this->resp(0, 'success');
    }
}