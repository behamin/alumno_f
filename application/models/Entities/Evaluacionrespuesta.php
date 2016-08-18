<?php
namespace Entities;

/**
	*@Entity(repositoryClass="Repositories\PreguntasRepositorio")
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

		public function __construct()
    {
        $this->responseid = 0;
				$this->response = -1;
    }

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

		public function setEvaluacionid(Evaluacion $evaluacion)
    {
        $this->evaluacion = $evaluacion;
    }

		public function setAlumnoid($alumnoid)
    {
        $this->alumnoid = $alumnoid;
    }

		public function setQuestionid($questionid)
    {
        $this->questionid = $questionid;
    }

		public function setResponseid($responseid)
    {
        $this->responseid = $responseid;
    }

}
