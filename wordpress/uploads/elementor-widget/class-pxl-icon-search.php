<?php

class PxlIconSearch_Widget extends Pxltheme_Core_Widget_Base{
    protected $name = 'pxl_icon_search';
    protected $title = 'Case Search';
    protected $icon = 'eicon-search';
    protected $categories = array( 'pxltheme-core' );
    protected $params = '{"sections":[{"name":"section_content","label":"Content","tab":"content","controls":[{"name":"email_placefolder","label":"Email Placefolder","type":"text","label_block":true,"condition":{"search_type":["form"]}},{"name":"pxl_icon","label":"Icon","type":"icons","fa4compatibility":"icon"},{"name":"icon_color","label":"Icon Color","type":"color","selectors":{"{{WRAPPER}} .pxl-search-popup-button i":"color: {{VALUE}} !important;","{{WRAPPER}} .pxl-search-popup-button svg path":"stroke: {{VALUE}} !important;"},"condition":{"search_type":["popup"]}},{"name":"text_color","label":"Text Color","type":"color","selectors":{"{{WRAPPER}} .pxl-search input[type=\"text\"]":"color: {{VALUE}} !important;"}},{"name":"text_typography","label":"Typography","type":"typography","control_type":"group","selector":"{{WRAPPER}} .pxl-search input[type=\"text\"]"},{"name":"gap","label":"Gap","type":"slider","size_units":["px"],"range":{"px":{"min":0,"max":300}},"selectors":{"{{WRAPPER}} .pxl-search .searchform-wrap":"gap: {{SIZE}}{{UNIT}};"}}]}]}';
    protected $styles = array(  );
    protected $scripts = array(  );
}