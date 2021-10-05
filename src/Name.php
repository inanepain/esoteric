<?php

/**
 * Name Numbers
 * 
 * PHP version 8
 */

declare(strict_types=1);

namespace Inane\Esoteric;

use Inane\Util\NumberUtil;

use const PHP_EOL;

use function implode;
use function preg_replace;
use function str_replace;
use function str_split;
use function strtolower;
use function strtr;

/**
 * Name
 * 
 * @version 1.0.0
 */
class Name {
    protected static array $nameNumbers = [
        1 => [
            'Number' => 1,
            'Title' => "Leader",
            'General' => "One is the leader. The number one indicates the ability to stand alone, and is a strong vibration. Ruled by the Sun.",
            'KeywordsPositive' => "independent, creative, original, ambitious, determined, self-assured.",
            'KeywordsNegative' => "arrogant, stubborn, impatient, self-centered.",
            'AsLovers' => "Number ones take the lead in love. Love and/or the chase is of utmost importance to these lovers. There can be self-centeredness, however. These lovers are willing to experiment, and they can be quite exciting--they can also require a lot of excitement because they can bore easily.",
        ], 2 => [
            'Number' => 2,
            'Title' => "Mediator",
            'General' => "This is the mediator and peace-lover. The number two indicates the desire for harmony. It is a gentle, considerate, and sensitive vibration. Ruled by the Moon.",
            'KeywordsPositive' => "diplomatic, warm, peaceful, sensitive.",
            'KeywordsNegative' => "too dependent, manipulative, passive-aggressive.",
            'AsLovers' => "Number Twos will bend over backwards to keep a relationship running smoothly. They offer emotional security to their lovers. The number two is associated with the Moon and, since the Moon rules Cancer in astrology, is similar to the Cancer vibration.",
        ], 3 => [
            'Number' => 3,
            'Title' => "Sociable",
            'General' => "Number Three is a sociable, friendly, and outgoing vibration. Kind, positive, and optimistic, Three's enjoy life and have a good sense of humor. Ruled by Jupiter.",
            'KeywordsPositive' => "jovial, friendly, positive, adventurous, self-expressive.",
            'KeywordsNegative' => "extravagant, scattered, superficial.",
            'AsLovers' => "Number Threes are fun, energetic, and willing to experiment. These lovers need space and contact with others in order to feel content. If they feel confined, they will be unhappy and restless. Allowed the freedom to socialize and scatter their energies, they are exciting and happy lovers.",
        ], 4 => [
            'Number' => 4,
            'Title' => "Worker",
            'General' => "This is the worker. Practical, with a love of detail, Fours are trustworthy, hard-working, and helpful. Ruled by Uranus.",
            'KeywordsPositive' => "trustworthy, helpful, steady, logical, self-disciplined, problem-solving.",
            'KeywordsNegative' => "contrary, stubborn, narrow.",
            'AsLovers' => "Although steady and generally trustworthy, Fours can be quite emotional and frustrated if they feel caged in. They tend to need some level of confrontation in their love lives. A relationship that stagnates will bring out their contrary nature. They love to solve problems, and if allowed to 'take on' and tackle predicaments, they are very loyal lovers.",
        ], 5 => [
            'Number' => 5,
            'Title' => "Freedom lover",
            'General' => "This is the freedom lover. The number five is an intellectual vibration. These are 'idea' people with a love of variety and the ability to adapt to most situations. Ruled by Mercury.",
            'KeywordsPositive' => "adaptable, freedom-loving, romantic, resourceful, witty, fun-loving, curious, flexible, accommodating.",
            'KeywordsNegative' => "non-committal, irresponsible, inconsistent.",
            'AsLovers' => "These lovers are generally attractive to the opposite sex, as they are adaptable, curious, and friendly. Their wit and love of fun is unmistakable. In order to be happy in love, they need some level of change and variety. They also require mental stimulation. They are quick to adapt to ups and downs, but when under-stimulated, they can be inconsistent and resisting of making commitments.",
        ], 6 => [
            'Number' => 6,
            'Title' => "Peace lover",
            'General' => "This is the peace lover. The number six is a loving, stable, and harmonious vibration. Ruled by Venus.",
            'KeywordsPositive' => "compassionate, stable, family-loving, trustworthy, domesticated.",
            'KeywordsNegative' => "superficial, jealous, possessive, unwilling to change.",
            'AsLovers' => "Number Sixes have a deep dislike of discord and will generally work hard at keeping the peace. They are very attached to their homes and their families. At their best, they are devoted and stable partners who do whatever they can to maintain balance and harmony. At their worst, they take their peace-loving natures too far, and become lethargic, diplomatic to the point of superficiality, and jealous.",
        ], 7 => [
            'Number' => 7,
            'Title' => "Thinker",
            'General' => "This is the deep thinker. The number seven is a spiritual vibration. These people are not very attached to material things, are introspective, and generally quiet. Ruled by Neptune.",
            'KeywordsPositive' => "unusual, introspective, intuitive, psychic, wise, reserved.",
            'KeywordsNegative' => "melancholic, odd, leaves too much to chance, hard to reach.",
            'AsLovers' => "These lovers are a little spaced out, and sometimes hard to reach and to understand. However, their disinterest in material things and focus on spirituality makes for interesting, if a little kooky, bed partners and mates. They are intuitive, some are psychic, and although they can be loners at different times in their lives, they are often devoted partners. They can reach levels of intimacy and romance beyond many people's imaginations. However, their goals in love may be too lofty and thus they can be prone to disappointment when relationships inevitably fall short of ideal.",
        ], 8 => [
            'Number' => 8,
            'Title' => "Manager",
            'General' => "This is the manager. Number Eight is a strong, successful, and material vibration. Ruled by Saturn.",
            'KeywordsPositive' => "ambitious, business-minded, practical, leading, authoritative, successful, courageous, accomplished, organized.",
            'KeywordsNegative' => "tense, narrow, materialistic, forceful.",
            'AsLovers' => "These lovers take a commitment with responsibility and bravery. When they treat relationships like business deals, however, they can easily alienate partners and fall short of creating a tolerant and romantic atmosphere. Eights are generally practical and secure, and offer their mates stability and security.",
        ], 9 => [
            'Number' => 9,
            'Title' => "Teacher",
            'General' => "This is the teacher. Number Nine is a tolerant, somewhat impractical, and sympathetic vibration. Ruled by Mars.",
            'KeywordsPositive' => "jack of all trades, humanitarian, sympathetic, helpful, emotional, tolerant, active, determined.",
            'KeywordsNegative' => "financially careless, moody, bullying, overly emotional, sullen, restless.",
            'AsLovers' => "These lovers are involved and helpful. Because they are sympathetic, they can easily be doormats. They show their love by helping their partners, and assuming their lovers' problems. If triggered, their emotions can be volcanic, and a seemingly meek personality can resort to bullying tactics when unhappy.",
        ]
    ];
    protected static array $meanings = [
        'personality' => [
            1 => 'pioneering, leading, independent, attaining, individualistic',
            2 => 'cooperation, adaptability, considering, partnering, mediating',
            3 => 'expression, verbalization, socialization, arts, joy of living',
            4 => 'values foundation, service, struggle against limits, steady growth',
            5 => 'expansiveness, visionary, adventure, constructive use of freedom',
            6 => 'responsibility, protection, nurturing, balance, sympathy',
            7 => 'analysis, understanding, awareness, studious, meditating',
            8 => 'practical endeavors, status oriented, power-seeking, high-material goals',
            9 => 'humanitarian, giving, selflessness, obligations, creative expression',
            11 => 'higher spiritual plane, intuitive, illumination, idealist, a dreamer',
            22 => 'master builder, large endeavors, powerful force, leadership',
        ],
        'destiny' => [
            1 => 'Standing Out, Leading by Example',
            2 => 'Fulfillment through Partnership',
            3 => 'Need to Create for Others to Enjoy',
            4 => 'Make Life Safe for Yourself and Others',
            5 => 'Go Out and See the Wide World',
            6 => 'Find a Way to Serve Where There is a Need',
            7 => 'Achieve a Spiritual Path to Guide Other Spiritually',
            8 => 'Lead Others to Success',
            9 => 'Learn Deeply and Teach',
            11 => 'Find Personal Enlightenment',
            22 => 'Teach Others How to be Partners',
            33 => 'Do Creativity to Heal Others',
            44 => 'Be a Community Leader',
            55 => 'Be a Community Disruptor',
        ],
        'soul' => [
            1 => "An individual that has a Soul Urge Number 1 draws energy from the self. Therefore, they operate with inner strength and inner direction that is intense. These individuals are often self-confident, self-aware, and self-motivated. Accepting that you need to initiate to get what you want and to get things done will help you be more successful in your relationships and endeavors.",
            2 => "An individual that has a Soul Urge Number 2 draws energy from relationships. Therefore, they operate with strength in partnership and shared energy. These individuals are often easy to connect with, empathic, and excellent communicators. Accepting that you need to team up with someone to get what you want and to get things done will help you be more successful in your relationships and endeavors.",
            3 => "An individual that has a Soul Urge Number 3 draws energy from creative effort. Therefore, they operate with a need to create to generate energy. These individuals are often imaginative, visionary, and clever. Accepting that you need to be creative to get what you want and to get things done will help you be more successful in your relationships and endeavors.",
            4 => "An individual that has a Soul Urge Number 4 draws energy from hard work and persistent effort. Therefore, they operate with steady energy that keeps going and going. These individuals are often dependable, no-nonsense, and practical. Accepting that you need to be methodical to get what you want and to get things done will help you be more successful in your relationships and endeavors.",
            5 => "An individual that has a Soul Urge Number 5 draws energy from exploring and conflict. Therefore, they operate with a need to challenge themselves and others to generate energy. These individuals are often playful, competitive, and fearless. Accepting that you need to be unafraid of what is new to get what you want and to get things done will help you be more successful in your relationships and endeavors.",
            6 => "An individual that has a Soul Urge Number 6 draws energy from service. Therefore, they operate with a need to help others to generate energy. These individuals are often compassionate, nurturing, and concerned. Accepting that you need to be serving others to get what you want and to get things done will help you be more successful in your relationships and endeavors.",
            7 => "An individual that has a Soul Urge Number 7 draws energy from spiritual belief. Therefore, they operate with a need to find a purpose to generate energy. These individuals are often philosophical, psychological, and spiritual. Accepting that you need to believe in something to get what you want and to get things done will help you be more successful in your relationships and endeavors.",
            8 => "An individual that has a Soul Urge Number 8 draws energy from goals. Therefore, they operate with a need to achieve to generate energy. These individuals are often striving, forceful, and powerful. Accepting that you need to lead to get what you want and to get things done will help you be more successful in your relationships and endeavors.",
            9 => "An individual that has a Soul Urge Number 9 draws energy from a love of life. Therefore, they operate with a need to unlock wisdom to generate energy. These individuals are often patient, observant, and introverted. Accepting that you need to open and generous to get what you want and to get things done will help you be more successful in your relationships and endeavors.",
            11 => "An individual that has a Soul Urge Number 11 draws energy from a special talent or inner gift. Therefore, they operate with a need to excel to generate energy. These individuals are often quirky, rebellious, and unconventional. Accepting that you need to “walk to the beat of your own drum” to get what you want and to get things done will help you be more successful in your relationships and endeavors.",
            22 => "An individual that has a Soul Urge Number 22 draws energy from the community. Therefore, they operate with a need to participate to generate energy. These individuals are often political, engaging, and influencing. Accepting that you need to engage the public to get what you want and to get things done will help you be more successful in your relationships and endeavors.",
        ],
        'personality2' => [
            1 => "An individual that has a Personality Number 1 presents as individualistic to others. Therefore, others see them as either self-confident or selfish. People who like mavericks will expect a Personality 1 to fulfill that role in life. Do not be surprised if people treat you as someone who can “do it” on your own, even if you want to get help.",
            2 => "An individual that has a Personality Number 2 presents as relatable to others. Therefore, others see them as either supportive or co-dependent. People who like partnership and teamwork will expect a Personality 2 to fulfill that role in life. Do not be surprised if people treat you as someone who they want to “work with”, even if you want to be left alone.",
            3 => "An individual that has a Personality Number 3 presents as creative to others. Therefore, others see them as either artistic or “out there”. People who like imagination will expect a Personality 3 to fulfill the artist role in life. Do not be surprised if people treat you as someone who can create on your own, even if you can only draw stick figures.",
            4 => "An individual that has a Personality Number 4 presents as stable and reliable to others. Therefore, others see them as either dependable or stubborn. People who like hard workers will expect a Personality 4 to fulfill that role in life. Do not be surprised if people treat you as someone who “has it together”, even if you cannot balance your bank account.",
            5 => "An individual that has a Personality Number 5 presents as adventurous to others. Therefore, other see them as either self-confident or selfish. People who like explorers will expect a Personality 5 to fulfill that role in life. Do not be surprised if people treat you as someone who embraces, even if you want to stay “right where you are”.",
            6 => "An individual that has a Personality Number 6 presents as helpful to others. Therefore, others see them as either nurturing or passive aggressive. People who value caretakers will expect a Personality 6 to fulfill that role in life. Do not be surprised if people treat you as someone who is always there to support them, even if you want to have your own life.",
            7 => "An individual that has a Personality Number 7 presents as mysterious to others. Therefore, others see them as either enlightened or delusional. People who like spiritual leaders will expect a Personality 7 to fulfill that role in life. Do not be surprised if people treat you as someone who can understand their purpose in life, even if you want to focus on your purpose in life.",
            8 => "An individual that has a Personality Number 8 presents as “in charge” to others. Therefore, others see them as either the leader or the tyrant. People who want a leader will expect a Personality 8 to fulfill that role in life. Do not be surprised if people treat you as someone who should be responsible for all the decisions, even if you want to have someone else take the responsibility.",
            9 => "An individual that has a Personality Number 9 presents as wise to others. Therefore, others see them as either altruistic or a “push over”. People who value wise counselors will expect a Personality 9 to fulfill that role in life. Do not be surprised if people treat you as someone who wants to listen to their worries and problems, even if you want someone to listen to you.",
            11 => "An individual that has a Personality Number 11 presents as stellar to others. Therefore, others see them as either spectacular or narcissistic. People who appreciate the highly talented person will expect a Personality 11 to fulfill that role in life. Do not be surprised if people treat them as someone special and amazing, even if they feel average.",
            22 => "An individual that has a Personality Number 22 presents as capable to others. Therefore, others see them as either an organizer or controlling. People who like managers will expect a Personality 22 to fulfill that role in life. Do not be surprised if people treat you as someone who can “pull it all together”, even if you feel unprepared.",
        ],
    ];

    protected static array $lookup = [
        'ajs',
        'bkt',
        'clm',
        'dmv',
        'enw',
        'fox',
        'gpy',
        'hqz',
        'ir'
    ];

    protected static array $normalise = [
        'ъ' => '-', 'Ь' => '-', 'Ъ' => '-', 'ь' => '-',
        'Ă' => 'A', 'Ą' => 'A', 'À' => 'A', 'Ã' => 'A', 'Á' => 'A', 'Æ' => 'A', 'Â' => 'A', 'Å' => 'A', 'Ä' => 'Ae',
        'Þ' => 'B',
        'Ć' => 'C', 'ץ' => 'C', 'Ç' => 'C',
        'È' => 'E', 'Ę' => 'E', 'É' => 'E', 'Ë' => 'E', 'Ê' => 'E',
        'Ğ' => 'G',
        'İ' => 'I', 'Ï' => 'I', 'Î' => 'I', 'Í' => 'I', 'Ì' => 'I',
        'Ł' => 'L',
        'Ñ' => 'N', 'Ń' => 'N',
        'Ø' => 'O', 'Ó' => 'O', 'Ò' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'Oe',
        'Ş' => 'S', 'Ś' => 'S', 'Ș' => 'S', 'Š' => 'S',
        'Ț' => 'T',
        'Ù' => 'U', 'Û' => 'U', 'Ú' => 'U', 'Ü' => 'Ue',
        'Ý' => 'Y',
        'Ź' => 'Z', 'Ž' => 'Z', 'Ż' => 'Z',
        'â' => 'a', 'ǎ' => 'a', 'ą' => 'a', 'á' => 'a', 'ă' => 'a', 'ã' => 'a', 'Ǎ' => 'a', 'а' => 'a', 'А' => 'a', 'å' => 'a', 'à' => 'a', 'א' => 'a', 'Ǻ' => 'a', 'Ā' => 'a', 'ǻ' => 'a', 'ā' => 'a', 'ä' => 'ae', 'æ' => 'ae', 'Ǽ' => 'ae', 'ǽ' => 'ae',
        'б' => 'b', 'ב' => 'b', 'Б' => 'b', 'þ' => 'b',
        'ĉ' => 'c', 'Ĉ' => 'c', 'Ċ' => 'c', 'ć' => 'c', 'ç' => 'c', 'ц' => 'c', 'צ' => 'c', 'ċ' => 'c', 'Ц' => 'c', 'Č' => 'c', 'č' => 'c', 'Ч' => 'ch', 'ч' => 'ch',
        'ד' => 'd', 'ď' => 'd', 'Đ' => 'd', 'Ď' => 'd', 'đ' => 'd', 'д' => 'd', 'Д' => 'D', 'ð' => 'd',
        'є' => 'e', 'ע' => 'e', 'е' => 'e', 'Е' => 'e', 'Ə' => 'e', 'ę' => 'e', 'ĕ' => 'e', 'ē' => 'e', 'Ē' => 'e', 'Ė' => 'e', 'ė' => 'e', 'ě' => 'e', 'Ě' => 'e', 'Є' => 'e', 'Ĕ' => 'e', 'ê' => 'e', 'ə' => 'e', 'è' => 'e', 'ë' => 'e', 'é' => 'e',
        'ф' => 'f', 'ƒ' => 'f', 'Ф' => 'f',
        'ġ' => 'g', 'Ģ' => 'g', 'Ġ' => 'g', 'Ĝ' => 'g', 'Г' => 'g', 'г' => 'g', 'ĝ' => 'g', 'ğ' => 'g', 'ג' => 'g', 'Ґ' => 'g', 'ґ' => 'g', 'ģ' => 'g',
        'ח' => 'h', 'ħ' => 'h', 'Х' => 'h', 'Ħ' => 'h', 'Ĥ' => 'h', 'ĥ' => 'h', 'х' => 'h', 'ה' => 'h',
        'î' => 'i', 'ï' => 'i', 'í' => 'i', 'ì' => 'i', 'į' => 'i', 'ĭ' => 'i', 'ı' => 'i', 'Ĭ' => 'i', 'И' => 'i', 'ĩ' => 'i', 'ǐ' => 'i', 'Ĩ' => 'i', 'Ǐ' => 'i', 'и' => 'i', 'Į' => 'i', 'י' => 'i', 'Ї' => 'i', 'Ī' => 'i', 'І' => 'i', 'ї' => 'i', 'і' => 'i', 'ī' => 'i', 'ĳ' => 'ij', 'Ĳ' => 'ij',
        'й' => 'j', 'Й' => 'j', 'Ĵ' => 'j', 'ĵ' => 'j', 'я' => 'ja', 'Я' => 'ja', 'Э' => 'je', 'э' => 'je', 'ё' => 'jo', 'Ё' => 'jo', 'ю' => 'ju', 'Ю' => 'ju',
        'ĸ' => 'k', 'כ' => 'k', 'Ķ' => 'k', 'К' => 'k', 'к' => 'k', 'ķ' => 'k', 'ך' => 'k',
        'Ŀ' => 'l', 'ŀ' => 'l', 'Л' => 'l', 'ł' => 'l', 'ļ' => 'l', 'ĺ' => 'l', 'Ĺ' => 'l', 'Ļ' => 'l', 'л' => 'l', 'Ľ' => 'l', 'ľ' => 'l', 'ל' => 'l',
        'מ' => 'm', 'М' => 'm', 'ם' => 'm', 'м' => 'm',
        'ñ' => 'n', 'н' => 'n', 'Ņ' => 'n', 'ן' => 'n', 'ŋ' => 'n', 'נ' => 'n', 'Н' => 'n', 'ń' => 'n', 'Ŋ' => 'n', 'ņ' => 'n', 'ŉ' => 'n', 'Ň' => 'n', 'ň' => 'n',
        'о' => 'o', 'О' => 'o', 'ő' => 'o', 'õ' => 'o', 'ô' => 'o', 'Ő' => 'o', 'ŏ' => 'o', 'Ŏ' => 'o', 'Ō' => 'o', 'ō' => 'o', 'ø' => 'o', 'ǿ' => 'o', 'ǒ' => 'o', 'ò' => 'o', 'Ǿ' => 'o', 'Ǒ' => 'o', 'ơ' => 'o', 'ó' => 'o', 'Ơ' => 'o', 'œ' => 'oe', 'Œ' => 'oe', 'ö' => 'oe',
        'פ' => 'p', 'ף' => 'p', 'п' => 'p', 'П' => 'p',
        'ק' => 'q',
        'ŕ' => 'r', 'ř' => 'r', 'Ř' => 'r', 'ŗ' => 'r', 'Ŗ' => 'r', 'ר' => 'r', 'Ŕ' => 'r', 'Р' => 'r', 'р' => 'r',
        'ș' => 's', 'с' => 's', 'Ŝ' => 's', 'š' => 's', 'ś' => 's', 'ס' => 's', 'ş' => 's', 'С' => 's', 'ŝ' => 's', 'Щ' => 'sch', 'щ' => 'sch', 'ш' => 'sh', 'Ш' => 'sh', 'ß' => 'ss',
        'т' => 't', 'ט' => 't', 'ŧ' => 't', 'ת' => 't', 'ť' => 't', 'ţ' => 't', 'Ţ' => 't', 'Т' => 't', 'ț' => 't', 'Ŧ' => 't', 'Ť' => 't', '™' => 'tm',
        'ū' => 'u', 'у' => 'u', 'Ũ' => 'u', 'ũ' => 'u', 'Ư' => 'u', 'ư' => 'u', 'Ū' => 'u', 'Ǔ' => 'u', 'ų' => 'u', 'Ų' => 'u', 'ŭ' => 'u', 'Ŭ' => 'u', 'Ů' => 'u', 'ů' => 'u', 'ű' => 'u', 'Ű' => 'u', 'Ǖ' => 'u', 'ǔ' => 'u', 'Ǜ' => 'u', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'У' => 'u', 'ǚ' => 'u', 'ǜ' => 'u', 'Ǚ' => 'u', 'Ǘ' => 'u', 'ǖ' => 'u', 'ǘ' => 'u', 'ü' => 'ue',
        'в' => 'v', 'ו' => 'v', 'В' => 'v',
        'ש' => 'w', 'ŵ' => 'w', 'Ŵ' => 'w',
        'ы' => 'y', 'ŷ' => 'y', 'ý' => 'y', 'ÿ' => 'y', 'Ÿ' => 'y', 'Ŷ' => 'y',
        'Ы' => 'y', 'ž' => 'z', 'З' => 'z', 'з' => 'z', 'ź' => 'z', 'ז' => 'z', 'ż' => 'z', 'ſ' => 'z', 'Ж' => 'zh', 'ж' => 'zh'
    ];

    protected array $data = [];

    public function __construct(
        protected string $name
    ) {
        $this->parseName($name);
    }

    public function __toString() {
        $result = [$this->name];
        foreach ($this->data as $label => $value) $result[] = "$label: $value\n\t" . static::$meanings[$label][$value];
        return implode(PHP_EOL, $result) . PHP_EOL;
    }

    protected function stringToNumber(string $s): int {
        foreach (static::$lookup as $idx => $val)  $s = str_replace(str_split($val), ($idx + 1) . "", $s);

        return (int) $s;
    }

    protected function parseName(string $name) {
        $name = strtr($name, static::$normalise);

        $name = preg_replace("/[^a-z]/", '', strtolower($name));
        $consonants = str_replace(str_split('aeiou'), '', $name);
        $vowels = str_replace(str_split($consonants), '', $name);

        $this->data['destiny'] = NumberUtil::reduceNumber(number: $this->stringToNumber($name), exceptions: [11, 22, 33]);
        $this->data['soul'] = NumberUtil::reduceNumber($this->stringToNumber($vowels));
        $this->data['personality'] = NumberUtil::reduceNumber($this->stringToNumber($consonants));
    }
}

// $peep = new Name('Philip Raab');
// echo $peep;
// $peep = new Name('Philip Michael Raab');
// echo $peep;
