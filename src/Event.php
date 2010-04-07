<?php
interface Event
{
    /**
     * Gets the host of the event
     *
     * @return object Event_Host
     */
    function getHost();

    /**
     * Gets the location on the host
     *
     * @return string
     */
    function getLocation();

    /**
     * Gets title
     *
     * @return string
     */
    function getTitle();

    /**
     * Gets tagline
     *
     * @return string
     */
    function getTagline();

    /**
     * Gets short teaser
     *
     * @return string
     */
    function getTeaser();

    /**
     * Gets description
     *
     * @return string
     */
    function getDescription();

    /**
     * Gets price in smallest amount, for instance cents and øre
     *
     * @return integer
     */
    function getPrice();

    /**
     * Gets description
     *
     * @return string
     */
    function getCategory();

    /**
     * Gets sub category
     *
     * @return string
     */
    function getSubcategory();

    /**
     * Gets start time
     *
     * @return object DateTime
     */
    function getStartAt();


    /**
     * Gets end time
     *
     * @return object DateTime
     */
    function getEndAt();
}