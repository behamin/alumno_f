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
     * @Column(type="string")
     * @var string
     **/
    protected $testid;

		/**
     * @Column(type="datetime")
     **/
    protected $dateeval;

		 /**
     * @ManyToOne(targetEntity="Evaluacionrespuesta")
     * @JoinColumn(name="evaluacionid", referencedColumnName="id")
     */
    protected $evaluacionrespuestas;

		public function __construct()
    {
        $this->dateeval = new \DateTime("now");
				$this->evaluacionrespuestas = new ArrayCollection();
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
        return $this->evaluacionrespuestas->toArray();
    }

}
