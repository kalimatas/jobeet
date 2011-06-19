<?php
class Jobeet
{
    static public function slugify($text)
    {
        // replace non letters or digits by -
        $text = preg_replace('/\W+/', '-', $text);

        $text = strtolower(trim($text, '-'));

        return $text;
    }
}
?>
