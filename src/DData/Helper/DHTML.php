<?php

namespace DData\Helper;
use Zend\View\Helper\AbstractHelper;


/**
 * Description of DHTML
 *
 * @author victor
 */
class DHTML extends AbstractHelper {
    
    protected $tag;
    protected $text;
    protected $htmlOptions;


    public function __invoke($tag="div",$text="",$htmlOptions=array()) {
        $this->setTag($tag);
        $this->setText($text);
        $this->setHtmlOptions($htmlOptions);
        return $this->renderHtml();
    }
    
    public function getTag() {
        return $this->tag;
    }

    public function getText() {
        return $this->text;
    }

    public function getHtmlOptions() {
        return $this->htmlOptions;
    }

    public function setTag($tag) {
        $this->tag = $tag;
    }

    public function setText($text) {
        $this->text = $text;
    }

    public function setHtmlOptions($htmlOptions) {
        $this->htmlOptions = $htmlOptions;
    }
    
    protected function buildAttributes(){
        $htmlOptions=$this->getHtmlOptions();
        $attributes="";
        if(is_array($htmlOptions)&& count($htmlOptions)>0)
        {
            foreach ($htmlOptions as $attr=>$value){
                $attributes.="$attr=\"$value\" ";
            }
        }
        return $attributes;
    }
    
    protected function renderHtml(){
        $tag=$this->getTag();
        $text=$this->getText();
        $attributes=$this->buildAttributes();
        $escaper = $this->getView()->plugin('escapehtml');
        return "<$tag $attributes>".$escaper($text)."</$tag>";
    }



}
