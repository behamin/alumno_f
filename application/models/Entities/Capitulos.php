<?php
namespace Entities;

/**
* @Entity
 * @Table(name="themes_parts")
 */

class Capitulos
{

		/**
     * @Id @GeneratedValue @Column(type="integer")
     * @var int
     **/
    protected $id_theme_parts;

		/**
     * @Column(type="integer")
     * @var int
     **/
    protected $id_theme;

		/**
     * @Column(type="integer")
     * @var int
     **/
    protected $id_scheme;

		/**
     * @Column(type="string")
     * @var string
     **/
    protected $title_theme_parts;

		/**
     * @Column(type="string")
     * @var string
     **/
    protected $text_theme_parts;

		/**
		 * @Column(type="string")
		 * @var string
		 **/
		protected $video_theme_parts;

		/**
		 * @Column(type="string")
		 * @var string
		 **/
		protected $image_theme_parts;

		/**
     * @Column(type="integer")
     * @var int
     **/
    protected $join_theme_part;

	 	public function getIdthemeparts()
    {
        return $this->id_theme_parts;
    }

		public function getIdtheme()
    {
        return $this->id_theme;
    }

		public function getIdscheme()
    {
        return $this->id_scheme;
    }

		public function getTitlethemeparts()
    {
        return $this->title_theme_parts;
    }

		public function getTextthemeparts()
    {
        return $this->text_theme_parts;
    }

		public function getVideothemeparts()
    {
        return $this->video_theme_parts;
    }

		public function getImagethemeparts()
    {
        return $this->image_theme_parts;
    }

		public function getJointhemepart()
    {
        return $this->join_theme_part;
    }

}
