<?php

/*
|--------------------------------------------------------------------------
| This file contains the iso8583 fields specification.
|--------------------------------------------------------------------------
|
| This field specifications following the iso8583 1987 version, that support
| the following data elements:
|    Datatype: a, n, s, an, as, ns, ans, b
|    Data encodings: bcd, ascii
|    Data lengths: fix, llvar, lllvar
|
*/

return [
    0 => [
        'type' => 'n',
        'length' => 4,
        'encode' => 'bcd',
    ],
    2 => [
        'type' => 'n..',
        'encode' => 'bcd',
        'length' => 19,
    ],
    3 => [
        'type' => 'n',
        'encode' => 'bcd',
        'length' => 6,
    ],
    4 => [
        'type' => 'n',
        'encode' => 'bcd',
        'length' => 12,
    ],
    5 => [
        'type' => 'n',
        'encode' => 'bcd',
        'length' => 12,
    ],
    6 => [
        'type' => 'n',
        'encode' => 'bcd',
        'length' => 12,
    ],
    7 => [
        'type' => 'n',
        'encode' => 'bcd',
        'length' => 10,
    ],
    8 => [
        'type' => 'n',
        'encode' => 'bcd',
        'length' => 8,
    ],
    9 => [
        'type' => 'n',
        'encode' => 'bcd',
        'length' => 8,
    ],
    10 => [
        'type' => 'n',
        'encode' => 'bcd',
        'length' => 8,
    ],
    11 => [
        'type' => 'n',
        'encode' => 'bcd',
        'length' => 6,
    ],
    12 => [
        'type' => 'n',
        'encode' => 'bcd',
        'length' => 6,
    ],
    13 => [
        'type' => 'n',
        'encode' => 'bcd',
        'length' => 4,
    ],
    14 => [
        'type' => 'n',
        'encode' => 'bcd',
        'length' => 4,
    ],
    15 => [
        'type' => 'n',
        'encode' => 'bcd',
        'length' => 4,
    ],
    16 => [
        'type' => 'n',
        'encode' => 'bcd',
        'length' => 4,
    ],
    17 => [
        'type' => 'n',
        'encode' => 'bcd',
        'length' => 4,
    ],
    18 => [
        'type' => 'n',
        'encode' => 'bcd',
        'length' => 4,
    ],
    19 => [
        'type' => 'n',
        'encode' => 'bcd',
        'length' => 3,
    ],
    20 => [
        'type' => 'n',
        'encode' => 'bcd',
        'length' => 3,
    ],
    21 => [
        'type' => 'n',
        'encode' => 'bcd',
        'length' => 3,
    ],
    22 => [
        'type' => 'n',
        'encode' => 'bcd',
        'length' => 3,
    ],
    23 => [
        'type' => 'n',
        'encode' => 'bcd',
        'length' => 3,
    ],
    24 => [
        'type' => 'n',
        'encode' => 'bcd',
        'length' => 3,
    ],
    25 => [
        'type' => 'n',
        'encode' => 'bcd',
        'length' => 2,
    ],
    26 => [
        'type' => 'n',
        'encode' => 'bcd',
        'length' => 2,
    ],
    27 => [
        'type' => 'n',
        'encode' => 'bcd',
        'length' => 1,
    ],
    28 => [
        'type' => 'an',
        'encode' => 'ascii',
        'length' => 9,
    ],
    29 => [
        'type' => 'an',
        'encode' => 'ascii',
        'length' => 9,
    ],
    30 => [
        'type' => 'an',
        'encode' => 'ascii',
        'length' => 9,
    ],
    31 => [
        'type' => 'an',
        'encode' => 'ascii',
        'length' => 9,
    ],
    32 => [
        'type' => 'n..',
        'encode' => 'bcd, bcd',
        'length' => 11,
    ],
    33 => [
        'type' => 'n..',
        'encode' => 'bcd, bcd',
        'length' => 11,
    ],
    34 => [
        'type' => 'ns..',
        'encode' => 'ascii',
        'length' => 28,
    ],
    35 => [
        'type' => 'ans',
        'encode' => 'ascii',
        'length' => 37,
    ],
    36 => [
        'type' => 'n...',
        'encode' => 'bcd, bcd',
        'length' => 104,
    ],
    37 => [
        'type' => 'an',
        'encode' => 'ascii',
        'length' => 12,
    ],
    38 => [
        'type' => 'an',
        'encode' => 'ascii',
        'length' => 6,
    ],
    39 => [
        'type' => 'an',
        'encode' => 'ascii',
        'length' => 2,
    ],
    40 => [
        'type' => 'an',
        'encode' => 'ascii',
        'length' => 3,
    ],
    41 => [
        'type' => 'ans',
        'encode' => 'ascii',
        'length' => 8,
    ],
    42 => [
        'type' => 'ans',
        'encode' => 'ascii',
        'length' => 15,
    ],
    43 => [
        'type' => 'ans',
        'encode' => 'ascii',
        'length' => 40,
    ],
    44 => [
        'type' => 'an..',
        'encode' => 'bcd, ascii',
        'length' => 25,
    ],
    45 => [
        'type' => 'an..',
        'encode' => 'bcd, ascii',
        'length' => 70,
    ],
    46 => [
        'type' => 'an...',
        'encode' => 'bcd,ascii',
        'length' => 999,
    ],
    47 => [
        'type' => 'an...',
        'encode' => 'bcd,ascii',
        'length' => 999,
    ],
    48 => [
        'type' => 'an...',
        'encode' => 'bcd,ascii',
        'length' => 999,
    ],
    49 => [
        'type' => 'n',
        'encode' => 'bcd',
        'length' => 3,
    ],
    50 => [
        'type' => 'n',
        'encode' => 'bcd',
        'length' => 3,
    ],
    51 => [
        'type' => 'n',
        'encode' => 'bcd',
        'length' => 3,
    ],
    52 => [
        'type' => 'b',
        'encode' => 'ascii',
        'length' => 64,
    ],
    53 => [
        'type' => 'n',
        'encode' => 'bcd',
        'length' => 16,
    ],
    54 => [
        'type' => 'an...',
        'encode' => 'bcd,ascii',
        'length' => 120,
    ],
    55 => [
        'type' => 'ans...',
        'encode' => 'bcd,ascii',
        'length' => 999,
    ],
    56 => [
        'type' => 'ans...',
        'encode' => 'bcd,ascii',
        'length' => 999,
    ],
    57 => [
        'type' => 'ans...',
        'encode' => 'bcd,ascii',
        'length' => 999,
    ],
    58 => [
        'type' => 'ans...',
        'encode' => 'bcd,ascii',
        'length' => 999,
    ],
    59 => [
        'type' => 'ans...',
        'encode' => 'bcd,ascii',
        'length' => 999,
    ],
    60 => [
        'type' => 'ans...',
        'encode' => 'bcd,ascii',
        'length' => 999,
    ],
    61 => [
        'type' => 'ans...',
        'encode' => 'bcd,ascii',
        'length' => 999,
    ],
    62 => [
        'type' => 'ans...',
        'encode' => 'bcd,ascii',
        'length' => 999,
    ],
    63 => [
        'type' => 'ans...',
        'encode' => 'bcd,ascii',
        'length' => 999,
    ],
    64 => [
        'type' => 'b',
        'encode' => 'ascii',
        'length' => 64,
    ],
    65 => [
        'type' => 'b',
        'encode' => 'ascii',
        'length' => 1,
    ],
    66 => [
        'type' => 'n',
        'encode' => 'bcd',
        'length' => 1,
    ],
    67 => [
        'type' => 'n',
        'encode' => 'bcd',
        'length' => 2,
    ],
    68 => [
        'type' => 'n',
        'encode' => 'bcd',
        'length' => 3,
    ],
    69 => [
        'type' => 'n',
        'encode' => 'bcd',
        'length' => 3,
    ],
    70 => [
        'type' => 'n',
        'encode' => 'bcd',
        'length' => 3,
    ],
    71 => [
        'type' => 'n',
        'encode' => 'bcd',
        'length' => 4,
    ],
    72 => [
        'type' => 'n',
        'encode' => 'bcd',
        'length' => 4,
    ],
    73 => [
        'type' => 'n',
        'encode' => 'bcd',
        'length' => 6,
    ],
    74 => [
        'type' => 'n',
        'encode' => 'bcd',
        'length' => 10,
    ],
    75 => [
        'type' => 'n',
        'encode' => 'bcd',
        'length' => 10,
    ],
    76 => [
        'type' => 'n',
        'encode' => 'bcd',
        'length' => 10,
    ],
    77 => [
        'type' => 'n',
        'encode' => 'bcd',
        'length' => 10,
    ],
    78 => [
        'type' => 'n',
        'encode' => 'bcd',
        'length' => 10,
    ],
    79 => [
        'type' => 'n',
        'encode' => 'bcd',
        'length' => 10,
    ],
    80 => [
        'type' => 'n',
        'encode' => 'bcd',
        'length' => 10,
    ],
    81 => [
        'type' => 'n',
        'encode' => 'bcd',
        'length' => 10,
    ],
    82 => [
        'type' => 'n',
        'encode' => 'bcd',
        'length' => 12,
    ],
    83 => [
        'type' => 'n',
        'encode' => 'bcd',
        'length' => 12,
    ],
    84 => [
        'type' => 'n',
        'encode' => 'bcd',
        'length' => 12,
    ],
    85 => [
        'type' => 'n',
        'encode' => 'bcd',
        'length' => 12,
    ],
    86 => [
        'type' => 'n',
        'encode' => 'bcd',
        'length' => 16,
    ],
    87 => [
        'type' => 'n',
        'encode' => 'bcd',
        'length' => 16,
    ],
    88 => [
        'type' => 'n',
        'encode' => 'bcd',
        'length' => 16,
    ],
    89 => [
        'type' => 'n',
        'encode' => 'bcd',
        'length' => 16,
    ],
    90 => [
        'type' => 'n',
        'encode' => 'bcd',
        'length' => 42,
    ],
    91 => [
        'type' => 'an',
        'encode' => 'ascii',
        'length' => 1,
    ],
    92 => [
        'type' => 'an',
        'encode' => 'bcd',
        'length' => 2,
    ],
    93 => [
        'type' => 'an',
        'encode' => 'bcd',
        'length' => 5,
    ],
    94 => [
        'type' => 'an',
        'encode' => 'bcd',
        'length' => 7,
    ],
    95 => [
        'type' => 'an',
        'encode' => 'bcd',
        'length' => 42,
    ],
    96 => [
        'type' => 'b',
        'encode' => 'ascii',
        'length' => 64,
    ],
    97 => [
        'type' => 'an',
        'encode' => 'ascii',
        'length' => 17,
    ],
    98 => [
        'type' => 'ans',
        'encode' => 'ascii',
        'length' => 25,
    ],
    99 => [
        'type' => 'n..',
        'encode' => 'bcd,ascii',
        'length' => 11,
    ],
    100 => [
        'type' => 'n..',
        'encode' => 'bcd,ascii',
        'length' => 11,
    ],
    101 => [
        'type' => 'ans...',
        'encode' => 'bcd,ascii',
        'length' => 17,
    ],
    102 => [
        'type' => 'ans...',
        'encode' => 'bcd,ascii',
        'length' => 28,
    ],
    103 => [
        'type' => 'ans...',
        'encode' => 'bcd,ascii',
        'length' => 28,
    ],
    104 => [
        'type' => 'ans...',
        'encode' => 'bcd,ascii',
        'length' => 100,
    ],
    105 => [
        'type' => 'ans...',
        'encode' => 'bcd,ascii',
        'length' => 999,
    ],
    106 => [
        'type' => 'ans...',
        'encode' => 'bcd,ascii',
        'length' => 999,
    ],
    107 => [
        'type' => 'ans...',
        'encode' => 'bcd,ascii',
        'length' => 999,
    ],
    108 => [
        'type' => 'ans...',
        'encode' => 'bcd,ascii',
        'length' => 999,
    ],
    109 => [
        'type' => 'ans...',
        'encode' => 'bcd,ascii',
        'length' => 999,
    ],
    110 => [
        'type' => 'ans...',
        'encode' => 'bcd,ascii',
        'length' => 999,
    ],
    111 => [
        'type' => 'ans...',
        'encode' => 'bcd,ascii',
        'length' => 999,
    ],
    112 => [
        'type' => 'ans...',
        'encode' => 'bcd,ascii',
        'length' => 999,
    ],
    113 => [
        'type' => 'ans...',
        'encode' => 'bcd,ascii',
        'length' => 999,
    ],
    114 => [
        'type' => 'ans...',
        'encode' => 'bcd,ascii',
        'length' => 999,
    ],
    115 => [
        'type' => 'ans...',
        'encode' => 'bcd,ascii',
        'length' => 999,
    ],
    116 => [
        'type' => 'ans...',
        'encode' => 'bcd,ascii',
        'length' => 999,
    ],
    117 => [
        'type' => 'ans...',
        'encode' => 'bcd,ascii',
        'length' => 999,
    ],
    118 => [
        'type' => 'ans...',
        'encode' => 'bcd,ascii',
        'length' => 999,
    ],
    119 => [
        'type' => 'ans...',
        'encode' => 'bcd,ascii',
        'length' => 999,
    ],
    120 => [
        'type' => 'ans...',
        'encode' => 'bcd,ascii',
        'length' => 999,
    ],
    121 => [
        'type' => 'ans...',
        'encode' => 'bcd,ascii',
        'length' => 999,
    ],
    122 => [
        'type' => 'ans...',
        'encode' => 'bcd,ascii',
        'length' => 999,
    ],
    123 => [
        'type' => 'ans...',
        'encode' => 'bcd,ascii',
        'length' => 999,
    ],
    124 => [
        'type' => 'ans...',
        'encode' => 'bcd,ascii',
        'length' => 999,
    ],
    125 => [
        'type' => 'ans...',
        'encode' => 'bcd,ascii',
        'length' => 999,
    ],
    126 => [
        'type' => 'ans...',
        'encode' => 'bcd,ascii',
        'length' => 999,
    ],
    127 => [
        'type' => 'ans...',
        'encode' => 'bcd,ascii',
        'length' => 999,
    ],
    128 => [
        'type' => 'b',
        'encode' => 'ascii',
        'length' => 64,
    ],
];
