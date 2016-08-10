<?php
namespace Entities;

/**
* @Entity
 * @Table(name="courses")
 */

class Cursos
{

		/**
     * @Id @GeneratedValue @Column(type="integer")
     * @var int
     **/
    protected $id_course;

		/**
     * @Column(type="string")
     * @var string
     **/
    protected $title_course;

		/**
     * @Column(type="string")
     * @var string
     **/
    protected $text_course;

		/**
     * @Column(type="string")
     * @var string
     **/
    protected $id_legal_rule;

		/**
     * @Column(type="string")
     * @var string
     **/
    protected $id_themes;

		/**
     *@Column(type="integer")
     * @var int
     **/
    protected $time_test;

		/**
     *@Column(type="integer")
     * @var int
     **/
    protected $max_question_test;


	 	public function getIdcourse()
    {
        return $this->id_course;
    }

		public function getTitlecourse()
    {
        return $this->title_course;
    }

		public function getIdlegalrule()
    {
        return $this->id_legal_rule;
    }

		public function getIdthemes()
    {
        return $this->id_themes;
    }

		public function getTextcourse()
    {
        return $this->text_course;
    }

		public function getTimeTest()
    {
        return $this->time_test;
    }

		public function getMaxQuestionTest()
    {
        return $this->max_question_test;
    }

}
