<?php

/*
 * This file is part of the Cilex framework.
 *
 * (c) Mike van Riel <mike.vanriel@naenius.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CommonLedger\Jobs\SoftwareEngineer\Commands;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use GuzzleHttp\Client;

/**
 * Example command for testing purposes.
 */
class SendToken extends \Cilex\Command\Command
{
    protected function configure()
    {
        $this
            ->setName('token:send')
            ->setDescription('Send your code and token to Common Ledger')
            ->addArgument('token', InputArgument::REQUIRED, 'The token you received from CL Job API');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // Building HTTP client
        $http_api = new \GuzzleHttp\Client();

        $token = $input->getArgument('token');

        // Building the structure of the request to the CL Job API
        $json = array(
            'code'  =>  array(),
            'token' =>  $token
        );

        // Getting code of Commands inside ./command
        $command_directory = opendir(__DIR__);
        while (false !== ($file = readdir($command_directory)))
        {
            if (preg_match("/.+?\.php$/", $file))
            {
                $json['code']['./' . basename(__DIR__) . '/' . $file] = base64_encode(file_get_contents(__DIR__ . "/" . $file));

            }
        }

        // Sending request to CL Job API
        try
        {
            $api_response = $http_api->post(
                "http://local.www.commonledger.com/job/github/software-engineer/token",
                array(
                    'headers' => array(
                        'content-type' => 'application/json'
                    ),
                    'body'  =>  json_encode($json)
                )
            );
        }
        catch (\GuzzleHttp\Exception\ClientException $e)
        {
            return $output->writeln("CL Job API: Cannot make a connection, can you access http://www.commonledger.com/ ?");
        }

        // Did the request successfully respond ?
        if ($api_response->getStatusCode() != "200")
        {
            return $output->writeln("CL Job API HTTP Status (" . $api_response->getStatusCode() . "): Are you sure you sent the right data?");
        }

        // Get the JSON response and parse it to gain access to "token"
        $api_json_response = json_decode($api_response->getBody(), true);

        $output->writeln("Fantastic, we got your email and code. We will be in touch soon at " . $api_json_response['email']);

        return;
    }
}
