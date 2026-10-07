<x-layouts.portfolio title="Works — Ivan Kim Almadin" page-css="css/pages/works.css" page-js="js/pages/works.js" active="works" body-class="portfolio-works">
<main class="works-page" id="works">
  <section class="works-hero">
    <div class="works-hero-image" aria-hidden="true"></div>
    <div class="container works-hero-content">
      <div class="works-heading">
        <div>
          <p class="eyebrow">My Works</p>
          <h1>Projects that reflect<br>my skills and creativity.</h1>
          <p>Here are some of the web applications and UI/UX designs I've worked on. Each project represents my passion for building useful and beautiful digital experiences.</p>
        </div>
      </div>
      <div class="filter-pills" role="group" aria-label="Filter projects">
        <button class="filter-pill active" type="button" data-filter="All" aria-pressed="true">All</button>
        <button class="filter-pill" type="button" data-filter="Web Development" aria-pressed="false">Web Development</button>
        <button class="filter-pill" type="button" data-filter="UI/UX Design" aria-pressed="false">UI/UX Design</button>
      </div>
    </div>
  </section>
  <section class="container works-list" id="works-grid" aria-live="polite"></section>
</main>
</x-layouts.portfolio>