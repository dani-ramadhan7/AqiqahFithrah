<?php

declare(strict_types=1);

$posterData = [
    'business' => [
        'name' => 'Aqiqah Fithrah',
        'tagline' => 'Insya Allah syar\'i bersama Kami',
        'foundation' => 'Yayasan Nidaul Fithrah',
        'address_lines' => [
            'Ruko galaxy bumi permai blok G6-16',
            'Jl. AR Hakim 20-36 Sukolilo Surabaya',
        ],
        'bank_account' => 'BSI 703 6976 009 (Yayasan Nidaul Fithrah)',
        'phone_display' => '0857.0483.6929',
        'phone_link' => '+6285704836929',
        'whatsapp_link' => 'https://wa.me/6285704836929',
        'effective_date' => 'Mulai April 2025',
    ],
    'nasi_box_packages' => [
        ['box' => 50, 'price' => 2650000],
        ['box' => 60, 'price' => 2900000],
        ['box' => 80, 'price' => 3300000],
        ['box' => 100, 'price' => 3900000],
        ['box' => 120, 'price' => 4400000],
        ['box' => 150, 'price' => 5200000],
    ],
    'nasi_box_contents' => [
        'Nasi',
        '3 tusuk sate / Krengsengan',
        '1 cup gulai',
        'Buah / Telur asin',
        'Sendok, tisu, tusuk gigi',
        'Acar',
        'Jeruk nipis',
        'Sambal',
        'Kerupuk udang',
        'Label shohibul aqiqah',
    ],
    'matangan_packages' => [
        ['name' => 'Hemat', 'sate' => 200, 'gulai' => 60, 'price' => 1800000],
        ['name' => 'Fithrah 1', 'sate' => 250, 'gulai' => 70, 'price' => 1900000],
        ['name' => 'Fithrah 2', 'sate' => 300, 'gulai' => 80, 'price' => 2050000],
        ['name' => 'Fithrah 3', 'sate' => 350, 'gulai' => 90, 'price' => 2200000],
        ['name' => 'Fithrah 4', 'sate' => 400, 'gulai' => 100, 'price' => 2400000],
        ['name' => 'Fithrah 5', 'sate' => 450, 'gulai' => 120, 'price' => 2600000],
        ['name' => 'Fithrah 6', 'sate' => 500, 'gulai' => 130, 'price' => 2800000],
        ['name' => 'Fithrah 7', 'sate' => 550, 'gulai' => 150, 'price' => 2950000],
    ],
    'matangan_bonus' => [
        'Acar',
        'Jeruk nipis',
        'Sambal',
        'Lembar shohibul aqiqah',
        'Sertifikat aqiqah',
    ],
    'advantages' => [
        'Kambing yang sudah cukup umur satu tahun dan kriteria syar\'i lainnya',
        'Resep masakan dari koki profesional',
        'Gratis ongkos kirim untuk wilayah Surabaya dan Sidoarjo',
        'Dapat diPesan melalui WhatsAppsApp atau datang langsung ke kantor',
        'Bisa memilih menu sate dan gulai atau krengsengan dan gulai',
        'Jika ada sisa makanan dari paket nasi box, akan kami kirimkan secara terpisah.',
    ],
    'menu_options' => 'Gulai dan sate atau gulai dan krengsengan',
    'free_delivery' => ['Surabaya', 'Sidoarjo', 'Pasuruan'],
    'gallery_images' => [
        'image/-5176998582274861155_121.jpg',
        'image/-5176998582274861156_121.jpg',
        'image/-5176998582274861157_121.jpg',
        'image/-5176998582274861137_121.jpg',
        'image/-5176998582274861140_121.jpg',
        'image/-5176998582274861148_121.jpg',
    ],
];

function formatRupiah(int $amount): string
{
    return 'Rp. ' . number_format($amount, 0, ',', '.');
}

function escapeHtml(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function buildWhatsappPackageLink(string $packageName): string
{
    $baseUrl = 'https://api.whatsapp.com/send';
    $message = sprintf(
        'Assalamualaikum Aqiqah Fithrah, Saya mau tanya tentang %s bisa?',
        $packageName
    );

    return $baseUrl . '?phone=6285704836929&text=' . rawurlencode($message);
}
