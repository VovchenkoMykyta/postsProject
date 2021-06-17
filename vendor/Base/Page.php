<?php

namespace Base;

class Page {

    private $templateFile;
    private $pageFile;
    private $data;

    public function __construct(string $templateFile, string $pageFile, array $data = NULL) {
        $this->pageFile = $pageFile;
        $this->templateFile = $templateFile;
        $this->data = $data;
    }

    public function render(){
        include_once "./view/".$this->templateFile.".php";
    }
}
