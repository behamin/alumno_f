<?php
namespace Entities;

/**
* @Entity(repositoryClass="Repositories\PreguntasRepositorio")
 * @Table(name="join_question")
 */

class PreguntasJoin
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
    protected $id_question;

		/**
     * @Column(type="integer")
     * @var int
     **/
    protected $id_join;

		/**
     * @Column(type="string")
     * @var string
     **/
    protected $table_join;

	 	public function getIdquestion()
    {
        return $this->id_question;
    }

}
