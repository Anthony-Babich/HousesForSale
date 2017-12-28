<?php
namespace House\Bundle\EventListener;

use ADesigns\CalendarBundle\Event\CalendarEvent;
use ADesigns\CalendarBundle\Entity\EventEntity;
use Doctrine\ORM\EntityManager;

class CalendarEventListener
{
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function loadEvents(CalendarEvent $calendarEvent)
    {
        $request = $calendarEvent->getRequest();
        $id = htmlspecialchars($request->get('type'));

        $companyEvents = $this->entityManager->getRepository('HouseBundle:RentalDates')->findBy(array('idHouse' => $id));

        foreach($companyEvents as $companyEvent) {
            $start = new \DateTime($companyEvent->getStartDate());
            $end = new \DateTime($companyEvent->getEndDate());
            $eventEntity = new EventEntity('', $start, $end, true);

            //optional calendar event settings
            $eventEntity->setAllDay(true); // default is false, set to true if this is an all day event
            $eventEntity->setBgColor('unset'); //set the background color of the event's label
            $eventEntity->setFgColor('#FFFFFF'); //set the foreground color of the event's label
            $eventEntity->setUrl(''); // url to send user to when event label is clicked
            $eventEntity->setCssClass('my-custom-class'); // a custom class you may want to apply to event labels

            //finally, add the event to the CalendarEvent for displaying on the calendar
            $calendarEvent->addEvent($eventEntity);
        }
    }
}