<?php
namespace App\EventListener;

use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\HttpKernelInterface;

class CopyrightListener {
    public function makeMyCopyright(ResponseEvent $event)
    {
        if (HttpKernelInterface::MASTER_REQUEST !== $event->getRequestType()) {
            return;
        }

        $date = date('Y');
        $html = "&copy; 2009 - ".$date;
        
        $response = $event->getResponse();
        $content = $response->getContent();
        
        $content = preg_replace(
            '#<copyright>#iU',
            '<span>'.$html.'</span>',
            $content
        );

        $response->setContent($content);
        $event->setResponse($response);
    }
}