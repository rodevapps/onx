<?php

class Tezaurus
{
    private array $data = array("market" => array("trade"), "small" => array("little", "compact"));

    public function getSynonyms(string $word): string {
        foreach($this->data as $data_word => $synonyms) {
            if ($data_word === $word) {
                return '{"word":"' . $word . '","synonyms":' . json_encode($synonyms) . '}';
            }
        }

        return '{"word":"' . $word . '","synonyms":[]}';
    }
}

$tezaurus = new Tezaurus();
print $tezaurus->getSynonyms('small') . "\n";
print $tezaurus->getSynonyms('asleast') . "\n";
