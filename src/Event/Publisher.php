<?php
interface Event_Publisher
{
    function publish(Event $event);
}