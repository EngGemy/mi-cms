<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsletterRequest;
use App\Services\NewsletterService;

class NewsletterController extends Controller
{
    public function store(NewsletterRequest $request, NewsletterService $service)
    {
        $service->subscribe(
            $request->input('email'),
            $request->input('name'),
            $request->input('source', 'footer'),
        );

        return back()->with('newsletter_ok', __('messages.newsletter_ok'));
    }
}
