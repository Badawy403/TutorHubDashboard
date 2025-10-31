<?php

namespace Razorpay\Api;

class Token extends Entity
{
    /**
     * @param $id Token id
     */
    public function fetch($id)
    {
        $relativeUrl = 'students/'.$this->student_id.'/'.$this->getEntityUrl().$id;

        return $this->request('GET', $relativeUrl);
    }

    public function all($options = array())
    {
        $relativeUrl = 'students/'.$this->student_id.'/'.$this->getEntityUrl();

        return $this->request('GET', $relativeUrl, $options);
    }

    public function delete($id)
    {
        $relativeUrl = 'students/'.$this->student_id.'/'.$this->getEntityUrl().$id;

        return $this->request('DELETE', $relativeUrl);
    }
}
