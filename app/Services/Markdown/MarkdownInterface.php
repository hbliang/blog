<?php
/**
 * Created by PhpStorm.
 * User: Ben
 * Date: 2017/2/7
 * Time: 下午4:46
 */
namespace App\Services\Markdown;

interface MarkdownInterface
{
    public function convertMarkdownToHtml($markdown);

    public function convertHtmlToMarkdown($html);
}