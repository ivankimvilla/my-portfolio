@extends('layouts.app')

@section('title', 'Experience - Ivan Kim Almadin')

@section('content')

<link rel="stylesheet" href="{{ asset('css/pages/experience.css') }}">

<div class="exp-page">
    <div class="exp-container">

        <section class="exp-section">
            <div class="exp-timeline">
                <article class="exp-item">
                    <div class="exp-item-header">
                        <div>
                            <h3>RYPACI IT SOLUTIONS</h3>
                        </div>
                    </div>

                    <div class="exp-entry">
                        <span class="exp-date">July 2025 – April 2026</span>
                        <div class="exp-bullets">
                            <ul>
                                <li>Developed scalable full-stack web applications to deliver comprehensive business solutions.</li>
                                <li>Built custom web tools that sped up daily work processes.</li>
                            </ul>
                        </div>
                        <div class="exp-statuses">
                            <span>FULL TIME INTERN</span>
                        </div>
                    </div>
                </article>

                <article class="exp-item">
                    <div class="exp-item-header">
                        <div>
                            <h3>ENSO AI</h3>
                        </div>
                    </div>

                    <div class="exp-entry">
                        <span class="exp-date">June 2026 – August 2026</span>
                        <div class="exp-bullets">
                            <ul>
                                <li>Created and optimized specialized prompts for advanced AI video generation models.</li>
                                <li>Developed targeted visual inputs to produce high-quality, targeted AI video content.</li>
                            </ul>
                        </div>
                        <div class="exp-statuses">
                            <span>OUTSOURCE</span>
                        </div>
                    </div>
                </article>

                <article class="exp-item">
                    <div class="exp-item-header">
                        <div>
                            <h3>AIZAP CREATIVES</h3>
                        </div>
                    </div>

                    <div class="exp-entry">
                        <span class="exp-date">July 2026 – September 2026</span>
                        <div class="exp-bullets">
                            <ul>
                                <li>Developed custom web applications, including fully functional, real-world portfolio websites.</li>
                                <li>Built responsive user interfaces and robust features for live client projects.</li>
                            </ul>
                        </div>
                        <div class="exp-statuses">
                            <span>PART TIME</span>
                        </div>
                    </div>
                </article>
            </div>
        </section>

        <section class="exp-references">
            <div class="exp-section-head small">
                <h2>References</h2>
            </div>

            <div class="exp-reference-list">
                <div class="ref-item">
                    <h3>AIZAP CREATIVES</h3>
                    <p>zapantakirk6@gmail.com</p>
                </div>
                <div class="ref-item">
                    <h3>ENSO AI</h3>
                    <p>zapantakirk6@gmail.com</p>
                </div>
                <div class="ref-item">
                    <h3>RYPACI IT SOLUTIONS</h3>
                    <p>info@rypaci.com</p>
                </div>
            </div>
        </section>

    </div>
</div>

@endsection
