<?php

class TextInput
{
    protected mixed $text;

    public function __construct() {
      $this->text = "";
    }

    public function add(string $text): void {
        $this->text .= $text;
    }

    public function getValue(): string {
        return $this->text;
    }
}

class NumericInput extends TextInput
{
    public function __construct() {
      $this->text = 0;
    }

    public function add(string $text): void {
        if (is_numeric($text)) {
            $this->text += (float) $text;
        }
    }
}

$textInput = new TextInput;
$textInput->add("Ala ma kota");
$textInput->add(" a kot ma Ale");
print $textInput->getValue() . "\n";

$textInput = new NumericInput;
$textInput->add("Ala ma kota");
$textInput->add(7);
$textInput->add(" a kot ma Ale");
$textInput->add(3);
print $textInput->getValue() . "\n";
