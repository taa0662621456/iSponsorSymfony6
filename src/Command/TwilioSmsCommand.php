<?php

namespace App\Command;

use Twilio\Rest\Client;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;

class TwilioSmsCommand extends ContainerAwareCommand
{
    private Client $twilio;

    public function __construct(Client $twilio)
    {
        $this->twilio = $twilio;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('myapp:sms')
            ->setDescription('Send reminder text message');
    }

    /**
     * @throws \Twilio\Exceptions\TwilioException
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine');
        $userRepository = $em->getRepository('AppBundle:User');
        $appointmentRepository = $em->getRepository('AppBundle:Appointment');

        // For our app, we'll be sending reminders to everyone who has an appointment on this current day, shortly after midnight.
        // As such, the start and end times we'll be checking for will be 12:00am (00:00h) and 11:59pm (23:59h).
        $start = new \DateTime();
        $start->setTime(00, 00);
        $end = clone $start;
        $end->modify('+1 days');
        $end->setTime(23, 59);

        // get appointments scheduled for today
        $appointments = $appointmentRepository->createQueryBuilder('a')
            ->select('a')
            ->where('a.date BETWEEN :now AND :end')
            ->setParameters([
                'now' => $start,
                'end' => $end,
            ])
            ->getQuery()
            ->getResult();

        if (\count($appointments) > 0) {
            $output->writeln('SMSes to send: #'.\count($appointments));
            $sender = $this->getContainer()->getParameter('twilio_number');

            foreach ($appointments as $appoint) {
                $user = $appoint->getUser();
                $message = $this->twilio->messages->create(
                    $user->getPhoneNumber(), // Send text to this number
                    [
                        'from' => $sender, // My Twilio phone number
                        'body' => 'Hello from Awesome Massages. A reminder that your massage appointment is for today at '.$appoint->getDate()->format('H:i').'. Call '.$sender.' for any questions.',
                    ]
                );

                $output->writeln('SMS #'.$message->sid.' sent to: '.$user->getPhoneNumber());
            }
        } else {
            $output->writeln('No appointments for today.');
        }
    }
}
