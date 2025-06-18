<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Movie;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        $movies = [
            [
                'title' => 'インターステラー',
                'description' => '近未来、地球規模の食糧難と環境変化によって人類の滅亡のカウントダウンが始まっていた。そんな状況で、あるミッションの遂行者に選ばれた元エンジニアの男性。それは人類の新たな居住地を探すため、未知の惑星へと旅立つというものだった。',
                'release_date' => '2014-11-22',
                'genre' => 'SF・ドラマ',
                'director' => 'クリストファー・ノーラン',
                'poster_url' => 'https://via.placeholder.com/300x450/4A90E2/FFFFFF?text=Interstellar',
                'rating' => 8.6,
                'duration' => 169,
            ],
            [
                'title' => '君の名は。',
                'description' => '千年ぶりとなる彗星の来訪を一か月後に控えた日本。山深い田舎町に暮らす女子高校生・三葉は憂鬱な毎日を過ごしていた。町長である父の選挙運動に、家系の神社の古き風習。小さく狭い町で、周囲の目が余計に気になる年頃だけに、都会への憧れを強くするばかり。',
                'release_date' => '2016-08-26',
                'genre' => 'アニメ・ロマンス',
                'director' => '新海誠',
                'poster_url' => 'https://via.placeholder.com/300x450/FF6B6B/FFFFFF?text=Your+Name',
                'rating' => 8.2,
                'duration' => 107,
            ],
            [
                'title' => 'アベンジャーズ/エンドゲーム',
                'description' => 'サノスによって宇宙の半分の生命が消し去られ、最強チーム"アベンジャーズ"も崩壊してしまった。はたして失われた35億の人々と仲間を取り戻す方法はあるのか？大逆転へのわずかな希望を信じて再び集結したアイアンマン、キャプテン・アメリカ、ソーたちに残されたのは、最強の絆だけ──。',
                'release_date' => '2019-04-26',
                'genre' => 'アクション・SF',
                'director' => 'アンソニー・ルッソ、ジョー・ルッソ',
                'poster_url' => 'https://via.placeholder.com/300x450/50C878/FFFFFF?text=Endgame',
                'rating' => 8.4,
                'duration' => 181,
            ],
            [
                'title' => 'パラサイト 半地下の家族',
                'description' => '半地下住宅に住む貧しいキム一家。長男ギウは名門大学生の友人に頼まれ、IT企業のCEOパク氏の豪邸へ家庭教師の面接を受けに向かう。そして妹ギジョンも偽の経歴でパク家の美術講師として潜り込む。',
                'release_date' => '2020-01-10',
                'genre' => 'スリラー・ドラマ',
                'director' => 'ポン・ジュノ',
                'poster_url' => 'https://via.placeholder.com/300x450/FFD93D/000000?text=Parasite',
                'rating' => 8.5,
                'duration' => 132,
            ],
            [
                'title' => 'トップガン マーヴェリック',
                'description' => '伝説のパイロット、マーヴェリックが帰ってきた。トップガンの教官として、新世代のパイロットたちを指導することになったマーヴェリック。しかし、彼らが挑むのは、これまでにない危険なミッションだった。',
                'release_date' => '2022-05-27',
                'genre' => 'アクション・ドラマ',
                'director' => 'ジョセフ・コシンスキー',
                'poster_url' => 'https://via.placeholder.com/300x450/FF4757/FFFFFF?text=Top+Gun',
                'rating' => 8.3,
                'duration' => 131,
            ],
            [
                'title' => 'ジョーカー',
                'description' => '「どんな時でも笑顔で人々を楽しませなさい」という母の言葉を胸にコメディアンを夢見る、孤独だが心優しいアーサー。都市の片隅でピエロメイクの大道芸人をしながら母を支える彼は、笑いのある人生は素晴らしいと信じ、ドン底から抜け出そうともがいていた。',
                'release_date' => '2019-10-04',
                'genre' => 'ドラマ・スリラー',
                'director' => 'トッド・フィリップス',
                'poster_url' => 'https://via.placeholder.com/300x450/9B59B6/FFFFFF?text=Joker',
                'rating' => 8.4,
                'duration' => 122,
            ],
        ];

        foreach ($movies as $movie) {
            Movie::create($movie);
        }
    }
}