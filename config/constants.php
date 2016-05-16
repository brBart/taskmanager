<?php

return [
    'domain' => 'http://192.168.33.11',
    'port'  => ':8000',
    'url' => 'http://192.168.33.11',
    'roles' => [
		'admin' =>0 ,
		'developer' =>1 ,
		'client' =>2,
		'company' =>3 ,
    ],
    'notification_type' =>[
        'new_task_assigned' => 0,
        'new_comment' => 1 ,
        'new_file_uploaded' => 2,
        'task_status_update' => 3,
    ],
    'path' =>[
    	'photos' => '/assets/apps/img/photos/',
    	'public_path' => public_path().'/assets/apps/img/photos/',
        'thumb' => public_path().'/assets/apps/img/photos/thumb/',
    ],
    'cities' =>[
        'Davao City',
        'Cebu City',
        'Manila', 
        'Cagayan de Oro City', 
        'General Santos City',
        'Quezon City',
    ],
    'countries' =>[
        'Afghanistan', 
        'Albania', 
        'Algeria', 
        'American Samoa', 
        'Andorra', 
        'Angola', 
        'Anguilla', 
        'Antarctica', 
        'Antigua and Barbuda', 
        'Argentina', 
        'Armenia', 
        'Aruba', 
        'Australia', 
        'Austria', 
        'Azerbaijan', 
        'Bahamas', 
        'Bahrain', 
        'Bangladesh', 'Barbados', 'Belarus', 'Belgium', 'Belize', 'Benin', 'Bermuda', 'Bhutan', 'Bolivia', 'Bosnia and Herzegowina', 'Botswana', 'Bouvet Island', 'Brazil', 'British Indian Ocean Territory', 'Brunei Darussalam', 'Bulgaria', 'Burkina Faso', 'Burundi', 'Cambodia', 'Cameroon', 'Canada', 'Cape Verde', 'Cayman Islands', 'Central African Republic', 'Chad', 'Chile', 'China', 'Christmas Island', 'Cocos (Keeling) Islands', 'Colombia', 'Comoros', 'Congo', 'Congo, the Democratic Republic of the', 'Cook Islands', 'Costa Rica', 'Cote d\'Ivoire', 'Croatia (Hrvatska)', 'Cuba', 'Cyprus', 'Czech Republic', 'Denmark', 'Djibouti', 'Dominica', 'Dominican Republic', 'East Timor', 'Ecuador', 'Egypt', 'El Salvador', 'Equatorial Guinea', 'Eritrea', 'Estonia', 'Ethiopia', 'Falkland Islands (Malvinas)', 'Faroe Islands', 'Fiji', 'Finland', 'France', 'France Metropolitan', 'French Guiana', 'French Polynesia', 'French Southern Territories', 'Gabon', 'Gambia', 'Georgia', 'Germany', 'Ghana', 'Gibraltar', 'Greece', 'Greenland', 'Grenada', 'Guadeloupe', 'Guam', 'Guatemala', 'Guinea', 'Guinea-Bissau', 'Guyana', 'Haiti', 'Heard and Mc Donald Islands', 'Holy See (Vatican City State)', 'Honduras', 'Hong Kong', 'Hungary', 'Iceland', 'India', 'Indonesia', 'Iran (Islamic Republic of)', 'Iraq', 'Ireland', 'Israel', 'Italy', 'Jamaica', 'Japan', 'Jordan', 'Kazakhstan', 'Kenya', 'Kiribati', 'Korea, Democratic People\'s Republic of', 'Korea, Republic of', 'Kuwait', 'Kyrgyzstan', 'Lao, People\'s Democratic Republic', 'Latvia', 'Lebanon', 'Lesotho', 'Liberia', 'Libyan Arab Jamahiriya', 'Liechtenstein', 'Lithuania', 'Luxembourg', 'Macau', 'Macedonia, The Former Yugoslav Republic of', 'Madagascar', 'Malawi', 'Malaysia', 'Maldives', 'Mali', 'Malta', 'Marshall Islands', 'Martinique', 'Mauritania', 'Mauritius', 'Mayotte', 'Mexico', 'Micronesia, Federated States of', 'Moldova, Republic of', 'Monaco', 'Mongolia', 'Montserrat', 'Morocco', 'Mozambique', 'Myanmar', 'Namibia', 'Nauru', 'Nepal', 'Netherlands', 'Netherlands Antilles', 'New Caledonia', 'New Zealand', 'Nicaragua', 'Niger', 'Nigeria', 'Niue', 'Norfolk Island', 'Northern Mariana Islands', 'Norway', 'Oman', 'Pakistan', 'Palau', 'Panama', 'Papua New Guinea', 'Paraguay', 'Peru', 'Philippines', 'Pitcairn', 'Poland', 'Portugal', 'Puerto Rico', 'Qatar', 'Reunion', 'Romania', 'Russian Federation', 'Rwanda', 'Saint Kitts and Nevis', 'Saint Lucia', 'Saint Vincent and the Grenadines', 'Samoa', 'San Marino', 'Sao Tome and Principe', 'Saudi Arabia', 'Senegal', 'Seychelles', 'Sierra Leone', 'Singapore', 'Slovakia (Slovak Republic)', 'Slovenia', 'Solomon Islands', 'Somalia', 'South Africa', 'South Georgia and the South Sandwich Islands', 'Spain', 'Sri Lanka', 'St. Helena', 'St. Pierre and Miquelon', 'Sudan', 'Suriname', 'Svalbard and Jan Mayen Islands', 'Swaziland', 'Sweden', 'Switzerland', 'Syrian Arab Republic', 'Taiwan, Province of China', 'Tajikistan', 'Tanzania, United Republic of', 'Thailand', 'Togo', 'Tokelau', 'Tonga', 'Trinidad and Tobago', 'Tunisia', 'Turkey', 'Turkmenistan', 'Turks and Caicos Islands', 'Tuvalu', 'Uganda', 'Ukraine', 'United Arab Emirates', 'United Kingdom', 'United States', 'United States Minor Outlying Islands', 'Uruguay', 'Uzbekistan', 'Vanuatu', 'Venezuela', 'Vietnam', 'Virgin Islands (British)', 'Virgin Islands (U.S.)', 'Wallis and Futuna Islands', 'Western Sahara', 'Yemen', 'Yugoslavia', 'Zambia', 'Zimbabwe'],
    'timezones' =>[ '(UTC-11:00) Midway Island' => 'Pacific/Midway',
                    '(UTC-11:00) Samoa' => 'Pacific/Samoa',
                    '(UTC-10:00) Hawaii' => 'Pacific/Honolulu',
                    '(UTC-09:00) Alaska' => 'US/Alaska',
                    '(UTC-08:00) Pacific Time (US &amp; Canada)' => 'America/Los_Angeles',
                    '(UTC-08:00) Tijuana' => 'America/Tijuana',
                    '(UTC-07:00) Arizona' => 'US/Arizona',
                    '(UTC-07:00) Chihuahua' => 'America/Chihuahua',
                    '(UTC-07:00) La Paz' => 'America/Chihuahua',
                    '(UTC-07:00) Mazatlan' => 'America/Mazatlan',
                    '(UTC-07:00) Mountain Time (US &amp; Canada)' => 'US/Mountain',
                    '(UTC-06:00) Central America' => 'America/Managua',
                    '(UTC-06:00) Central Time (US &amp; Canada)' => 'US/Central',
                    '(UTC-06:00) Guadalajara' => 'America/Mexico_City',
                    '(UTC-06:00) Mexico City' => 'America/Mexico_City',
                    '(UTC-06:00) Monterrey' => 'America/Monterrey',
                    '(UTC-06:00) Saskatchewan' => 'Canada/Saskatchewan',
                    '(UTC-05:00) Bogota' => 'America/Bogota',
                    '(UTC-05:00) Eastern Time (US &amp; Canada)' => 'US/Eastern',
                    '(UTC-05:00) Indiana (East)' => 'US/East-Indiana',
                    '(UTC-05:00) Lima' => 'America/Lima',
                    '(UTC-05:00) Quito' => 'America/Bogota',
                    '(UTC-04:00) Atlantic Time (Canada)' => 'Canada/Atlantic',
                    '(UTC-04:30) Caracas' => 'America/Caracas',
                    '(UTC-04:00) La Paz' => 'America/La_Paz',
                    '(UTC-04:00) Santiago' => 'America/Santiago',
                    '(UTC-03:30) Newfoundland' => 'Canada/Newfoundland',
                    '(UTC-03:00) Brasilia' => 'America/Sao_Paulo',
                    '(UTC-03:00) Buenos Aires' => 'America/Argentina/Buenos_Aires',
                    '(UTC-03:00) Georgetown' => 'America/Argentina/Buenos_Aires',
                    '(UTC-03:00) Greenland' => 'America/Godthab',
                    '(UTC-02:00) Mid-Atlantic' => 'America/Noronha',
                    '(UTC-01:00) Azores' => 'Atlantic/Azores',
                    '(UTC-01:00) Cape Verde Is.' => 'Atlantic/Cape_Verde',
                    '(UTC+00:00) Casablanca' => 'Africa/Casablanca',
                    '(UTC+00:00) Edinburgh' => 'Europe/London',
                    '(UTC+00:00) Greenwich Mean Time : Dublin' => 'Etc/Greenwich',
                    '(UTC+00:00) Lisbon' => 'Europe/Lisbon',
                    '(UTC+00:00) London' => 'Europe/London',
                    '(UTC+00:00) Monrovia' => 'Africa/Monrovia',
                    '(UTC+00:00) UTC' => 'UTC',
                    '(UTC+01:00) Amsterdam' => 'Europe/Amsterdam',
                    '(UTC+01:00) Belgrade' => 'Europe/Belgrade',
                    '(UTC+01:00) Berlin' => 'Europe/Berlin',
                    '(UTC+01:00) Bern' => 'Europe/Berlin',
                    '(UTC+01:00) Bratislava' => 'Europe/Bratislava',
                    '(UTC+01:00) Brussels' => 'Europe/Brussels',
                    '(UTC+01:00) Budapest' => 'Europe/Budapest',
                    '(UTC+01:00) Copenhagen' => 'Europe/Copenhagen',
                    '(UTC+01:00) Ljubljana' => 'Europe/Ljubljana',
                    '(UTC+01:00) Madrid' => 'Europe/Madrid',
                    '(UTC+01:00) Paris' => 'Europe/Paris',
                    '(UTC+01:00) Prague' => 'Europe/Prague',
                    '(UTC+01:00) Rome' => 'Europe/Rome',
                    '(UTC+01:00) Sarajevo' => 'Europe/Sarajevo',
                    '(UTC+01:00) Skopje' => 'Europe/Skopje',
                    '(UTC+01:00) Stockholm' => 'Europe/Stockholm',
                    '(UTC+01:00) Vienna' => 'Europe/Vienna',
                    '(UTC+01:00) Warsaw' => 'Europe/Warsaw',
                    '(UTC+01:00) West Central Africa' => 'Africa/Lagos',
                    '(UTC+01:00) Zagreb' => 'Europe/Zagreb',
                    '(UTC+02:00) Athens' => 'Europe/Athens',
                    '(UTC+02:00) Bucharest' => 'Europe/Bucharest',
                    '(UTC+02:00) Cairo' => 'Africa/Cairo',
                    '(UTC+02:00) Harare' => 'Africa/Harare',
                    '(UTC+02:00) Helsinki' => 'Europe/Helsinki',
                    '(UTC+02:00) Istanbul' => 'Europe/Istanbul',
                    '(UTC+02:00) Jerusalem' => 'Asia/Jerusalem',
                    '(UTC+02:00) Kyiv' => 'Europe/Helsinki',
                    '(UTC+02:00) Pretoria' => 'Africa/Johannesburg',
                    '(UTC+02:00) Riga' => 'Europe/Riga',
                    '(UTC+02:00) Sofia' => 'Europe/Sofia',
                    '(UTC+02:00) Tallinn' => 'Europe/Tallinn',
                    '(UTC+02:00) Vilnius' => 'Europe/Vilnius',
                    '(UTC+03:00) Baghdad' => 'Asia/Baghdad',
                    '(UTC+03:00) Kuwait' => 'Asia/Kuwait',
                    '(UTC+03:00) Minsk' => 'Europe/Minsk',
                    '(UTC+03:00) Nairobi' => 'Africa/Nairobi',
                    '(UTC+03:00) Riyadh' => 'Asia/Riyadh',
                    '(UTC+03:00) Volgograd' => 'Europe/Volgograd',
                    '(UTC+03:30) Tehran' => 'Asia/Tehran',
                    '(UTC+04:00) Abu Dhabi' => 'Asia/Muscat',
                    '(UTC+04:00) Baku' => 'Asia/Baku',
                    '(UTC+04:00) Moscow' => 'Europe/Moscow',
                    '(UTC+04:00) Muscat' => 'Asia/Muscat',
                    '(UTC+04:00) St. Petersburg' => 'Europe/Moscow',
                    '(UTC+04:00) Tbilisi' => 'Asia/Tbilisi',
                    '(UTC+04:00) Yerevan' => 'Asia/Yerevan',
                    '(UTC+04:30) Kabul' => 'Asia/Kabul',
                    '(UTC+05:00) Islamabad' => 'Asia/Karachi',
                    '(UTC+05:00) Karachi' => 'Asia/Karachi',
                    '(UTC+05:00) Tashkent' => 'Asia/Tashkent',
                    '(UTC+05:30) Chennai' => 'Asia/Calcutta',
                    '(UTC+05:30) Kolkata' => 'Asia/Kolkata',
                    '(UTC+05:30) Mumbai' => 'Asia/Calcutta',
                    '(UTC+05:30) New Delhi' => 'Asia/Calcutta',
                    '(UTC+05:30) Sri Jayawardenepura' => 'Asia/Calcutta',
                    '(UTC+05:45) Kathmandu' => 'Asia/Katmandu',
                    '(UTC+06:00) Almaty' => 'Asia/Almaty',
                    '(UTC+06:00) Astana' => 'Asia/Dhaka',
                    '(UTC+06:00) Dhaka' => 'Asia/Dhaka',
                    '(UTC+06:00) Ekaterinburg' => 'Asia/Yekaterinburg',
                    '(UTC+06:30) Rangoon' => 'Asia/Rangoon',
                    '(UTC+07:00) Bangkok' => 'Asia/Bangkok',
                    '(UTC+07:00) Hanoi' => 'Asia/Bangkok',
                    '(UTC+07:00) Jakarta' => 'Asia/Jakarta',
                    '(UTC+07:00) Novosibirsk' => 'Asia/Novosibirsk',
                    '(UTC+08:00) Beijing' => 'Asia/Hong_Kong',
                    '(UTC+08:00) Chongqing' => 'Asia/Chongqing',
                    '(UTC+08:00) Hong Kong' => 'Asia/Hong_Kong',
                    '(UTC+08:00) Krasnoyarsk' => 'Asia/Krasnoyarsk',
                    '(UTC+08:00) Kuala Lumpur' => 'Asia/Kuala_Lumpur',
                    '(UTC+08:00) Perth' => 'Australia/Perth',
                    '(UTC+08:00) Singapore' => 'Asia/Singapore',
                    '(UTC+08:00) Taipei' => 'Asia/Taipei',
                    '(UTC+08:00) Ulaan Bataar' => 'Asia/Ulan_Bator',
                    '(UTC+08:00) Urumqi' => 'Asia/Urumqi',
                    '(UTC+09:00) Irkutsk' => 'Asia/Irkutsk',
                    '(UTC+09:00) Osaka' => 'Asia/Tokyo',
                    '(UTC+09:00) Sapporo' => 'Asia/Tokyo',
                    '(UTC+09:00) Seoul' => 'Asia/Seoul',
                    '(UTC+09:00) Tokyo' => 'Asia/Tokyo',
                    '(UTC+09:30) Adelaide' => 'Australia/Adelaide',
                    '(UTC+09:30) Darwin' => 'Australia/Darwin',
                    '(UTC+10:00) Brisbane' => 'Australia/Brisbane',
                    '(UTC+10:00) Canberra' => 'Australia/Canberra',
                    '(UTC+10:00) Guam' => 'Pacific/Guam',
                    '(UTC+10:00) Hobart' => 'Australia/Hobart',
                    '(UTC+10:00) Melbourne' => 'Australia/Melbourne',
                    '(UTC+10:00) Port Moresby' => 'Pacific/Port_Moresby',
                    '(UTC+10:00) Sydney' => 'Australia/Sydney',
                    '(UTC+10:00) Yakutsk' => 'Asia/Yakutsk',
                    '(UTC+11:00) Vladivostok' => 'Asia/Vladivostok',
                    '(UTC+12:00) Auckland' => 'Pacific/Auckland',
                    '(UTC+12:00) Fiji' => 'Pacific/Fiji',
                    '(UTC+12:00) International Date Line West' => 'Pacific/Kwajalein',
                    '(UTC+12:00) Kamchatka' => 'Asia/Kamchatka',
                    '(UTC+12:00) Magadan' => 'Asia/Magadan',
                    '(UTC+12:00) Marshall Is.' => 'Pacific/Fiji',
                    '(UTC+12:00) New Caledonia' => 'Asia/Magadan',
                    '(UTC+12:00) Solomon Is.' => 'Asia/Magadan',
                    '(UTC+12:00) Wellington' => 'Pacific/Auckland',
                    '(UTC+13:00) Nuku\'alofa' => 'Pacific/Tongatapu'
    ],
    'messages'=>[
        'success' => 'Successfully added',
        'error' => 'Error adding, please try again',
        'warning' => 'Warning!',
    ],
    'task_statuses' =>[
        'draft' => 0,
        'estimate' => 1,
        'approval' => 2,
        'develop' => 3,
        'more info' => 4,
        'complete' => 5,
        'archived' => 6,   
     ],
     'photo' => [
         'profile_photo' => '/assets/apps/img/photos/preview.png',
     ],
     'task_status' =>[
                    'all'      => [ 
                                    'draft' => 0,
                                    'estimate' => 1,
                                    'approval' => 2,
                                    'develop' => 3,
                                    'more info' => 4,
                                    'complete' => 5,
                                    'archived' => 6,                                    
                                  ],

                    'admin'    =>[
                                   'draft' => 0,
                                   'estimate' => 1,
                                   'approval' => 2,
                                   'develop' => 3,
                                   'more info' => 4,
                                   'complete' => 5,
                                   'archived' => 6,
                                 ],

                    'developer' =>[
                                    'develop' => 3,
                                    'more info' => 4,
                                    'complete' => 5,
                                  ],

                    'client'    =>[
                                   'draft' => 0,
                                   'estimate' => 1,
                                   'develop' => 3,
                                   'more info' => 4,
                                   'complete' => 5,
                                   'archived' => 6,
                                ],
                    'reverse'   =>[
                                   0 => 'draft',
                                   1 => 'estimate',
                                   2 => 'approval',
                                   3 => 'develop',
                                   4 => 'more info',
                                   5 => 'complete',
                                   6 => 'archived',
                                  ]

     ],

];	


?>  
