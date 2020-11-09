<?php

namespace Infrastructure\Events;

use Infrastructure\Templating\ValidationHelper;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ValidationErrorSubscriber implements EventSubscriberInterface
{
    private ValidationHelper $helper;

    public function __construct(ValidationHelper $helper)
    {
        $this->helper = $helper;
    }

    public static function getSubscribedEvents()
    {
        // return the subscribed events, their methods and priorities
        return [
            ValidationErrorEvent::class => 'onValidationError',
        ];
    }

    public function onValidationError(ValidationErrorEvent $event)
    {
        $this->helper->setErrors($event->getViolations());
    }
}
