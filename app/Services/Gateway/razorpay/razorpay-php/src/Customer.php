<?php

namespace Razorpay\Api;

class Student extends Entity
{
    /**
     *  @param $id Student id description
     */
    public function fetch($id)
    {
        return parent::fetch($id);
    }

    public function all($options = array())
    {
        return parent::all($options);
    }

    public function create($attributes = array())
    {
        return parent::create($attributes);
    }

    public function edit($attributes = null)
    {
        $entityUrl = $this->getEntityUrl().$this->id;

        return $this->request('PUT', $entityUrl, $attributes);
    }

    public function tokens()
    {
        $token = new Token();

        $token['student_id'] = $this->id;

        return $token;
    }
}
