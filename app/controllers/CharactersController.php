<?php

class CharactersController extends Controller
{
    private array $characters = [
        "v_male" => [
            "name" => "V (Male)",
            "img"  => "/img/vmale.png",
            "desc" => "V is the customizable male protagonist of Cyberpunk 2077, a determined mercenary trying to rise within Night City's brutal streets. Known for his calm, low-toned voice and sharp attitude, he balances combat skill, cyberware upgrades, and street instincts. His life changes after the Relic implant binds his consciousness to Johnny Silverhand, pushing him into a struggle for identity, survival, and control. V's morality and personality shift based on player choices, making him a flexible and layered character.",
            "facts" => [
                "Voiced by Gavin Drea.",
                "Male V's dialogue often has a drier, more sarcastic tone.",
                "Some interactions and romance options differ from the female version."
            ]
        ],

        "v_female" => [
            "name" => "V (Female)",
            "img"  => "/img/vfemale.png",
            "desc" => "V is the customizable female protagonist of Cyberpunk 2077, a determined mercenary trying to rise within Night City's brutal streets. Known for her emotional delivery and sharp attitude, she balances combat skill, cyberware upgrades, and street instincts.",
            "facts" => [
                "Voiced by Cherami Leigh.",
                "Female V's dialogue has a more emotional tone.",
                "Different romance options available compared to male V."
            ]
        ],

        "char6" => [
            "name" => "Johnny Silverhand",
            "img"  => "/img/img2.png",
            "desc" => "Johnny Silverhand is a legendary rockerboy and the digital ghost haunting V's mind.",
            "facts" => [
                "Voiced and motion-captured by Keanu Reeves.",
                "Former lead singer of Samurai.",
                "Died in 2023 during the assault on Arasaka Tower."
            ]
        ],

        "char7" => [
            "name" => "Judy Alvarez",
            "img"  => "/img/img3.png",
            "desc" => "Judy Alvarez is a talented braindance technician working at Lizzie's Bar.",
            "facts" => [
                "Expert in braindance editing.",
                "Romance option only for female V.",
                "Member of The Mox."
            ]
        ],

        "char8" => [
            "name" => "Panam Palmer",
            "img"  => "/img/img5.png",
            "desc" => "Panam Palmer is a skilled nomad from the Aldecaldos clan.",
            "facts" => [
                "Expert driver.",
                "Romance option only for male V.",
                "Aldecaldos nomad."
            ]
        ],

        "char9" => [
            "name" => "Jackie Welles",
            "img"  => "/img/img6.png",
            "desc" => "Jackie Welles is V's best friend and partner in crime.",
            "facts" => [
                "Loyal friend of V.",
                "Former Valentinos member.",
                "Dreams of becoming a legend."
            ]
        ]
    ];

    public function index() 
    {
        $characters = [
            ['id'=>1,'name'=>'v_female','image'=>'/img/vfemale.png'],
            ['id'=>2,'name'=>'v_male','image'=>'/img/vmale.png'],
            ['id'=>3,'name'=>'char6','image'=>'/img/img2.png'],
            ['id'=>4,'name'=>'char7','image'=>'/img/img3.png'],
            ['id'=>5,'name'=>'char8','image'=>'/img/img5.png'],
            ['id'=>6,'name'=>'char9','image'=>'/img/img6.png'],
        ];

        // pecah jadi 2 character per slide
        $slides = array_chunk($characters, 2);
        $this->view('characters/index', compact('slides'));    
    }

    public function detail(string $charId = '')
    {
        if (!isset($this->characters[$charId])) {
            $this->view('characters/not_found', [
                'charId' => $charId
            ]);
            return;
        }

        $this->view('characters/detail', [
            'data' => $this->characters[$charId]
        ]);
    }
}