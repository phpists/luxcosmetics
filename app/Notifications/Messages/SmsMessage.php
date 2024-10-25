<?php

namespace App\Notifications\Messages;

use Illuminate\Support\Facades\Http;

class SmsMessage
{
    protected string $baseUrl;
    protected string $login;
    protected string $apiKey;
    protected string $sign;

    protected null|string|array $to;
    protected array $lines;

    /**
     * SmsMessage constructor.
     * @param array $lines
     */
    public function __construct($lines = [])
    {
        $this->lines = $lines;

        $this->baseUrl = config('services.sms_aero.base_url');
        $this->login = config('services.sms_aero.login');
        $this->apiKey = config('services.sms_aero.api_key');
        $this->sign = config('services.sms_aero.sign');
    }

    public function line(string $line = ''): self
    {
        $this->lines[] = $line;

        return $this;
    }

    public function to(string|array $to): self
    {
        $this->to = $to;

        return $this;
    }

    /**
     * @throws \Exception
     */
    public function send()
    {
        if (!$this->to || !count($this->lines))
            throw new \Exception('SMS not correct.');

        if (is_string($this->to))
            $to = ['number' => $this->to];
        else if (is_array($this->to))
            $to = ['numbers' => $this->to];

        $text = implode("\r\n", $this->lines);

        try {
            return Http::baseUrl($this->baseUrl)
                ->withBasicAuth($this->login, $this->apiKey)
                ->acceptJson()
                ->asForm()
                ->post('sms/send', [
                    ...$to,
                    'sign' => $this->sign,
                    'text' => $text,
                ]);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
        }
    }
}
