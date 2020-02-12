<?php
$text = "A strange string to pass, maybe with some ø, æ, å characters.";

foreach (mb_list_encodings() as $chr) {
    echo mb_convert_encoding($text, 'UTF-8', $chr) . " : " . $chr . "<br>";
}
