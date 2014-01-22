DHTML
=====

DHTML (Dynamic HTML) is a View Helper Plugin for generating HTML elements in Zend framework 2.
It supports adding and manipulating HTML attributes and values.
Just add the module to your project and you can dynamically create, style and reuse HTML elements in your view.
It is highly flexible and capable of simplifying highly complex view pages.

## Requirements
The requirements of this module is listed in composer.json.
## Installation
1. require "DomainData/DHTML" : "dev-master", in your composer.json and run composer update
2. Enable the DData module in config/application.config.php file

        "require": {
            "php": ">=5.3.3",
            "zendframework/zendframework": "2.2.*",
            "DomainData/DHTML" : "dev-master"

        },
        "repositories": [
            {
            "type":"vcs",
            "url": "https://github.com/vodiahco/dhtml.git"
            }
        ]

## Usage in your view file.
To generate H3 elements

        $h3Element = $this->DHTML($tag="h3",$text="text content",$htmlOptions=array('id'=>'my-id','class'=>'my-class');
        echo $h3Element;
or
    
You can also use the following methods:

        $h3Element = $this->DHTML();
        $h3Element->setText("my text");
        $h3Element->setCssClass("new class");
        $h3Element->appendCssClass("add-class");
        $h3Element->appendText('add-text');
        echo $$h3Element;

The class also supports method chaining:

        $p= $this->DHTML()
        ->setTag("p")
        ->setText("text here")
        ->setClass("p-class");
        echo $p;


Class also supports nesting objects;

        $h3Element->appendText($p->toString());

It can be used to generate and build any html element;



