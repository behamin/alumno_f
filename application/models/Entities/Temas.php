<?php
namespace Entities;

/**
* @Entity
 * @Table(name="themes")
 */

class Temas
{

		/**
     * @Id @GeneratedValue @Column(type="integer")
     * @var int
     **/
    protected $id_theme;

		/**
     * @Column(type="string")
     * @var string
     **/
    protected $title_theme;

		/**
     * @Column(type="string")
     * @var string
     **/
    protected $text_theme;

	 	public function getIdtheme()
    {
        return $this->id_theme;
    }

		public function getTitletheme()
    {
        return $this->title_theme;
    }

		public function getTexttheme()
    {
        return $this->text_theme;
    }

}
