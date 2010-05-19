<?php
class Event_Publisher_Kultunaut implements Event_Publisher
{
    protected $place;

    function __construct($place)
    {
        $this->place = $place;
    }

    function publish(Event $event)
    {
        $timestamp = date('YmdHis');
        $request = new HTTP_Request2('http://www.kultunaut.dk/perl/arradd/type-nynaut/timestamp-' . $timestamp, HTTP_Request2::METHOD_POST);

        $summary = $event->getTitle();
        $short_description = $event->getTeaser();
        $long_description = $event->getDescription();
        $start_date_day = $event->getStartAt()->format('d');
        $start_date_month = $event->getStartAt()->format('n');
        $start_date_year = $event->getStartAt()->format('Y');
        $end_date_day = $event->getEndAt()->format('d');
        $end_date_month = $event->getEndAt()->format('n');
        $start_date_year = $event->getEndAt()->format('Y');
        if ($event->getStartAt()->format('i') == '00') {
            $time = 'kl. ' . $event->getStartAt()->format('H');
        } else {
            $time = 'kl. ' . $event->getEndAt()->format('H') . '.' . $event->getEndAt()->format('i');
        }
        $genre = $event->getCategory();
        $group = 'Alle'; // Målgruppe
        $price = $event->getPrice();
        $homepage = $event->getLink();
        $email = $event->getHost()->getEmail();

        $data = array(
            'side' => 'arr',
            'ArrKunstner' => $summary,
            'ArrBeskrivelse' => $short_description,
            'ArrLangBeskriv' => $long_description,
            'ArrStartday' => $start_date_day,
            'ArrStartmonth' => $start_date_month,
            'ArrStartyear' => $start_date_year,
            'ArrSlutday' => $end_date_day,
            'ArrSlutmonth' => $end_date_month,
            'ArrSlutyear' => $start_date_year,
            'ArrTidspunkt' => $time,
            'ArrUGenre' => $genre,
            'ArrMaalgruppe' => $group,
            'ArrPris' => 'Ukendt pris',
            // 'ArrPrisEntre' => $price,
            'ArrHomepage' => $homepage,
            'ArrEmail' => $email
        );

        $data = array_map('utf8_decode', $data);

        $request->addPostParameter($data);

        $response = $request->send();

        // @todo do some error checking

        $timestamp = date('YmdHis');
        $request = new HTTP_Request2('http://www.kultunaut.dk/perl/arradd/type-nynaut/timestamp-' . $timestamp, HTTP_Request2::METHOD_POST);

        $data['side'] = 'sted';
        $data['StedNr'] = $this->place; // Vejle Idrætshøjskole
        $data['SkiftArrang'] = 'no';
        $data['adress'] = utf8_decode($event->getHost()->getName()."\n".$event->getHost()->getAddress()."\n".$event->getHost()->getZipcode()." ". $event->getHost()->getCity());

        $request->addPostParameter($data);

        $response = $request->send();

        $body = $response->getBody();

        // @todo do some error checking

        $xpath = new DOMXPath(@DOMDocument::loadHTML($body));

        $event_id = $xpath->query("//input[@type='hidden' and @name='ArrNr']/@value")->item(0)->nodeValue; #4485217

        $data['side'] = 'godkend';
        $data['ArrNr'] = $event_id;

        $request = new HTTP_Request2('http://www.kultunaut.dk/perl/arradd/type-nynaut/timestamp-' . $timestamp . '/tak', HTTP_Request2::METHOD_POST);
        $request->addPostParameter($data);
        $response = $request->send();

        return $event_id;
    }
}
