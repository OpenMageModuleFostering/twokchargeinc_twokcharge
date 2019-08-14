<?php

/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    Payment Method
 * @package     TwoKChargeInc_TwoKCharge
 * @copyright   Copyright (c) 2012 2000Charge Inc (http://www.2000charge.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

echo 'Running Upgrade script (mysql4-upgrade-0.2.0-0.2.2.php) for TwoKChargeInc_TwoKCharge<br />'; 

$installer = $this;

$installer->startSetup();

$table = $this->getTable('twokcharge_iban');


$installer->run("
    
        DROP TABLE IF EXISTS {$table};
        CREATE TABLE `{$table}`
        (
        country VARCHAR(255) NOT NULL, 
        country_id VARCHAR(255) NOT NULL UNIQUE,
        bank_code VARCHAR(255) NOT NULL,
        account_number VARCHAR(255) NOT NULL
        ) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
        
        INSERT INTO `{$table}`
                (`country`, `country_id`, `bank_code`, `account_number` ) 
             VALUES 
                ('Andorra',        'AD', '0  4n 4n', '0  12   0 '),
                ('Albania',        'AL', '0  8n 0 ', '0  16   0 '),
                ('Austria',        'AT', '0  5n 0 ', '0  11n  0 '),
                ('Bosnia and Herzegovina',
                                        'BA', '0  3n 3n', '0   8n  2n'),
                ('Belgium',        'BE', '0  3n 0 ', '0   7n  2n'),
                ('Bulgaria',       'BG', '0  4a 4n', '2n  8   0 '),
                ('Switzerland',    'CH', '0  5n 0 ', '0  12   0 '),
                ('Cyprus',         'CY', '0  3n 5n', '0  16   0 '),
                ('Czech Republic', 'CZ', '0  4n 0 ', '0  16n  0 '),
                ('Germany',        'DE', '0  8n 0 ', '0  10n  0 '),
                ('Denmark',        'DK', '0  4n 0 ', '0   9n  1n'),
                ('Estonia',        'EE', '0  2n 0 ', '2n 11n  1n'),
                ('Spain',          'ES', '0  4n 4n', '2n 10n  0 '),
                ('Finland',        'FI', '0  6n 0 ', '0   7n  1n'),
                ('Faroe Islands',  'FO', '0  4n 0 ', '0   9n  1n'),
                ('France',         'FR', '0  5n 5n', '0  11   2n'),
                ('United Kingdom', 'GB', '0  4a 6n', '0   8n  0 '),
                ('Georgia',        'GE', '0  2a 0 ', '0  16n  0 '),
                ('Gibraltar',      'GI', '0  4a 0 ', '0  15   0 '),
                ('Greenland',      'GL', '0  4n 0 ', '0   9n  1n'),
                ('Greece',         'GR', '0  3n 4n', '0  16   0 '),
                ('Croatia',        'HR', '0  7n 0 ', '0  10n  0 '),
                ('Hungary',        'HU', '0  3n 4n', '1n 15n  1n'),
                ('Ireland',        'IE', '0  4a 6n', '0   8n  0 '),
                ('Israel',         'IL', '0  3n 3n', '0  13n  0 '),
                ('Iceland',        'IS', '0  4n 0 ', '2n 16n  0 '),
                ('Italy',          'IT', '1a 5n 5n', '0  12   0 '),
                ('Kuwait',         'KW', '0  4a 0 ', '0  22   0 '),
                ('Kazakhstan',     'KZ', '0  3n 0 ', '0  13   0 '),
                ('Lebanon',        'LB', '0  4n 0 ', '0  20   0 '),
                ('Liechtenstein',  'LI', '0  5n 0 ', '0  12   0 '),
                ('Lithuania',      'LT', '0  5n 0 ', '0  11n  0 '),
                ('Luxembourg',     'LU', '0  3n 0 ', '0  13   0 '),
                ('Latvia',         'LV', '0  4a 0 ', '0  13   0 '),
                ('Monaco',         'MC', '0  5n 5n', '0  11   2n'),
                ('Montenegro',     'ME', '0  3n 0 ', '0  13n  2n'),
                ('Macedonia, Former Yugoslav Republic of',
                                        'MK', '0  3n 0 ', '0  10   2n'),
                ('Mauritania',     'MR', '0  5n 5n', '0  11n  2n'),
                ('Malta',          'MT', '0  4a 5n', '0  18   0 '),
                ('Mauritius',      'MU', '0  4a 4n', '0  15n  3a'),
                ('Netherlands',    'NL', '0  4a 0 ', '0  10n  0 '),
                ('Norway',         'NO', '0  4n 0 ', '0   6n  1n'),
                ('Poland',         'PL', '0  8n 0 ', '0  16n  0 '),
                ('Portugal',       'PT', '0  4n 4n', '0  11n  2n'),
                ('Romania',        'RO', '0  4a 0 ', '0  16   0 '),
                ('Serbia',         'RS', '0  3n 0 ', '0  13n  2n'),
                ('Saudi Arabia',   'SA', '0  2n 0 ', '0  18   0 '),
                ('Sweden',         'SE', '0  3n 0 ', '0  16n  1n'),
                ('Slovenia',       'SI', '0  5n 0 ', '0   8n  2n'),
                ('Slovak Republic',
                                        'SK', '0  4n 0 ', '0  16n  0 '),
                ('San Marino',     'SM', '1a 5n 5n', '0  12   0 '),
                ('Tunisia',        'TN', '0  2n 3n', '0  13n  2n'),
                ('Turkey',         'TR', '0  5n 0 ', '1  16   0 ')

");


$installer->endSetup();



