<?php
/**
 * Entities_Event
 *
 * @Table(name="event")
 * @Entity
 */
class Entities_Event implements Event
{
    /**
     * @var integer $id
     *
     * @Column(name="id", type="integer")
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var string $title
     *
     * @Column(name="title", type="string", length=255)
     */
    protected $title;

    /**
     * @var string $tagline
     *
     * @Column(name="tagline", type="string", length=255)
     */
    protected $tagline;

    /**
     * @var string $teaser
     *
     * @Column(name="teaser", type="string", length=65555)
     */
    protected $teaser;

    /**
     * @var string $description
     *
     * @Column(name="description", type="string", length=65555)
     */
    protected $description;

    /**
     * @var string $link
     *
     * @Column(name="link", type="string", length=65555)
     */
    protected $link;

    /**
     * @var datetime $start_at
     *
     * @Column(name="start_at", type="datetime")
     */
    protected $start_at;

    /**
     * @var datetime $end_at
     *
     * @Column(name="end_at", type="datetime")
     */
    protected $end_at;

    /**
     * @var datetime $dateCreated
     *
     * @Column(name="date_created", type="datetime")
     */
    protected $dateCreated;

    /**
     * @var datetime $dateUpdated
     *
     * @Column(name="date_updated", type="datetime")
     */
    protected $dateUpdated;

    /**
     * @var decimal $price
     *
     * @Column(name="price", type="decimal")
     */
    protected $price;

    /**
     * Gets the host of the event
     *
     * @return object Event_Host
     */
    function getHost()
    {

    }

    /**
     * Gets the location on the host
     *
     * @return string
     */
    function getLocation()
    {

    }

    /**
     * Gets title
     *
     * @return string
     */
    function getTitle()
    {
        return $this->title;
    }

    /**
     * Gets tagline
     *
     * @return string
     */
    function getTagline()
    {
        return $this->tagline;
    }

    /**
     * Gets short teaser
     *
     * @return string
     */
    function getTeaser()
    {
        return $this->teaser;
    }

    /**
     * Gets description
     *
     * @return string
     */
    function getDescription()
    {
        return $this->description;
    }

    /**
     * Gets price in smallest amount, for instance cents and øre
     *
     * @return integer
     */
    function getPrice()
    {
        return $this->price;
    }

    /**
     * Gets description
     *
     * @return string
     */
    function getCategory()
    {

    }

    /**
     * Gets sub category
     *
     * @return string
     */
    function getSubcategory()
    {

    }

    /**
     * Gets start time
     *
     * @return object DateTime
     */
    function getStartAt()
    {
        return $this->start_at;
    }

    /**
     * Gets end time
     *
     * @return object DateTime
     */
    function getEndAt()
    {
        return $this->end_at;
    }

    /**
     * Gets direct link
     *
     * @return link
     */
    function getLink()
    {
        return $this->link;
    }

    function setTitle($title)
    {
        $this->title = $title;
    }
}