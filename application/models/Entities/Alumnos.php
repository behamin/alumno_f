<?php
namespace Entities;

/**
* @Entity
 * @Table(name="alumnos")
 */

class Alumnos
{

		/**
     * @Id @GeneratedValue @Column(type="integer")
     * @var int
     **/
    protected $id;

		/**
		 * @Column(type="integer")
		 * @var int
		 **/
		protected $courseid;

		/**
     * @Column(type="string",nullable=true)
     * @var string
     **/
    protected $password;

		/**
     * @Column(type="smallint")
     * @var smallint
     **/
    protected $active;

	  /**
     * @Column(type="datetime")
     **/
    protected $created;

	  /**
     * @OneToOne(targetEntity="Alumnosdatos", mappedBy="alumnos",cascade={"remove"})
     */
    protected $alumnosdatos;

    public function __construct()
    {
        $this->created = new \DateTime("now");
    }

	 	public function getId()
    {
        return $this->id;
    }

		public function getCourseid()
    {
        return $this->courseid;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

		public function getActive()
    {
        return $this->active;
    }

    public function setActive($active)
    {

				$this->active = $active;
    }

		public function getCreated()
    {
        return $this->created;
    }

    public function getAlumnosdatos()
    {
        return $this->alumnosdatos;
    }

		public function setAlumnosdatos($alumnosdatos)
    {
        $this->alumnosdatos = $alumnosdatos;
    }

}
