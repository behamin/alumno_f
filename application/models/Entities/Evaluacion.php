<?php
namespace Entities;

/**
* @Entity
 * @Table(name="evaluacion")
 */

class Evaluacion
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
    protected $testid;

		/**
     * @Column(type="datetime")
     **/
    protected $dateeval;

    /**
     * @OneToMany(targetEntity="Evaluacionrespuesta", mappedBy="evaluacion")
     */
	 private $evaluacionrespuestas;

		public function __construct()
    {
        $this->dateeval = new \DateTime("now");
    }

	 	public function getId()
    {
        return $this->id;
    }

		public function getTestid()
    {
        return $this->testid;
    }

		public function getDateeval()
    {
        return $this->dateeval;
    }

		public function getEvaluacionrespuestas()
    {
				//$this->evaluacionrespuestas = new ArrayCollection();
        return $this->evaluacionrespuestas->toArray();
    }

		public function setTestid($testid)
    {
        $this->testid = $testid;
    }

}
