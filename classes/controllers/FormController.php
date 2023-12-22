<?php

namespace popups\classes\controllers;
class FormController {
    private $name;
    private $email;
    private $phone;

    public function __construct( $name, $email, $phone ) {
        $this->name  = $this->sanitizeInput( $name );
        $this->email = $this->sanitizeInput( $email );
        $this->phone = $this->sanitizeInput( $phone );
    }

    private function sanitizeInput( $input ) {
        // Perform necessary sanitization to prevent SQL injection and other attacks
        $sanitized_input = stripslashes( $input );
        $sanitized_input = htmlspecialchars( $sanitized_input );
        $sanitized_input = trim( $sanitized_input );

        return $sanitized_input;
    }

    public function processForm( $to_emails ) {
        // Send an email with form data
        $to      = $to_emails;
        $subject = 'New Form Submission from Proxima website';
        $message = "Name: $this->name\nEmail: $this->email\nPhone: $this->phone";
        $headers = "From: sender@example.com\r\n";

        if ( mail( $to, $subject, $message, $headers ) ) {
            return true;
        } else {
            return false;
        }
    }
}
