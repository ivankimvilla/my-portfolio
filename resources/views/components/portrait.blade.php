@props(['class' => 'portrait', 'label' => 'Portrait illustration'])
<svg class="{{ $class }}" viewBox="0 0 600 700" preserveAspectRatio="xMaxYMax meet" role="img" aria-label="{{ $label }}">
  <defs>
    <linearGradient id="skin-tone" x1="0" y1="0" x2="1" y2="1"><stop offset="0" stop-color="#dcab7f"/><stop offset="1" stop-color="#b57e4d"/></linearGradient>
    <linearGradient id="hair-tone" x1="0" y1="0" x2="0" y2="1"><stop offset="0" stop-color="#1a211d"/><stop offset="1" stop-color="#0b0f0d"/></linearGradient>
  </defs>
  <path d="M30 700c10-175 112-255 255-275h30c143 20 245 100 255 275z" fill="url(#hair-tone)"/>
  <path d="M262 392h80v78c-24 26-56 26-80 0z" fill="#a9733f"/>
  <path d="M196 438c24 52 86 74 158 0" fill="none" stroke="#222b26" stroke-width="22" stroke-linecap="round"/>
  <path d="M262 470v90M342 470v90" stroke="#2a342e" stroke-width="4" stroke-linecap="round"/>
  <ellipse cx="302" cy="282" rx="84" ry="108" fill="url(#skin-tone)"/>
  <ellipse cx="217" cy="296" rx="11" ry="23" fill="#c28f60"/><ellipse cx="387" cy="296" rx="11" ry="23" fill="#b57e4d"/>
  <path d="M212 276c-16-92 40-154 104-150 58 4 90 54 74 134-14-46-46-72-88-74-44 2-74 30-90 90z" fill="#15100c"/>
  <path d="M262 282q12-8 26 0M326 282q12-8 26 0" stroke="#2a1a10" stroke-width="5" fill="none" stroke-linecap="round"/>
  <ellipse cx="276" cy="300" rx="6" ry="4.5" fill="#1b120c"/><ellipse cx="340" cy="300" rx="6" ry="4.5" fill="#1b120c"/>
  <path d="M308 306v32q-9 7-16 2" stroke="#946236" stroke-width="3.5" fill="none" stroke-linecap="round"/>
  <path d="M282 360q22 12 44 0" stroke="#7a4a30" stroke-width="4" fill="none" stroke-linecap="round"/>
</svg>
