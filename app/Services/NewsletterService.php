<?php

namespace App\Services;

use App\Models\NewsletterSubscriber;
use Illuminate\Support\Str;

class NewsletterService
{
    public function subscribe(string $email, ?string $name = null, ?string $source = null): NewsletterSubscriber
    {
        $sub = NewsletterSubscriber::firstOrNew(['email' => $email]);

        $sub->name   = $name ?: $sub->name;
        $sub->locale = app()->getLocale();
        $sub->source = $source ?: $sub->source;

        if (!$sub->confirmation_token) {
            $sub->confirmation_token = Str::random(48);
        }

        // For now we treat the form submission as confirmed.
        // To use double opt-in, comment the next line and send a confirmation email.
        $sub->confirmed_at = $sub->confirmed_at ?? now();

        $sub->save();
        return $sub;
    }

    public function unsubscribe(string $email): bool
    {
        return (bool) NewsletterSubscriber::where('email', $email)
            ->update(['unsubscribed_at' => now()]);
    }
}
