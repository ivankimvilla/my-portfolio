# Portfolio Project Structure & CSS Architecture

## Project Setup
- **Framework:** Laravel with Vite + Tailwind CSS v4
- **Location:** `/c/xampp/htdocs/my-portfolio/`
- **Main User:** Ivan Kim Almadin (Full-Stack Developer)

## CSS Architecture

### Files
1. **resources/css/app.css** - Main entry point
   - Imports Tailwind CSS
   - Imports portfolio.css
   - Defines font theme

2. **resources/css/portfolio.css** - Professional custom styles
   - CSS variables for colors, shadows, transitions
   - Animations (fade-in, float, bounce-slow)
   - Component classes (buttons, cards, forms)
   - Accessibility features
   - Dark mode support

3. **resources/css/PORTFOLIO_CSS_GUIDE.md** - Comprehensive documentation

### Key Design Features
- Professional gradient: Blue (#2563eb) → Purple (#7c3aed) → Pink (#ec4899)
- Smooth animations for interactivity
- Dark mode support via CSS variables
- Accessibility (focus rings, reduced-motion)
- Responsive mobile-first design
- Clean component-based architecture

## Component Structure
- **Header** - Navigation with gradient logo
- **Project Cards** - Hover animations, gradient headers
- **Skill Cards** - Colored icons, smooth interactions
- **Contact Form** - Professional input styling
- **Footer** - Social links, organized layout
- **CTA Sections** - Eye-catching gradients

## CSS Best Practices Applied
- CSS custom properties for theming
- Semantic variable naming
- Accessibility-first approach
- Responsive breakpoints (md: 768px)
- Dark mode via prefers-color-scheme
- Print styles included
