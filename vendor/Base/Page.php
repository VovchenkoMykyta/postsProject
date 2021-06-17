<?php

namespace Base;

class Page {

    private $templateFile;
    private $pageFile;

    public function __construct(string $templateFile, string $pageFile) {
        $this->pageFile = $pageFile;
        $this->templateFile = $templateFile;
    }

    public function render(array $data = NULL){
        include_once $this->templateFile.".php";
    }
}
