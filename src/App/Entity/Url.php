<?php

namespace App\Entity;

use Zend\Form\Annotation;

/**
 * @Annotation\Name("url")
 */
class Url
{
    /**
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Options({"label":"The original url:", "class": "form-control"})
     * @var string
     */
    private $original_url;

    /** @var string */
    private $shortened_url;

    /**
     * @return string
     */
    public function getOriginalUrl()
    {
        return $this->original_url;
    }

    public function getArrayCopy()
    {
        return get_object_vars($this);
    }

    public function populate($data)
    {
        if (array_key_exists('original_url', $data)) {
            $this->original_url = $data['original_url'];
        }
    }
}