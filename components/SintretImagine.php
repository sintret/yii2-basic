<?php

namespace app\components;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use yii\imagine\Image;

class SintretImagine extends Image {

    public static $driver = [self::DRIVER_GD2, self::DRIVER_GMAGICK, self::DRIVER_IMAGICK];

}
