Eventpublishers
==

A bunch of event publishers to create events:

Create events
--

The events needs to implement the interfaces supplied in this package.

    $event = new Event($data, $host);   

Facebook
--

The facebook publisher requires the official Facebook php5 library:

    pear channel-discover pearhub.org
    pear install pearhub/facebook
    
An example on how to use the publisher:

    $client = new Facebook($appapikey, $appsecret);

    if (!$facebook->api_client->users_hasAppPermission('create_event')){
        return'<script type="text/javascript">window.open("http://www.facebook.com/authorize.php?api_key='.$facebook->api_key.'&v=1.0&ext_perm=create_event", "Permission");</script>'; echo'<meta http-equiv="refresh" content="0; URL=javascript:history.back();">'; exit;
    }
    
    $publisher = new Event_Publisher_Facebook($client, $page_id);
    $publisher->publish($event);
    
Kultunaut
--

The kultunaut publisher requires PEAR's HTTP_Request2:

    pear install HTTP_Request2
    
An example on how to use the publisher:

    $publisher = new Event_Publisher_Kultunaut($place);
    $publisher->publish($event);    
    
Known issues
--

* No way to update the published material
* Subscription could be added
* Add tests - how could I do that