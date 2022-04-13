<?php

declare(strict_types=1);

namespace App\Services;

use Carbon\Carbon;
use DOMXPath;

class NewsParser
{
    private NewsReader $reader;

    public function __construct(NewsReader $reader)
    {
        $this->reader = $reader;
    }

    public function parse(): array
    {
        $dom = new \DOMDocument();
        $dom->loadHTML($this->reader->read());

        $items = [];

        foreach ($dom->getElementsByTagName('tr') as $tr) {
            /**@var $tr \DOMElement */
            if (!$this->isNewsRow($tr)) {
                continue;
            }

            foreach ($tr->getElementsByTagName('td') as $i => $td) {
                /**@var $td \DOMElement */
                if ($this->isTitleElement($td, $i)) {
                    /**@var $link \DOMElement */
                    $link    = $td->getElementsByTagName('a')[0];
                    $items[] = [
                        'external_id' => (int)$tr->getAttribute('id'),
                        'title'       => $link->nodeValue ?: '',
                        'link'        => $link->getAttribute('href') ?: '',
                        'points'      => 1,
                        'postCreated' => Carbon::now(),
                    ];
                }
            }
        }

        return $items;
    }

    private function isNewsRow(\DOMElement $element): bool
    {
        return is_numeric($element->getAttribute('id'));
    }

    private function isTitleElement(\DOMElement $element, int $order): bool
    {
        return $order === 2;
    }
}
