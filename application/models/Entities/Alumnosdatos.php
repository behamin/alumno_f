<?php
namespace Entities;

/**
 * @Entity
 * @Table(name="alumnosdatos")
 */

class Alumnosdatos
{

	/**
     * @Id @GeneratedValue @Column(type="integer")
     * @var int
     **/
    protected $id;

    /**
     * @OneToOne(targetEntity="Alumnos", inversedBy="alumnosdatos")
     * @JoinColumn(name="alumnosid", referencedColumnName="id")
     */
    protected $alumnos;

		/**
     * @Column(type="string",length=45)
     * @var string
     **/
    protected $name;

		/**
     * @Column(type="string",length=45,nullable=false)
     * @var string
     **/
    protected $surname;

		/**
     * @Column(type="string",length=150,nullable=false,unique=true,options={"comment":"required|valid_email"})
     * @var string
     **/
    protected $email;

		/**
     * @Column(type="string",length=45,nullable=true)
     * @var string
     **/
    protected $address;

		/**
     * @Column(type="string",length=45,nullable=true)
     * @var string
     **/
    protected $city;

		/**
     * @Column(type="smallint",nullable=true)
     * @var smallint
     **/
    protected $zip;

		/**
     * @Column(type="integer",nullable=true)
     * @var string
     **/
    protected $phone;

		/**
		 * @Column(type="string",length=9,nullable=true)
		 * @var string
		 **/
		protected $nif;

		/**
     * @Column(type="string",nullable=true)
     * @var string
     **/
    protected $image;

		public function __construct()
    {

    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

		public function getSurname()
    {
        return $this->surname;
    }

    public function setSurname($surname)
    {
        $this->surname = $surname;
    }

		public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

		public function getAddress()
    {
        return $this->address;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

		public function getCity()
    {
        return $this->city;
    }

    public function setCity($city)
    {
        $this->city = $city;
    }

		public function getZip()
    {
        return $this->zip;
    }

    public function setZip($zip)
    {
        $this->zip = $zip;
    }

		public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

		public function getNif()
    {
        return $this->nif;
    }

    public function setNif($nif)
    {
        $this->nif = $nif;
    }

		public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

		public function getAlumnos()
    {
        return $this->alumnos;
    }

		public function setAlumnos($alumnos)
    {
        $this->alumnos = $alumnos;
    }

}
