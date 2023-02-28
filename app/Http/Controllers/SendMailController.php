<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecipientRequest;
use App\Mail\InviteMail;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;

class SendMailController extends Controller
{
    public function __invoke(RecipientRequest $request): JsonResponse
    {
        foreach ($request->recipients as $recipient) {
            Mail::to($recipient['email'])->later(now()->addMinute(), new InviteMail($request->input('message')));
        }

        return response()->json([
            'status' => 'success'
        ]);
    }
}
