<?php

namespace steevanb\ProxyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Informations about a proxy
 *
 * @ORM\Table(name="proxy_proxies")
 * @ORM\Entity(repositoryClass="steevanb\ProxyBundle\EntityRepository\Proxy")
 */
class Proxy
{
	/**
	 * State
	 */
	const STATE_ENABLED = 1;
	const STATE_DISABLED = 2;
	const STATE_DELETED = 3;
	/**
	 * @var int
	 *
	 * @ORM\Column(type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;

	/**
	 * @var string
	 *
	 * @ORM\Column(type="string", length=45)
	 */
	private $address;

	/**
	 * @var int
	 *
	 * @ORM\Column(type="integer", options={"unsigned"=true})
	 */
	private $port;

	/**
	 * @var int
	 *
	 * @ORM\Column(type="smallint", options={"unsigned"=true})
	 */
	private $state = self::STATE_ENABLED;

	/**
	 * @var \DateTime
	 *
	 * @ORM\Column(type="datetime")
	 */
	private $date;

	/**
	 * @var int
	 *
	 * @ORM\Column(type="smallint", options={"unsigned"=true})
	 */
	private $errors = 0;

	/**
	 * @var \DateTime
	 * @ORM\Column(type="datetime", nullable=true)
	 */
	private $lastErrorDate;

	/**
	 * Get id
	 *
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Set address
	 *
	 * @param string $address
	 * @return $this
	 */
	public function setAddress($address)
	{
		$this->address = $address;
		return $this;
	}

	/**
	 * Get address
	 *
	 * @return string
	 */
	public function getAddress()
	{
		return $this->address;
	}

	/**
	 * Set port
	 *
	 * @param int $port
	 * @return $this
	 */
	public function setPort($port)
	{
		$this->port = $port;
		return $this;
	}

	/**
	 * Get port
	 *
	 * @return int
	 */
	public function getPort()
	{
		return $this->port;
	}

	/**
	 * Get adresse:port string
	 *
	 * @return string
	 */
	public function getAddressPort()
	{
		return $this->getAddress() . ':' . $this->getPort();
	}

	/**
	 * Set state
	 *
	 * @param int $state
	 * @return $this
	 */
	public function setState($state)
	{
		$this->state = $state;
		return $this;
	}

	/**
	 * Get state
	 *
	 * @return int
	 */
	public function getState()
	{
		return $this->state;
	}

	/**
	 * Set date
	 *
	 * @param \DateTime $date
	 * @return $this
	 */
	public function setDate(\DateTime $date)
	{
		$this->date = $date;
		return $this;
	}

	/**
	 * Get date
	 *
	 * @return \DateTime
	 */
	public function getDate()
	{
		return $this->date;
	}

	/**
	 * Set errors count
	 *
	 * @param int $count
	 * @return $this
	 */
	public function setErrors($count)
	{
		$this->errors = $count;
		return $this;
	}

	/**
	 * Add an error
	 *
	 * @return $this
	 */
	public function incError()
	{
		$this->errors++;
		$this->setLastErrorDate(new \DateTime());
		return $this;
	}

	/**
	 * Get errors count
	 *
	 * @return int
	 */
	public function getErrors()
	{
		return $this->errors;
	}

	/**
	 * Set last error date
	 *
	 * @param \DateTime $date
	 * @throws \Exception
	 */
	public function setLastErrorDate($date)
	{
		if ($date === null || $date instanceof \DateTime) {
			$this->lastErrorDate = $date;
		} else {
			throw new \Exception('Invalid date format : "' . $date . '".');
		}
	}

	/**
	 * Get last error date
	 *
	 * @return \DateTime
	 */
	public function getLastErrorDate()
	{
		return $this->lastErrorDate;
	}

}