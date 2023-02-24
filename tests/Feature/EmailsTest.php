<?php

namespace Tests\Feature;

use App\Enums\Role;
use App\Mail\InviteMail;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class EmailsTest extends TestCase
{
    public function test_send_email()
    {
        Mail::fake();

        $rec1 = [
            'email' => fake()->email,
            'role' => Role::rand()->value,
        ];

        $rec2 = [
            'email' => fake()->email,
            'role' => Role::rand()->value,
        ];

        $data = [
            'recipients' => [$rec1, $rec2],
            'message' => fake()->text
        ];

        $this->postJson(route('sendMail'), $data)
            ->assertSuccessful();

        Mail::assertQueued(InviteMail::class, function ($mail) use ($data) {
            $mail->hasTo($data['recipients'][0]['email']);
            $mail->hasTo($data['recipients'][1]['email']);
            $mail->assertHasSubject('Invite to Forever Missed');

            return $mail;
        });
    }

    public function test_send_email_validation_error()
    {
        $rec1 = [
            'email' => fake()->email,
            'role' => Role::rand()->value,
        ];

        $rec2 = [
            'email' => fake()->email,
            'role' => null,
        ];

        $data = [
            'recipients' => [$rec1, $rec2],
            'message' => fake()->text
        ];

        $this->postJson(route('sendMail'), $data)
            ->assertStatus(422);
    }
}
