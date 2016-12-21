# Pashto Cardinals

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

A number to text converter for Pashto language.

## Install

Via Composer

``` bash
$ composer require aloko/pashto-cardinals
```

## Usage

``` php
use Aloko\PashtoCardinals\PashtoCardinal;

echo (new PashtoCardinal(222))->convertToText(); // This will return 'Dwa Sawa Dwa Wisht'
```

## Security

If you discover any security related issues, please email mustafa.aloko@gmail.com instead of using the issue tracker.

## Credits

- [Mustafa Ehsan Alokozay](http://github.com/mustafaaloko)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/aloko/pashto-cardinals.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/aloko/pashto-cardinals/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/aloko/pashto-cardinals.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/aloko/pashto-cardinals.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/aloko/pashto-cardinals.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/aloko/pashto-cardinals
[link-travis]: https://travis-ci.org/aloko/pashto-cardinals
[link-scrutinizer]: https://scrutinizer-ci.com/g/aloko/pashto-cardinals/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/aloko/pashto-cardinals
[link-downloads]: https://packagist.org/packages/aloko/pashto-cardinals
[link-author]: https://github.com/mustafaaloko
[link-contributors]: ../../contributors
