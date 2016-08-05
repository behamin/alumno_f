<?php
namespace Entities;

/**
* @Entity
 * @Table(name="evaluacionrespuestas")
 */

class Evaluacionrespuesta
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
    protected $evaluacionid;

    /**
     * @ManyToOne(targetEntity="Evaluacion", inversedBy="evaluacionrespuesta")
     * @JoinColumn(name="evaluacionid", referencedColumnName="id")
     */
    private $evaluacion;

	 	public function getId()
    {
        return $this->id;
    }

		public function getEvaluacionid()
    {
        return $this->evaluacionid;
    }

}
