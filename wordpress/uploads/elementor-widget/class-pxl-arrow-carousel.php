<?php

class PxlArrowCarousel_Widget extends Pxltheme_Core_Widget_Base{
    protected $name = 'pxl_arrow_carousel';
    protected $title = 'Case Nav Carousel';
    protected $icon = 'eicon-animation';
    protected $categories = array( 'pxltheme-core' );
    protected $params = '{"sections":[{"name":"style_section","label":"Style","tab":"content","controls":[{"name":"style","label":"Style","type":"select","options":{"style-1":"Style 1"},"default":"style-1"}]}]}';
    protected $styles = array(  );
    protected $scripts = array(  );
}