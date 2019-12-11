<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MailController extends AbstractController
{
    /**
     * @Route("/mail", name="mail")
     */
    public function index(\Swift_Mailer $mailer)
    {
        // Définition de l'expéditeur
        // --
        // Peut être une chaine ou un tableau
        // $sender = "john@doe.com";
        $from = [ "john@doe.com" => "John Doe" ];
        $to = ["jane@doe.com" => "Jane Doe", "bruce@wayne.com" => "Bruce Wayne"];
        $subject = "This is the email subject";
        $data = [
            'subject'   => $subject,
            'firstname' => "Bruce",
            'lastname'  => "WAYNE",
            'email'     => "bruce@wayne.com"
        ];
        $message = new \Swift_Message();
        $message->setSubject( $subject );
        $message->setFrom( $from );
        $message->setTo( $to );

        // Le message principal (au format HTML)
        $message->setBody(
            $this->renderView(
                "mail/index.html.twig"
            ), 
            'text/html'
        );

        // Le message alternatif (au format TXT)
        $message->addPart(
            $this->renderView(
                "mail/index.txt.twig"
            ), 
            'text/plain'
        );

        $sent = $mailer->send($message);

        return $this->json([
            'subject'   => $data['subject'],
            'is sent ?' => $sent ? "yes" : "no",
            'path'      => 'src/Controller/MailController.php',
        ]);
    }
}
