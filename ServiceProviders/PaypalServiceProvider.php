<?php

namespace CMSilex\PayPal\ServiceProviders;

use GuzzleHttp\Client;
use Silex\Application;
use Silex\ServiceProviderInterface;
use Symfony\Component\HttpFoundation\Request;

class PayPalServiceProvider implements ServiceProviderInterface
{
    public function register (Application $app)
    {
        $app['paypal.test'] = $app->share(function () {
            $client = new Client([
                'base_uri' => 'https://api.sandbox.paypal.com/v1/'
            ]);

            $res = $client->post('oauth2/token', [
                'auth' => [
                    'AVpLUAOs0MKwSlY3lkoejUaIYDDVtnkzEZZcvvhjkbm74I-Q08zeumK9YKQtqa_zvDewnTputNTtSq6t',
                    'EFdzypzJDBTNJR9j7bzv2GTpJ2bHlqCgGhRI0-TM5v7aY0qfDvpjZMpCV84K0-ojzUP4fB5HdmWx_jBI'
                ],
                'headers' => [
                    "Accept" => "application/json",
                    "Accept-Language" => "en_AU"
                ],
                'form_params' => [
                    'grant_type' => 'client_credentials'
                ]
            ]);

            dump($res->getBody()->getContents());
        });
    }

    public function boot (Application $app)
    {

    }
}