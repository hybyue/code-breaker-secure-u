<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DepartmentNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $visitor;
    public $departmentEmail;

    public function __construct($visitor, $departmentEmail)
    {
        $this->visitor = $visitor;
        $this->departmentEmail = $departmentEmail;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Visitor Notification',
        );
    }
    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.department_notif',
            with: [
                'visitorName' => $this->visitor->first_name . ' ' . $this->visitor->last_name,
                'purpose' => $this->visitor->purpose,
                'department' => $this->visitor->person_to_visit,
                'date' => $this->visitor->created_at->format('F j, Y'),
                'time' => $this->visitor->created_at->format('g:i A')
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
