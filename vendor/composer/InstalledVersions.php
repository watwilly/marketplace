<?php

/*
 * This file is part of Composer.
 *
 * (c) Nils Adermann <naderman@naderman.de>
 *     Jordi Boggiano <j.boggiano@seld.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Composer;

use Composer\Autoload\ClassLoader;
use Composer\Semver\VersionParser;

/**
 * This class is copied in every Composer installed project and available to all
 *
 * To require it's presence, you can require `composer-runtime-api ^2.0`
 */
class InstalledVersions
{
    private static $installed = array (
  'root' => 
  array (
    'pretty_version' => '1.0.0+no-version-set',
    'version' => '1.0.0.0',
    'aliases' => 
    array (
    ),
    'reference' => NULL,
    'name' => 'laravel/laravel',
  ),
  'versions' => 
  array (
    'arrilot/laravel-widgets' => 
    array (
      'pretty_version' => '3.13.0',
      'version' => '3.13.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '24297e9a7b1988808b782567892170cd421e6715',
    ),
    'asm89/stack-cors' => 
    array (
      'pretty_version' => '1.3.0',
      'version' => '1.3.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'b9c31def6a83f84b4d4a40d35996d375755f0e08',
    ),
    'brick/math' => 
    array (
      'pretty_version' => '0.8.15',
      'version' => '0.8.15.0',
      'aliases' => 
      array (
      ),
      'reference' => '9b08d412b9da9455b210459ff71414de7e6241cd',
    ),
    'composer/ca-bundle' => 
    array (
      'pretty_version' => '1.2.7',
      'version' => '1.2.7.0',
      'aliases' => 
      array (
      ),
      'reference' => '95c63ab2117a72f48f5a55da9740a3273d45b7fd',
    ),
    'composer/composer' => 
    array (
      'pretty_version' => '1.10.6',
      'version' => '1.10.6.0',
      'aliases' => 
      array (
      ),
      'reference' => 'be81b9c4735362c26876bdbfd3b5bc7e7f711c88',
    ),
    'composer/semver' => 
    array (
      'pretty_version' => '1.5.1',
      'version' => '1.5.1.0',
      'aliases' => 
      array (
      ),
      'reference' => 'c6bea70230ef4dd483e6bbcab6005f682ed3a8de',
    ),
    'composer/spdx-licenses' => 
    array (
      'pretty_version' => '1.5.3',
      'version' => '1.5.3.0',
      'aliases' => 
      array (
      ),
      'reference' => '0c3e51e1880ca149682332770e25977c70cf9dae',
    ),
    'composer/xdebug-handler' => 
    array (
      'pretty_version' => '1.4.1',
      'version' => '1.4.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '1ab9842d69e64fb3a01be6b656501032d1b78cb7',
    ),
    'cordoval/hamcrest-php' => 
    array (
      'replaced' => 
      array (
        0 => '*',
      ),
    ),
    'davedevelopment/hamcrest-php' => 
    array (
      'replaced' => 
      array (
        0 => '*',
      ),
    ),
    'dnoegel/php-xdg-base-dir' => 
    array (
      'pretty_version' => 'v0.1.1',
      'version' => '0.1.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '8f8a6e48c5ecb0f991c2fdcf5f154a47d85f9ffd',
    ),
    'doctrine/annotations' => 
    array (
      'pretty_version' => '1.12.1',
      'version' => '1.12.1.0',
      'aliases' => 
      array (
      ),
      'reference' => 'b17c5014ef81d212ac539f07a1001832df1b6d3b',
    ),
    'doctrine/cache' => 
    array (
      'pretty_version' => '1.10.0',
      'version' => '1.10.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '382e7f4db9a12dc6c19431743a2b096041bcdd62',
    ),
    'doctrine/collections' => 
    array (
      'pretty_version' => '1.6.7',
      'version' => '1.6.7.0',
      'aliases' => 
      array (
      ),
      'reference' => '55f8b799269a1a472457bd1a41b4f379d4cfba4a',
    ),
    'doctrine/common' => 
    array (
      'pretty_version' => '2.13.3',
      'version' => '2.13.3.0',
      'aliases' => 
      array (
      ),
      'reference' => 'f3812c026e557892c34ef37f6ab808a6b567da7f',
    ),
    'doctrine/dbal' => 
    array (
      'pretty_version' => '2.10.2',
      'version' => '2.10.2.0',
      'aliases' => 
      array (
      ),
      'reference' => 'aab745e7b6b2de3b47019da81e7225e14dcfdac8',
    ),
    'doctrine/event-manager' => 
    array (
      'pretty_version' => '1.1.0',
      'version' => '1.1.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '629572819973f13486371cb611386eb17851e85c',
    ),
    'doctrine/inflector' => 
    array (
      'pretty_version' => '1.4.0',
      'version' => '1.4.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'ab5de36233a1995f9c776c741b803eb8207aebef',
    ),
    'doctrine/instantiator' => 
    array (
      'pretty_version' => '1.3.0',
      'version' => '1.3.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'ae466f726242e637cebdd526a7d991b9433bacf1',
    ),
    'doctrine/lexer' => 
    array (
      'pretty_version' => '1.2.0',
      'version' => '1.2.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '5242d66dbeb21a30dd8a3e66bf7a73b66e05e1f6',
    ),
    'doctrine/persistence' => 
    array (
      'pretty_version' => '1.3.8',
      'version' => '1.3.8.0',
      'aliases' => 
      array (
      ),
      'reference' => '7a6eac9fb6f61bba91328f15aa7547f4806ca288',
    ),
    'doctrine/reflection' => 
    array (
      'pretty_version' => '1.2.2',
      'version' => '1.2.2.0',
      'aliases' => 
      array (
      ),
      'reference' => 'fa587178be682efe90d005e3a322590d6ebb59a5',
    ),
    'dragonmantank/cron-expression' => 
    array (
      'pretty_version' => 'v2.3.0',
      'version' => '2.3.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '72b6fbf76adb3cf5bc0db68559b33d41219aba27',
    ),
    'egulias/email-validator' => 
    array (
      'pretty_version' => '2.1.17',
      'version' => '2.1.17.0',
      'aliases' => 
      array (
      ),
      'reference' => 'ade6887fd9bd74177769645ab5c474824f8a418a',
    ),
    'facade/flare-client-php' => 
    array (
      'pretty_version' => '1.3.2',
      'version' => '1.3.2.0',
      'aliases' => 
      array (
      ),
      'reference' => 'db1e03426e7f9472c9ecd1092aff00f56aa6c004',
    ),
    'facade/ignition' => 
    array (
      'pretty_version' => '2.0.2',
      'version' => '2.0.2.0',
      'aliases' => 
      array (
      ),
      'reference' => '67f1677954ad33ca6b77f2c41cf43a58624f27fc',
    ),
    'facade/ignition-contracts' => 
    array (
      'pretty_version' => '1.0.0',
      'version' => '1.0.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'f445db0fb86f48e205787b2592840dd9c80ded28',
    ),
    'fideloper/proxy' => 
    array (
      'pretty_version' => '4.3.0',
      'version' => '4.3.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'ec38ad69ee378a1eec04fb0e417a97cfaf7ed11a',
    ),
    'filp/whoops' => 
    array (
      'pretty_version' => '2.7.2',
      'version' => '2.7.2.0',
      'aliases' => 
      array (
      ),
      'reference' => '17d0d3f266c8f925ebd035cd36f83cf802b47d4a',
    ),
    'fruitcake/laravel-cors' => 
    array (
      'pretty_version' => 'v1.0.6',
      'version' => '1.0.6.0',
      'aliases' => 
      array (
      ),
      'reference' => '1d127dbec313e2e227d65e0c483765d8d7559bf6',
    ),
    'fzaninotto/faker' => 
    array (
      'pretty_version' => 'v1.9.1',
      'version' => '1.9.1.0',
      'aliases' => 
      array (
      ),
      'reference' => 'fc10d778e4b84d5bd315dad194661e091d307c6f',
    ),
    'google/recaptcha' => 
    array (
      'pretty_version' => '1.2.4',
      'version' => '1.2.4.0',
      'aliases' => 
      array (
      ),
      'reference' => '614f25a9038be4f3f2da7cbfd778dc5b357d2419',
    ),
    'guzzlehttp/guzzle' => 
    array (
      'pretty_version' => '6.5.3',
      'version' => '6.5.3.0',
      'aliases' => 
      array (
      ),
      'reference' => 'aab4ebd862aa7d04f01a4b51849d657db56d882e',
    ),
    'guzzlehttp/promises' => 
    array (
      'pretty_version' => 'v1.3.1',
      'version' => '1.3.1.0',
      'aliases' => 
      array (
      ),
      'reference' => 'a59da6cf61d80060647ff4d3eb2c03a2bc694646',
    ),
    'guzzlehttp/psr7' => 
    array (
      'pretty_version' => '1.6.1',
      'version' => '1.6.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '239400de7a173fe9901b9ac7c06497751f00727a',
    ),
    'hamcrest/hamcrest-php' => 
    array (
      'pretty_version' => 'v2.0.0',
      'version' => '2.0.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '776503d3a8e85d4f9a1148614f95b7a608b046ad',
    ),
    'illuminate/auth' => 
    array (
      'replaced' => 
      array (
        0 => 'v7.10.3',
      ),
    ),
    'illuminate/broadcasting' => 
    array (
      'replaced' => 
      array (
        0 => 'v7.10.3',
      ),
    ),
    'illuminate/bus' => 
    array (
      'replaced' => 
      array (
        0 => 'v7.10.3',
      ),
    ),
    'illuminate/cache' => 
    array (
      'replaced' => 
      array (
        0 => 'v7.10.3',
      ),
    ),
    'illuminate/config' => 
    array (
      'replaced' => 
      array (
        0 => 'v7.10.3',
      ),
    ),
    'illuminate/console' => 
    array (
      'replaced' => 
      array (
        0 => 'v7.10.3',
      ),
    ),
    'illuminate/container' => 
    array (
      'replaced' => 
      array (
        0 => 'v7.10.3',
      ),
    ),
    'illuminate/contracts' => 
    array (
      'replaced' => 
      array (
        0 => 'v7.10.3',
      ),
    ),
    'illuminate/cookie' => 
    array (
      'replaced' => 
      array (
        0 => 'v7.10.3',
      ),
    ),
    'illuminate/database' => 
    array (
      'replaced' => 
      array (
        0 => 'v7.10.3',
      ),
    ),
    'illuminate/encryption' => 
    array (
      'replaced' => 
      array (
        0 => 'v7.10.3',
      ),
    ),
    'illuminate/events' => 
    array (
      'replaced' => 
      array (
        0 => 'v7.10.3',
      ),
    ),
    'illuminate/filesystem' => 
    array (
      'replaced' => 
      array (
        0 => 'v7.10.3',
      ),
    ),
    'illuminate/hashing' => 
    array (
      'replaced' => 
      array (
        0 => 'v7.10.3',
      ),
    ),
    'illuminate/http' => 
    array (
      'replaced' => 
      array (
        0 => 'v7.10.3',
      ),
    ),
    'illuminate/log' => 
    array (
      'replaced' => 
      array (
        0 => 'v7.10.3',
      ),
    ),
    'illuminate/mail' => 
    array (
      'replaced' => 
      array (
        0 => 'v7.10.3',
      ),
    ),
    'illuminate/notifications' => 
    array (
      'replaced' => 
      array (
        0 => 'v7.10.3',
      ),
    ),
    'illuminate/pagination' => 
    array (
      'replaced' => 
      array (
        0 => 'v7.10.3',
      ),
    ),
    'illuminate/pipeline' => 
    array (
      'replaced' => 
      array (
        0 => 'v7.10.3',
      ),
    ),
    'illuminate/queue' => 
    array (
      'replaced' => 
      array (
        0 => 'v7.10.3',
      ),
    ),
    'illuminate/redis' => 
    array (
      'replaced' => 
      array (
        0 => 'v7.10.3',
      ),
    ),
    'illuminate/routing' => 
    array (
      'replaced' => 
      array (
        0 => 'v7.10.3',
      ),
    ),
    'illuminate/session' => 
    array (
      'replaced' => 
      array (
        0 => 'v7.10.3',
      ),
    ),
    'illuminate/support' => 
    array (
      'replaced' => 
      array (
        0 => 'v7.10.3',
      ),
    ),
    'illuminate/testing' => 
    array (
      'replaced' => 
      array (
        0 => 'v7.10.3',
      ),
    ),
    'illuminate/translation' => 
    array (
      'replaced' => 
      array (
        0 => 'v7.10.3',
      ),
    ),
    'illuminate/validation' => 
    array (
      'replaced' => 
      array (
        0 => 'v7.10.3',
      ),
    ),
    'illuminate/view' => 
    array (
      'replaced' => 
      array (
        0 => 'v7.10.3',
      ),
    ),
    'intervention/image' => 
    array (
      'pretty_version' => '2.5.1',
      'version' => '2.5.1.0',
      'aliases' => 
      array (
      ),
      'reference' => 'abbf18d5ab8367f96b3205ca3c89fb2fa598c69e',
    ),
    'justinrainbow/json-schema' => 
    array (
      'pretty_version' => '5.2.9',
      'version' => '5.2.9.0',
      'aliases' => 
      array (
      ),
      'reference' => '44c6787311242a979fa15c704327c20e7221a0e4',
    ),
    'kodova/hamcrest-php' => 
    array (
      'replaced' => 
      array (
        0 => '*',
      ),
    ),
    'larapack/doctrine-support' => 
    array (
      'pretty_version' => 'v0.1.9',
      'version' => '0.1.9.0',
      'aliases' => 
      array (
      ),
      'reference' => 'ab6e821c467704ae91a9a944e6ebdaad6a99a294',
    ),
    'larapack/hooks' => 
    array (
      'pretty_version' => 'v1.0.12',
      'version' => '1.0.12.0',
      'aliases' => 
      array (
      ),
      'reference' => 'ce2c8c078a56036c357f26036174412cb9059f8e',
    ),
    'larapack/voyager-hooks' => 
    array (
      'pretty_version' => 'v1.2.3',
      'version' => '1.2.3.0',
      'aliases' => 
      array (
      ),
      'reference' => '1a54df95b4179a9d26e9aacbd8676c8ccd78be0e',
    ),
    'laravel/framework' => 
    array (
      'pretty_version' => 'v7.10.3',
      'version' => '7.10.3.0',
      'aliases' => 
      array (
      ),
      'reference' => '6e927e78aafd578d59c99608e7f0e23a5f7bfc5a',
    ),
    'laravel/helpers' => 
    array (
      'pretty_version' => 'v1.2.0',
      'version' => '1.2.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '1f978fc5dad9f7f906b18242c654252615201de4',
    ),
    'laravel/laravel' => 
    array (
      'pretty_version' => '1.0.0+no-version-set',
      'version' => '1.0.0.0',
      'aliases' => 
      array (
      ),
      'reference' => NULL,
    ),
    'laravel/socialite' => 
    array (
      'pretty_version' => 'v4.3.2',
      'version' => '4.3.2.0',
      'aliases' => 
      array (
      ),
      'reference' => '4bd66ee416fea04398dee5b8c32d65719a075db4',
    ),
    'laravel/tinker' => 
    array (
      'pretty_version' => 'v2.4.0',
      'version' => '2.4.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'cde90a7335a2130a4488beb68f4b2141869241db',
    ),
    'laravel/ui' => 
    array (
      'pretty_version' => 'v2.0.3',
      'version' => '2.0.3.0',
      'aliases' => 
      array (
      ),
      'reference' => '15368c5328efb7ce94f35ca750acde9b496ab1b1',
    ),
    'league/commonmark' => 
    array (
      'pretty_version' => '1.4.3',
      'version' => '1.4.3.0',
      'aliases' => 
      array (
      ),
      'reference' => '412639f7cfbc0b31ad2455b2fe965095f66ae505',
    ),
    'league/flysystem' => 
    array (
      'pretty_version' => '1.0.67',
      'version' => '1.0.67.0',
      'aliases' => 
      array (
      ),
      'reference' => '5b1f36c75c4bdde981294c2a0ebdb437ee6f275e',
    ),
    'league/oauth1-client' => 
    array (
      'pretty_version' => '1.7.0',
      'version' => '1.7.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'fca5f160650cb74d23fc11aa570dd61f86dcf647',
    ),
    'mercadopago/dx-php' => 
    array (
      'pretty_version' => '2.2.1',
      'version' => '2.2.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '2ea4d51f6b29d568b3a06d430114467fc2ab6b90',
    ),
    'mockery/mockery' => 
    array (
      'pretty_version' => '1.3.1',
      'version' => '1.3.1.0',
      'aliases' => 
      array (
      ),
      'reference' => 'f69bbde7d7a75d6b2862d9ca8fab1cd28014b4be',
    ),
    'monolog/monolog' => 
    array (
      'pretty_version' => '2.0.2',
      'version' => '2.0.2.0',
      'aliases' => 
      array (
      ),
      'reference' => 'c861fcba2ca29404dc9e617eedd9eff4616986b8',
    ),
    'myclabs/deep-copy' => 
    array (
      'pretty_version' => '1.9.5',
      'version' => '1.9.5.0',
      'aliases' => 
      array (
      ),
      'reference' => 'b2c28789e80a97badd14145fda39b545d83ca3ef',
      'replaced' => 
      array (
        0 => '1.9.5',
      ),
    ),
    'nesbot/carbon' => 
    array (
      'pretty_version' => '2.33.0',
      'version' => '2.33.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '4d93cb95a80d9ffbff4018fe58ae3b7dd7f4b99b',
    ),
    'nikic/php-parser' => 
    array (
      'pretty_version' => 'v4.4.0',
      'version' => '4.4.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'bd43ec7152eaaab3bd8c6d0aa95ceeb1df8ee120',
    ),
    'nunomaduro/collision' => 
    array (
      'pretty_version' => 'v4.2.0',
      'version' => '4.2.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'd50490417eded97be300a92cd7df7badc37a9018',
    ),
    'opis/closure' => 
    array (
      'pretty_version' => '3.5.1',
      'version' => '3.5.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '93ebc5712cdad8d5f489b500c59d122df2e53969',
    ),
    'phar-io/manifest' => 
    array (
      'pretty_version' => '1.0.3',
      'version' => '1.0.3.0',
      'aliases' => 
      array (
      ),
      'reference' => '7761fcacf03b4d4f16e7ccb606d4879ca431fcf4',
    ),
    'phar-io/version' => 
    array (
      'pretty_version' => '2.0.1',
      'version' => '2.0.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '45a2ec53a73c70ce41d55cedef9063630abaf1b6',
    ),
    'phpdocumentor/reflection-common' => 
    array (
      'pretty_version' => '2.1.0',
      'version' => '2.1.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '6568f4687e5b41b054365f9ae03fcb1ed5f2069b',
    ),
    'phpdocumentor/reflection-docblock' => 
    array (
      'pretty_version' => '5.1.0',
      'version' => '5.1.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'cd72d394ca794d3466a3b2fc09d5a6c1dc86b47e',
    ),
    'phpdocumentor/type-resolver' => 
    array (
      'pretty_version' => '1.1.0',
      'version' => '1.1.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '7462d5f123dfc080dfdf26897032a6513644fc95',
    ),
    'phpoption/phpoption' => 
    array (
      'pretty_version' => '1.7.3',
      'version' => '1.7.3.0',
      'aliases' => 
      array (
      ),
      'reference' => '4acfd6a4b33a509d8c88f50e5222f734b6aeebae',
    ),
    'phpspec/prophecy' => 
    array (
      'pretty_version' => 'v1.10.3',
      'version' => '1.10.3.0',
      'aliases' => 
      array (
      ),
      'reference' => '451c3cd1418cf640de218914901e51b064abb093',
    ),
    'phpunit/php-code-coverage' => 
    array (
      'pretty_version' => '7.0.10',
      'version' => '7.0.10.0',
      'aliases' => 
      array (
      ),
      'reference' => 'f1884187926fbb755a9aaf0b3836ad3165b478bf',
    ),
    'phpunit/php-file-iterator' => 
    array (
      'pretty_version' => '2.0.2',
      'version' => '2.0.2.0',
      'aliases' => 
      array (
      ),
      'reference' => '050bedf145a257b1ff02746c31894800e5122946',
    ),
    'phpunit/php-text-template' => 
    array (
      'pretty_version' => '1.2.1',
      'version' => '1.2.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '31f8b717e51d9a2afca6c9f046f5d69fc27c8686',
    ),
    'phpunit/php-timer' => 
    array (
      'pretty_version' => '2.1.2',
      'version' => '2.1.2.0',
      'aliases' => 
      array (
      ),
      'reference' => '1038454804406b0b5f5f520358e78c1c2f71501e',
    ),
    'phpunit/php-token-stream' => 
    array (
      'pretty_version' => '3.1.1',
      'version' => '3.1.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '995192df77f63a59e47f025390d2d1fdf8f425ff',
    ),
    'phpunit/phpunit' => 
    array (
      'pretty_version' => '8.5.4',
      'version' => '8.5.4.0',
      'aliases' => 
      array (
      ),
      'reference' => '8474e22d7d642f665084ba5ec780626cbd1efd23',
    ),
    'psr/container' => 
    array (
      'pretty_version' => '1.0.0',
      'version' => '1.0.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'b7ce3b176482dbbc1245ebf52b181af44c2cf55f',
    ),
    'psr/event-dispatcher' => 
    array (
      'pretty_version' => '1.0.0',
      'version' => '1.0.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'dbefd12671e8a14ec7f180cab83036ed26714bb0',
    ),
    'psr/event-dispatcher-implementation' => 
    array (
      'provided' => 
      array (
        0 => '1.0',
      ),
    ),
    'psr/http-message' => 
    array (
      'pretty_version' => '1.0.1',
      'version' => '1.0.1.0',
      'aliases' => 
      array (
      ),
      'reference' => 'f6561bf28d520154e4b0ec72be95418abe6d9363',
    ),
    'psr/http-message-implementation' => 
    array (
      'provided' => 
      array (
        0 => '1.0',
      ),
    ),
    'psr/log' => 
    array (
      'pretty_version' => '1.1.3',
      'version' => '1.1.3.0',
      'aliases' => 
      array (
      ),
      'reference' => '0f73288fd15629204f9d42b7055f72dacbe811fc',
    ),
    'psr/log-implementation' => 
    array (
      'provided' => 
      array (
        0 => '1.0.0',
        1 => '1.0',
      ),
    ),
    'psr/simple-cache' => 
    array (
      'pretty_version' => '1.0.1',
      'version' => '1.0.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '408d5eafb83c57f6365a3ca330ff23aa4a5fa39b',
    ),
    'psy/psysh' => 
    array (
      'pretty_version' => 'v0.10.4',
      'version' => '0.10.4.0',
      'aliases' => 
      array (
      ),
      'reference' => 'a8aec1b2981ab66882a01cce36a49b6317dc3560',
    ),
    'ralouphie/getallheaders' => 
    array (
      'pretty_version' => '3.0.3',
      'version' => '3.0.3.0',
      'aliases' => 
      array (
      ),
      'reference' => '120b605dfeb996808c31b6477290a714d356e822',
    ),
    'ramsey/collection' => 
    array (
      'pretty_version' => '1.0.1',
      'version' => '1.0.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '925ad8cf55ba7a3fc92e332c58fd0478ace3e1ca',
    ),
    'ramsey/uuid' => 
    array (
      'pretty_version' => '4.0.1',
      'version' => '4.0.1.0',
      'aliases' => 
      array (
      ),
      'reference' => 'ba8fff1d3abb8bb4d35a135ed22a31c6ef3ede3d',
    ),
    'rhumsaa/uuid' => 
    array (
      'replaced' => 
      array (
        0 => '4.0.1',
      ),
    ),
    'scrivo/highlight.php' => 
    array (
      'pretty_version' => 'v9.18.1.1',
      'version' => '9.18.1.1',
      'aliases' => 
      array (
      ),
      'reference' => '52fc21c99fd888e33aed4879e55a3646f8d40558',
    ),
    'sebastian/code-unit-reverse-lookup' => 
    array (
      'pretty_version' => '1.0.1',
      'version' => '1.0.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '4419fcdb5eabb9caa61a27c7a1db532a6b55dd18',
    ),
    'sebastian/comparator' => 
    array (
      'pretty_version' => '3.0.2',
      'version' => '3.0.2.0',
      'aliases' => 
      array (
      ),
      'reference' => '5de4fc177adf9bce8df98d8d141a7559d7ccf6da',
    ),
    'sebastian/diff' => 
    array (
      'pretty_version' => '3.0.2',
      'version' => '3.0.2.0',
      'aliases' => 
      array (
      ),
      'reference' => '720fcc7e9b5cf384ea68d9d930d480907a0c1a29',
    ),
    'sebastian/environment' => 
    array (
      'pretty_version' => '4.2.3',
      'version' => '4.2.3.0',
      'aliases' => 
      array (
      ),
      'reference' => '464c90d7bdf5ad4e8a6aea15c091fec0603d4368',
    ),
    'sebastian/exporter' => 
    array (
      'pretty_version' => '3.1.2',
      'version' => '3.1.2.0',
      'aliases' => 
      array (
      ),
      'reference' => '68609e1261d215ea5b21b7987539cbfbe156ec3e',
    ),
    'sebastian/global-state' => 
    array (
      'pretty_version' => '3.0.0',
      'version' => '3.0.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'edf8a461cf1d4005f19fb0b6b8b95a9f7fa0adc4',
    ),
    'sebastian/object-enumerator' => 
    array (
      'pretty_version' => '3.0.3',
      'version' => '3.0.3.0',
      'aliases' => 
      array (
      ),
      'reference' => '7cfd9e65d11ffb5af41198476395774d4c8a84c5',
    ),
    'sebastian/object-reflector' => 
    array (
      'pretty_version' => '1.1.1',
      'version' => '1.1.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '773f97c67f28de00d397be301821b06708fca0be',
    ),
    'sebastian/recursion-context' => 
    array (
      'pretty_version' => '3.0.0',
      'version' => '3.0.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '5b0cd723502bac3b006cbf3dbf7a1e3fcefe4fa8',
    ),
    'sebastian/resource-operations' => 
    array (
      'pretty_version' => '2.0.1',
      'version' => '2.0.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '4d7a795d35b889bf80a0cc04e08d77cedfa917a9',
    ),
    'sebastian/type' => 
    array (
      'pretty_version' => '1.1.3',
      'version' => '1.1.3.0',
      'aliases' => 
      array (
      ),
      'reference' => '3aaaa15fa71d27650d62a948be022fe3b48541a3',
    ),
    'sebastian/version' => 
    array (
      'pretty_version' => '2.0.1',
      'version' => '2.0.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '99732be0ddb3361e16ad77b68ba41efc8e979019',
    ),
    'seld/jsonlint' => 
    array (
      'pretty_version' => '1.8.0',
      'version' => '1.8.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'ff2aa5420bfbc296cf6a0bc785fa5b35736de7c1',
    ),
    'seld/phar-utils' => 
    array (
      'pretty_version' => '1.1.0',
      'version' => '1.1.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '8800503d56b9867d43d9c303b9cbcc26016e82f0',
    ),
    'swiftmailer/swiftmailer' => 
    array (
      'pretty_version' => 'v6.2.3',
      'version' => '6.2.3.0',
      'aliases' => 
      array (
      ),
      'reference' => '149cfdf118b169f7840bbe3ef0d4bc795d1780c9',
    ),
    'symfony/console' => 
    array (
      'pretty_version' => 'v5.0.8',
      'version' => '5.0.8.0',
      'aliases' => 
      array (
      ),
      'reference' => '5fa1caadc8cdaa17bcfb25219f3b53fe294a9935',
    ),
    'symfony/css-selector' => 
    array (
      'pretty_version' => 'v5.0.8',
      'version' => '5.0.8.0',
      'aliases' => 
      array (
      ),
      'reference' => '5f8d5271303dad260692ba73dfa21777d38e124e',
    ),
    'symfony/error-handler' => 
    array (
      'pretty_version' => 'v5.0.8',
      'version' => '5.0.8.0',
      'aliases' => 
      array (
      ),
      'reference' => '949ffc17c3ac3a9f8e6232220e2da33913c04ea4',
    ),
    'symfony/event-dispatcher' => 
    array (
      'pretty_version' => 'v5.0.8',
      'version' => '5.0.8.0',
      'aliases' => 
      array (
      ),
      'reference' => '24f40d95385774ed5c71dbf014edd047e2f2f3dc',
    ),
    'symfony/event-dispatcher-contracts' => 
    array (
      'pretty_version' => 'v2.0.1',
      'version' => '2.0.1.0',
      'aliases' => 
      array (
      ),
      'reference' => 'af23c2584d4577d54661c434446fb8fbed6025dd',
    ),
    'symfony/event-dispatcher-implementation' => 
    array (
      'provided' => 
      array (
        0 => '2.0',
      ),
    ),
    'symfony/filesystem' => 
    array (
      'pretty_version' => 'v5.0.8',
      'version' => '5.0.8.0',
      'aliases' => 
      array (
      ),
      'reference' => '7cd0dafc4353a0f62e307df90b48466379c8cc91',
    ),
    'symfony/finder' => 
    array (
      'pretty_version' => 'v5.0.8',
      'version' => '5.0.8.0',
      'aliases' => 
      array (
      ),
      'reference' => '600a52c29afc0d1caa74acbec8d3095ca7e9910d',
    ),
    'symfony/http-foundation' => 
    array (
      'pretty_version' => 'v5.0.8',
      'version' => '5.0.8.0',
      'aliases' => 
      array (
      ),
      'reference' => 'e47fdf8b24edc12022ba52923150ec6484d7f57d',
    ),
    'symfony/http-kernel' => 
    array (
      'pretty_version' => 'v5.0.8',
      'version' => '5.0.8.0',
      'aliases' => 
      array (
      ),
      'reference' => '3565e51eecd06106304baba5ccb7ba89db2d7d2b',
    ),
    'symfony/mime' => 
    array (
      'pretty_version' => 'v5.0.8',
      'version' => '5.0.8.0',
      'aliases' => 
      array (
      ),
      'reference' => '5d6c81c39225a750f3f43bee15f03093fb9aaa0b',
    ),
    'symfony/polyfill-ctype' => 
    array (
      'pretty_version' => 'v1.16.0',
      'version' => '1.16.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '1aab00e39cebaef4d8652497f46c15c1b7e45294',
    ),
    'symfony/polyfill-iconv' => 
    array (
      'pretty_version' => 'v1.16.0',
      'version' => '1.16.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'd51debc1391a609c514f6f072dd59a61b461502a',
    ),
    'symfony/polyfill-intl-idn' => 
    array (
      'pretty_version' => 'v1.16.0',
      'version' => '1.16.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'ab0af41deab94ec8dceb3d1fb408bdd038eba4dc',
    ),
    'symfony/polyfill-mbstring' => 
    array (
      'pretty_version' => 'v1.16.0',
      'version' => '1.16.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'a54881ec0ab3b2005c406aed0023c062879031e7',
    ),
    'symfony/polyfill-php72' => 
    array (
      'pretty_version' => 'v1.16.0',
      'version' => '1.16.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '42fda6d7380e5c940d7f68341ccae89d5ab9963b',
    ),
    'symfony/polyfill-php73' => 
    array (
      'pretty_version' => 'v1.16.0',
      'version' => '1.16.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '7e95fe59d12169fcf4041487e4bf34fca37ee0ed',
    ),
    'symfony/process' => 
    array (
      'pretty_version' => 'v5.0.8',
      'version' => '5.0.8.0',
      'aliases' => 
      array (
      ),
      'reference' => '3179f68dff5bad14d38c4114a1dab98030801fd7',
    ),
    'symfony/routing' => 
    array (
      'pretty_version' => 'v5.0.8',
      'version' => '5.0.8.0',
      'aliases' => 
      array (
      ),
      'reference' => '9b18480a6e101f8d9ab7c483ace7c19441be5111',
    ),
    'symfony/service-contracts' => 
    array (
      'pretty_version' => 'v2.0.1',
      'version' => '2.0.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '144c5e51266b281231e947b51223ba14acf1a749',
    ),
    'symfony/translation' => 
    array (
      'pretty_version' => 'v5.0.8',
      'version' => '5.0.8.0',
      'aliases' => 
      array (
      ),
      'reference' => 'c3879db7a68fe3e12b41263b05879412c87b27fd',
    ),
    'symfony/translation-contracts' => 
    array (
      'pretty_version' => 'v2.0.1',
      'version' => '2.0.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '8cc682ac458d75557203b2f2f14b0b92e1c744ed',
    ),
    'symfony/translation-implementation' => 
    array (
      'provided' => 
      array (
        0 => '2.0',
      ),
    ),
    'symfony/var-dumper' => 
    array (
      'pretty_version' => 'v5.0.8',
      'version' => '5.0.8.0',
      'aliases' => 
      array (
      ),
      'reference' => '09de28632f16f81058a85fcf318397218272a07b',
    ),
    'tcg/voyager' => 
    array (
      'pretty_version' => 'v1.4.1',
      'version' => '1.4.1.0',
      'aliases' => 
      array (
      ),
      'reference' => 'f4e6775364a00716a85b8f0fdfe729df68a47913',
    ),
    'theseer/tokenizer' => 
    array (
      'pretty_version' => '1.1.3',
      'version' => '1.1.3.0',
      'aliases' => 
      array (
      ),
      'reference' => '11336f6f84e16a720dae9d8e6ed5019efa85a0f9',
    ),
    'tijsverkoyen/css-to-inline-styles' => 
    array (
      'pretty_version' => '2.2.2',
      'version' => '2.2.2.0',
      'aliases' => 
      array (
      ),
      'reference' => 'dda2ee426acd6d801d5b7fd1001cde9b5f790e15',
    ),
    'vlucas/phpdotenv' => 
    array (
      'pretty_version' => 'v4.1.5',
      'version' => '4.1.5.0',
      'aliases' => 
      array (
      ),
      'reference' => '539bb6927c101a5605d31d11a2d17185a2ce2bf1',
    ),
    'voku/portable-ascii' => 
    array (
      'pretty_version' => '1.4.10',
      'version' => '1.4.10.0',
      'aliases' => 
      array (
      ),
      'reference' => '240e93829a5f985fab0984a6e55ae5e26b78a334',
    ),
    'webmozart/assert' => 
    array (
      'pretty_version' => '1.8.0',
      'version' => '1.8.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'ab2cb0b3b559010b75981b1bdce728da3ee90ad6',
    ),
  ),
);
    private static $canGetVendors;
    private static $installedByVendor = array();

    /**
     * Returns a list of all package names which are present, either by being installed, replaced or provided
     *
     * @return string[]
     * @psalm-return list<string>
     */
    public static function getInstalledPackages()
    {
        $packages = array();
        foreach (self::getInstalled() as $installed) {
            $packages[] = array_keys($installed['versions']);
        }


        if (1 === \count($packages)) {
            return $packages[0];
        }

        return array_keys(array_flip(\call_user_func_array('array_merge', $packages)));
    }

    /**
     * Checks whether the given package is installed
     *
     * This also returns true if the package name is provided or replaced by another package
     *
     * @param  string $packageName
     * @return bool
     */
    public static function isInstalled($packageName)
    {
        foreach (self::getInstalled() as $installed) {
            if (isset($installed['versions'][$packageName])) {
                return true;
            }
        }

        return false;
    }

    /**
     * Checks whether the given package satisfies a version constraint
     *
     * e.g. If you want to know whether version 2.3+ of package foo/bar is installed, you would call:
     *
     *   Composer\InstalledVersions::satisfies(new VersionParser, 'foo/bar', '^2.3')
     *
     * @param VersionParser $parser      Install composer/semver to have access to this class and functionality
     * @param string        $packageName
     * @param string|null   $constraint  A version constraint to check for, if you pass one you have to make sure composer/semver is required by your package
     *
     * @return bool
     */
    public static function satisfies(VersionParser $parser, $packageName, $constraint)
    {
        $constraint = $parser->parseConstraints($constraint);
        $provided = $parser->parseConstraints(self::getVersionRanges($packageName));

        return $provided->matches($constraint);
    }

    /**
     * Returns a version constraint representing all the range(s) which are installed for a given package
     *
     * It is easier to use this via isInstalled() with the $constraint argument if you need to check
     * whether a given version of a package is installed, and not just whether it exists
     *
     * @param  string $packageName
     * @return string Version constraint usable with composer/semver
     */
    public static function getVersionRanges($packageName)
    {
        foreach (self::getInstalled() as $installed) {
            if (!isset($installed['versions'][$packageName])) {
                continue;
            }

            $ranges = array();
            if (isset($installed['versions'][$packageName]['pretty_version'])) {
                $ranges[] = $installed['versions'][$packageName]['pretty_version'];
            }
            if (array_key_exists('aliases', $installed['versions'][$packageName])) {
                $ranges = array_merge($ranges, $installed['versions'][$packageName]['aliases']);
            }
            if (array_key_exists('replaced', $installed['versions'][$packageName])) {
                $ranges = array_merge($ranges, $installed['versions'][$packageName]['replaced']);
            }
            if (array_key_exists('provided', $installed['versions'][$packageName])) {
                $ranges = array_merge($ranges, $installed['versions'][$packageName]['provided']);
            }

            return implode(' || ', $ranges);
        }

        throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
    }

    /**
     * @param  string      $packageName
     * @return string|null If the package is being replaced or provided but is not really installed, null will be returned as version, use satisfies or getVersionRanges if you need to know if a given version is present
     */
    public static function getVersion($packageName)
    {
        foreach (self::getInstalled() as $installed) {
            if (!isset($installed['versions'][$packageName])) {
                continue;
            }

            if (!isset($installed['versions'][$packageName]['version'])) {
                return null;
            }

            return $installed['versions'][$packageName]['version'];
        }

        throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
    }

    /**
     * @param  string      $packageName
     * @return string|null If the package is being replaced or provided but is not really installed, null will be returned as version, use satisfies or getVersionRanges if you need to know if a given version is present
     */
    public static function getPrettyVersion($packageName)
    {
        foreach (self::getInstalled() as $installed) {
            if (!isset($installed['versions'][$packageName])) {
                continue;
            }

            if (!isset($installed['versions'][$packageName]['pretty_version'])) {
                return null;
            }

            return $installed['versions'][$packageName]['pretty_version'];
        }

        throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
    }

    /**
     * @param  string      $packageName
     * @return string|null If the package is being replaced or provided but is not really installed, null will be returned as reference
     */
    public static function getReference($packageName)
    {
        foreach (self::getInstalled() as $installed) {
            if (!isset($installed['versions'][$packageName])) {
                continue;
            }

            if (!isset($installed['versions'][$packageName]['reference'])) {
                return null;
            }

            return $installed['versions'][$packageName]['reference'];
        }

        throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
    }

    /**
     * @return array
     * @psalm-return array{name: string, version: string, reference: string, pretty_version: string, aliases: string[]}
     */
    public static function getRootPackage()
    {
        $installed = self::getInstalled();

        return $installed[0]['root'];
    }

    /**
     * Returns the raw installed.php data for custom implementations
     *
     * @return array[]
     * @psalm-return array{root: array{name: string, version: string, reference: string, pretty_version: string, aliases: string[]}, versions: list<string, array{pretty_version: ?string, version: ?string, aliases: ?string[], reference: ?string, replaced: ?string[], provided: ?string[]}>}
     */
    public static function getRawData()
    {
        return self::$installed;
    }

    /**
     * Lets you reload the static array from another file
     *
     * This is only useful for complex integrations in which a project needs to use
     * this class but then also needs to execute another project's autoloader in process,
     * and wants to ensure both projects have access to their version of installed.php.
     *
     * A typical case would be PHPUnit, where it would need to make sure it reads all
     * the data it needs from this class, then call reload() with
     * `require $CWD/vendor/composer/installed.php` (or similar) as input to make sure
     * the project in which it runs can then also use this class safely, without
     * interference between PHPUnit's dependencies and the project's dependencies.
     *
     * @param  array[] $data A vendor/composer/installed.php data set
     * @return void
     *
     * @psalm-param array{root: array{name: string, version: string, reference: string, pretty_version: string, aliases: string[]}, versions: list<string, array{pretty_version: ?string, version: ?string, aliases: ?string[], reference: ?string, replaced: ?string[], provided: ?string[]}>} $data
     */
    public static function reload($data)
    {
        self::$installed = $data;
        self::$installedByVendor = array();
    }

    /**
     * @return array[]
     */
    private static function getInstalled()
    {
        if (null === self::$canGetVendors) {
            self::$canGetVendors = method_exists('Composer\Autoload\ClassLoader', 'getRegisteredLoaders');
        }

        $installed = array();

        if (self::$canGetVendors) {
            // @phpstan-ignore-next-line
            foreach (ClassLoader::getRegisteredLoaders() as $vendorDir => $loader) {
                if (isset(self::$installedByVendor[$vendorDir])) {
                    $installed[] = self::$installedByVendor[$vendorDir];
                } elseif (is_file($vendorDir.'/composer/installed.php')) {
                    $installed[] = self::$installedByVendor[$vendorDir] = require $vendorDir.'/composer/installed.php';
                }
            }
        }

        $installed[] = self::$installed;

        return $installed;
    }
}
