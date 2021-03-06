<?php declare(strict_types=1);

namespace Formularium;

trait DatatypeRandomTrait
{

    /**
     * Generates a random string using only letters and numbers
     *
     * @param integer $minLetters
     * @param integer $maxletters
     * @param string $source
     * @return string
     */
    public static function getRandomString(
        int $minLetters = 5,
        int $maxletters = 15,
        string $source = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"
    ): string
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
