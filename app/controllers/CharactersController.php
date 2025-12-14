<?php

class CharactersController extends Controller
{
    private array $characters = [
        "v_male" => [
            "name" => "V (Male)",
            "img"  => "/img/vmale.png",
            "desc" => "V is the customizable male protagonist of Cyberpunk 2077, a determined mercenary trying to rise within Night City’s brutal streets. Known for his calm, low-toned voice and sharp attitude, he balances combat skill, cyberware upgrades, and street instincts. His life changes after the Relic implant binds his consciousness to Johnny Silverhand, pushing him into a struggle for identity, survival, and control. V’s morality and personality shift based on player choices, making him a flexible and layered character.",
            "facts" => [
                "Voiced by Gavin Drea.",
                "Male V's dialogue often has a drier, more sarcastic tone.",
                "Some interactions and romance options differ from the female version."
            ]
        ],

        "v_female" => [
            "name" => "V (Female)",
            "img"  => "/img/vfemale.png",
            "desc" => "V is a skilled mercenary navigating the ruthless streets of Night City. As the female version, she combines sharp instincts, adaptability, and a bold presence. After obtaining a dangerous biochip containing Johnny Silverhand’s engram, V is forced into a fight not only against the city’s power players but also for her own identity.
            Capable in gunplay, hacking, and close combat, Female V can shift from empathetic to ruthless depending on the player’s choices. Her story often highlights loyalty, survival, and the emotional weight of her connections—especially with characters like Judy Alvarez and Panam Palmer. Stylish, cyber-enhanced, and fiercely determined, V stands as one of Night City’s most versatile mercs.",
            "facts" => [
                "“V” isn’t an acronym—her full name is intentionally left undefined.",
                "Voiced by Cherami Leigh, known for major game and anime roles.",
                "Female V has unique mocap animations, giving her distinct movement and personality.",
            ]
        ],

        "char6" => [
            "name" => "Judy Alvarez",
            "img"  => "/img/img2.png",
            "desc" => "Judy Alvarez is one of Night City’s most talented braindance editors and a key member of the Mox. Brilliant, creative, and fiercely principled, she uses her technical mastery not for fame but to protect vulnerable people—especially workers exploited in the braindance industry.
            Judy is sharp-minded, emotionally intuitive, and unafraid to fight for what she believes in. Beneath her rebellious appearance lies a compassionate core, making her one of the most grounded and sincere allies V can have. Her relationship with V can develop into a deep, heartfelt romance—only available for Female V.",
            "facts" => [
                "Judy is considered one of the best braindance specialists in Night City, with skills rivaling corporate-level technicians.",
                "Judy’s voice actress is Carla Tassara, praised for emotional and nuanced performances.",
                "Her background in Laguna Bend, a town flooded due to megacorporate expansion, shaped her distrust of big corporations."
            ]
        ],

        "char7" => [
            "name" => "Panam Palmer",
            "img"  => "/img/img3.png",
            "desc" => "Panam Palmer is a bold, resourceful nomad from the Aldecaldos clan. Known for her sharp instincts, exceptional combat skills, and unmatched driving and sniping abilities, Panam embodies the spirit of independence that defines the Badlands.
            Headstrong and deeply loyal, she often clashes with authority but fiercely protects those she considers family. Her partnership with V can grow into a strong bond built on trust, shared fights, and mutual respect—developing into a romantic relationship for Male V. Panam represents freedom, loyalty, and the promise of life beyond Night City’s chaos.",
            "facts" => [
                "Her voice actress, Emily Woo Zeller, is praised for making Panam feel grounded, emotional, and authentic.",
                "Panam’s iconic Quadra Type-66 “Javelina” is one of the best off-road vehicles in the game.",
                "Panam is a former Aldecaldos scout and one of the most skilled drivers and sharpshooters in the Badlands.",
            ]
        ],

        "char8" => [
            "name" => "Alt Cunningham",
            "img"  => "/img/img5.png",
            "desc" => "Alt Cunningham is one of the most brilliant netrunners in history and the creator of the legendary Soulkiller program. Once a rising star in Night City’s tech scene, she became the target of Arasaka, who forcibly digitized her consciousness.
            Now existing as a post-human entity within the Old Net, Alt is powerful, enigmatic, and far beyond human limitations. Her connection to Johnny Silverhand is emotional yet complicated, shaped by loss, memory, and the evolution of her digital self.",
            "facts" => [
                "Alt was originally a gifted netrunner working for ITS, long before becoming a digital consciousness.",
                "Soulkiller—her creation—can copy and destroy minds, and changed the future of the Net forever.",
                "Alt’s influence extends into multiple endings, especially involving V’s fate.",
            ]
        ],

        "char9" => [
            "name" => "Viktor Vektor",
            "img"  => "/img/img6.png",
            "desc" => "Viktor Vektor is a trusted ripperdoc in Watson and one of the few people in Night City who genuinely cares about his clients. Known for his calm demeanor, steady hands, and old-school ethics, Viktor offers high-quality cyberware without the predatory practices seen elsewhere in the city.
            He becomes a mentor and father-figure to V, providing guidance, medical support, and grounded wisdom amid the chaos of Night City.",
            "facts" => [
                "Viktor is an old-school ripperdoc, preferring reliable tech over flashy experimental implants.",
                "He used to be an underground boxer, giving him his strong, calm presence.",
                "Unlike many ripperdocs, Viktor prioritizes safety and trust over profit.",
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