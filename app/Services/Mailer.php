<?php
    namespace App\Services;

    use App\User;
    use Illuminate\Contracts\Mail\MailQueue as IlluminateMailer;

    class Mailer
    {

        /**
         * @var IlluminateMailer
         */
        private $mailer;

        /**
         * @param IlluminateMailer $mailer
         */
        function __construct( IlluminateMailer $mailer )
        {
            $this->mailer = $mailer;
        }

        /**
         * Send an email to a user
         *
         * @param User  $user
         * @param       $subject
         * @param       $view
         * @param array $data
         */
        public function sendTo( User $user, $subject, $view, array $data = [ ] )
        {
            $this->send( $user->present->name, $user->email, $subject, $view, $data );
        }

        /**
         * Send an email
         *
         * @param       $name
         * @param       $email
         * @param       $subject
         * @param       $view
         * @param array $data
         */
        public function send( $name, $email, $subject, $view, array $data = [ ] )
        {

            $this->mailer->send( $view, $data,
                function ( $message ) use ( $name, $email, $subject ) {
                    $message->to( $email, $name );
                    $message->subject( '' );
                } );
        }
    }