<?php
// Edit the call content here. Text is escaped; do not put HTML in these fields.
// A paragraph may be a string or text segments with an optional bold flag.
// Keep unknown URLs empty. Submission and application URLs are in config/site.php.
return [
    'cfp' => [
        'intro' => 'Workshop dates, the host city, and the scope of this edition will be announced here.',
        'invitation' => 'We invite submissions on networking research, including, but not limited to:',
        'submission_title' => 'Submission Instructions',
        'submission' => [
            [['text' => 'Submission format: ', 'bold' => true], ['text' => 'Page limits, formatting, and file requirements will be announced here.']],
            [['text' => 'Review process: ', 'bold' => true], ['text' => 'Anonymity requirements and review instructions will be announced here.']],
            [['text' => 'Originality and publication: ', 'bold' => true], ['text' => 'Submission eligibility and publication arrangements will be announced here.']],
        ],
        'template_label' => 'Paper formatting template',
        'submission_label' => 'Paper submission portal',
        'ai_title' => 'Generative AI Use',
        'ai' => 'The policy on the use of generative AI in submissions will be announced here.',
        'publication' => [
            'title' => 'Publication and Open Access Information',
            'intro' => 'Publication arrangements, applicable charges, and author guidance will be announced here.',
            'guidance_label' => 'Author guidance',
            'guidance_url' => '',
            'resources_intro' => 'Further publication information will be available through the following resources:',
            'resources' => [
                ['label' => 'Publication model', 'link_label' => 'Details to be announced', 'url' => ''],
                ['label' => 'Open access information', 'link_label' => 'Details to be announced', 'url' => ''],
            ],
            'contact_intro' => 'Publication questions may be directed to',
            'contact_label' => '[Publication contact]',
            'contact_url' => '',
        ],
        'camera_ready_title' => 'Camera-Ready Instructions',
        'camera_ready' => [
            [['text' => 'Title and authorship changes: ', 'bold' => true], ['text' => 'The approval process will be announced here.']],
            [['text' => 'Final paper format: ', 'bold' => true], ['text' => 'Formatting requirements will be announced here.']],
            [['text' => 'Indexing information: ', 'bold' => true], ['text' => 'Required classification information will be announced here.']],
            [['text' => 'Rights and publication information: ', 'bold' => true], ['text' => 'Instructions will be supplied after acceptance.']],
            'Camera-ready questions and the publication chairs’ contact details will be announced here.',
        ],
    ],
    'cfposter' => [
        'intro' => 'The workshop dates and host city will be announced here.',
        'overview' => 'The poster session invites discussion of preliminary work and ongoing research in networking and systems. This edition’s scope will be announced here.',
        'motivation_title' => 'Why should you submit a Poster?',
        'motivation' => 'Poster sessions provide an opportunity to discuss developing ideas with the research community. Participation details will be announced here.',
        'publication_notice' => 'Poster publication arrangements will be announced here.',
        'format_title' => 'What to submit',
        'format' => [['text' => 'Submission format: ', 'bold' => true], ['text' => 'Length, formatting, eligibility, and review requirements will be announced here.']],
        'submission_title' => 'Where to submit',
        'submission_label' => 'Poster submission portal',
        'submission_note' => 'Submission instructions and review details will be announced here.',
        'presentation_title' => 'Poster Presentation Information',
        'presentation_before' => 'Poster display requirements: ',
        'presentation_emphasis' => 'to be announced',
        'presentation_after' => '. Size, orientation, and on-site presentation instructions will be announced here.',
        'presentation_notice' => 'Author registration and attendance requirements will be announced here.',
        // Poster dates use date in the left column and description in the right.
        'dates' => [
            ['date' => 'To be announced', 'label' => 'Submission Deadline'],
        ],
    ],
    'grant' => [
        'intro' => [
            'Travel grant availability, the support offered, and application requirements will be announced here.',
            'The available travel grant programs and their participation goals will be described here:',
        ],
        'programs' => [
            [
                'title' => '[Travel Grant Program 1]',
                'eligibility_intro' => 'Eligibility requirements will be announced here.',
                'eligibility' => [
                    [['text' => '[Applicant category]: ', 'bold' => true], ['text' => 'Eligibility criteria will be announced here.']],
                    [['text' => '[Applicant category]: ', 'bold' => true], ['text' => 'Eligibility criteria will be announced here.']],
                ],
                'application_intro' => 'Application instructions and required materials will be announced here.',
                'application' => [
                    'Applicant information requirements will be announced here.',
                    'Participation information requirements will be announced here.',
                    'Supporting statement requirements will be announced here.',
                    'Recommendation requirements will be announced here.',
                    'Other declarations or supporting materials will be announced here.',
                ],
                'application_url' => '',
            ],
            [
                'title' => '[Travel Grant Program 2]',
                'eligibility_intro' => 'Additional eligibility requirements for this program will be announced here.',
                'eligibility' => ['Program-specific eligibility criteria will be announced here.'],
                'application_intro' => 'Application instructions and required materials will be announced here.',
                'application' => [],
                'application_url' => '',
            ],
        ],
        'program_note' => [['text' => 'Application limits: ', 'bold' => true], ['text' => 'Rules for applying to the available grant programs will be announced here.']],
        'dates' => [
            ['label' => 'Deadline for application:', 'date' => 'To be announced'],
        ],
        'application_label' => 'Travel grant application',
        'selection' => [
            'The review process and selection criteria will be announced here.',
            'Funding priorities will be announced here.',
            'Notification and acceptance instructions will be announced here.',
        ],
        'notes' => [
            'Registration instructions for grant applicants and recipients will be announced here.',
            'Contact information for travel grant questions will be announced here.',
        ],
    ],
    'awards-nomination' => [
        'intro' => [
            [['text' => 'Award categories: ', 'bold' => true], ['text' => 'The awards offered by this edition will be announced here.']],
            'Nomination eligibility, required information, and submission instructions will be announced here.',
        ],
        'awards' => [
            ['title' => '[Award category 1]', 'purpose' => 'The purpose and significance of this award will be announced here.', 'eligibility' => 'Eligibility and assessment criteria will be announced here.', 'selection' => 'The selection process will be announced here.'],
            ['title' => '[Award category 2]', 'purpose' => 'The purpose and significance of this award will be announced here.', 'eligibility' => 'Eligibility and assessment criteria will be announced here.', 'selection' => 'The selection process will be announced here.'],
            ['title' => '[Award category 3]', 'purpose' => 'The purpose and significance of this award will be announced here.', 'eligibility' => 'Eligibility and assessment criteria will be announced here.', 'selection' => 'The selection process will be announced here.'],
        ],
        'process' => [
            'The nomination opening date and submission requirements will be announced here.',
            'The nomination deadline and late-submission policy will be announced here.',
            'The review committee and conflict-of-interest process will be announced here.',
            'Winner notification and award presentation arrangements will be announced here.',
        ],
        'nomination_label' => 'Award nomination form',
        'deadline' => 'To be announced',
        'committee_title' => 'The APNet Awards Selection Committee',
        'chair' => '[Committee chair and affiliation]',
        'members' => ['[Committee member and affiliation]'],
    ],
];
