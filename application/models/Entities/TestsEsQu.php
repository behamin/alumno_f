<?php
namespace Entities;

/**
* @Entity
 * @Table(name="test_questions")
 */

class TestsEsQu
{

		/**
     * @Id @GeneratedValue @Column(type="integer")
     * @var int
     **/
    protected $id;

		/**
     *@Column(type="integer")
     * @var int
     **/
    protected $id_test;

		/**
     *@Column(type="integer")
     * @var int
     **/
    protected $id_question;

		public function getId()
    {
        return $this->id;
    }

		public function getIdtest()
    {
        return $this->id_test;
    }

		public function getIdquestion()
    {
        return $this->id_question;
    }

}
