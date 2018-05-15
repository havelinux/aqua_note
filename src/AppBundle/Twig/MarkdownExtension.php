<?php

namespace AppBundle\Twig;

use Knp\Bundle\MarkdownBundle\MarkdownParserInterface;

class MarkdownExtension extends \Twig_Extension
{
  private $markdownParser;

  public function __construct(MarkdownParserInterface $markdownParser)
  {
    $this->markdownParser = $markdownParser;
  }

  public function getFilters()
  {
    return [
      new \Twig_SimpleFilter('markdownify', array($this, 'parseMarkdown'), [
        'is_safe' => ['html']
      ])
    ];
  }

  public function parseMarkdown($str)
  {
    return $this->markdownParser->transformMarkdown($str);
  }

  public function getName()
  {
    return 'app_markdown';
  }
}
