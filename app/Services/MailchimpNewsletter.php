<?php

namespace App\Services;

use MailchimpMarketing\ApiClient;

class MailchimpNewsletter implements Newsletter
{
    public function __construct(protected ApiClient $client)
    {

    }

    public function subscribe(string $email, string $list = null)
    {
        $list ??= config('services.mailchimp.lists.subscriber');

        return $this->client->lists->addListMember('679bea46a6',[
            'email_address' => $email,
            'status' => 'subscribed'
        ]);
    }


}
