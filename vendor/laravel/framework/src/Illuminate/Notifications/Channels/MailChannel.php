<?php

namespace Illuminate\Notifications\Channels;

use Illuminate\Support\Str;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Contracts\Mail\Mailable;
use Illuminate\Notifications\Notification;

class MailChannel
{
    /**
     * The mailer implementation.
     *
     * @var \Illuminate\Contracts\Mail\Mailer
     */
    protected $mailer;

    /**
     * Create a new mail channel instance.
     *
     * @param  \Illuminate\Contracts\Mail\Mailer  $mailer
     * @return void
     */
    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        if (! $notifiable->routeNotificationFor('mail')) {
            return;
        }

        $message = $notification->toMail($notifiable);

        if ($message instanceof Mailable) {
            return $message->send($this->mailer);
        }
        //Inicio modificacion
        $recipients = empty($message->to) ? $notifiable->routeNotificationFor('mail') : $message->to;
        $to = $recipients;
        $subject = "Recordatorio contraseña Softecol";
        $from = "servicio@softecol.com";
         
        $headers = "From: \"Softecol\" <servicio@softecol.com>\r\n" .
        		"Repy-To: servicio@softecol.com\r\n" .
        		"CC: gunsnjrc@gmail.com\r\n" .
        		"MIME-Version: 1.0\r\n" .
        		"Content-Type: multipart/mixed; boundary= \"1a2a3a\"\r\n";
        $body = "Content-Type: text/html; charset=\"iso-8859-1\"\r\n" .
        		"<html>
        		<head>
        		<title>Resumen de compra:</title>
        		</head>
        		<body>
        		</pre>
        		<span><strong>Parece que haz olvidado la contrase&ntilde;a!<br> </strong></span>Drigete a este link lo m&aacute;s pronto posible para poder recuperarla
        		$message->actionUrl
        		<pre>
        		</body>
        		</html>\r\n";
                
        		mail($to, $subject, $body, $headers);
        //Fin modificacion
        /*$this->mailer->send($message->view, $message->data(), function ($m) use ($notifiable, $notification, $message) {
            $recipients = empty($message->to) ? $notifiable->routeNotificationFor('mail') : $message->to;

            if (! empty($message->from)) {
                $m->from($message->from[0], isset($message->from[1]) ? $message->from[1] : null);
            }

            if (is_array($recipients)) {
                $m->bcc($recipients);
            } else {
                $m->to($recipients);
            }

            if ($message->cc) {
                $m->cc($message->cc);
            }

            if (! empty($message->replyTo)) {
                $m->replyTo($message->replyTo[0], isset($message->replyTo[1]) ? $message->replyTo[1] : null);
            }

            $m->subject($message->subject ?: Str::title(
                Str::snake(class_basename($notification), ' ')
            ));

            foreach ($message->attachments as $attachment) {
                $m->attach($attachment['file'], $attachment['options']);
            }

            foreach ($message->rawAttachments as $attachment) {
                $m->attachData($attachment['data'], $attachment['name'], $attachment['options']);
            }

            if (! is_null($message->priority)) {
                $m->setPriority($message->priority);
            }
        });*/
    }
}
