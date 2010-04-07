<?php
require_once 'config.local.php';
require_once 'facebook.php';

class VIH_Host implements Event_Host
{
    function getName() {
        return 'Vejle Idrætshøjskole';
    }
    function getContactPerson() {
        return 'Lars Olesen';
    }
    function getAddress() {
        return 'Ørnebjergvej 28';
    }
    function getZipcode() {
        return '7100';
    }
    function getEmail() {
        return 'lars@vih.dk';
    }
    function getPhone() {
        return '26176860';
    }
    function getCity() {
        return 'Vejle';
    }
}

class VIH_Event implements Event
{
      /**
     * Gets the host of the event
     *
     * @return object Event_Host
     */
    function getHost() {
        return new VIH_Host;
    }

    /**
     * Gets the location on the host
     *
     * @return string
     */
    function getLocation() {
        return 'Kunstgræsbanen';
    }

    /**
     * Gets title
     *
     * @return string
     */
    function getTitle() {
        return 'Dogmefitness';
    }

    /**
     * Gets tagline
     *
     * @return string
     */
    function getTagline() {
        return 'Hård fysisk træning i naturen';
    }

    /**
     * Gets short teaser
     *
     * @return string
     */
    function getTeaser() {
        return 'Vi flytter traktordæk, kaster med træstubbe, skubber og trækker.';
    }

    /**
     * Gets description
     *
     * @return string
     */
    function getDescription() {
        return 'Der bliver sved på panden. Det tror jeg godt, at jeg kan garantere.';
    }

    /**
     * Gets price in smallest amount, for instance cents and øre
     *
     * @return integer
     */
    function getPrice() {
        return 0;
    }

    /**
     * Gets description
     *
     * @return string
     */
    function getCategory() {
        return 'Sport';
    }

    /**
     * Gets sub category
     *
     * @return string
     */
    function getSubcategory() {
        return 'Sportstræning';
    }

    /**
     * Gets start time
     *
     * @return object DateTime
     */
    function getStartAt() {
        return new DateTime('2010-04-08 16:30:00');
    }


    /**
     * Gets end time
     *
     * @return object DateTime
     */
    function getEndAt() {
        return new DateTime('2010-04-08 17:30:00');
    }
}

// http://www.henrycipolla.com/blog/2008/02/how-to-create-infinite-sessions-with-the-facebook-platform-api/


$facebook = new Facebook($appapikey, $appsecret);

if (!empty($_GET['auth_token'])) {
    $auth_token = $_GET['auth_token'];
}

try {
    if (!$facebook->api_client->users_hasAppPermission('create_event')){
        echo '<script type="text/javascript">window.open("http://www.facebook.com/authorize.php?api_key='.$facebook->api_key.'&v=1.0&ext_perm=create_event", "Permission");</script>'; echo'<meta http-equiv="refresh" content="0; URL=javascript:history.back();">'; exit;
    }
} catch (Exception $e) {
    echo '<script type="text/javascript">window.open("http://login.facebook.com/login.php?api_key='.$appapikey.'&v=1.0", "Permission");</script>'; echo'<meta http-equiv="refresh" content="0; URL=javascript:history.back();">'; exit;
}

$event = new VIH_Event;

$publisher = new Event_Publisher_Facebook($facebook);
$publisher->setPageId($page_id); // the page id you want to publish to
$event_id = $publisher->publish($event);

echo 'Published as #' . $event_id;