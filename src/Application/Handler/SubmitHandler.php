<?php

namespace Application\Handler;

use Application\CommandQuery\SubmitCommand;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class SubmitHandler
{
    private HttpClientInterface $client;
    private MailerInterface $mailer;
    private string $rapidApiKey;

    public function __construct(HttpClientInterface $client, MailerInterface $mailer, string $rapidApiKey)
    {
        $this->client = $client;
        $this->mailer = $mailer;
        $this->rapidApiKey = $rapidApiKey;
    }

    public function handle(SubmitCommand $command): array
    {
        $url = 'https://rapidapi.com/apidojo/api/yahoo-finance1?endpoint=apiendpoint_a1e0ecc6-0a3a-43fd-8133-77a66d33f68c';

        $headers = [
            'Accept' => 'application/json',
            'X-RapidAPI-Key' => $this->rapidApiKey,
            'x-rapidapi-host' => 'apidojo-yahoo-finance-v1.p.rapidapi.com',
        ];

        $startDate = \DateTime::createFromFormat('Y-m-d', $command->startDate);
        $endDate = \DateTime::createFromFormat('Y-m-d', $command->endDate);

        $query = [
            'symbol' => $command->company,
            'period1' => $startDate->getTimestamp(),
            'period2' => $endDate->getTimestamp(),
        ];

        $response = $this->client->request('GET', $url, ['headers' => $headers, 'query' => $query]);

        $data = json_decode($response->getContent(), true);

        $this->sendEmail($command->email, $data);

        return $data;
    }

    private function sendEmail(string $destination, array $data): void
    {
        $message = (new Email())
            ->from('info@challenge.com')
            ->to($destination)
            ->subject('Time for Symfony Mailer!')
            ->text('Sending emails is fun again!')
            ->html('<p>See Twig integration for better HTML integration!</p>');

        $this->mailer->send($message);
    }
}
