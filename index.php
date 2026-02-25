<?php

declare(strict_types=1);

require __DIR__ . '/poster_data.php';

$business = $posterData['business'];
$nasiBoxPackages = $posterData['nasi_box_packages'];
$nasiBoxContents = $posterData['nasi_box_contents'];
$matanganPackages = $posterData['matangan_packages'];
$matanganBonus = $posterData['matangan_bonus'];
$advantages = $posterData['advantages'];
$galleryImages = $posterData['gallery_images'];
$copyrightYear = date('Y');
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= escapeHtml($business['name']); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --aq-warning-soft: #fff8db;
            --aq-border: #e5d7a6;
        }

        body {
            background-color: #f8f9fa;
        }

        .hero {
            background: linear-gradient(135deg, #ffe082 0%, #ffd54f 55%, #ffc107 100%);
        }

        .hero .lead {
            font-size: 1.2rem;
        }

        .gallery-image {
            aspect-ratio: 16 / 9;
            object-fit: cover;
        }

        .card-soft {
            background-color: var(--aq-warning-soft);
            border: 1px solid var(--aq-border);
        }

        .text-small {
            font-size: 0.95rem;
        }
    </style>
</head>

<body>
    <header class="hero border-bottom border-warning-subtle">
        <div class="container py-5">
            <div class="row g-4 align-items-center">
                <div class="col-lg-8">
                    <h1 class="display-5 fw-bold mb-2"><?= escapeHtml($business['name']); ?></h1>
                    <p class="lead mb-4"><?= escapeHtml($business['tagline']); ?></p>
                    <div class="d-grid gap-2 d-sm-flex">
                        <a class="btn btn-dark btn-lg px-4" href="<?= escapeHtml($business['whatsapp_link']); ?>" target="_blank" rel="noopener">
                            Pesan via WhatsApp
                        </a>
                        <a class="btn btn-outline-dark btn-lg px-4" href="tel:<?= escapeHtml($business['phone_link']); ?>">
                            <?= escapeHtml($business['phone_display']); ?>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-body p-4">
                            <h2 class="h5 fw-bold mb-3">Kontak & Pembayaran</h2>
                            <p class="mb-2 text-small"><strong>Kantor:</strong> <?= escapeHtml($business['foundation']); ?></p>
                            <?php foreach ($business['address_lines'] as $addressLine): ?>
                                <p class="mb-1 text-small"><?= escapeHtml($addressLine); ?></p>
                            <?php endforeach; ?>
                            <hr>
                            <p class="mb-2 text-small"><strong><?= escapeHtml($business['bank_account']); ?></strong></p>
                            <p class="mb-0 text-small"><strong>Telp/WA:</strong> <?= escapeHtml($business['phone_display']); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main>
        <section class="container py-5">
            <div class="row mb-3">
                <div class="col">
                    <h2 class="h3 fw-bold mb-1">Galeri Produk</h2>
                    <p class="text-muted mb-0">Insya Allah syar'i, rasa lezat, dan pengolahan amanah.</p>
                </div>
            </div>

            <div id="foodCarousel" class="carousel slide shadow-sm rounded overflow-hidden" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <?php foreach ($galleryImages as $index => $unusedImage): ?>
                        <button type="button" data-bs-target="#foodCarousel" data-bs-slide-to="<?= (int) $index; ?>" <?= $index === 0 ? 'class="active" aria-current="true"' : ''; ?> aria-label="Slide <?= (int) ($index + 1); ?>"></button>
                    <?php endforeach; ?>
                </div>
                <div class="carousel-inner">
                    <?php foreach ($galleryImages as $index => $image): ?>
                        <div class="carousel-item <?= $index === 0 ? 'active' : ''; ?>">
                            <img src="<?= escapeHtml($image); ?>" class="d-block w-100 gallery-image" alt="Menu aqiqah <?= (int) ($index + 1); ?>">
                        </div>
                    <?php endforeach; ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#foodCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#foodCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </section>

        <section class="container pb-5">
            <h2 class="h3 fw-bold mb-3">Keunggulan Aqiqah Fithrah</h2>
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <ul class="mb-0">
                        <?php foreach ($advantages as $advantage): ?>
                            <li class="mb-2"><?= escapeHtml($advantage); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </section>

        <section class="container pb-5">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
                <h2 class="h3 fw-bold mb-0">Paket Nasi Box</h2>
                <span class="badge text-bg-warning fs-6"><?= escapeHtml($business['effective_date']); ?></span>
            </div>
            <div class="row g-3">
                <?php foreach ($nasiBoxPackages as $package): ?>
                    <?php $packageName = 'Paket ' . (int) $package['box'] . ' Box'; ?>
                    <div class="col-sm-6 col-lg-4">
                        <div class="card h-100 shadow-sm border-0 card-soft">
                            <div class="card-body d-flex flex-column">
                                <h3 class="h5 fw-bold mb-2"><?= escapeHtml($packageName); ?></h3>
                                <p class="display-6 fw-bold mb-0"><?= escapeHtml(formatRupiah((int) $package['price'])); ?></p>
                                <a
                                    class="btn btn-warning mt-3"
                                    href="<?= escapeHtml(buildWhatsappPackageLink($packageName)); ?>"
                                    target="_blank"
                                    rel="noopener"
                                >
                                    Pesan
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="card mt-4 shadow-sm border-0">
                <div class="card-body">
                    <h3 class="h5 fw-bold">Isi Dalam Box</h3>
                    <div class="row g-0 mt-2">
                        <?php foreach ($nasiBoxContents as $content): ?>
                            <div class="col-md-6">
                                <div class="py-2 border-bottom pe-md-3 text-small">- <?= escapeHtml($content); ?></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>

        <section class="container pb-5">
            <h2 class="h3 fw-bold mb-3">Paket Matangan</h2>
            <div class="table-responsive shadow-sm rounded">
                <table class="table table-striped table-hover align-middle mb-0">
                    <thead class="table-warning">
                        <tr>
                            <th>Paket</th>
                            <th>Sate</th>
                            <th>Gulai</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($matanganPackages as $package): ?>
                            <?php $packageName = 'Paket ' . $package['name']; ?>
                            <tr>
                                <td><strong><?= escapeHtml($package['name']); ?></strong></td>
                                <td><?= (int) $package['sate']; ?> tusuk</td>
                                <td><?= (int) $package['gulai']; ?> porsi</td>
                                <td><strong><?= escapeHtml(formatRupiah((int) $package['price'])); ?></strong></td>
                                <td>
                                    <a
                                        class="btn btn-sm btn-warning"
                                        href="<?= escapeHtml(buildWhatsappPackageLink($packageName)); ?>"
                                        target="_blank"
                                        rel="noopener"
                                    >
                                        Pesan
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="row g-3 mt-2">
                <div class="col-lg-6">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <h3 class="h5 fw-bold">Bonus Paket Matangan</h3>
                            <ul class="mb-0">
                                <?php foreach ($matanganBonus as $bonus): ?>
                                    <li><?= escapeHtml($bonus); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <h3 class="h5 fw-bold">Info Tambahan</h3>
                            <p class="mb-2"><strong>Pilihan menu:</strong> <?= escapeHtml($posterData['menu_options']); ?></p>
                            <p class="mb-0"><strong>Free ongkos kirim:</strong> <?= escapeHtml(implode(', ', $posterData['free_delivery'])); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-warning-subtle border-top border-warning-subtle mt-4">
        <div class="container py-5">
            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="ratio ratio-16x9 shadow-sm">
                        <iframe
                            title="Lokasi Aqiqah Fithrah"
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            src="https://maps.google.com/maps?width=100%25&amp;height=400&amp;hl=id&amp;q=Ruko%20Galaxy%20Bumi%20Permai%20Blok%20G6%20No.%2016,%20Jl.%20Arif%20Rahman%20Hakim%20No.20-36,%20Sukolilo,%20Surabaya+(Yayasan%20Nidaul%20Fithrah)&amp;t=&amp;z=17&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
                    </div>
                </div>
                <div class="col-lg-4">
                    <h2 class="h5 fw-bold mb-3">Kantor Kami</h2>
                    <p class="mb-1"><strong><?= escapeHtml($business['foundation']); ?></strong></p>
                    <?php foreach ($business['address_lines'] as $addressLine): ?>
                        <p class="mb-1"><?= escapeHtml($addressLine); ?></p>
                    <?php endforeach; ?>
                    <p class="mb-1 mt-3"><strong><?= escapeHtml($business['bank_account']); ?></strong></p>
                    <p class="mb-0"><strong>Telp/WA:</strong> <a class="link-dark" href="tel:<?= escapeHtml($business['phone_link']); ?>"><?= escapeHtml($business['phone_display']); ?></a></p>
                </div>
            </div>
            <hr class="my-4">
            <p class="text-center mb-0">&copy; <?= escapeHtml((string) $copyrightYear); ?> <?= escapeHtml($business['name']); ?>. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
