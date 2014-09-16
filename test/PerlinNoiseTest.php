<?php

class SimplexNoise2DTest extends \PHPUnit_Framework_TestCase
{
    function test1()
    {
        $perlin = new \NoiseGenerator\PerlinNoise(3000);

        $width = 100;
        $height = 100;

        //$octaves = array(64, 32, 16, 8, 4, 2);
        $octaves = array(64, 16, 4, 2);

        $noise = array();

        for ($y = 0; $y < $height; $y += 1) {
            for ($x = 0; $x < $width; $x += 1) {
                $num = $perlin->noise($x, $y, 0, $octaves);

                $raw = ($num / 2) + .5;
                if ($raw < 0) $raw = 0;
                $noise[$x][$y] = $raw;
            }
        }

        $fileName = 'perlin-'.implode('-', $octaves).'.png';
        \NoiseGenerator\NoiseWriter::writeImage($noise, $fileName);
        //unlink($fileName);
    }

    /**
     * Write out png from each octave
     */
    function testEachOctave()
    {

        $perlin = new \NoiseGenerator\PerlinNoise(3000);

        $width = 100;
        $height = 100;

        $octaves = array(64, 32, 16, 8, 4, 2);

        foreach ($octaves as $octave) {

            $noise = array();

            for ($y = 0; $y < $height; $y += 1) {
                for ($x = 0; $x < $width; $x += 1) {
                    $num = $perlin->noise($x, $y, 0, array($octave));

                    $raw = ($num / 2) + .5;
                    if ($raw < 0) $raw = 0;
                    $noise[$x][$y] = $raw;
                }
            }

            $fileName = 'perlin-octave-'.$octave.'.png';
            \NoiseGenerator\NoiseWriter::writeImage($noise, $fileName);
            //unlink($fileName);
        }

    }
}
