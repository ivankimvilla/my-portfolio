@extends('layouts.app')

@section('title', 'Skills - Ivan Kim Almadin')

@section('content')

<link rel="stylesheet" href="{{ asset('css/pages/skills.css') }}">

<div class="sk-page">
    <div class="sk-container">

        <section class="sk-section">
            <div class="sk-two-col">
                <div class="sk-column">
                    <h2 class="sk-column-title">Technical Skills</h2>
                    <ul class="sk-list">
                        <li>Full-Stack Web Development – Frontend &amp; Backend</li>
                        <li>Frontend Development – HTML, CSS, JavaScript, Responsive UI</li>
                        <li>Backend Development – PHP, Laravel, REST APIs</li>
                        <li>Database Management – MySQL, Database Design</li>
                        <li>AI Integration – AI APIs, AI-Powered Applications</li>
                        <li>AI Agent Development – AI Agent Pipelines &amp; Connectors</li>
                        <li>Prompt Engineering – AI-Assisted Development &amp; Workflow Automation</li>
                        <li>API Integration – Third-Party APIs and External Services</li>
                        <li>Version Control</li>
                        <li>Deployment &amp; Hosting</li>
                    </ul>
                </div>

                <div class="sk-column">
                    <h2 class="sk-column-title">Professional Skills</h2>
                    <ul class="sk-list">
                        <li>Problem Solving &amp; Technical Troubleshooting</li>
                        <li>Fast Learning &amp; Adaptability</li>
                        <li>Workflow Automation</li>
                        <li>Critical Thinking</li>
                        <li>Solution-Oriented Development</li>
                        <li>Continuous Improvement</li>
                    </ul>
                </div>
            </div>
        </section>


    </div>
</div>

@endsection
