<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Project;

class ProjectPublicationMail extends Mailable
{
    use Queueable, SerializesModels;

    protected Project $project;

    /**
     * Create a new message instance.
     */
    public function __construct($project)
    {
        $this->project = $project;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Project Publication Mail',
            replyTo: 'semmisno2@protonmail.com'
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $project = $this->project;
        $text = $this->project->is_public ? 'New project published' : 'Project drafted';
        $url = env('APP_FRONTEND_URL') . "/projects/$project->slug";

        return new Content(
            markdown: 'mails.projects.published',
            with: compact('project', 'text', 'url'),
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
