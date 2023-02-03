<?php

namespace Drupal\nppe_module_html_site_importer\Importer;

use Symfony\Component\Finder\Finder;
use Sunra\PhpSimple\HtmlDomParser;
use Drupal\nppe_module_html_site_importer\Importer\Parser;

class HtmlImporter {

    /**
     * @var
     */
    private $dom;

    /**
     * @var
     */
    private $dir;

    /**
     * @var string
     */
    private $assetsPath;

    /**
     * @var
     */
    private $mapped;

    private $cssPathsToReplace;

    private $externalPathsToIgnore;

    /**
     *
     * HtmlImporter constructor.
     *
     * @param $dir
     * @param string $assetsPath
     */
    public function __construct($dir, $assetsPath = '',$cssPathsToReplace,$externalPathsToIgnore) {
        $this->dir = $dir;
        $this->assetsPath = $assetsPath;
        $this->cssPathsToReplace  = $cssPathsToReplace;
        $this->externalPathsToIgnore = $externalPathsToIgnore;

    }

    /**
     * Maps the files in the directory to an array based on file types
     *
     * @return HtmlImporter
     */
    public function mapFiles() {
        $mapped = [];
        $finder = new Finder();
        $finder->files()->in($this->dir);

        foreach ($finder as $file) {
            if (!isset($mapped[$file->getExtension()])) {
                $mapped[$file->getExtension()] = [];
            }
            $mapped[$file->getExtension()][] = $file->getRealPath();
        }

        $this->mapped = $mapped;

        return $this;
    }

    /**
     * @return $this
     */
    public function copyAssets($destinationFolder, $tempFolder) {
        \Drupal::messenger()->addMessage(t('copyAssets:'), 'error');
        foreach ($this->mapped as $type => $files) {
            if ($type !== 'html') {
                foreach ($files as $file) {

                    $destination = $destinationFolder . '/' . basename($file);
                    \Drupal::messenger()->addMessage(t('$destination:' . $destination), 'error');
                    \Drupal::messenger()->addMessage(t('$destination:' . json_encode($file)), 'error');

                    \Drupal::messenger()->addMessage(t('$destinationFolder:' . $destinationFolder), 'error');
                    \Drupal::messenger()->addMessage(t('$tempFolder:' . $tempFolder), 'error');

                    $directory_path = str_replace($tempFolder, $destinationFolder, dirname($file));

                    //Check if the directory already exists.
                    if (!is_dir($directory_path)) {
                        //Directory does not exist, so lets create it.
                        mkdir($directory_path, 0755, true);
                    }
                    $directory_path = $directory_path . '/' . basename($file);

                    /* remove cache js file from file name ex .js?1WDF45 .css%3Fv=4.css */
                    if (strpos($directory_path, "?") !== false) {
                        $directory_path = substr($directory_path,0, strpos($directory_path,"?"));
                    }
                    if (strpos($type, "?") !== false) {
                        $type = substr($type,0, strpos($type,"?"));
                    }
                    if ($type === 'css') {
                        $fileContent = preg_replace($this->cssPathsToReplace, '/' . $this->assetsPath."/", file_get_contents($file));
                        /* remove .. in front of path ../assest/banner.css*/
                        $fileContent = preg_replace('/\.\./', '', $fileContent);
                        file_put_contents($file,$fileContent);
                    } else if ($type === 'js') {
                        $fileContent =  file_get_contents($file);
                        $fileContent = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $fileContent);
                        if ((strpos($fileContent, "jQuery") === false) && (strpos($fileContent, "GTM") === false)) {
                            $fileContent =  '(function ($) { ' . $fileContent . ' })(jQuery);';
                        }
                        file_put_contents($file,$fileContent);
                    }


                    $success = copy($file, $directory_path);

                }
            }
        }

        return $this;
    }

    /**
     * @param $html
     *
     * @return mixed|string
     */
    public function clean($html) {
        $this->dom = HtmlDomParser::str_get_html($html);
        $this->replaceHtml('link', 'href');
        $this->replaceHtml('script', 'src');
        $this->replaceHtml('img', 'src');
        $this->cleanUrls();
        return $this->dom->save();

    }

    /**
     * @return mixed
     */
    public function getMapped() {
        return $this->mapped;
    }

    /**
     *
     * @param $type
     * @param $attribute
     */
    public function replaceHtml($type, $attribute) {
        foreach ($this->dom->find($type) as $index => $link) {
            if (preg_match_all($this->externalPathsToIgnore, $this->dom->find($type, $index)->{$attribute}) === 0) {
                $filename = basename($this->dom->find($type, $index)->{$attribute});
                if (!empty($filename)) {
                    $domObject = $this->dom->find($type, $index);
                    /*
                    * Ignore any External Links
                    */
                    if (strpos($domObject->{$attribute}, "http") !== false) {
                        \Drupal::messenger()->addMessage(t('$link External Link:' . $link), 'error');
                        continue;
                    }

                    $domObject->{$attribute} = preg_replace('/\.\.\//', '', $domObject->{$attribute});
                    if (strpos($domObject->{$attribute}, "%3F") !== false) {
                        $domObject->{$attribute} = substr($domObject->{$attribute},0, strpos($domObject->{$attribute},"%3F"));
                    }

                    $domObject->{$attribute} = "/" .$this->assetsPath. "/" . $domObject->{$attribute};
                    $attr = $domObject->{$attribute};

                }
            }
/*
            drupal_set_message(t('$filename:' . $filename), 'error');
            if (!empty($filename)) {
                drupal_set_message(t('$link:' . $link), 'error');
                $domObject = $this->dom->find($type, $index);

                $domObject->{$attribute} = "/" . $this->assetsPath ."/" . $domObject->{$attribute};


                $domObject->{$attribute} = "/". preg_replace('/\.\.\//', '', $domObject->{$attribute});
                if (strpos($domObject->{$attribute}, "%3F") !== false) {
                    $domObject->{$attribute} = substr($domObject->{$attribute},0, strpos($domObject->{$attribute},"%3F"));
                }

                $attr = $domObject->{$attribute};

            }*/
        }
    }

    /**
     * Returns set directory
     *
     * @return mixed
     */
    public function getDir() {
        return $this->dir;
    }

    /**
     * Removes .html from all links in the document for clean-urls
     */
    private function cleanUrls() {
        foreach ($this->dom->find('a') as $index => $link) {
            $this->dom->find('a', $index)->href = preg_replace('/\.html/', '', $this->dom->find('a', $index)->href);
        }
    }

    public function html_to_obj($html) {
        $dom = new \DOMDocument();
        $dom->loadHTML($html);
        return $this->element_to_obj($dom->documentElement);
    }
    public function element_to_obj($element) {
        $obj = array( "tag" => $element->tagName );
        foreach ($element->attributes as $attribute) {
            $obj[$attribute->name] = $attribute->value;
        }
        foreach ($element->childNodes as $subElement) {
            if ($subElement->nodeType == XML_TEXT_NODE) {
                $obj["html"] = $subElement->wholeText;
            }
            else {
                $obj["children"][] = $this->element_to_obj($subElement);
            }
        }
        return $obj;
    }

    /**
     *
     * @param $type
     * @param $attribute
     */
    public function createNavFromHtml($html) {
        \Drupal::messenger()->addMessage(t('$html : ' . $html), 'erorr');
        /* Retreive Nav from the HTML*/
        //$d = new \DOMDocument;
        //$d->loadHTML($html);
        //$nav = $d->getElementsByTagName('nav')->item(0);
        //drupal_set_message(t('$nav : ' . json_encode($nav)), 'error');



        $parser = new Parser();
        $parser->parse($html);
        print_r($parser->getElements());
        \Drupal::messenger()->addMessage('Parser : ' . '<pre>' . $parser->getElements() .'</pre>', 'error');


        //$regexNav = '#<\s*?nav\b[^>]*>(.*?)</nav\b[^>]*>#s';
        //preg_match($regexNav, $html, $Nav);

        //preg_match_all('#<\s*?nav\b[^>]*>(.*?)</nav\b[^>]*>#s', $html, $matches);
        //foreach ($matches[1] as $text) {;
        //    drupal_set_message(t('$text : ' . $text), 'success');
        //}

        /* Create Drupal Menu */
        //drupal_set_message(t('$file : ' . json_encode($this->html_to_obj($Nav[1]), JSON_PRETTY_PRINT)), 'success');

        /* Remove tag from HTML */


        //return $this->dom->save();

        \Drupal::messenger()->addMessage(t('----------------------------------------------------------------'), 'error');
    }


        /**
         *
         * @param $type
         * @param $attribute
         *
         * @return mixed
         */
        public function removeTagHtml($tag, $html) {
            /* Remove tag from HTML */
            $html = preg_replace('@<('.$tag.')[^>]*>.*?</\1>@is', '', $html);
            return $html;
        }
    }
