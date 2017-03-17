<?php

function my_strtr($inputStr, $from, $to, $encoding = 'UTF-8') {
        $inputStrLength = mb_strlen($inputStr, $encoding);

        $translated = '';

        for($i = 0; $i < $inputStrLength; $i++) {
                $currentChar = mb_substr($inputStr, $i, 1, $encoding);

                $translatedCharPos = mb_strpos($from, $currentChar, 0, $encoding);

                if($translatedCharPos === false) {
                        $translated .= $currentChar;
                }
                else {
                        $translated .= mb_substr($to, $translatedCharPos, 1, $encoding);
                }
        }

        return $translated;
}

?>