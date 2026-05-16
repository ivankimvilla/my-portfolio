@extends('layouts.admin')
@section('title', 'Admin Skills')
@section('header', 'Admin Skills Settings')
@section('content')

<link rel="stylesheet" href="{{ asset('css/admin/skill/profile-skills.css') }}">

<section class="ab-skills" style="padding: 0; margin: 0; background: none;">
    <div style="display:flex; align-items:center; gap:10px; font-size:10px; font-weight:600; text-transform:uppercase; letter-spacing:2.5px; color:#c8a96e; margin-bottom:10px;">
        <span style="display:inline-block; width:20px; height:1px; background:#c8a96e; flex-shrink:0;"></span>
        Management
    </div>
    <h2 style="font-family:'Cormorant Garamond',serif; font-size:32px; font-weight:300; letter-spacing:-0.5px; color:#f0ece4; margin:0 0 4px;">
        Update <em style="font-style:italic; color:#c8a96e;">Skills.</em>
    </h2>

    <div class="ab-divider">
        <div class="ab-divider-line"></div>
        <div class="ab-divider-dot"></div>
        <div class="ab-divider-line"></div>
    </div>

    @if ($errors->any())
        <div class="pf-alert pf-alert-error" style="margin-bottom: 24px;">
            <strong>Please fix the following:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('success'))
        <div class="pf-alert pf-alert-success" style="margin-bottom: 24px;">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('admin.profile.skills.update') }}" style="margin-top: 32px;">
        @csrf
        @method('PUT')


        <div class="ab-skills-inner" style="grid-template-columns: 1fr; gap: 48px;">
            <div class="skill-card">
                <div class="ab-eyebrow" style="margin-bottom:28px;">Professional Skills</div>
                <div class="ab-skill-bars">
                    @php
                        $skills = old('skills', data_get($user, 'skills') ?: [['label' => '', 'pct' => '']]);
                    @endphp

                    <div id="skills-list">
                        @foreach ($skills as $index => $skill)
                            <div class="skill-row">
                                <div class="skill-fields">
                                    <input
                                        type="text"
                                        name="skills[{{ $index }}][label]"
                                        class="ab-skill-bar-label"
                                        value="{{ old("skills.$index.label", data_get($skill, 'label')) }}"
                                        placeholder="Backend Development"
                                    />
                                    <input
                                        type="text"
                                        name="skills[{{ $index }}][pct]"
                                        class="ab-skill-bar-pct"
                                        value="{{ old("skills.$index.pct", data_get($skill, 'pct')) }}"
                                        placeholder="95%"
                                    />
                                </div>
                                @php
                                    $pct = old("skills.$index.pct", data_get($skill, 'pct')) ?: '0%';
                                    $pctValue = rtrim($pct, '%');
                                @endphp
                                <div class="skill-actions">
                                    <div class="skill-progress">
                                        <div class="skill-progress-head">
                                            <span class="skill-percent">{{ $pct ?: '0%' }}</span>
                                            <span class="skill-name-preview">{{ old("skills.$index.label", data_get($skill, 'label')) ?: 'Skill name' }}</span>
                                        </div>
                                        <div class="ab-skill-bar-track">
                                            <div class="ab-skill-bar-fill" style="width:{{ $pctValue ?: 0 }}%"></div>
                                        </div>
                                    </div>
                                    <button type="button" class="pf-btn-secondary remove-skill-btn">Remove</button>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="skill-footer">
                        <button type="button" id="add-skill-btn" class="pf-btn-secondary">Add Skill</button>
                        <button type="submit" class="pf-btn-primary">
                            <span><i class="fas fa-save" style="margin-right:6px;"></i>Save Changes</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

                <template id="skill-row-template">
                    <div class="skill-row">
                        <div class="skill-fields">
                            <input
                                type="text"
                                name="skills[][label]"
                                class="ab-skill-bar-label"
                                placeholder="Backend Development"
                            />
                            <input
                                type="text"
                                name="skills[][pct]"
                                class="ab-skill-bar-pct"
                                placeholder="95%"
                            />
                        </div>
                        <div class="skill-actions">
                            <div class="skill-progress">
                                <div class="skill-progress-head">
                                    <span class="skill-percent">0%</span>
                                    <span class="skill-name-preview">Skill name</span>
                                </div>
                                <div class="ab-skill-bar-track">
                                    <div class="ab-skill-bar-fill" style="width:0%"></div>
                                </div>
                            </div>
                            <button type="button" class="pf-btn-secondary remove-skill-btn">Remove</button>
                        </div>
                    </div>
                </template>
                <script>
                    (function () {
                        const skillsList = document.getElementById('skills-list');
                        const addButton = document.getElementById('add-skill-btn');
                        const template = document.getElementById('skill-row-template');

                        function updateFill(input) {
                            const row = input.closest('.skill-row');
                            const fill = row?.querySelector('.ab-skill-bar-fill');
                            const percentLabel = row?.querySelector('.skill-percent');
                            if (!fill || !percentLabel) return;

                            const value = input.value.trim().replace('%', '');
                            const width = Math.min(Math.max(parseInt(value, 10) || 0, 0), 100);
                            fill.style.width = width + '%';
                            percentLabel.textContent = width + '%';
                        }

                        function updateLabel(input) {
                            const row = input.closest('.skill-row');
                            const labelPreview = row?.querySelector('.skill-name-preview');
                            if (!labelPreview) return;
                            labelPreview.textContent = input.value.trim() || 'Skill name';
                        }

                        function bindRow(row) {
                            const pctInput = row.querySelector('.ab-skill-bar-pct');
                            const labelInput = row.querySelector('.ab-skill-bar-label');

                            if (pctInput) {
                                pctInput.addEventListener('input', function () {
                                    updateFill(this);
                                });
                                updateFill(pctInput);
                            }

                            if (labelInput) {
                                labelInput.addEventListener('input', function () {
                                    updateLabel(this);
                                });
                                updateLabel(labelInput);
                            }

                            row.querySelectorAll('.remove-skill-btn').forEach((button) => {
                                button.addEventListener('click', function () {
                                    const targetRow = this.closest('.skill-row');
                                    if (targetRow) {
                                        targetRow.remove();
                                    }
                                });
                            });
                        }

                        skillsList.querySelectorAll('.skill-row').forEach(bindRow);

                        addButton.addEventListener('click', function () {
                            const clone = template.content.firstElementChild.cloneNode(true);
                            skillsList.appendChild(clone);
                            bindRow(clone);
                        });
                    })();
                </script>

    </form>
</section>
@endsection