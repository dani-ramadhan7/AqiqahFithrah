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
    <link rel="icon" type="image/jpeg" href="image/icon_aqiqah.jpeg">
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

        .brand-icon {
            width: 52px;
            height: 52px;
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid rgba(0, 0, 0, 0.15);
        }

        .whatsapp-float {
            position: fixed;
            right: 20px;
            bottom: 20px;
            width: 58px;
            height: 58px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            z-index: 1080;
        }
    </style>
</head>

<body>
    <header class="hero border-bottom border-warning-subtle">
        <div class="container py-5">
            <div class="row g-4 align-items-center">
                <div class="col-lg-8">
                    <div class="d-flex align-items-center gap-3 mb-2">
                        <img src="image/icon_aqiqah.jpeg" alt="Icon Aqiqah Fithrah" class="brand-icon">
                        <h1 class="display-5 fw-bold mb-0"><?= escapeHtml($business['name']); ?></h1>
                    </div>
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
            <p class="text-center mb-1">&copy; <?= escapeHtml((string) $copyrightYear); ?> <?= escapeHtml($business['name']); ?>. All rights reserved.</p>
            <p class="text-center mb-0"><a class="link-dark" href="admin/login.php">Admin Dashboard</a></p>
        </div>
    </footer>

    <a
        href="<?= escapeHtml($business['whatsapp_link']); ?>"
        class="btn btn-success whatsapp-float"
        target="_blank"
        rel="noopener"
        aria-label="Chat WhatsApp Aqiqah Fithrah"
        title="Chat WhatsApp">
        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true">
            <path d="M13.601 2.326A7.854 7.854 0 0 0 8.013 0C3.66 0 .123 3.537.123 7.89a7.86 7.86 0 0 0 1.061 3.95L0 16l4.273-1.114a7.88 7.88 0 0 0 3.74.954h.003c4.351 0 7.888-3.537 7.888-7.89a7.84 7.84 0 0 0-2.303-5.624ZM8.016 14.53h-.003a6.6 6.6 0 0 1-3.36-.92l-.24-.142-2.535.661.676-2.471-.156-.254A6.58 6.58 0 0 1 1.43 7.89c0-3.635 2.957-6.592 6.59-6.592a6.56 6.56 0 0 1 4.686 1.947 6.55 6.55 0 0 1 1.933 4.66c-.002 3.635-2.958 6.59-6.593 6.59Zm3.614-4.942c-.198-.099-1.173-.579-1.355-.646-.181-.066-.313-.099-.445.099-.132.198-.512.645-.627.778-.115.132-.23.149-.428.05-.198-.1-.835-.308-1.591-.981-.588-.524-.985-1.171-1.1-1.369-.115-.198-.012-.305.086-.403.089-.088.198-.23.297-.347.099-.115.132-.198.198-.33.066-.132.033-.248-.017-.347-.049-.099-.445-1.074-.61-1.469-.16-.383-.323-.33-.445-.337l-.379-.007a.73.73 0 0 0-.528.248c-.181.198-.693.677-.693 1.65s.71 1.914.809 2.046c.099.132 1.397 2.134 3.386 2.991.473.205.842.327 1.13.418.474.151.905.13 1.246.079.38-.057 1.173-.479 1.339-.941.165-.463.165-.86.115-.941-.049-.082-.181-.132-.38-.231Z"/>
        </svg>
    </a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
