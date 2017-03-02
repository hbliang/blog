<?php
/**
 * Created by PhpStorm.
 * User: Ben
 * Date: 2017/2/7
 * Time: 下午4:49
 */

namespace App\Services\Markdown;

use League\HTMLToMarkdown\HtmlConverter;

class Markdown implements MarkdownInterface
{
    protected static $instance;

    /**
     * Markdown To Html
     * @var \Parsedown
     */
    protected $toHtmlConverter;

    /**
     * Html To Markdown
     * @var HtmlConverter
     */
    protected $toMarkdownConverter;

    public function __construct()
    {
        $this->toMarkdownConverter = new HtmlConverter();

        $this->toHtmlConverter = new \Parsedown();
    }
    
    public static function instance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new static;
        }
        
        return self::$instance;
    }

    public function convertMarkdownToHtml($markdown)
    {
        return $this->toHtmlConverter->text($markdown);
    }

    public function convertHtmlToMarkdown($html)
    {
        return $this->toMarkdownConverter->convert($html);
    }
}