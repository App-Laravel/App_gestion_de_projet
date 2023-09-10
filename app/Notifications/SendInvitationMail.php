<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Modules\Project\src\Models\Project;
use Illuminate\Support\Facades\URL;

class SendInvitationMail extends Notification
{
    use Queueable;

    protected $project;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Project $project)
    {
        $this->project = $project;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail(object $notifiable): MailMessage
    {
        
        $senderName = ucwords($notifiable->name);
        $projectName = ucfirst($this->project->name);
        
        $url = URL::temporarySignedRoute(
            'user.projects.accept-invitation',
            Carbon::now()->addHours(24),
            [
                'id'    => $this->project->id,
                'hash'  => sha1($notifiable->email),
            ]
        );

        return (new MailMessage)
                ->subject("$senderName has invited you to join a project")
                ->markdown('mail.invite', [
                    'senderName'    => $senderName,
                    'projectName'   => $projectName,
                    'url'           => $url,
                ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
