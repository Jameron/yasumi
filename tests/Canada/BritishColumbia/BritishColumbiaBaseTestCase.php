<?php

declare(strict_types=1);
/**
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2020 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me@sachatelgenhof.com>
 */

namespace Yasumi\tests\Canada\BritishColumbia;

use Yasumi\tests\Canada\CanadaBaseTestCase;
use Yasumi\tests\YasumiBase;

/**
 * Base class for test cases of the British Columbia holiday provider.
 */
abstract class BritishColumbiaBaseTestCase extends CanadaBaseTestCase
{
    use YasumiBase;

    /**
     * Name of the region (e.g. country / state) to be tested.
     */
    public const REGION = 'Canada\BritishColumbia';

    /**
     * Timezone in which this provider has holidays defined.
     */
    public const TIMEZONE = 'America/Vancouver';

    /**
     * Locale that is considered common for this provider.
     */
    public const LOCALE = 'en_CA';

    /**
     * Number of iterations to be used for the various unit tests of this provider.
     */
    public const TEST_ITERATIONS = 50;
}
