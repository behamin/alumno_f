<?php
namespace Entities;

/**
* @Entity
 * @Table(name="questions")
 */

class Preguntas
{

		/**
     * @Id @GeneratedValue @Column(type="integer")
     * @var int
     **/
    protected $id_question;

		/**
     * @Column(type="string")
     * @var string
     **/
    protected $question;

	 	public function getIdquestion()
    {
        return $this->id_question;
    }

		public function getQuestion()
    {
        return $this->question;
    }

}
