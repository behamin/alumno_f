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
     * @Column(type="integer")
     * @var int
     **/
    protected $alumnoid;

		/**
     * @Column(type="integer")
     * @var int
     **/
    protected $questionid;

		/**
     * @Column(type="integer")
     * @var int
     **/
    protected $responseid;

		/**
     * @Column(type="integer")
     * @var int
     **/
    protected $response;

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

		public function getQuestionid()
    {
        return $this->questionid;
    }

		public function getResponseid()
    {
        return $this->responseid;
    }

		public function getResponse()
    {
        return $this->response;
    }

}
