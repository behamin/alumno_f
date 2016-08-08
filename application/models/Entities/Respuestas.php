<?php
namespace Entities;

/**
* @Entity
 * @Table(name="responses")
 */

class Respuestas
{

		/**
     * @Id @GeneratedValue @Column(type="integer")
     * @var int
     **/
    protected $id_response;

		/**
     * @Column(type="integer")
     * @var int
     **/
    protected $id_question;

		/**
     * @Column(type="string")
     * @var string
     **/
    protected $response;

		/**
     * @Column(type="smallint")
     * @var smallint
     **/
    protected $ok_response;

	 	public function getIdresponse()
    {
        return $this->id_response;
    }

		public function getIdquestion()
    {
        return $this->id_question;
    }

		public function getResponse()
    {
        return $this->response;
    }

		public function getOkresponse()
    {
        return $this->ok_response;
    }

}
