<?php
$furOrangeHex = "#c55816";

$carouselImages = json_encode(scandir(__DIR__ . "/Carousel-Images"));


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>Grim Grim's Website</title>

  <!-- Bootstrap 5 CSS -->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
    rel="stylesheet"
  />

  <style>
    body {
      background-color: <?= $furOrangeHex ?>;
      color: #333;
    }
    .profile-header img {
      width: 160px;
      height: 160px;
      object-fit: cover;
      border: 4px solid <?= $furOrangeHex ?>;
    }
    .gallery-img {
      cursor: pointer;
      transition: transform .2s;
    }
    .gallery-img:hover {
      transform: scale(1.05);
    }
  </style>
</head>
<body>

  <div class="container py-5">
    <!-- Profile Card -->
    <div class="card mx-auto shadow-sm" style="max-width: 800px;">
      <div class="card-body">
        <!-- Header -->
        <div class="d-flex flex-column align-items-center text-center profile-header mb-4">
          <img
            src="/Images/Based-Boy.png"
            alt="Grim Grim Portrait"
            class="rounded-circle mb-3"
          />
          <h1 id="cat-name" class="h3">Grim Grim</h1>
          <p class="text-muted">“Grimothy, Creature, Chicken... A cat of many names”</p>
        </div>

        <!-- Info Grid -->
        <div class="row g-3 mb-4">
          <div class="col-6 col-md-3">
            <div class="border rounded p-3 h-100 bg-light">
              <h6 class="text-secondary">Home Address</h6>
              <p id="cat-address" class="small mb-0">
                123 Meow Lane<br/>Catville, PA 12345
              </p>
            </div>
          </div>
          <div class="col-6 col-md-3">
            <div class="border rounded p-3 h-100 bg-light">
              <h6 class="text-secondary">Contact</h6>
              <p id="cat-contact" class="small mb-0">
                (555) 123-CAT1<br/>meow@example.com
              </p>
            </div>
          </div>
          <div class="col-6 col-md-3">
            <div class="border rounded p-3 h-100 bg-light">
              <h6 class="text-secondary">Favorite Toy</h6>
              <p id="cat-toy" class="small mb-0">Feather Wand</p>
            </div>
          </div>
          <div class="col-6 col-md-3">
            <div class="border rounded p-3 h-100 bg-light">
              <h6 class="text-secondary">Birthday</h6>
              <p id="cat-bday" class="small mb-0">2011</p>
            </div>
          </div>
        </div>

        <div class="container">
          <h2 class="mb-4">You want more pictures of our boy</h2>

          <div id="catCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner" id="carouselInner">
              <!-- JS will inject .carousel-item blocks here -->
            </div>

            <button
              class="carousel-control-prev"
              type="button"
              data-bs-target="#catCarousel"
              data-bs-slide="prev"
            >
              <span class="carousel-control-prev-icon"></span>
              <span class="visually-hidden">Prev</span>
            </button>
            <button
              class="carousel-control-next"
              type="button"
              data-bs-target="#catCarousel"
              data-bs-slide="next"
            >
              <span class="carousel-control-next-icon"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
        </div>

        <!-- Bootstrap JS Bundle (Includes Popper) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


  <!-- Lightbox Modal -->
  <div
    class="modal fade"
    id="lightboxModal"
    tabindex="-1"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content bg-transparent border-0">
        <div class="modal-body p-0">
          <img
            src=""
            id="lightbox-img"
            class="w-100 rounded"
            alt="Enlarged Photo"
          />
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap 5 JS Bundle (includes Popper) -->
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
  ></script>

  <script>
    // When any gallery-image is clicked, swap its src into the modal img
    document.querySelectorAll('.gallery-img').forEach(img => {
      img.addEventListener('click', e => {
        const src = e.currentTarget.src
        document.getElementById('lightbox-img').src = src
      });
    });


    // 1) List your image paths here:
    const imageList = JSON.parse(<?= $carouselImages ?>);

    // 2) Build carousel slides (3 images per slide)
    const chunkSize = 3;
    const carouselInner = document.getElementById('carouselInner');

    for (let i = 0; i < imageList.length; i += chunkSize) {
      // take a slice of up to 3 images
      const chunk = imageList.slice(i, i + chunkSize);

      // create carousel-item div
      const itemDiv = document.createElement('div');
      itemDiv.classList.add('carousel-item');
      if (i === 0) itemDiv.classList.add('active'); // first slide active

      // create a row to hold 3 columns
      const row = document.createElement('div');
      row.classList.add('row', 'g-2', 'justify-content-center');

      // for each image in the chunk, create a column
      chunk.forEach(src => {
        const col = document.createElement('div');
        col.classList.add('col-12', 'col-md-4');

        const img = document.createElement('img');
        img.src = src;
        img.alt = 'Another picture of Grim Grim';
        img.classList.add('d-block', 'w-100');

        col.appendChild(img);
        row.appendChild(col);
      });

      itemDiv.appendChild(row);
      carouselInner.appendChild(itemDiv);
    }

    // 3) Optional: start auto-slide every 3 seconds
    const carousel = new bootstrap.Carousel('#catCarousel', {
      interval: 3000,
      ride: 'carousel'
    });

  </script>
</body>
</html>