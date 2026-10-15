<?php
// 每届内容集中维护在这里。复制数组条目可增加人员、论文、日期等；[] 表示尚未公布。
// 文本为纯文本（自动转义），不要写 HTML。链接可以是 https://... 或 web/ 下的相对资源路径。
return [
    'welcome' => 'APNet brings together researchers in computer networking and systems to discuss innovative ideas at their early stages. Promising work can receive timely feedback from the community and develop into future research.',
    'notice' => ['text' => '[Important conference announcement]', 'url' => ''],
    'calls' => require __DIR__ . '/calls.php',
    'news' => [
        ['date' => '[Announcement date]', 'text' => 'Conference details will be announced here.', 'url' => ''],
    ],
    // Workshop is shown automatically. Add extra deadlines here when needed.
    'dates' => [],
    'topics' => [
        'Network architectures, protocols, and systems',
        'Datacenter and cloud networking',
        'Network measurement and management',
        'Network security and privacy',
        'Programmable networks',
        'Wireless, mobile, and satellite networks',
        'Networking for AI and AI for networking',
    ],
    'organization' => [
        'General Chairs' => [['name' => '[Chair name]', 'affiliation' => '[Institution]', 'url' => '']],
        'Program Chairs' => [['name' => '[Chair name]', 'affiliation' => '[Institution]', 'url' => '']],
        'Poster Chairs' => [],
        'Publication Chairs' => [],
        'Publicity Chairs' => [],
        'Finance Chairs' => [],
        'Sponsorship Chairs' => [],
        'Local Chairs' => [],
        'Travel Grant Chairs' => [],
        'Web Chairs' => [['name' => '[Chair name]', 'affiliation' => '[Institution]', 'url' => '']],
        'Steering Committee' => [],
    ],
    'program_committee' => [
        ['name' => '[Member name]', 'affiliation' => '[Institution]', 'url' => ''],
    ],
    'program_session_times' => [
        ['title' => 'Keynote Talk', 'duration' => '[Talk duration]'],
        ['title' => 'Regular Paper', 'duration' => '[Talk duration] + [Q&A duration]'],
        ['title' => 'Academic Insight Talk', 'duration' => '[Talk duration]'],
        ['title' => 'Industry Spotlight Talk', 'duration' => '[Talk duration]'],
    ],
    'program' => [
        ['day' => '[Date] (Day 1)', 'sessions' => [
            ['time' => '[Start–end time]', 'title' => 'Opening Remarks', 'speaker' => '[General Chair name] / [Program Chair name]', 'items' => []],
            ['time' => '[Start–end time]', 'title' => 'Keynote: [Talk title]', 'speaker' => '[Speaker name] ([Institution])',
             'slides' => '', 'video' => '', 'items' => []],
            ['time' => '[Start–end time]', 'title' => 'Session 1: [Session title]', 'chair' => '[Session chair name]',
             'items' => [
                 ['title' => '[Paper 1 title]', 'authors' => '[Author 1], [Author 2] ([Institution 1]); [Author 3] ([Institution 2])', 'url' => '', 'slides' => '', 'video' => ''],
                 ['title' => '[Paper 2 title]', 'authors' => '[Author 1], [Author 2] ([Institution 1]); [Author 3] ([Institution 2])', 'url' => '', 'slides' => '', 'video' => ''],
                 ['title' => '[Paper 3 title]', 'authors' => '[Author 1], [Author 2] ([Institution 1]); [Author 3] ([Institution 2])', 'url' => '', 'slides' => '', 'video' => ''],
                 ['title' => '[Paper 4 title]', 'authors' => '[Author 1], [Author 2] ([Institution 1]); [Author 3] ([Institution 2])', 'url' => '', 'slides' => '', 'video' => ''],
             ]],
            ['time' => '[Start–end time]', 'title' => 'Coffee Break', 'items' => []],
            ['time' => '[Start–end time]', 'title' => 'Session 2: [Session title]', 'chair' => '[Session chair name]',
             'items' => [
                 ['title' => '[Paper 5 title]', 'authors' => '[Author 1], [Author 2] ([Institution 1]); [Author 3] ([Institution 2])', 'url' => '', 'slides' => '', 'video' => ''],
                 ['title' => '[Paper 6 title]', 'authors' => '[Author 1], [Author 2] ([Institution 1]); [Author 3] ([Institution 2])', 'url' => '', 'slides' => '', 'video' => ''],
                 ['title' => '[Paper 7 title]', 'authors' => '[Author 1], [Author 2] ([Institution 1]); [Author 3] ([Institution 2])', 'url' => '', 'slides' => '', 'video' => ''],
                 ['title' => '[Paper 8 title]', 'authors' => '[Author 1], [Author 2] ([Institution 1]); [Author 3] ([Institution 2])', 'url' => '', 'slides' => '', 'video' => ''],
             ]],
            ['time' => '[Start–end time]', 'title' => 'Lunch', 'items' => []],
            ['time' => '[Start–end time]', 'title' => 'Session 3: [Session title]', 'chair' => '[Session chair name]',
             'items' => [
                 ['title' => '[Paper 9 title]', 'authors' => '[Author 1], [Author 2] ([Institution 1]); [Author 3] ([Institution 2])', 'url' => '', 'slides' => '', 'video' => ''],
                 ['title' => '[Paper 10 title]', 'authors' => '[Author 1], [Author 2] ([Institution 1]); [Author 3] ([Institution 2])', 'url' => '', 'slides' => '', 'video' => ''],
                 ['title' => '[Paper 11 title]', 'authors' => '[Author 1], [Author 2] ([Institution 1]); [Author 3] ([Institution 2])', 'url' => '', 'slides' => '', 'video' => ''],
                 ['title' => '[Paper 12 title]', 'authors' => '[Author 1], [Author 2] ([Institution 1]); [Author 3] ([Institution 2])', 'url' => '', 'slides' => '', 'video' => ''],
                 ['title' => '[Paper 13 title]', 'authors' => '[Author 1], [Author 2] ([Institution 1]); [Author 3] ([Institution 2])', 'url' => '', 'slides' => '', 'video' => ''],
             ]],
        ]],
    ],
    'program_note' => 'All times are in [Conference time zone]. The schedule will be confirmed before the conference.',
    'talks' => [
        'keynote' => [
            ['title' => '[Keynote title]', 'name' => '[Speaker name]', 'affiliation' => '[Institution]', 'url' => '', 'photo' => '',
             'abstract' => 'The keynote abstract will be announced here.', 'bio' => 'The speaker biography will be announced here.', 'slides' => '', 'video' => ''],
        ],
        'industry' => [
            ['title' => '[Industry talk title]', 'name' => '[Speaker name]', 'affiliation' => '[Organization]', 'url' => '', 'photo' => '',
             'abstract' => 'The talk abstract will be announced here.', 'bio' => 'The speaker biography will be announced here.', 'slides' => '', 'video' => ''],
        ],
        'sigcommnsdi' => [
            ['title' => '[Academic talk title]', 'name' => '[Speaker name]', 'affiliation' => '[Institution]', 'url' => '', 'photo' => '',
             'abstract' => 'The talk abstract will be announced here.', 'bio' => 'The speaker biography will be announced here.', 'slides' => '', 'video' => ''],
        ],
    ],
    'papers' => [
        ['title' => '[Paper 1 title]', 'authors' => '[Author 1], [Author 2] ([Institution 1]); [Author 3] ([Institution 2])', 'url' => '', 'slides' => '', 'video' => ''],
        ['title' => '[Paper 2 title]', 'authors' => '[Author 1], [Author 2] ([Institution 1]); [Author 3] ([Institution 2])', 'url' => '', 'slides' => '', 'video' => ''],
        ['title' => '[Paper 3 title]', 'authors' => '[Author 1], [Author 2] ([Institution 1]); [Author 3] ([Institution 2])', 'url' => '', 'slides' => '', 'video' => ''],
        ['title' => '[Paper 4 title]', 'authors' => '[Author 1], [Author 2] ([Institution 1]); [Author 3] ([Institution 2])', 'url' => '', 'slides' => '', 'video' => ''],
        ['title' => '[Paper 5 title]', 'authors' => '[Author 1], [Author 2] ([Institution 1]); [Author 3] ([Institution 2])', 'url' => '', 'slides' => '', 'video' => ''],
        ['title' => '[Paper 6 title]', 'authors' => '[Author 1], [Author 2] ([Institution 1]); [Author 3] ([Institution 2])', 'url' => '', 'slides' => '', 'video' => ''],
        ['title' => '[Paper 7 title]', 'authors' => '[Author 1], [Author 2] ([Institution 1]); [Author 3] ([Institution 2])', 'url' => '', 'slides' => '', 'video' => ''],
        ['title' => '[Paper 8 title]', 'authors' => '[Author 1], [Author 2] ([Institution 1]); [Author 3] ([Institution 2])', 'url' => '', 'slides' => '', 'video' => ''],
        ['title' => '[Paper 9 title]', 'authors' => '[Author 1], [Author 2] ([Institution 1]); [Author 3] ([Institution 2])', 'url' => '', 'slides' => '', 'video' => ''],
        ['title' => '[Paper 10 title]', 'authors' => '[Author 1], [Author 2] ([Institution 1]); [Author 3] ([Institution 2])', 'url' => '', 'slides' => '', 'video' => ''],
        ['title' => '[Paper 11 title]', 'authors' => '[Author 1], [Author 2] ([Institution 1]); [Author 3] ([Institution 2])', 'url' => '', 'slides' => '', 'video' => ''],
        ['title' => '[Paper 12 title]', 'authors' => '[Author 1], [Author 2] ([Institution 1]); [Author 3] ([Institution 2])', 'url' => '', 'slides' => '', 'video' => ''],
        ['title' => '[Paper 13 title]', 'authors' => '[Author 1], [Author 2] ([Institution 1]); [Author 3] ([Institution 2])', 'url' => '', 'slides' => '', 'video' => ''],
    ],
    'posters' => [
        ['title' => '[Poster 1 title]', 'authors' => '[Author 1], [Author 2] ([Institution 1]); [Author 3] ([Institution 2])', 'url' => '', 'slides' => '', 'video' => ''],
        ['title' => '[Poster 2 title]', 'authors' => '[Author 1], [Author 2] ([Institution 1]); [Author 3] ([Institution 2])', 'url' => '', 'slides' => '', 'video' => ''],
        ['title' => '[Poster 3 title]', 'authors' => '[Author 1], [Author 2] ([Institution 1]); [Author 3] ([Institution 2])', 'url' => '', 'slides' => '', 'video' => ''],
        ['title' => '[Poster 4 title]', 'authors' => '[Author 1], [Author 2] ([Institution 1]); [Author 3] ([Institution 2])', 'url' => '', 'slides' => '', 'video' => ''],
        ['title' => '[Poster 5 title]', 'authors' => '[Author 1], [Author 2] ([Institution 1]); [Author 3] ([Institution 2])', 'url' => '', 'slides' => '', 'video' => ''],
    ],
    'registration' => [
        'intro' => 'Registration dates, fees, and instructions will be announced here.',
        'currency' => '[Currency]',
        'early_deadline' => 'To be announced',
        'deadline' => 'To be announced',
        'categories' => ['[Category 1]', '[Category 2]', '[Category 3]', '[Category 4]'],
        'fees' => [
            ['category' => 'Early Registration', 'amounts' => ['To be announced', 'To be announced', 'To be announced', 'To be announced']],
            ['category' => 'Late Registration', 'amounts' => ['To be announced', 'To be announced', 'To be announced', 'To be announced']],
        ],
    ],
    'sponsors' => [
        ['name' => '[Sponsor 1]', 'tier' => '[Sponsorship tier]', 'url' => '', 'logo' => ''],
        ['name' => '[Sponsor 2]', 'tier' => '[Sponsorship tier]', 'url' => '', 'logo' => ''],
        ['name' => '[Sponsor 3]', 'tier' => '[Sponsorship tier]', 'url' => '', 'logo' => ''],
        ['name' => '[Sponsor 4]', 'tier' => '[Sponsorship tier]', 'url' => '', 'logo' => ''],
        ['name' => '[Sponsor 5]', 'tier' => '[Sponsorship tier]', 'url' => '', 'logo' => ''],
    ],
    'past_events' => [],
    'visa' => [
        'intro' => 'Invitation letter instructions and the local contact will be announced here. The information required for requests will include:',
        'fields' => ['[Required applicant information]', '[Required affiliation information]', '[Other required information]'],
    ],
    // 长文部分按标题与段落填写；不要沿用上一届的费用、政策、页数或法律/签证信息。
    // 每个 section 可选 links => [['label' => '链接标题', 'url' => 'https://...']]。
    'sections' => [
        'index' => [],
        'registration' => [
            ['title' => 'A Special Note on Author Registration Policy', 'paragraphs' => ['Author registration requirements will be announced here.']],
            ['title' => 'Important Deadline for Accepted Papers and Posters', 'paragraphs' => ['Author registration deadlines will be announced here.']],
            ['title' => 'Cancellation Policy', 'paragraphs' => ['Cancellation and refund terms will be announced before registration opens.']],
        ],
        'local' => [
            ['title' => 'Getting Here', 'paragraphs' => ['The venue address, local transport, accessibility, and arrival information will be announced here.']],
            ['title' => 'Accommodation', 'paragraphs' => ['Hotel options and any conference booking arrangements will be announced here.']],
        ],
        'visa' => [],
        'supporters' => [],
    ],
];
