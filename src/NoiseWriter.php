<?php
namespace NoiseGenerator;

class NoiseWriter
{
    /**
     * Scales 0.0 - 1.0 (noise range) to 0 - 255 (byte)
     */
    private static function noiseValueToByte($f)
    {
        if ($f == 1.0)
            return 255;

        return (int) ($f * 256.0);
    }

    /**
     * Converts noise map to image resource using gray scale
     * @param $noise array noise map, 0.0 to 1.0 floats
     * @return GD image resource
     */
    public static function toImage($noise)
    {
        $width = count($noise);
        $height = count($noise[0]);

        $im = imagecreatetruecolor($width, $height);

        for ($x = 0; $x < $width; $x++) {
            for ($y = 0; $y < $height; $y++) {
                $byte = self::noiseValueToByte($noise[$x][$y]);
                $col = imagecolorallocate($im, $byte, $byte, $byte);
                imagesetpixel($im, $x, $y, $col);
            }
        }

        return $im;
    }

    /**
     * Writes a PNG image
     * @param $noise array noise map
     * @param $fileName string
     */
    public static function writeImage($noise, $fileName)
    {
        $im = self::toImage($noise);
        imagepng($im, $fileName);
        imagedestroy($im);
    }
}
