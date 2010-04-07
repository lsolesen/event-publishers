<?php
class Event_Publisher_Facebook implements Event_Publisher
{
    protected $facebook;
    protected $page_id = null;

    function __construct(Facebook $facebook)
    {
        $this->facebook = $facebook;
    }

    function setPageId($page_id)
    {
        $this->page_id = $page_id;
    }

    function publish(Event $event)
    {
        if ($this->page_id === null) {
            throw new Exception('Set the page_id');
        }

        // validate category and subcategory

        // validate time
        $start_date_day = $event->getStartAt()->format('d');
        $start_date_month = $event->getStartAt()->format('m');
        $start_date_year = $event->getStartAt()->format('Y');
        $start_time_hour = $event->getStartAt()->format('H');
        $start_time_min = $event->getStartAt()->format('i');

        $end_date_day = $event->getEndAt()->format('d');
        $end_date_month = $event->getEndAt()->format('m');
        $end_date_year= $event->getEndAt()->format('Y');
        $end_time_hour = $event->getEndAt()->format('H');
        $end_time_min = $event->getEndAt()->format('i');

        // @hack to provide the correct timestamp for Denmark
        $timestamp_add = 9;
        $timestamp_add = 0;
        $start_time_hour = $start_time_hour + $timestamp_add;
        $end_time_hour = $end_time_hour + $timestamp_add;
        // @hack end

        $start_time = mktime($start_time_hour, $start_time_min, 00, $start_date_month, $start_date_day, $start_date_year);
        $end_time = mktime($end_time_hour, $end_time_min, 00, $end_date_month, $end_date_day, $end_date_year);

        $data = array(
            'name' => $event->getTitle(),
            'category' => $event->getCategory(),
            'subcategory' => $event->getSubCategory(),
            'host' => $event->getHost()->getName(),
            'location' => $event->getLocation(),
            'start_time' => $start_time,
            'end_time' => $end_time,
            'street' => $event->getHost()->getAddress(),
            'city' => $event->getHost()->getCity(),
            'phone' => $event->getHost()->getPhone(),
            'email' => $event->getHost()->getEmail(),
            'description' => $event->getTeaser(),
            'privacy_type', // OPEN, CLOSED, SECRET
            'tagline' => $event->getTagline(),
            'page_id' => $this->page_id
        );

        try {
            return $event_id = $this->facebook->api_client->events_create(json_encode($data));
        } catch (Exception $e){
            throw $e;
        }
    }
}