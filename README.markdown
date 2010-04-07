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
        return'<script type="text/javascript">window.open("http://www.facebook.com/authorize.php?api_key='.$this->facebook->api_key.'&v=1.0&ext_perm=create_event", "Permission");</script>'; echo'<meta http-equiv="refresh" content="0; URL=javascript:history.back();">'; exit;
    }
    
    $publisher = new Event_Publisher_Facebook($client);
    $publiser->setPageId($page_id); // the page id you want to publish to
    $publisher->publish($event);
    