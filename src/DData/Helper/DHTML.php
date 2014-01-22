<?php

namespace DData\Helper;
use Zend\View\Helper\AbstractHelper;




/**
 * This class is a View helper plugin for generating html tags in Zend framework 2.
 * It supports adding and manipulating html attributes and values<br/>
 * created 21/01/2014
 *
 * @author Victor Odiah (vodiahco1@gmail.com)
 * @version 1.0
 * 
 */
class DHTML extends AbstractHelper {
    
    /**
     * The html tag type;
     * @var string 
     */
    protected $tag;
    /**
     * html content
     * @var string 
     */
    protected $text;
    /**
     * an array of attribute / value pair
     * @var array 
     */
    protected $htmlOptions;
    /**
     *
     * @var string 
     */
    protected $space=" ";
    /**
     *
     * @var string 
     */
    protected $classKey="class";
    /**
     *
     * @var string 
     */
    protected $idKey="id";
    /**
     * Value indicating true or false for rendering or escaping html
     * @var boolean 
     */
    protected $renderHtml=false;
    
    
    public function __construct() {
       
    }

    
    public function __invoke($tag="div",$text="",$htmlOptions=array()) {
        $thisObj= clone $this;
        $tag=(is_string($tag))? $tag : "<div>";
        $thisObj->setTag($tag);
        $text=(is_string($text))? $text : "";
        $thisObj->setText($text);
        $htmlOptions=(is_array($htmlOptions)? $htmlOptions:array());
        $thisObj->setHtmlOptions($htmlOptions);
        return $thisObj;
    }
    
    public function __toString() {
       return $this->render(); 
    }
    
    public function toString() {
       return $this->__toString();
    }

    
    /**
     * retreives the current tag
     * @return string
     */
    public function getTag() {
        return $this->tag;
    }

    /**
     * returns the current text used within the tag
     * @return string
     */
    public function getText() {
        return $this->text;
    }

    /**
     * returns an array of html attribute/value pair for the current html element
     * @return array
     */
    public function getHtmlOptions() {
        return $this->htmlOptions;
    }
    
    /**
     * sets an array of attributes/value pair
     * @param array $htmlOptions
     * @return DData\Helper\DHTML 
     */
    public function setHtmlOptions($htmlOptions) {
        if(is_array($htmlOptions)){
        $this->htmlOptions = $htmlOptions;
        }
        return $this;
    }

    /**
     * sets the tag to be used in rendering
     * @param string $tag
     * @return DData\Helper\DHTML
     */
    public function setTag($tag) {
        if(is_string($tag))
        {
        $this->tag = $tag;
        }
        return $this;
    }

    /**
     * sets the text that should be rendered
     * @param string $text
     * @return DData\Helper\DHTML
     */
    public function setText($text) {
        if(is_string($text)){
        $this->text = $text;
        }
        return $this;
    }
    
    /**
     * this method appends a string/text to the value of the current element
     * @param string $text
     * @return DData\Helper\DHTML
     */
    public function appendText($text){
        if(is_string($text))
        {
          $this->text.=$text;   
        }
       return $this;
    }
    
    
    /**
     * this method returns all css class(es) applied to the element
     * @return string
     */
    public function getCssClass() {
       $htmlOptions=$this->getHtmlOptions();
       return (isset($htmlOptions[$this->classKey])) ? $htmlOptions[$this->classKey] : null;
    }
    
    /**
     * This method is sets a css class for the current element. This method overrides any/all existing css classes
     * to add css class without overriding any existing css class, please use \DData\Helper\DHTML::appendCssClass()
     * @see \DData\Helper\DHTML::appendCssClass()
     * @param string $cssClass
     * @return \DData\Helper\DHTML
     */
    public function setCssClass($cssClass) {
        if(is_string($cssClass)){
        $htmlOptions=$this->getHtmlOptions();
        $htmlOptions[$this->classKey]=$cssClass;
        $this->htmlOptions=$htmlOptions;
        }
        return $this;
        
    }
    
    /**
     * This methos appends a css class to the current element. It does not override any existing css class. To Override all existing
     * css classes please use \DData\Helper\DHTML::setCssClass()
     * @see \DData\Helper\DHTML::setCssClass()
     * @param type $cssClass
     * @return \DData\Helper\DHTML 
     */
    public function appendCssClass($cssClass){
         if(is_string($cssClass)){
        $htmlOptions=$this->getHtmlOptions();
        $htmlOptions[$this->classKey].=$this->space.$cssClass;
        $this->htmlOptions=$htmlOptions;
        }
        return $this;
    }

    /**
     * This method returns the ID of the current element.
     * @return string
     */
    public function getId() {
       $htmlOptions=$this->getHtmlOptions();
       return (isset($htmlOptions[$this->idKey])) ? $htmlOptions[$this->idKey] : null;
    }
    
    /**
     * This method sets the ID for the current element
     * @param type $id
     * @return \DData\Helper\DHTML
     */
    public function setId($id) {
       if(is_string($id)){
        $htmlOptions=$this->getHtmlOptions();
        $htmlOptions[$this->idKey]=$id;
        $this->htmlOptions=$htmlOptions;
        }
        return $this;
    }
    
    /**
     * Return true or false to indicate if escaping html or rendering html is set
     * @return boolean
     */
    public function getRenderHtml() {
        return $this->renderHtml;
    }

    /**
     * This method is used to swith escaping html rendering on or off.
     * @param boolean $renderHtml
     * @return \DData\Helper\DHTML
     */
    public function setRenderHtml($renderHtml) {
        
        if(is_bool($renderHtml)){
            
        $this->renderHtml = $renderHtml;
        }
        return $this;
    }

    
    
    
    
    /**
     * this is a method for generating the attributes. It is used internally.
     * @return string
     */
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
    
    /**
     * this method renders the html element with values provided
     * @return string
     */
    public function render(){
        $tag=$this->getTag();
        $text=$this->getText();
        $attributes=$this->buildAttributes();
        if($this->renderHtml)
        {
        return "<$tag $attributes>".($text)."</$tag>";
        }
        else{
        $escaper = $this->getView()->plugin('escapehtml');
        return "<$tag $attributes>".$escaper($text)."</$tag>";
        }
    }



}
