<?php

/**
 * Birth Numbers
 * 
 * PHP version 8
 */

declare(strict_types=1);

namespace Inane\Esoteric;

use DateTime;
use Inane\Util\NumberUtil;

use function implode;
use function is_array;

/**
 * Birth
 * 
 * @version 1.0.0
 */
class Birth {
    private static array $birthNumbers = [
        1 => [
            'life path' => 1,
            'Title' => 'Originator',
            'Description' => "1s are originals - Coming up with new ideas and executing them is natural. Having things their own way is another trait that gets them as being stubborn and arrogant. 1s are extremely honest and do well to learn some diplomacy skills. They like to take the initiative and are often leaders or bosses, as they like to be the best. Being self-employed is definitely helpful for them.... Lesson to learn: Others' ideas might be just as good or better and to stay open minded.",
            'Famous' => ['Tom Hanks', 'Robert Redbird', 'Hulk Logan', 'Carol Burnet', 'Wynn Judd', 'Nancy Reagan', 'Raquel Welsh'],
        ],
        2 => [
            'life path' => 2,
            'Title' => 'Peacemaker',
            'Description' => "2s are the born diplomats. They are aware of others' needs and moods and often think of others before themselves. Naturally analytical and very intuitive they don't like to be alone. Friendship and companionship is very important and can lead them to be successful in life, but on the other hand they'd rather be alone than in an uncomfortable relationship. Being naturally shy they should learn to boost their self-esteem and express themselves freely and seize the moment and not put things off.",
            'Famous' => ['President Bill Clinton', 'Madonna', 'Whoopee Goldberg', 'Thomas Edison', 'Wolfgang Amadeus Mozart'],
        ],
        3 => [
            'life path' => 3,
            'Title' => 'Nonconformist',
            'Description' => "3s are idealists. They are very creative, social, charming, romantic, and easygoing. They start many things, but don't always see them through. They like others to be happy and go to great lengths to achieve it. They are very popular and idealistic. They should learn to see the world from a more realistic point of view.",
            'Famous' => ['Alan Alda', 'Ann Landers', 'Bill Cosby', 'Melanie Griffith', 'Salvador Dali', 'Jodi Foster'],
        ],
        4 => [
            'life path' => 4,
            'Title' => 'Conservative',
            'Description' => "4s are sensible and traditional. They like order and routine. They only act when they fully understand what they are expected to do. They like getting their hands dirty and working hard. They are attracted to the outdoors and feel an affinity with nature. They are prepared to wait and can be stubborn and persistent. They should learn to be more flexible and to be nice to themselves.",
            'Famous' => ['Neil Diamond', 'Margaret Thatcher', 'Arnold Schwarzenegger', 'Tina Turner', 'Paul Hogan', 'Oprah Winfrey'],
        ],
        5 => [
            'life path' => 5,
            'Title' => 'Nonconformist',
            'Description' => "5s are the explorers. Their natural curiosity, risk taking, and enthusiasm often land them in hot water. They need diversity, and don't like to be stuck in a rut. The whole world is their school and they see a learning possibility in every situation. The questions never stop. They are well advised to look before they take action and make sure they have all the facts before jumping to conclusions.",
            'Famous' => ['Abraham Lincoln', 'Charlotte Bronte', 'Jessica Walter', 'Vincent Van Gogh', 'Bette Midler', 'Helen Keller', 'Mark Hamil'],
        ],
        6 => [
            'life path' => 6,
            'Title' => 'Romantic',
            'Description' => "6s are idealistic and need to feel useful to be happy.  A strong family connection is important to them. Their emotions influence their decisions. They have a strong urge to take care of others and to help.  They are very loyal and make great teachers. They like art or music.  They make loyal friends who take the friendship seriously.  6s should learn to differentiate between what they can change and what they cannot.",
            'Famous' => ['Albert Einstein', 'Jane Seymour', 'John Denver', 'Meryl Streep', 'Christopher Columbus', 'Goldie Hawn'],
        ],
        7 => [
            'life path' => 7,
            'Title' => 'Intellectual',
            'Description' => "7s are the searchers. Always probing for hidden information, they find it difficult to accept things at face value. Emotions don't sway their decisions. Questioning everything in life, they don't like to be questioned themselves. They're never off to a fast start, and their motto is slow and steady wins the race. They come across as philosophers and being very knowledgeable, and sometimes as loners. They are technically inclined and make great researchers uncovering information. They like secrets. They live in their own world and should learn what is acceptable and what not in the world at large.",
            'Famous' => ['William Shakespeare', 'Lucille Ball', 'Michael Jackson', 'Joan Baez', 'Princess Diana'],
        ],
        8 => [
            'life path' => 8,
            'Title' => 'Big Shot',
            'Description' => "8s are the problem solvers. They are professional, blunt and to the point, have good judgment and are decisive. They have grand plans and like to live the good life. They take charge of people. They view people objectively. They let you know in no uncertain terms that they are the boss. They should learn to exude their decisions on their own needs rather than on what others want.",
            'Famous' => ['Edgar Cayce', 'Barbra Streisand', 'George Harrison', 'Jane Fonda', 'Pablo Picasso', 'Aretha Franklin', 'Nostrodamus'],
        ],
        9 => [
            'life path' => 9,
            'Title' => 'Performer',
            'Description' => "9s are natural entertainers. They are very caring and generous, giving away their last dollar to help. With their charm, they have no problem making friends and nobody is a stranger to them. They have so many different personalities that people around them have a hard time understanding them. They are like chameleons, ever changing and blending in. They have tremendous luck, but also can suffer from extremes in fortune and mood. To be successful, they need to build a loving foundation.",
            'Famous' => ['Albert Schweitzer', 'Shirley MacLaine', 'Harrison Ford', 'Jimmy Carter', 'Elvis Presley'],
        ],
    ];

    protected int $birthNumber;

    public function __construct(
        protected DateTime $birthday
    ) {
        $this->parseBirthday();
    }

    public function __toString() {
        $result = [$this->birthday->format('Y/m/d')];
        foreach (static::$birthNumbers[$this->birthNumber] as $label => $value) $result[] = "$label: " . (is_array($value) ? implode(', ', $value) : $value);
        return implode(PHP_EOL, $result) . PHP_EOL;
    }

    /**
     * Return Age in Years
     *
     * @param Datetime|String $now
     * @return Integer
     */
    public function getAge() {
        return $this->birthday->diff((new DateTime('NOW')))->format('%y');
    }

    protected function parseBirthday(): void {
        $this->birthNumber = NumberUtil::reduceNumber($this->birthday->format('Y') + $this->birthday->format('m') + $this->birthday->format('d'));
    }
}
