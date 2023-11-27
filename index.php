<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <style>
    .btn-danger,
    .btn-danger:hover,
    .btn-danger:active,
    .btn-danger:visited,
    .btn-danger:focus {
      background-color: #C79705 !important;
      border-color: #C79705 !important;
    }
  </style>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  <title>Aqiqah Fithrah</title>
</head>

<body>

	<div class="p-5 bg-warning text-center">
    <h1 class="display-4 fw-normal"><b>Aqiqah Fithrah</b></h1>
    <p class="lead"><b>"PASTIKAN YANG SYAR'I BERSAMA KAMI"</b></p>
    <hr class="my-4">
    <p>"SYAR'I, LEZAT, & TERPERCAYA"</p>
  </div>

  <br>

  <div class="container mt-3">
    <h3>Fithrah Produk</h3>
    <p>Produk masakan Aqiqah Fithrah dikelola secara profesional dan tentunya dengan memenuhi kriteria syar'i.</p>
  </div>

  <br>

  <!-- Carousel -->
  <div id="demo" class="carousel slide mx-auto" style="width: 75%" data-bs-ride="carousel">

    <!-- Indicators/dots -->
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
      <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
      <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
    </div>

    <!-- The slideshow/carousel -->
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="image/-5176998582274861155_121.jpg" alt="" class="d-block" style="width:100%">
        <div class="carousel-caption">
          <!-- <h3>Sate</h3>
                <p>Sate kambing dengan bumbu meresap</p> -->
        </div>
      </div>
      <div class="carousel-item">
        <img src="image/-5176998582274861156_121.jpg" alt="" class="d-block" style="width:100%">
        <div class="carousel-caption">
          <!-- <h3>Gule</h3>
                <p>Gule kambing yang gurih</p> -->
        </div>
      </div>
      <div class="carousel-item">
        <img src="image/-5176998582274861157_121.jpg" alt="" class="d-block" style="width:100%">
        <div class="carousel-caption">
          <!-- <h3>Krengsengan</h3>
                <p>Krengsengan yang lezat</p> -->
        </div>
        <!-- </div>
          <div class="carousel-item">
            <img src="image/-5176998582274861137_121.jpg" alt="" class="d-block" style="width:100%">
            <div class="carousel-caption">
              <h3>Gule</h3>
                <p>Gule kambing yang gurih</p>
            </div>
          </div>
          <div class="carousel-item">
            <img src="image/-5176998582274861140_121.jpg" alt="" class="d-block" style="width:100%">
            <div class="carousel-caption">
              <h3>Krengsengan</h3>
                <p>Krengsengan yang lezat</p>
            </div> -->
      </div>
    </div>

    <!-- Left and right controls/icons -->
    <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
      <span class="carousel-control-next-icon"></span>
    </button>
  </div>

  <br><br>

  <div class="container mt-3">
    <h2>Keunggulan Aqiqah Fithrah</h2>
    <table class="table table-hover">
      <tbody>
        <tr>
          <td>Kambing yang sudah cukup umur satu tahun dan kriteria syar'i lainnya</td>
        </tr>
        <tr>
          <td>Resep masakan dari koki profesional</td>
        </tr>
        <tr>
          <td>Gratis ongkos kirim untuk wilayah Surabaya dan Sidoarjo</td>
        </tr>
        <tr>
          <td>Dapat diPesan melalui WhatsAppsApp atau datang langsung ke kantor </td>
        </tr>
        <tr>
          <td>Bisa memilih menu sate dan gulai atau krengsengan dan gulai</td>
        </tr>
        <tr>
          <td>Jika ada sisa makanan dari paket nasi box, akan kami kirimkan secara terpisah.</td>
        </tr>
      </tbody>
    </table>
  </div>

  <br>

  <div class="container">
    <h2>Daftar Paket</h2>
    <hr class="my-4">
    <div class="row" id="packagesRow">
    </div>
  </div>

  <script>
    // Fetch packages data from PHP
    fetch('packages.php')
      .then(response => response.json())
      .then(packages => {
        packages.forEach(package => {
          document.getElementById('packagesRow').innerHTML += `
          <div class="col-md-6 mb-4">
            <div class="card bg-gradient-warning border-1">
              <div class="card-header bg-warning text-center text-white py-4">
                  <h2 class="display-4 mb-0">${package.box} Box</h2>
                  <p class="lead">(${package.tusuk} Tusuk)</p>
              </div>
              <div class="card-body">
                  <h5 class="card-title"><b>${package.title}</b></h5>
                  <p class="card-text">Matang: ${package.priceMatang}<br>Nasi Box: ${package.priceNasiBox}<br>Deskripsi: ${package.tusuk} tusuk + Gulai (${package.box} box)</p>
              </div>
              <div class="card-footer bg-light">
                  <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal${package.id}">
                  Detail
                  </button>
              </div>
            </div>
          </div>

          <div class="modal fade" id="modal${package.id}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-xl">
						<div class="modal-content">
							<div class="modal-header bg-warning">
								<h1 class="modal-title fs-5" id="exampleModalLabel">${package.title}</h1>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<div class="container mt-5">
									<div class="row">
										<div class="col-md-6">
											<img src="${package.imageUrl}" alt="Product Image" class="img-fluid">
										</div>
										<div class="col-md-6">
											<!-- ... Content ... -->
											<h2>${package.title}</h2>
											<p class="text-muted">Memperkenalkan <b>${package.title}</b>! Paket ini menawarkan pengalaman kuliner yang lezat dengan dua opsi yang dapat Anda pilih:<br><br>
												1. Opsi <b>Matang</b>, dengan harga <b>Rp${package.priceMatang}</b>, menyediakan makanan siap saji untuk kenyamanan Anda.<br>
												2. Opsi <b>Nasi Box</b>, dengan harga <b>Rp${package.priceNasiBox}</b>, menawarkan makanan yang dikemas sempurna, cocok untuk acara atau pertemuan.<br><br>
												${package.title} mencakup <b>${package.tusuk} tusuk sate</b> dan <b>Gulai</b>, yang didistribusikan dalam <b>${package.box} kotak</b>. Kombinasi sate yang lezat dan gulai yang beraroma ini tentunya dapat memenuhi selera hidangan Anda.<br><br>
												Untuk melakukan pemesanan, cukup klik tombol "Pesan". Selamat menikmati hidangan yang lezat!
											</p>
											<p><strong>Matang:</strong> Rp${package.priceMatang}</p>
											<p><strong>Nasi Box:</strong> Rp${package.priceNasiBox}</p>
											<a type="button" class="btn btn-danger" href="${package.whatsappLink}">
												<!-- ... WhatsApp SVG ... -->
												Pesan
											</a>
										</div>
										<!-- ... -->
									</div>
								</div>
							</div>
						</div>
					</div>
          </div>
        `;
        });
      })
      .catch(error => console.error('Error fetching packages:', error));
  </script>

	<br>

	<div class="container">
		<!-- Advantages Section -->
		<h2>Paket Nasi Kotak</h2>
		<hr class="my-4">
		<ul>
			<li>Gratis acar, bawang goreng, sambal, kerupuk, jeruk nipis dan buah (pisang, apel atau jeruk). <b>Catatan:</b>
				tidak dapat memesan buah</li>
		</ul>
	</div>

	<br>

	<div class="container">
		<!-- Advantages Section -->
		<h2>Paket Matang</h2>
		<hr class="my-4">
		<ul>
			<li>Acar dan sambal gratis</li>
		</ul>
	</div>

	<br><br>

	<!-- Second Carousel (Duplicate) -->
	<div id="demo2" class="carousel slide mx-auto" style="width: 50%" data-bs-ride="carousel">

		<!-- Indicators/dots -->
		<div class="carousel-indicators">
			<button type="button" data-bs-target="#demo2" data-bs-slide-to="0" class="active"></button>
			<button type="button" data-bs-target="#demo2" data-bs-slide-to="1"></button>
			<button type="button" data-bs-target="#demo2" data-bs-slide-to="2"></button>
		</div>

		<!-- The slideshow/carousel -->
		<div class="carousel-inner">
			<div class="carousel-item active">
				<img src="image/-5176998582274861137_121.jpg" alt="" class="d-block" style="width:100%">
				<div class="carousel-caption">
					<!-- <h3>Sate</h3>
									<p>Sate kambing dengan bumbu meresap</p> -->
				</div>
			</div>
			<div class="carousel-item">
				<img src="image/-5176998582274861140_121.jpg" alt="" class="d-block" style="width:100%">
				<div class="carousel-caption">
					<!-- <h3>Gule</h3>
									<p>Gule kambing yang gurih</p> -->
				</div>
			</div>
			<div class="carousel-item">
				<img src="image/-5176998582274861148_121.jpg" alt="" class="d-block" style="width:100%">
				<div class="carousel-caption">
					<!-- <h3>Krengsengan</h3>
									<p>Krengsengan yang lezat</p> -->
				</div>
			</div>
		</div>

		<!-- Left and right controls/icons -->
		<button class="carousel-control-prev" type="button" data-bs-target="#demo2" data-bs-slide="prev">
			<span class="carousel-control-prev-icon"></span>
		</button>
		<button class="carousel-control-next" type="button" data-bs-target="#demo2" data-bs-slide="next">
			<span class="carousel-control-next-icon"></span>
		</button>
	</div>

	<br><br>

	<footer class="bg-warning p-5">
		<div style="width: 100%" class="container"><iframe width="100%" height="400" frameborder="0" scrolling="no"
				marginheight="0" marginwidth="0"
				src="https://maps.google.com/maps?width=100%25&amp;height=400&amp;hl=en&amp;q=Ruko%20Galaxy%20Bumi%20Permai%20Blok%20G6%20No.%2016,%20Jl.%20Arif%20Rahman%20Hakim%20No.20-36,%20Klampis%20Ngasem,%20Kec.%20Sukolilo,%20Surabaya,%20Jawa%20Timur%2060119+(Yayasan%20Nida'ul%20Fithrah)&amp;t=&amp;z=20&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"><a
					href="https://www.maps.ie/population/">Calculate population in area</a></iframe></div>
		<br>
		<div class="container">
			<div class="row justify-content-end">
				<div class="col-md-4 text-end">
					<h5 class="display-6"><b>Kantor Kami</b></h5>
					<hr class=" my-4">
					<p><b>Yayasan Nidaul Fithrah</b><br>
						Ruko galaxy bumi permai blok G6-16<br>
						JI. AR Hakim 20-36 Sukolilo Surabaya<br>
						Telp <a href="tel:+6285733827200" class="text-dark">+6285733827200</a></p>
				</div>
				<hr class="my-4">
				<div>
					<p align="center">&copy; 2023. All rights reserved.</p>
				</div>
			</div>
		</div>
	</footer>

	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
		integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
		crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
		integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
		crossorigin="anonymous"></script>

</body>

</html>