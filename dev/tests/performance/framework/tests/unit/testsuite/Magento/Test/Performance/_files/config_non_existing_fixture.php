<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

$result = require __DIR__ . '/config_data.php';
$result['scenario']['scenarios']['Scenario']['fixtures'] = ['non_existing_fixture.php'];
return $result;
