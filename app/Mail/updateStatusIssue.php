<?php

namespace App\Mail;

use App\Models\Issue;
use App\Models\NotificationEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class updateStatusIssue extends Mailable
{
    use Queueable, SerializesModels;

    public Issue $issue;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($issue)
    {
        $this->issue = $issue;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        $comp = $this->issue->summary->inspection->location->pit;
        if ($comp == 'MKP') {
            $email = NotificationEmail::whereIn('company', ['MKP', 'MIP'])->get();
        } else if ($comp == 'RML') {
            $email = NotificationEmail::whereIn('company', ['RML', 'MIP'])->get();
        }
        $cc = $email->map(function ($e, $k) {
            return $e->email;
        });
        return new Envelope(
            subject: "[OPTIMALS - GMP] ISSUE-" . $this->issue->code . ", DI-" . $this->issue->summary->inspection->code . ", " . issue()[$this->issue->status],
            cc: $cc,
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'email.update_issue_status',
            with: ['issue' => $this->issue],

            // text: "test"
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
