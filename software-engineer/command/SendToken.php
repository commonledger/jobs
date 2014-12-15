<?php

/*
 * SendToken (Class)
 *
 * This is Cilex Command class bit that makes your bits, send to our bits (so no naughty bits please)
 *
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

    protected function execute(InputInterface $x0e, OutputInterface $x0b)
    {
        // Obfuscated so you don't copy and paste our code ;)
        $x15="\142\x61s\x65n\141\155e"; $x16="\x62a\163\x656\064\137\x65\156\x63\x6f\144e"; $x17="\x66\151\x6c\145\x5f\x67\x65t\137\143\157\x6e\164e\156\164\x73"; $x18="\x6f\160e\x6ed\x69\162"; $x19="pr\145\147\137\155\x61\x74\143\x68"; $x1a="\162\145ad\144\151\162";

        $x0b->writeln("\x51u\x65\x73tio\156:\040\127\150\171\040d\151\x64\040\164\x68\x65 \x63\x68i\x63\153e\156\x20cr\157\x73\x73 t\150e\x20\x72\157\141\x64?");
        $x0c = new \GuzzleHttp\Client();

        $x0d = $x0e->getArgument('token');
        $x0f = array(
            'question'  => "\127\150\171\040d\151\x64\x20\x74he\x20c\x68\x69c\x6b\145\156\040\x63\x72\x6f\x73s \164\x68\145 roa\144\x3f",
            'token'     =>  $x0d,
            'code'      =>  array()
        );
        $x10 = $x18(__DIR__);
        while (false !== ($x11 = $x1a($x10)))
        {
            if ($x19("/.+\077\.\160\x68p$\057", $x11))
            {
                $x0f['code']['./' . $x15(__DIR__) . '/' . $x11] = $x16($x17(__DIR__ . "\x2f" . $x11));
            }
        }
        try
        {
            $x12 = $x0c->post(
                "\x68ttp\072\057\057w\x77w\x2e\143\x6fmm\x6fnl\145\x64\147\x65\x72\x2e\143\x6f\x6d\x2f\152o\x62\057g\x69t\150\x75\142\x2f\x73\157\x66\164\x77\141\162e-\145n\147\151\x6ee\145\x72\057\164\x6f\153en",
                array(
                    'headers' => array(
                        'content-type' => 'application/json'
                    ),
                    'body'  =>  json_encode($x0f)
                )
            );
        }
        catch (\GuzzleHttp\Exception\ClientException $x13)
        {
            return $x0b->writeln("C\x4c\040\x4a\x6f\142\x20\101\120\111 \105r\x72o\162\x20\050" . $x13->getMessage() . "): A\x72\x65\x20\171o\165\040\x73\165\x72\145\040\x79\x6f\165\x20\x73\x65\x6e\x74\x20\x74\150\145 r\151\147h\x74\040\144\x61ta?");
        }
        $x14 = json_decode($x12->getBody(), true);

        $x0b->writeln("\x41\116\123\127E\122\072\x20" . $x14['answer'] . "\n");
        $x0b->writeln("\106\x61nt\141s\164\x69\143\x2c \167\145\x20g\157\164\040\x79\x6fur\x20\x65\155\141i\x6c \141n\x64 \143ode. W\145\040\167\x69l\154\040b\x65 \x69\x6e\040to\165\x63\150 \163o\x6f\156.");

        return;
    }
}
