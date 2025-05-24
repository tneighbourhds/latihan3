<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Garden Tree - Landing Page</title>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap');
  * {
    margin: 0; padding: 0; box-sizing: border-box;
  }
  body {
    font-family: 'Quicksand', sans-serif;
    background-color: #F3F3F3; /* Light Grey */
    color: #000014; /* Default black */
    line-height: 1.5;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
  }
  a {
    text-decoration: none;
    color: inherit;
  }
  button {
    font-family: inherit;
  }

  /* Navbar */
  header {
    position: relative;
    background-image: url("{{ asset('storage/siswa_photos/sijaa.jpg') }}");
    background-size: cover;
    background-position: center;
    padding: 1rem 2rem;
    color: #FFFFFF;
    z-index: 2;
  }
  header::before {
    content: "";
    position: absolute;
    inset: 0;
    background-color: rgba(0, 44, 88, 0.6); /* Dark blue overlay */
    z-index: 1;
  }
  .navbar {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: space-between;
    max-width: 1200px;
    margin: auto;
    z-index: 2;
  }
  .navbar .logo {
    font-weight: 700;
    font-size: 1.5rem;
    display: flex;
    align-items: center;
    letter-spacing: 1.1px;
    color: #FFFFFF;
  }
  .navbar .logo svg {
    margin-right: 10px;
    fill: #80A1F8; /* Light Blue */
    width: 28px;
    height: 28px;
  }
  .navbar nav {
    display: flex;
    gap: 2rem;
    font-weight: 600;
    font-size: 1rem;
    color: #FFFFFF;
    position: relative;
    z-index: 2;
  }
  .navbar nav a {
    cursor: pointer;
    user-select: none;
    color: #FFFFFF;
    transition: color 0.3s ease;
  }
  .navbar nav a:hover,
  .navbar nav a:focus {
    color: #80A1F8; /* Light Blue */
    outline: none;
  }
  .navbar .auth-buttons {
    display: flex;
    gap: 1rem;
    position: relative;
    z-index: 2;
  }
  .btn-register {
    border: 2px solid #80A1F8; /* Light Blue */
    padding: 0.45rem 1.5rem;
    border-radius: 24px;
    font-weight: 600;
    background: transparent;
    cursor: pointer;
    color: #80A1F8; /* Light Blue */
    transition: background-color 0.3s ease, color 0.3s ease;
  }
  .btn-register:hover,
  .btn-register:focus {
    background-color: #0043F1; /* Blue */
    border-color: #0043F1;
    color: #FDFDFD; /* White */
    outline: none;
  }
  .btn-login {
    background-color: #80A1F8; /* Light Blue */
    color: #000014; /* Black */
    padding: 0.45rem 1.8rem;
    border-radius: 24px;
    font-weight: 600;
    border: none;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }
  .btn-login:hover,
  .btn-login:focus {
    background-color: #002C58; /* Dark Blue */
    color: #FDFDFD; /* White */
    outline: none;
  }


    /* Gallery Grid Section */
  .gallery {
    max-width: 900px;
    margin: 0 auto 3rem auto;
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    grid-auto-rows: 150px;
    gap: 12px;
  }

  .gallery-item {
    position: relative;
    overflow: hidden;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.15);
    cursor: pointer;
    transition: transform 0.3s ease;
  }

  .gallery-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform 0.4s ease;
  }

  .gallery-item:hover img {
    transform: scale(1.1);
  }

  .item1 { grid-column: span 2; grid-row: span 2; }
  .item2 { }
  .item3 { }
  .item4 { }
  .item5 { }
  .item6 { }
  .item7 { }
  .item8 { grid-column: span 2; grid-row: span 2; }
  .item9 { grid-column: span 2; }

  h1 {
  text-align: center;
  margin-bottom: 1rem;
  font-weight: 700;
}

p.description {
  text-align: center;
  margin-bottom: 2rem;
  font-weight: 500;
  color: #555;
}


  /* Load More Button */
  .load-more {
    margin: 2rem auto 5rem auto;
    display: block;
    background-color: #0043F1;
    color: #FFF;
    border: none;
    padding: 0.75rem 2rem;
    font-size: 1rem;
    border-radius: 25px;
    cursor: pointer;
    box-shadow: 0 4px 12px rgb(0 67 241 / 0.5);
    transition: background-color 0.3s ease;
  }

  .load-more:hover {
    background-color: #002C58;
  }

  /* Hero Section */
  .hero {
    position: relative;
    z-index: 2;
    text-align: center;
    padding: 7rem 1.5rem 7rem;
    max-width: 900px;
    margin: 0 auto;
    color: #FFFFFF; /* White text */
    text-shadow: 0 2px 8px rgba(0, 0, 0, 0.7);
  }
  .hero h1 {
    font-size: 3rem;
    font-weight: 700;
    margin-bottom: 0.8rem;
    line-height: 1.2;
    letter-spacing: 0.03em;
  }
  .hero p {
    font-size: 1.05rem;
    margin-bottom: 2.5rem;
    max-width: 640px;
    margin-left: auto;
    margin-right: auto;
  }
  .btn-group {
    display: inline-flex;
    gap: 1.2rem;
  }
  .btn-primary {
    background-color: #80A1F8; /* Light Blue */
    border: none;
    padding: 0.8rem 2.6rem;
    font-weight: 700;
    border-radius: 6px;
    cursor: pointer;
    color: #000014; /* Black */
    font-size: 1rem;
    transition: background-color 0.3s ease;
  }
  .btn-primary:hover {
    background-color: #0043F1; /* Blue */
  }
  .btn-secondary {
    background-color: transparent;
    border: 2px solid #80A1F8; /* Light Blue */
    padding: 0.75rem 2.6rem;
    font-weight: 700;
    border-radius: 6px;
    color: #80A1F8; /* Light Blue */
    cursor: pointer;
    font-size: 1rem;
    transition: background-color 0.3s ease, color 0.3s ease;
  }
  .btn-secondary:hover {
    background-color: #80A1F8; /* Light Blue */
    color: #000014; /* Black */
  }

  /* Cards Section */
  .cards {
    display: flex;
    justify-content: center;
    gap: 1.4rem;
    margin: 2.5rem 0 4rem;
    max-width: 960px;
    margin-left: auto;
    margin-right: auto;
    padding: 0 1rem;
  }
  .card {
    position: relative;
    flex: 1;
    cursor: pointer;
    overflow: hidden;
    border-radius: 10px;
    box-shadow: 0 0 22px #000014aa;
    color: #FDFDFD;
    background-size: cover;
    background-position: center;
    min-height: 230px;
    display: flex;
    align-items: flex-end;
    padding: 1.4rem 1.5rem 1.5rem;
    font-size: 1rem;
    font-weight: 600;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }
  .card:hover {
    transform: scale(1.06);
    box-shadow: 0 0 28px #0043F1cc;
  }
  .card .plus {
    position: absolute;
    top: 12px;
    right: 12px;
    font-size: 1.8rem;
    font-weight: 900;
    background: #002C58cc;
    border-radius: 50%;
    width: 32px;
    height: 32px;
    line-height: 28px;
    text-align: center;
    cursor: pointer;
    user-select: none;
    transition: background-color 0.3s ease;
  }
  .card .plus:hover {
    background-color: #0043F1cc;
  }
  .card-text {
    position: relative;
    z-index: 1;
    color: #FDFDFD;
    font-weight: 700;
    font-size: 1.2rem;
    text-shadow: 0 0 6px rgba(0,0,0,0.7);
  }

  /* Gallery Carousel Section */
  .gallery-carousel-section {
    max-width: 960px;
    margin: 3rem auto 5rem;
    padding: 0 1rem;
    color: #000014;
    text-align: center;
  }
  .gallery-carousel-section h2 {
    font-weight: 700;
    font-size: 2rem;
    margin-bottom: 1.5rem;
    letter-spacing: 0.03em;
  }
  .carousel-container {
    position: relative;
    overflow: hidden;
    border-radius: 12px;
    box-shadow: 0 0 20px rgb(0 0 0 / 0.1);
    background: #fff;
  }
  .carousel-track-container {
    overflow: hidden;
  }
  .carousel-track {
    display: flex;
    list-style: none;
    padding: 0;
    margin: 0;
  }
  .carousel-slide {
    min-width: 100%;
    user-select: none;
  }
  .carousel-slide img {
    width: 100%;
    height: 300px;
    object-fit: cover;
    display: block;
    border-radius: 12px;
  }
  .carousel-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: #0043F1cc;
    border: none;
    color: white;
    font-size: 2rem;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    cursor: pointer;
    z-index: 10;
    user-select: none;
    transition: background-color 0.3s ease;
  }
  .carousel-btn:hover {
    background-color: #002C58;
  }
  .carousel-btn.prev {
    left: 10px;
  }
  .carousel-btn.next {
    right: 10px;
  }

  /* About Section */
  .about-section {
    max-width: 960px;
    margin: 4rem auto 3rem;
    display: flex;
    gap: 3rem;
    padding: 0 1rem;
    color: #000014;
    align-items: center;
  }
  .about-text {
    flex: 1 1 350px;
  }
  .about-text h2 {
    font-weight: 700;
    margin-bottom: 1rem;
    font-size: 1.9rem;
    color: #002C58;
  }
  .about-text p {
    font-size: 1rem;
    color: #0043F1;
    line-height: 1.6;
  }
  .about-text a {
    font-weight: 700;
    font-size: 1rem;
    color: #80A1F8;
    display: inline-flex;
    align-items: center;
    margin-top: 1rem;
    transition: color 0.3s ease;
  }
  .about-text a svg {
    margin-left: 8px;
    fill: #80A1F8;
    width: 14px;
    height: 14px;
    transition: transform 0.3s ease;
  }
  .about-text a:hover {
    color: #0043F1;
  }
  .about-text a:hover svg {
    transform: translateX(4px);
  }
  .about-image {
    flex: 1 1 350px;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 0 18px #00001422;
  }
  .about-image img {
    width: 100%;
    display: block;
    border-radius: 12px;
  }

  /* Contact Section - Perlebar */
  .contact-section {
    max-width: 900px;
    margin: 3rem auto;
    padding: 2rem 3rem;
    background: linear-gradient(135deg, #80A1F8 0%, #0043F1 100%);
    border-radius: 16px;
    box-shadow: 0 8px 20px rgb(0 67 241 / 0.3);
    color: #FDFDFD;
    font-weight: 600;
  }
  .contact-section h2 {
    font-weight: 700;
    font-size: 2.2rem;
    margin-bottom: 1.5rem;
    letter-spacing: 0.04em;
    text-align: center;
  }
  .contact-list-enhanced {
    display: flex;
    flex-direction: column;
    gap: 2rem;
  }
  .contact-item {
    display: flex;
    align-items: center;
    gap: 0.8rem;
    background: #FDFDFD;
    padding: 0.9rem 1.3rem;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgb(0 0 0 / 0.12);
    color: #000014;
    text-decoration: none;
    font-size: 1.05rem;
    position: relative;
    transition: box-shadow 0.3s ease, transform 0.3s ease;
    user-select: none;
  }
  .contact-item:hover,
  .contact-item:focus {
    box-shadow: 0 6px 18px rgb(0 67 241 / 0.6);
    transform: translateY(-4px);
    outline: none;
  }
  .contact-item img {
    flex-shrink: 0;
  }
  .contact-item .arrow {
    margin-left: auto;
    font-size: 1.3rem;
    color: #0043F1;
    transition: margin-left 0.3s ease;
  }
  .contact-item:hover .arrow,
  .contact-item:focus .arrow {
    margin-left: 0.5rem;
  }
  .contact-item.whatsapp img {
    filter: invert(39%) sepia(90%) saturate(615%) hue-rotate(78deg) brightness(92%) contrast(87%);
  }
  .contact-item.instagram img {
    filter: invert(31%) sepia(77%) saturate(3090%) hue-rotate(296deg) brightness(92%) contrast(88%);
  }
  .contact-item.email img {
    filter: invert(30%) sepia(12%) saturate(1657%) hue-rotate(79deg) brightness(91%) contrast(86%);
  }

  /* Footer */
  footer {
    background-color: #002C58;
    color: #EAEAEA;
    padding: 3rem 2rem 3rem;
    font-size: 0.9rem;
    line-height: 1.5;
    margin-top: auto;
  }
  .footer-container {
    max-width: 1100px;
    margin: auto;
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 2rem;
  }
  .footer-col {
    flex: 1 1 220px;
    min-width: 180px;
  }
  .footer-col h3 {
    color: #80A1F8;
    font-weight: 700;
    font-size: 1.1rem;
    margin-bottom: 1rem;
    letter-spacing: 0.02em;
  }
  .footer-col p,
  .footer-col a {
    color: #EAEAEA;
    font-weight: 500;
    display: block;
    margin-bottom: 0.9rem;
    transition: color 0.3s ease;
  }
  .footer-col a:hover {
    color: #0043F1;
  }
  .footer-contact-info svg {
    width: 18px;
    height: 18px;
    vertical-align: middle;
    margin-right: 6px;
    fill: #EAEAEA;
  }
  .footer-contact-info a {
    display: inline-flex;
    align-items: center;
  }

  /* Responsive */
  @media (max-width: 768px) {
    .navbar nav {
      gap: 1rem;
      font-size: 0.9rem;
    }
    .cards {
      flex-direction: column;
      max-width: 320px;
      margin: 2.5rem auto;
    }
    .about-section {
      flex-direction: column;
      max-width: 320px;
      margin: 4rem auto;
    }
    .stats {
      flex-direction: column;
      max-width: 320px;
      margin: 3rem auto;
      gap: 1.5rem;
    }
    .process-steps {
      flex-direction: column;
      max-width: 320px;
      margin: auto;
      gap: 2.5rem;
    }
    .btn-process {
      float: none;
      margin-bottom: 1.8rem;
    }
    .footer-container {
      flex-direction: column;
      gap: 2.5rem;
      max-width: 320px;
      margin: auto;
    }
  }
</style>
</head>
<body>

<header id="home">
  <div class="navbar">
    <a href="#" class="logo" aria-label="Garden Tree Logo">
    <img src="{{ asset('storage/siswa_photos/logosija2.png') }}" alt="Garden Tree Logo" style="width:28px; height:28px; margin-right:10px; object-fit:contain;">
    SIJA Stembayo
    </a>


    <nav>
        <a href="#home" tabindex="0">Home</a>
        <a href="#gallery" tabindex="0">Gallery</a>
        <a href="#about-us" tabindex="0">About us</a>
        <a href="#contact-us" tabindex="0">Contact us</a>
    </nav>

    <div class="auth-buttons">
      <button class="btn-register" type="button">Register</button>
      <button class="btn-login" type="button">Login</button>
    </div>
  </div>
  <div class="hero" role="banner" aria-label="Garden Tree hero section with call to action">
    <h1>Absensi Praktik Kerja Lapangan untuk Pencatatan Kehadiran</h1>
    <p>Memudahkan proses pencatatan kehadiran siswa selama Praktik Kerja Lapangan dengan sistem absensi yang sederhana, cepat, dan akurat, sehingga mendukung kelancaran administrasi dan monitoring kegiatan lapangan.</p>
    <div class="btn-group">
      <button class="btn-primary" type="button">Get In Touch</button>
      <button class="btn-secondary" type="button">Who We Are</button>
    </div>
  </div>
</header>

<section class="cards" aria-label="Services cards">
<div class="card" style="background-image: url('{{ asset('storage/siswa_photos/jaringan.jpeg') }}')">
    <span class="card-text">Jaringan Komputer Dasar</span>
  </div>
  <div class="card" style="background-image: url('{{ asset('storage/siswa_photos/siskom.jpeg') }}')">
    <span class="card-text">Sistem Komputer</span>
  </div>
  <div class="card" style="background-image: url('{{ asset('storage/siswa_photos/program.jpeg') }}')">
    <span class="card-text">Pemrograman Dasar</span>
  </div>
  <div class="card" style="background-image: url('{{ asset('storage/siswa_photos/jaringan.jpeg') }}')" tabindex="0" aria-label="Internet of Things">
    <span class="card-text">Internet of Things</span>
  </div>
</section>


<section id="about-us" class="about-section custom-about" aria-label="Digital agency problems and solutions">
  <div class="about-text">
    <h2>Digital agency problems<br>and their best solutions</h2>
    <p>Omitting compelling digital experiences that captivate audiences and drive meaningful connections. Our digital agency combines innovation, strategy, and expertise to fuel your online success. The other hand we discovered problems including and criticize not who are so bright and the opinions. We believe that the success of the agency depends on sharing the chances of phases of the moment.</p>
  </div>
  <div class="images-carousel" aria-label="Team images carousel">
    <button class="carousel-btn prev" aria-label="Previous image">&lt;</button>
    <div class="carousel-track-container">
      <ul class="carousel-track">
        <li class="carousel-slide">
          <img src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?auto=format&fit=crop&w=800&q=80" alt="Team Collaboration" />
        </li>
      </ul>
    </div>
    <button class="carousel-btn next" aria-label="Next image">&gt;</button>
  </div>
</section>


<h1>Our Gallery</h1>
<p class="description">This project is created in order to help business</p>

<div id="gallery" class="gallery" aria-label="Image gallery with mixed sizes">
  <div class="gallery-item item1">
    <img src="{{ asset('storage/siswa_photos/foto1.jpg') }}" alt="Hanger rack with clothes" />
  </div>
  <div class="gallery-item item2">
    <img src="{{ asset('storage/siswa_photos/foto2.jpg') }}" alt="Two people walking outside" />
  </div>
  <div class="gallery-item item3">
    <img src="{{ asset('storage/siswa_photos/foto3.jpg') }}" alt="Watch on table" />
  </div>
  <div class="gallery-item item4">
    <img src="{{ asset('storage/siswa_photos/foto4.jpg') }}" alt="Man wearing hat looking sideways" />
  </div>
  <div class="gallery-item item5">
    <img src="{{ asset('storage/siswa_photos/foto5.jpg') }}" alt="Shoes and pants flat lay" />
  </div>
  <div class="gallery-item item6">
    <img src="{{ asset('storage/siswa_photos/foto6.jpg') }}" alt="Shirts on hangers" />
  </div>
  <div class="gallery-item item7">
    <img src="{{ asset('storage/siswa_photos/foto7.jpg') }}" alt="Colorful flower pattern" />
  </div>
  <div class="gallery-item item8">
    <img src="{{ asset('storage/siswa_photos/foto8.jpg') }}" alt="Green leaves in glass vase" />
  </div>
  <div class="gallery-item item9">
    <img src="{{ asset('storage/siswa_photos/foto9.jpg') }}" alt="Stack of white books" />
  </div>
</div>




<section id="contact-us" class="contact-section" aria-label="Contact information">
  <h2>Contact Us</h2>
  <div class="contact-list-enhanced">
    <a href="https://wa.me/6281234567890" target="_blank" rel="noopener" aria-label="WhatsApp contact" class="contact-item whatsapp">
      <img src="https://cdn-icons-png.flaticon.com/24/733/733585.png" alt="WhatsApp icon" width="24" height="24" />
      WhatsApp: +62 812-3456-7890
      <span class="arrow">→</span>
    </a>
    <a href="https://instagram.com/yourprofile" target="_blank" rel="noopener" aria-label="Instagram profile" class="contact-item instagram">
      <img src="https://cdn-icons-png.flaticon.com/24/733/733558.png" alt="Instagram icon" width="24" height="24" />
      Instagram: @yourprofile
      <span class="arrow">→</span>
    </a>
    <a href="mailto:info@gardentree.com" aria-label="Email contact" class="contact-item email">
      <img src="https://cdn-icons-png.flaticon.com/24/732/732200.png" alt="Email icon" width="24" height="24" />
      Email: info@gardentree.com
      <span class="arrow">→</span>
    </a>
  </div>
</section>

<footer>
  <div class="footer-container" aria-label="Footer navigation and contact information">
    <div class="footer-col">
      <h3>PKL Tracker</h3>
      <p>Platform digital untuk mengelola Praktek Kerja Lapangan SMK TI Bali Global dengan teknologi modern dan interface yang user-friendly.</p>
    </div>
    <div class="footer-col">
      <h3>Quick Links</h3>
      <a href="#">Home</a>
      <a href="#">Gallery</a>
      <a href="#">About us</a>
      <a href="#">Login</a>
      <a href="#">Register</a>
    </div>
    <div class="footer-col">
      <h3>Support</h3>
      <a href="#">Help Center</a>
      <a href="#">Documentation</a>
      <a href="#">FAQ</a>
      <a href="#">Contact Support</a>
    </div>
    <div class="footer-col footer-contact-info">
      <h3>Contact Info</h3>
      <p><svg aria-hidden="true" focusable="false" viewBox="0 0 24 24"><path d="M20 4H4c-1.104 0-2 .896-2 2v12a2 2 0 002 2h16a2 2 0 002-2V6c0-1.104-.896-2-2-2zm0 2l-8 5-8-5h16z"/></svg> <a href="mailto:pkl@smktibali.ac.id">pkl@smktibali.ac.id</a></p>
      <p><svg aria-hidden="true" focusable="false" viewBox="0 0 24 24"><path d="M6.62 10.79a15.053 15.053 0 006.59 6.59l1.58-1.58a1 1 0 011.11-.21c1.21.48 2.53.74 3.88.74a1 1 0 011 1v3.5a1 1 0 01-1 1C10.54 21 3 13.46 3 4a1 1 0 011-1h3.5a1 1 0 011 1c0 1.35.25 2.67.74 3.88a1 1 0 01-.21 1.11l-1.41 1.8z"/></svg> +62 361-123-4567</p>
      <p><svg aria-hidden="true" focusable="false" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zM7 9a5 5 0 0110 0c0 2.98-3.02 7.87-5 10.88C10.01 16.86 7 11.92 7 9z"/></svg> Bali, Indonesia</p>
    </div>
  </div>
</footer>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const track = document.querySelector('.gallery-carousel-section .carousel-track');
    const slides = Array.from(track.children);
    const nextButton = document.querySelector('.gallery-carousel-section .carousel-btn.next');
    const prevButton = document.querySelector('.gallery-carousel-section .carousel-btn.prev');
    const slideWidth = slides[0].getBoundingClientRect().width;

    slides.forEach((slide, index) => {
      slide.style.left = slideWidth * index + 'px';
    });

    let currentSlideIndex = 0;

    const moveToSlide = (track, targetIndex) => {
      track.style.transform = 'translateX(-' + slides[targetIndex].style.left + ')';
      currentSlideIndex = targetIndex;
    };

    prevButton.addEventListener('click', () => {
      const prevIndex = currentSlideIndex === 0 ? slides.length - 1 : currentSlideIndex - 1;
      moveToSlide(track, prevIndex);
    });

    nextButton.addEventListener('click', () => {
      const nextIndex = currentSlideIndex === slides.length - 1 ? 0 : currentSlideIndex + 1;
      moveToSlide(track, nextIndex);
    });
  });
</script>

</body>
</html>
