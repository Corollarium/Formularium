<?php declare(strict_types=1);

namespace Formularium;

trait DatatypeRandomTrait
{

    /**
     * Generates a random string using only letters and numbers
     *
     * @param integer $minLetters
     * @param integer $maxletters
     * @return string
     */
    public static function getRandomString($minLetters = 5, $maxletters = 15, $source = "abcdefghijkmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"): string
    {
        $pattern = 'R';
        $sourceLen = mb_strlen($source);
        $numberOfLetters = rand($minLetters, $maxletters);
        for ($i = 0; $i < $numberOfLetters - 1; $i++) {
            $pattern .= $source[rand(0, $sourceLen - 1)];
        }
        return $pattern;
    }

    public static function faker(): \Faker\Generator
    {
        static $faker = null;
        if (!$faker) {
            $faker = \Faker\Factory::create();
        }
        return $faker;
    }
}
