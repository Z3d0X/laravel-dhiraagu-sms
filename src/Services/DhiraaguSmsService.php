<?php

namespace Zedox\LaravelDhiraaguSms\Services;

use GuzzleHttp\Client;
use Zedox\LaravelDhiraaguSms\Exceptions\CouldNotSendSms;
use Zedox\LaravelDhiraaguSms\Exceptions\CouldNotUseSmsService;

class DhiraaguSmsService {
    const DEFAULT_API_URL = 'https://bulkmessage.dhiraagu.com.mv/jsp/receiveSMS.jsp';
    private $userid;
    private $password;
    protected $url;

    /**
     * @param string $userid
     * @param string $password
     * @param string $url
     * @throws CouldNotUseSmsService
     */
    public function __construct($userid, $password, $url = '')
    {
        $this->userid = $userid;
        $this->password = $password;
        $this->url = $url ?: self::DEFAULT_API_URL;
        if (!$userid || !$password) {
            throw CouldNotUseSmsService::missingCredentials();
        }
    }

    /**
     * @param string $toMobile
     * @param string $message
     * @return bool
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws CouldNotSendSms
     * @throws CouldNotUseSmsService
     */
    public function send($toMobile, $message)
    {
        if (in_array(strlen($toMobile),[7,10])) {
            if (strlen($toMobile) === 7) $toMobile = '960'.$toMobile;
            if(strlen($toMobile) === 10 && substr($toMobile, 0, 3) !== '960') {
                throw CouldNotUseSmsService::invalidRecipient();
            }
        } else {
            throw CouldNotUseSmsService::invalidRecipient();
        }

        $client = new Client();
        $query = [
            'userid' => $this->userid,
            'password' => $this->password,
            'to' => $toMobile,
            'text' => $message
        ];

        $response = $client->request('GET', $this->url,
            ['query' => $query]
        );

        $responseBody = trim($response->getBody()->getContents());
        $responseStatus = explode(':', $responseBody)[0];
        if ($responseStatus === 'Failed'){
            throw CouldNotSendSms::serviceRespondedWithAnError($responseBody);
        } else {
            return true;
        }
    }
}