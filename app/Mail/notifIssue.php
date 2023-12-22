<?php

namespace App\Mail;

use App\Models\DailyInspection;
use App\Models\NotificationEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class notifIssue extends Mailable
{
    use Queueable, SerializesModels;

    public DailyInspection $dailyInspection;
    public array $issues;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($dailyInspection, $issues)
    {
        $this->dailyInspection = $dailyInspection;
        $this->issues = $issues;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        $comp = $this->dailyInspection->location->pit;
        if ($comp == 'MKP') {
            $email = NotificationEmail::whereIn('company', ['MKP', 'MIP'])->get();
        } else if ($comp == 'RML') {
            $email = NotificationEmail::whereIn('company', ['RML', 'MIP'])->get();
        }
        $cc = $email->map(function ($e, $k) {
            return $e->email;
        });
        return new Envelope(
            subject: '[OPTIMALS - GMP]DAILY INSPECTION - ' . $this->dailyInspection->code . ' HAS  NEW ISSUE',
            cc: $cc
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
            view: 'email.notif_issue',
            with: ['dailyInspection' => $this->dailyInspection, 'issues' => $this->issues]
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
