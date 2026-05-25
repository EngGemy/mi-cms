<?php

namespace App\Http\Controllers;

use App\Actions\StoreContactSubmission;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    public function store(ContactRequest $request, StoreContactSubmission $action)
    {
        $submission = $action->handle($request->validated(), $request);

        // TODO: dispatch SendContactNotification job (mail to sales inbox)

        return back()->with('contact_ok', __('messages.contact_ok'));
    }
}
