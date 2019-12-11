<?php
namespace App\EventListener;

use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\HttpKernelInterface;

class BooksListener {

    public function makeMyLiBooks(ResponseEvent $event)
    {
        if (HttpKernelInterface::MASTER_REQUEST !== $event->getRequestType()) {
            return;
        }

        
        $response = $event->getResponse();
        $content = $response->getContent();

        preg_match_all("#(<li>).{1,}(</li>)#",$content,$matches);
        $i = 1;
        $li[] = '<ul id="books">';
        foreach ($matches[0] as $match) {
            $li[] = "<li>".$i." : ".strip_tags($match)."</li>";
            $i++;
        }
        $li[] = '</ul>';

        $content = preg_replace("#\<ul\b[^>]*>([.\n\s\t\>]*<li>.*<\/li>){1,}[.\n\s\t\>]*<\/ul>#",implode($li),$content);
        
        $response->setContent($content);
        $event->setResponse($response);
    }

}