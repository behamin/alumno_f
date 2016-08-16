<?php
namespace Entities;

/**
* @Entity
 * @Table(name="tests")
 */

class Tests
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
    protected $alumnoid;

		/**
     * @Column(type="string")
     * @var string
     **/
    protected $questions;

		/**
     * @Column(type="smallint")
     * @var smallint
     **/
		protected $is_time;

		/**
     * @Column(type="integer")
     * @var int
     **/
    protected $minutes;

		/**
     * @Column(type="smallint")
     * @var smallint
     **/
		protected $evaluation;

		/**
     * @Column(type="smallint")
     * @var smallint
     **/
		protected $question_type;

		/**
     * @Column(type="smallint")
     * @var smallint
     **/
		protected $level_question;

		/**
     * @Column(type="integer")
     * @var int
     **/
    protected $num_question;

		/**
     * @Column(type="datetime")
     **/
    protected $createdtest;

		public function __construct()
    {
        $this->createdtest = new \DateTime("now");
				$this->is_time = 0;
				$this->evaluation = 0;
				$this->level_question = 0;
    }

	 	public function getId()
    {
        return $this->id;
    }

		public function getCreatedtest()
    {
        return $this->createdtest;
    }

		public function getQuestions()
    {
        return $this->questions;
    }

		public function setAlumnoid($alumnoid)
    {
        $this->alumnoid = $alumnoid;
    }

		public function setQuestionType($question_type)
    {
        $this->question_type = $question_type;
    }

		public function setQuestions($questions)
    {
        $this->questions = $questions;
    }

		public function setMinutes($minutes)
    {
        $this->minutes = $minutes;
    }

		public function setNumQuestion($num_question)
    {
        $this->num_question = $num_question;
    }

}
