<?php
// 寺のデータを配列で定義



$temples = [
    [
        "name" => "浅草寺",
        "location" => "〒111-0032 東京都台東区浅草2-3-1",
        "url" => "https://www.google.com/maps/place/%E3%80%92111-0032+%E6%9D%B1%E4%BA%AC%E9%83%BD%E5%8F%B0%E6%9D%B1%E5%8C%BA%E6%B5%85%E8%8D%89%EF%BC%92%E4%B8%81%E7%9B%AE%EF%BC%93%E2%88%92%EF%BC%91/@35.7111643,139.7963844,17z/data=!3m1!4b1!4m6!3m5!1s0x60188ec6db07b503:0xd2e6844913996c2a!8m2!3d35.7111643!4d139.7963844!16s%2Fg%2F11bw3y7d_l?entry=ttu"
    ],
    [
        "name" => "柴又帝釈天",
        "location" => "〒125-0052 東京都葛飾区柴又7-10-3",
        "url" => "https://www.google.com/maps/place/%E3%80%92125-0052+%E6%9D%B1%E4%BA%AC%E9%83%BD%E8%91%9B%E9%A3%BE%E5%8C%BA%E6%9F%B4%E5%8F%88%EF%BC%97%E4%B8%81%E7%9B%AE%EF%BC%91%EF%BC%90%E2%88%92%EF%BC%93/@35.7583335,139.8752126,17z/data=!3m1!4b1!4m6!3m5!1s0x601885a32a9c87c3:0xdd0918e8d8808f1a!8m2!3d35.7583335!4d139.8777875!16s%2Fg%2F11cpk4fbtd?entry=ttu"
    ],
    [
        "name" => "増上寺",
        "location" => "〒105-0011 東京都港区芝公園4-7-35",
        "url" => "https://www.google.com/maps/place/%E3%80%92105-0011+%E6%9D%B1%E4%BA%AC%E9%83%BD%E6%B8%AF%E5%8C%BA%E8%8A%9D%E5%85%AC%E5%9C%92%EF%BC%94%E4%B8%81%E7%9B%AE%EF%BC%97%E2%88%92%EF%BC%93%EF%BC%95/@35.6578099,139.7469472,17z/data=!3m1!4b1!4m6!3m5!1s0x60188bbee41e5ccf:0xc189a054506fbe3b!8m2!3d35.6578099!4d139.7495221!16s%2Fg%2F12hmdk9ff?entry=ttu"
    ],
    [
        "name" => "寛永寺",
        "location" => "〒110-0002 東京都台東区上野桜木1-14-11",
        "url" => "https://www.google.com/maps/place/%E3%80%92110-0002+%E6%9D%B1%E4%BA%AC%E9%83%BD%E5%8F%B0%E6%9D%B1%E5%8C%BA%E4%B8%8A%E9%87%8E%E6%A1%9C%E6%9C%A8%EF%BC%91%E4%B8%81%E7%9B%AE%EF%BC%91%EF%BC%94%E2%88%92%EF%BC%91%EF%BC%91/@35.7210616,139.7735892,18.55z/data=!4m6!3m5!1s0x60188e82209d6ec7:0x55b547de7069a2c8!8m2!3d35.7217384!4d139.7745959!16s%2Fg%2F11c10fb4yb?entry=ttu"
    ],
    [
        "name" => "築地本願寺",
        "location" => "〒104-8435 東京都中央区築地3-15-1",
        "url" => "https://www.google.com/maps/place/%E7%AF%89%E5%9C%B0%E6%9C%AC%E9%A1%98%E5%AF%BA/@35.6818203,139.7611747,14z/data=!4m10!1m2!2m1!1z44CSMTA0LTg0MzUg5p2x5Lqs6YO95Lit5aSu5Yy656-J5ZywMy0xNS0x!3m6!1s0x60188bdf42f23f8f:0x5079895cf0ec2793!8m2!3d35.6664862!4d139.7722836!15sCirjgJIxMDQtODQzNSDmnbHkuqzpg73kuK3lpK7ljLrnr4nlnLAzLTE1LTFaMiIw44CSIDEwNCA4NDM1IOadseS6rCDpg70g5Lit5aSuIOWMuiDnr4nlnLAgMyAxNSAxkgEPYnVkZGhpc3RfdGVtcGxlmgEkQ2hkRFNVaE5NRzluUzBWSlEwRm5TVU53TFhGUGFYbEJSUkFC4AEA!16zL20vMDd3cDN4?entry=ttu"
    ],
    [
        "name" => "東本願寺",
        "location" => "〒111-0035 東京都台東区西浅草1-5-5",
        "url" => "https://www.google.com/maps/place/%E3%80%92111-0035+%E6%9D%B1%E4%BA%AC%E9%83%BD%E5%8F%B0%E6%9D%B1%E5%8C%BA%E8%A5%BF%E6%B5%85%E8%8D%89%EF%BC%91%E4%B8%81%E7%9B%AE%EF%BC%95%E2%88%92%EF%BC%95/@35.7109982,139.7872173,17z/data=!3m1!4b1!4m6!3m5!1s0x60188ebeedfde15b:0xb3192069117ac879!8m2!3d35.7109982!4d139.7897922!16s%2Fg%2F12hk4mcty?entry=ttu"
    ],
    [
        "name" => "泉岳寺",
        "location" => "〒108-0074 東京都港区高輪2-11-1",
        "url" => "https://www.google.com/maps/place/%E6%B3%89%E5%B2%B3%E5%AF%BA+%E6%9C%AC%E5%A0%82/@35.6364972,139.7375122,15z/data=!3m1!5s0x60188bab517883d3:0x3547b1e7e0dc53f9!4m10!1m2!2m1!1z5rOJ5bKz5a-6!3m6!1s0x60188bab4efbfe29:0xc39935ddaaf2f123!8m2!3d35.6377125!4d139.7362831!15sCgnms4nlsrPlr7paDSIL5rOJIOWysyDlr7qSAQ9idWRkaGlzdF90ZW1wbGWaASRDaGREU1VoTk1HOW5TMFZKUTBGblNVTnhkRFJITldoUlJSQULgAQA!16s%2Fg%2F11c46153x_?entry=ttu"
    ],
    [
        "name" => "法明寺",
        "location" => "〒171-0032 東京都豊島区雑司が谷3-15-20",
        "url" => "https://www.google.com/maps/place/%E3%80%92171-0022+%E6%9D%B1%E4%BA%AC%E9%83%BD%E8%B1%8A%E5%B3%B6%E5%8C%BA%E5%8D%97%E6%B1%A0%E8%A2%8B%EF%BC%93%E4%B8%81%E7%9B%AE%EF%BC%91%EF%BC%98%E2%88%92%EF%BC%91%EF%BC%98+%E6%B3%95%E6%98%8E%E5%AF%BA/@35.724302,139.7115001,17z/data=!3m1!4b1!4m6!3m5!1s0x60188d6a2d1b6c2d:0x7938068fef269c3e!8m2!3d35.724302!4d139.714075!16s%2Fg%2F120txfzc?entry=ttu"
    ],
    [
        "name" => "豊川稲荷",
        "location" => "〒107-0051 東京都港区元赤坂1-4-7",
        "url" => "https://www.google.com/maps/place/%E8%B1%8A%E5%B7%9D%E7%A8%B2%E8%8D%B7%E6%9D%B1%E4%BA%AC%E5%88%A5%E9%99%A2/@35.6763514,139.7306374,17z/data=!4m15!1m8!3m7!1s0x60188c7e152ea7f9:0x8663c5c6f9ca7080!2z44CSMTA3LTAwNTEg5p2x5Lqs6YO95riv5Yy65YWD6LWk5Z2C77yR5LiB55uu77yU4oiS77yX!3b1!8m2!3d35.6763514!4d139.7332123!16s%2Fg%2F11c4_nghrh!3m5!1s0x60188c7e121ee92b:0x5761574668b96c9!8m2!3d35.6764056!4d139.73285!16s%2Fg%2F120m5y07?entry=ttu"
    ],
    [
        "name" => "天王寺",
        "location" => "〒110-0001 東京都台東区谷中7-14-8",
        "url" => "https://www.google.com/maps/place/%E3%80%92110-0001+%E6%9D%B1%E4%BA%AC%E9%83%BD%E5%8F%B0%E6%9D%B1%E5%8C%BA%E8%B0%B7%E4%B8%AD%EF%BC%97%E4%B8%81%E7%9B%AE%EF%BC%91%EF%BC%94%E2%88%92%EF%BC%98/@35.7268007,139.768423,16.75z/data=!4m6!3m5!1s0x60188dd50dbef9a7:0xf86f443a9c92aa71!8m2!3d35.7267047!4d139.7713181!16s%2Fg%2F1yw0_v8z1?entry=ttu"
    ],
    // 他の寺のデータも同様に追加
];

// APIのレスポンスを設定
$response = [
    "status" => "success",
    "message" => "東京の寺院の情報を取得しました",
    "data" => $temples
];

// レスポンスをJSON形式で出力
header("Content-Type: application/json");
echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
?>


