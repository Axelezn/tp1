<?php

namespace App\Service;

use App\Entity\Newsletter;
use App\Form\NewsletterType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;

class NewsletterService
{
    private FormFactoryInterface $formFactory;

    public function __construct(FormFactoryInterface $formFactory)
    {
        $this->formFactory = $formFactory;
    }

    public function createNewsletterForm(): FormInterface
    {
        return $this->formFactory->create(NewsletterType::class, new Newsletter());
    }
}