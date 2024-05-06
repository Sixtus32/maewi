<?php
namespace sixtus\maewi\models;

use DateTime;
use sixtus\maewi\lib\Model;

class Events extends Model
{
    private int $eventId;
    private bool $privacy;
    private int $number_likes;
    private int $number_passes;
    private bool $payment;
    private DateTime $date_started;
    private DateTime $date_ended;
    private string $event_status;
    private string $assisance_conditions;
    private int $accountId;

    public function __construct(
        bool $privacy,
        int $number_likes,
        int $number_passes,
        bool $payment,
        DateTime $date_started,
        DateTime $date_ended,
        string $event_status = 'STARTED',
        string $assisance_conditions,
        int $accountId
    )
    {
        $this->eventId = $this->generateEventId();
    }

    public function generateEventId()
    {
        $query=$this->query("");
        $data=$query->fetch();
        return ($data)?$data['eventId']+1:1;
    }

    public function __get($prop)
    {
        return $this->$prop;
    }

    public function __set($prop, $value)
    {
        $this->$prop=$value;
    }
}