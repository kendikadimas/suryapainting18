<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SuryaPainting18 | Spesialis Cat Velg &amp; Body Motor — Bekasi &amp; Cikarang</title>
    <meta name="description" content="SuryaPainting18 — bengkel spesialis pengecatan velg dan body motor sejak 2014. Hasil rapi, mengkilap, dan tahan lama dengan standar SOP pabrik. Warna standar maupun custom.">

    <link rel="icon" type="image/png" href="/assets/favicon.png">
    <link rel="apple-touch-icon" href="/assets/favicon.png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:ital,wght@0,400;0,600;0,700;0,800;0,900;1,700;1,800;1,900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --red: #ee14b1;
            --red-dark: #c0108f;
            --dark: #0d0d0d;
            --dark-2: #111111;
            --dark-3: #171717;
            --dark-4: #1e1e1e;
            --gray: #888888;
            --gray-light: #aaaaaa;
            --border: rgba(255,255,255,0.08);
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--dark);
            color: #fff;
            overflow-x: hidden;
        }

        /* ===== UTILITY ===== */
        .container-xl {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 24px;
        }
        @media (min-width: 1024px) { .container-xl { padding: 0 48px; } }

        .label-tag {
            font-family: 'Inter', sans-serif;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--red);
        }

        .section-eyebrow {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 18px;
        }
        .section-eyebrow-line {
            flex: 0 0 40px;
            height: 2px;
            background: var(--red);
        }

        .btn-red {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: var(--red);
            color: #fff;
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 13px;
            font-weight: 800;
            letter-spacing: 2.5px;
            text-transform: uppercase;
            padding: 15px 34px;
            text-decoration: none;
            border: 2px solid var(--red);
            transition: background 0.25s, transform 0.2s;
            cursor: pointer;
            font-style: italic;
        }
        .btn-red:hover { background: var(--red-dark); border-color: var(--red-dark); transform: translateY(-2px); }

        .btn-outline {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: transparent;
            color: #fff;
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 13px;
            font-weight: 800;
            letter-spacing: 2.5px;
            text-transform: uppercase;
            padding: 13px 32px;
            text-decoration: none;
            border: 2px solid rgba(255,255,255,0.5);
            transition: border-color 0.25s, background 0.25s, transform 0.2s;
            cursor: pointer;
            font-style: italic;
        }
        .btn-outline:hover { border-color: #fff; background: rgba(255,255,255,0.05); transform: translateY(-2px); }

        /* ===== HEADER / NAV ===== */
        #main-header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 100;
            background: rgba(10,10,10,0.97);
            backdrop-filter: blur(20px);
            transition: background 0.3s, box-shadow 0.3s;
        }
        #main-header.scrolled {
            box-shadow: 0 1px 0 rgba(255,255,255,0.06);
        }

        .nav-inner {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 24px;
            height: 72px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        @media (min-width: 1024px) { .nav-inner { padding: 0 48px; } }

        .nav-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }
        .nav-logo-icon {
            width: 36px;
            height: 36px;
            background: var(--red);
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        }
        .nav-logo-icon svg { width: 18px; height: 18px; color: #fff; }
        .nav-logo-text {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 22px;
            font-weight: 800;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: #fff;
        }
        .nav-logo-text span { color: var(--red); }

        .nav-links {
            display: none;
            align-items: center;
            gap: 36px;
        }
        @media (min-width: 768px) { .nav-links { display: flex; } }
        .nav-links a {
            color: rgba(255,255,255,0.75);
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            text-decoration: none;
            transition: color 0.2s;
            position: relative;
        }
        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0; right: 0;
            height: 2px;
            background: var(--red);
            transform: scaleX(0);
            transition: transform 0.2s;
        }
        .nav-links a:hover { color: #fff; }
        .nav-links a:hover::after { transform: scaleX(1); }

        .nav-actions { display: flex; align-items: center; gap: 12px; }

        /* ===== HERO ===== */
        #top {
            position: relative;
            z-index: 1;
            min-height: 100vh;
            min-height: 100dvh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            overflow: hidden;
            box-sizing: border-box;
            background: transparent;
        }
        #top > .container-xl {
            position: relative;
            z-index: 1;
            width: 100%;
            padding-top: 120px;
            padding-bottom: clamp(48px, 8vh, 80px);
            display: flex;
            justify-content: center;
        }
        .hero-inner {
            width: 100%;
            max-width: 820px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .hero-photo-bg {
            position: absolute;
            inset: 0;
            background:
                linear-gradient(to right, rgba(5,5,5,0.85) 0%, rgba(5,5,5,0.55) 55%, rgba(5,5,5,0.25) 100%),
                linear-gradient(to top, rgba(5,5,5,0.7) 0%, transparent 50%),
                radial-gradient(ellipse 60% 80% at 80% 50%, rgba(238,20,177,0.12), transparent 60%),
                #0d0d0d;
            background-size: cover;
            background-position: center;
        }

        /* Diagonal red accent bottom-left */
        .hero-diag {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 0;
            border-style: solid;
            border-width: 0 0 80px 140px;
            border-color: transparent transparent var(--dark) transparent;
            z-index: 2;
        }

        .hero-content {
            position: relative;
            z-index: 1;
            padding: 140px 0 120px;
        }

        .hero-eyebrow {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 20px;
        }
        .hero-eyebrow-line { width: 50px; height: 2px; background: var(--gray); }
        .hero-eyebrow span {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 3.5px;
            text-transform: uppercase;
            color: var(--gray-light);
        }

        .hero-title {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: clamp(58px, 9vw, 110px);
            font-weight: 900;
            font-style: italic;
            line-height: 0.9;
            text-transform: uppercase;
            color: #fff;
            margin-bottom: 28px;
            letter-spacing: -1px;
        }
        .hero-title em {
            display: block;
            font-style: italic;
            color: var(--red);
        }

        .hero-desc {
            font-size: 14px;
            line-height: 1.8;
            color: rgba(255,255,255,0.65);
            max-width: 460px;
            margin-bottom: 44px;
        }

        .hero-cta {
            display: flex;
            flex-wrap: wrap;
            gap: 14px;
            align-items: center;
        }

        /* ===== HERO + STATS BLOCK — shared bg, trapesium putih ===== */
        .hero-stats-block {
            position: relative;
            overflow: hidden;
        }
        .hero-stats-bg {
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse 80% 60% at 50% 40%, rgba(139,92,246,0.15), transparent 60%),
                radial-gradient(ellipse 60% 50% at 80% 80%, rgba(88,28,135,0.12), transparent 50%),
                #080808;
            z-index: 0;
            pointer-events: none;
        }

        /* ===== STATS — white trapezoid, hero bleeds through right ===== */
        #stats {
            background: transparent;
            position: relative;
            z-index: 2;
            margin-top: 0;
        }
        .stats-white-panel {
            position: relative;
            z-index: 1;
            background: #fff;
        }
        .stats-wrap {
            position: relative;
            z-index: 1;
            padding: clamp(28px, 4vw, 48px) 0;
        }
        .stats-inner {
            display: flex;
            justify-content: space-around;
            align-items: center;
            gap: 24px;
            padding-right: clamp(16px, 3vw, 32px);
        }
        @media (max-width: 767px) {
            .stats-inner {
                flex-direction: column;
                align-items: center;
                gap: 24px;
                padding-right: 0;
            }
            .stat-number { font-size: clamp(40px, 14vw, 56px) !important; letter-spacing: -1px !important; }
            .stat-label { font-size: 11px !important; letter-spacing: 2px !important; margin-top: 6px !important; }
        }

        .stat-item {
            text-align: center;
            flex: 1;
        }

        .stat-number {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: clamp(56px, 8vw, 96px);
            font-weight: 900;
            font-style: italic;
            line-height: 1;
            color: #111;
            letter-spacing: -2px;
        }
        .stat-suffix {
            color: var(--red);
            font-style: italic;
        }
        .stat-label {
            font-size: clamp(10px, 1.2vw, 12px);
            font-weight: 800;
            letter-spacing: 2.5px;
            text-transform: uppercase;
            color: #111;
            margin-top: 10px;
        }

        /* ===== KEUNGGULAN / WHY US — black bg, split layout ===== */
        #keunggulan {
            padding: 110px 0;
            min-height: 90vh;
            background: var(--dark-2);
            position: relative;
            overflow: hidden;
        }
        .why-bg-text {
            position: absolute;
            top: -10px;
            right: -20px;
            font-family: 'Barlow Condensed', sans-serif;
            font-size: clamp(80px, 14vw, 160px);
            font-weight: 900;
            font-style: italic;
            text-transform: uppercase;
            color: rgba(255,255,255,0.03);
            line-height: 1;
            pointer-events: none;
            user-select: none;
            white-space: nowrap;
        }

        .keunggulan-layout {
            display: grid;
            grid-template-columns: 1fr;
            gap: 64px;
            align-items: center;
        }
        @media (min-width: 1024px) {
            .keunggulan-layout { grid-template-columns: 1fr 1fr; }
        }

        /* Why Us image — asymmetric composition: photo top-right, red block bottom-left on black */
        .keunggulan-img-wrap {
            position: relative;
            background: var(--dark-2);
            padding-bottom: 70px;
            padding-left: 48px;
            min-height: 480px;
        }
        @media (min-width: 1024px) { .keunggulan-img-wrap { min-height: 580px; } }

        .keunggulan-img-main {
            position: absolute;
            top: 0;
            left: 48px;
            right: 0;
            bottom: 80px;
            width: calc(100% - 48px);
            height: calc(100% - 80px);
            object-fit: cover;
            display: block;
            clip-path: polygon(0 0, calc(100% - 32px) 0, 100% 100%, 32px 100%);
        }
        .keunggulan-img-accent {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 56%;
            height: 22%;
            background: var(--red);
            z-index: 2;
            clip-path: polygon(0 0, calc(100% - 24px) 0, 100% 100%, 24px 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2px 24px;
        }
        .keunggulan-accent-text {
            font-family: 'Inter', sans-serif;
            font-size: clamp(11px, 1.4vw, 15px);
            font-weight: 500;
            color: #fff;
            line-height: 1.6;
            text-align: center;
            max-width: 100%;
        }
        .keunggulan-slide-dots {
            position: absolute;
            bottom: calc(22% + 12px);
            right: 24px;
            z-index: 3;
            display: flex;
            justify-content: center;
            gap: 8px;
            pointer-events: none;
        }
        @media (max-width: 767px) {
            .keunggulan-slide-dots {
                right: auto;
                left: 50%;
                transform: translateX(-50%);
                bottom: calc(32% + 8px);
            }
        }
        .keunggulan-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            border: 2px solid rgba(255,255,255,0.6);
            background: transparent;
            cursor: pointer;
            padding: 0;
            transition: all 0.2s;
            pointer-events: auto;
        }
        .keunggulan-dot.active {
            background: var(--red);
            border-color: var(--red);
        }

        /* ===== LOKASI ===== */
        #lokasi {
            padding: 110px 0;
            background: #fff;
            position: relative;
            overflow: hidden;
        }
        .lokasi-bg-text {
            position: absolute;
            top: -10px;
            right: -10px;
            font-family: 'Barlow Condensed', sans-serif;
            font-size: clamp(80px, 14vw, 160px);
            font-weight: 900;
            font-style: italic;
            text-transform: uppercase;
            color: rgba(0,0,0,0.04);
            line-height: 1;
            pointer-events: none;
            user-select: none;
            white-space: nowrap;
        }
        .lokasi-header {
            text-align: center;
            margin-bottom: 60px;
            position: relative;
        }
        .lokasi-header .section-eyebrow {
            justify-content: center;
            margin-bottom: 14px;
        }
        .lokasi-header h2 {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: clamp(36px, 5.5vw, 72px);
            font-weight: 900;
            font-style: italic;
            text-transform: uppercase;
            line-height: 1.0;
            color: #111;
            margin-bottom: 18px;
        }
        .lokasi-header p {
            font-size: 14px;
            line-height: 1.8;
            color: #666;
            max-width: 520px;
            margin: 0 auto;
        }

        .lokasi-cards {
            display: grid;
            grid-template-columns: 1fr;
            gap: 24px;
        }
        @media (min-width: 768px) { .lokasi-cards { grid-template-columns: repeat(2, 1fr); } }

        .lokasi-card {
            background: #111;
            overflow: hidden;
        }
        .lokasi-card-photo {
            position: relative;
            aspect-ratio: 16/10;
            overflow: hidden;
        }
        .lokasi-card-map {
            position: relative;
            aspect-ratio: 16/9;
            overflow: hidden;
            background: #1a1a1a;
        }
        .lokasi-card-map iframe {
            width: 100%;
            height: 100%;
            display: block;
            filter: grayscale(30%) contrast(1.1);
            transition: filter 0.4s;
        }
        .lokasi-card:hover .lokasi-card-map iframe { filter: grayscale(0%) contrast(1); }
        .lokasi-card-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-top: 16px;
            padding: 10px 20px;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: #fff;
            background: var(--red);
            border: none;
            text-decoration: none;
            transition: background 0.2s;
            font-family: 'Inter', sans-serif;
        }
        .lokasi-card-btn:hover { background: #c41610; }
        .lokasi-card-photo img {
            width: 100%; height: 100%;
            object-fit: cover;
            display: block;
            transition: transform 0.7s cubic-bezier(0.25,0.46,0.45,0.94);
            filter: grayscale(15%);
        }
        .lokasi-card:hover .lokasi-card-photo img { transform: scale(1.05); filter: grayscale(0%); }
        .lokasi-card-photo-overlay {
            position: absolute; inset: 0;
            background: linear-gradient(to bottom, transparent 40%, rgba(0,0,0,0.6) 100%);
        }
        .lokasi-card-body {
            padding: 28px 30px 30px;
        }
        .lokasi-card-name {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 28px;
            font-weight: 900;
            font-style: italic;
            text-transform: uppercase;
            color: #fff;
            margin-bottom: 10px;
            letter-spacing: 0.5px;
        }
        .lokasi-card-desc {
            font-size: 13px;
            line-height: 1.75;
            color: var(--gray);
            margin-bottom: 22px;
        }
        .lokasi-card-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 18px;
            align-items: flex-start;
            padding-top: 18px;
            border-top: 1px solid rgba(255,255,255,0.08);
        }
        .lokasi-meta-item {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            min-width: 0;
        }
        .lokasi-meta-icon {
            flex-shrink: 0;
            margin-top: 2px;
        }
        .lokasi-meta-icon svg { width: 16px; height: 16px; color: var(--red); }
        .lokasi-meta-text {
            font-size: 13px;
            line-height: 1.5;
            color: rgba(255,255,255,0.8);
            font-weight: 500;
        }
        .lokasi-meta-text strong { display: block; font-size: 13px; font-weight: 700; color: #fff; }

        .keunggulan-right {
            position: relative;
        }
        .keunggulan-right h2 {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: clamp(40px, 5.5vw, 72px);
            font-weight: 900;
            font-style: italic;
            text-transform: uppercase;
            line-height: 0.95;
            color: #fff;
            margin-bottom: 20px;
        }
        .keunggulan-right > p {
            font-size: 14px;
            line-height: 1.8;
            color: var(--gray);
            margin-bottom: 36px;
            max-width: 480px;
        }

        .keunggulan-items { display: flex; flex-direction: column; gap: 28px; margin-bottom: 40px; }
        .keunggulan-item { display: flex; gap: 18px; align-items: flex-start; }
        .keunggulan-item-icon {
            flex-shrink: 0;
            width: 44px;
            height: 44px;
            border: 1.5px solid rgba(255,255,255,0.25);
            display: flex; align-items: center; justify-content: center;
        }
        .keunggulan-item-icon svg { width: 20px; height: 20px; color: #fff; }
        .keunggulan-item-title {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 14px;
            font-weight: 800;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: #fff;
            margin-bottom: 6px;
        }
        .keunggulan-item p { font-size: 13px; line-height: 1.75; color: var(--gray); }

        /* ===== LAYANAN / SERVICES ===== */
        #layanan {
            padding: 110px 0;
            background: #fff;
            position: relative;
            overflow: hidden;
        }
        .layanan-bg-text {
            position: absolute;
            top: -20px;
            right: -10px;
            font-family: 'Barlow Condensed', sans-serif;
            font-size: clamp(80px, 15vw, 170px);
            font-weight: 900;
            font-style: italic;
            text-transform: uppercase;
            color: rgba(0,0,0,0.04);
            line-height: 1;
            pointer-events: none;
            user-select: none;
            white-space: nowrap;
        }

        .layanan-header {
            display: flex;
            flex-wrap: wrap;
            align-items: flex-start;
            justify-content: space-between;
            gap: 24px;
            margin-bottom: 52px;
            position: relative;
        }
        .layanan-header h2 {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: clamp(36px, 5vw, 64px);
            font-weight: 900;
            font-style: italic;
            text-transform: uppercase;
            line-height: 1.0;
            color: #111;
        }

        .layanan-cards {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 4px;
        }
        @media (min-width: 768px) { .layanan-cards { grid-template-columns: repeat(2, 1fr); } }
        @media (min-width: 1024px) { .layanan-cards { grid-template-columns: repeat(4, 1fr); } }

        .layanan-card {
            position: relative;
            overflow: hidden;
            aspect-ratio: 3/4;
            background: #111;
            display: block;
            cursor: pointer;
        }
        .layanan-card-img {
            position: absolute;
            inset: 0;
            background: linear-gradient(160deg, #2a1a1a 0%, #0d0d0d 100%);
            overflow: hidden;
        }
        .layanan-card-img img {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.7s cubic-bezier(0.25, 0.46, 0.45, 0.94), opacity 0.5s;
            display: block;
        }
        .layanan-card:hover .layanan-card-img img { transform: scale(1.08); }
        .layanan-card-placeholder-icon {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            border: 2px solid rgba(238,20,177,0.4);
            display: flex; align-items: center; justify-content: center;
        }
        .layanan-card-placeholder-inner {
            width: 32px; height: 32px;
            border-radius: 50%;
            background: rgba(238,20,177,0.65);
        }

        .layanan-card-scrim {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.92) 0%, rgba(0,0,0,0.2) 60%, transparent 100%);
        }
        .layanan-card-body {
            position: absolute;
            bottom: 0; left: 0; right: 0;
            padding: 24px 22px;
        }
        .layanan-card h3 {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 26px;
            font-weight: 900;
            font-style: italic;
            text-transform: uppercase;
            color: #fff;
            margin-bottom: 8px;
            transition: color 0.2s;
        }
        .layanan-card p {
            font-size: 12px;
            line-height: 1.7;
            color: rgba(255,255,255,0.65);
            margin-bottom: 16px;
        }
        .layanan-card-learn {
            display: flex;
            align-items: center;
            gap: 10px;
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: #fff;
            text-decoration: none;
        }
        .layanan-card-learn::before {
            content: '';
            display: inline-block;
            width: 20px;
            height: 2px;
            background: #fff;
            flex-shrink: 0;
            transition: width 0.2s;
        }
        .layanan-card:hover .layanan-card-learn::before { width: 32px; }

        .layanan-card-dots {
            position: absolute;
            top: 12px;
            right: 12px;
            z-index: 5;
            display: flex;
            gap: 6px;
        }
        .layanan-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: rgba(255,255,255,0.4);
            transition: background 0.2s;
        }
        .layanan-dot--active {
            background: var(--red);
        }

        /* ===== GALERI ===== */
        #galeri {
            padding: 110px 0;
            background: var(--dark-2);
            position: relative;
            overflow: hidden;
        }
        .galeri-header {
            display: flex;
            flex-wrap: wrap;
            align-items: flex-end;
            justify-content: space-between;
            gap: 24px;
            margin-bottom: 48px;
        }
        .galeri-header h2 {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: clamp(36px, 5vw, 64px);
            font-weight: 900;
            font-style: italic;
            text-transform: uppercase;
            line-height: 1.0;
            color: #fff;
        }

        .galeri-carousel-wrap {
            position: relative;
            display: flex;
            align-items: center;
            gap: 0;
        }
        .galeri-track {
            display: flex;
            gap: 4px;
            overflow-x: auto;
            scroll-snap-type: x mandatory;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none;
            flex: 1;
        }
        .galeri-track::-webkit-scrollbar { display: none; }
        .galeri-track .galeri-item {
            scroll-snap-align: start;
            flex: 0 0 calc(50% - 2px);
            aspect-ratio: 4/3;
        }
        @media (min-width: 1024px) {
            .galeri-track .galeri-item { flex: 0 0 calc(33.333% - 3px); }
        }
        @media (max-width: 767px) {
            .galeri-track .galeri-item { flex: 0 0 85%; }
        }
        .galeri-arrow {
            position: absolute;
            z-index: 5;
            top: 50%;
            transform: translateY(-50%);
            width: 44px;
            height: 44px;
            border-radius: 50%;
            border: none;
            background: rgba(0,0,0,0.65);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background 0.2s, opacity 0.2s;
            backdrop-filter: blur(4px);
        }
        .galeri-arrow:hover { background: rgba(0,0,0,0.9); }
        .galeri-arrow-left { left: 12px; }
        .galeri-arrow-right { right: 12px; }
        @media (max-width: 767px) {
            .galeri-arrow { width: 36px; height: 36px; }
            .galeri-arrow-left { left: 6px; }
            .galeri-arrow-right { right: 6px; }
        }

        .galeri-item {
            position: relative;
            overflow: hidden;
            aspect-ratio: 4/3;
            cursor: pointer;
            display: block;
            background: var(--dark-3);
            border: none;
            padding: 0;
        }
        @media (min-width: 768px) {
            .galeri-item:first-child { aspect-ratio: unset; }
        }
        .galeri-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.7s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            display: block;
        }
        .galeri-item:hover img { transform: scale(1.07); }
        .galeri-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.1) 45%, transparent 75%);
            opacity: 0.8;
            transition: opacity 0.3s;
        }
        }
        .galeri-item:hover .galeri-overlay { opacity: 1; }
        .galeri-caption {
            position: absolute;
            bottom: 0; left: 0; right: 0;
            padding: 24px;
            transform: translateY(6px);
            transition: transform 0.3s;
        }
        .galeri-item:hover .galeri-caption { transform: translateY(0); }
        .galeri-caption .label-tag { color: var(--red); display: block; margin-bottom: 4px; }
        .galeri-caption h3 {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 22px;
            font-weight: 800;
            font-style: italic;
            text-transform: uppercase;
            color: #fff;
        }

        /* ===== CERITA / TIMELINE ===== */
        #cerita {
            padding: 110px 0;
            background: var(--dark-3);
        }
        .cerita-layout {
            display: grid;
            grid-template-columns: 1fr;
            gap: 60px;
        }
        @media (min-width: 1024px) {
            .cerita-layout { grid-template-columns: 1fr 1fr; align-items: center; }
        }
        .cerita-left h2 {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: clamp(36px, 5vw, 60px);
            font-weight: 900;
            font-style: italic;
            text-transform: uppercase;
            line-height: 0.95;
            color: #fff;
            margin-bottom: 24px;
        }
        .cerita-left p {
            font-size: 14px;
            line-height: 1.8;
            color: var(--gray);
            margin-bottom: 16px;
        }
        .timeline {
            position: relative;
            padding-left: 28px;
            border-left: 2px solid rgba(255,255,255,0.1);
        }
        .timeline-item {
            position: relative;
            padding-bottom: 44px;
        }
        .timeline-item:last-child { padding-bottom: 0; }
        .timeline-dot {
            position: absolute;
            left: -36px; top: 6px;
            width: 14px; height: 14px;
            background: var(--red);
            border: 2px solid var(--dark-3);
        }
        .timeline-item.inactive .timeline-dot { background: #333; border-color: #555; }
        .timeline-item .label-tag { margin-bottom: 8px; display: block; }
        .timeline-item.inactive .label-tag { color: var(--gray); }
        .timeline-item h3 {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 20px;
            font-weight: 800;
            font-style: italic;
            text-transform: uppercase;
            color: #fff;
            margin-bottom: 8px;
        }
        .timeline-item p { font-size: 13px; line-height: 1.75; color: var(--gray); }

        /* ===== QUOTE / CTA BAND ===== */
        #quote-band {
            position: relative;
            overflow: hidden;
        }
        .quote-band-bg {
            position: absolute;
            inset: 0;
            background:
                linear-gradient(to right, rgba(5,5,5,0.75) 0%, rgba(5,5,5,0.4) 60%, transparent 100%),
                linear-gradient(to top, rgba(5,5,5,0.6) 0%, transparent 50%);
        }
        .quote-band-photo {
            position: absolute;
            inset: 0;
            background: #1a0a0a;
            background-size: cover;
            background-position: center;
        }
        .quote-band-content {
            position: relative;
            padding: 100px 0;
            z-index: 1;
        }
        .quote-band-eyebrow {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 20px;
        }
        .quote-band-eyebrow-line { width: 40px; height: 1px; background: var(--gray); }
        .quote-band-eyebrow span {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--red);
        }
        .quote-text {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: clamp(32px, 5vw, 62px);
            font-weight: 900;
            font-style: italic;
            line-height: 1.0;
            color: #fff;
            max-width: 700px;
            margin-bottom: 36px;
            text-transform: uppercase;
        }

        /* ===== LACAK PESANAN ===== */
        #lacak {
            padding: 110px 0;
            background: #f5f5f5;
        }
        .lacak-label { color: var(--red); display: block; margin-bottom: 16px; }
        .lacak-title {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: clamp(36px, 5vw, 60px);
            font-weight: 900;
            font-style: italic;
            text-transform: uppercase;
            color: #111;
            line-height: 1.0;
            margin-bottom: 16px;
        }
        .lacak-desc {
            font-size: 14px;
            line-height: 1.8;
            color: #666;
            max-width: 480px;
            margin-bottom: 40px;
        }
        /* Two-column layout: left=form, right=result */
        .lacak-layout {
            display: grid;
            grid-template-columns: 1fr;
            gap: 48px;
            align-items: start;
        }
        @media (min-width: 1024px) {
            .lacak-layout { grid-template-columns: 1fr 1fr; gap: 64px; }
        }
        .lacak-left {}
        .lacak-right {
            position: sticky;
            top: 88px; /* below fixed navbar */
        }
        .track-form {
            display: flex;
            flex-direction: column;
            gap: 0;
            max-width: 600px;
        }
        @media (min-width: 560px) { .track-form { flex-direction: row; } }
        .track-input {
            flex: 1;
            padding: 18px 24px;
            background: #fff;
            border: 2px solid #ddd;
            border-right: none;
            font-size: 15px;
            font-weight: 700;
            font-family: 'Inter', sans-serif;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: #111;
            outline: none;
            transition: border-color 0.2s;
            border-radius: 0;
        }
        @media (max-width: 559px) { .track-input { border-right: 2px solid #ddd; border-bottom: none; } }
        .track-input:focus { border-color: var(--red); }
        .track-input::placeholder { color: #aaa; font-weight: 400; letter-spacing: 1px; }
        .track-btn {
            background: var(--red);
            border: 2px solid var(--red);
            color: #fff;
            padding: 18px 36px;
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 13px;
            font-weight: 800;
            font-style: italic;
            letter-spacing: 2px;
            text-transform: uppercase;
            cursor: pointer;
            transition: background 0.2s;
            white-space: nowrap;
        }
        .track-btn:hover { background: var(--red-dark); }
        .track-btn:disabled { opacity: 0.7; cursor: not-allowed; }

        /* Track Result */
        .track-error {
            background: #fff3f3;
            border: 2px solid rgba(238,20,177,0.2);
            padding: 20px 24px;
            max-width: 600px;
            margin-top: 24px;
            display: flex;
            align-items: center;
            gap: 16px;
        }
        .track-error-icon {
            width: 36px; height: 36px;
            background: var(--red);
            color: #fff;
            display: flex; align-items: center; justify-content: center;
            font-weight: 900; font-size: 18px;
            flex-shrink: 0;
        }
        .track-error h4 { font-size: 15px; font-weight: 700; color: #111; margin-bottom: 4px; }
        .track-error p { font-size: 13px; color: #666; }

        .track-result {
            /* no extra margin-top since it lives in its own column */
        }
        .track-result-header {
            background: #111;
            padding: 24px 28px;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 2px;
        }
        .track-result-code-label {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--gray);
            margin-bottom: 4px;
        }
        .track-result-code {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 28px;
            font-weight: 900;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: #fff;
        }
        .track-status-badge {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            padding: 8px 18px;
            border: 2px solid;
        }
        .track-info {
            background: #fff;
            padding: 24px 28px;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 2px;
        }
        .track-info-label {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--gray);
            display: block; margin-bottom: 4px;
        }
        .track-info-val {
            font-weight: 700;
            font-size: 15px;
            color: #111;
        }
        .track-timeline-wrap {
            background: #fff;
            padding: 28px;
        }
        .track-timeline-title {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 20px;
            font-weight: 900;
            font-style: italic;
            text-transform: uppercase;
            color: #111;
            margin-bottom: 28px;
        }
        .track-timeline {
            position: relative;
            padding-left: 28px;
            border-left: 2px solid #e0e0e0;
        }
        .track-timeline-item {
            position: relative;
            padding-bottom: 32px;
        }
        .track-timeline-item:last-child { padding-bottom: 0; }
        .track-timeline-dot {
            position: absolute;
            left: -37px; top: 4px;
            width: 16px; height: 16px;
        }
        .track-timeline-dot.active { background: var(--red); }
        .track-timeline-dot.inactive { background: #ccc; }
        .track-timeline-item h4 {
            font-weight: 700;
            font-size: 15px;
            color: #111;
            margin-bottom: 4px;
        }
        .track-timeline-date {
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 1px;
            color: var(--gray);
            text-transform: uppercase;
        }
        .track-timeline-item p {
            font-size: 13px;
            line-height: 1.7;
            color: #555;
            margin-top: 6px;
        }
        .track-timeline-img {
            margin-top: 12px;
            max-width: 320px;
            cursor: pointer;
        }
        .track-timeline-img img {
            width: 100%;
            height: 160px;
            object-fit: cover;
            border: 2px solid #eee;
            display: block;
        }

        /* ===== TESTIMONI ===== */
        #testimoni {
            padding: 110px 0;
            background: var(--dark-2);
        }
        .testi-header {
            display: flex;
            flex-wrap: wrap;
            align-items: flex-end;
            justify-content: space-between;
            gap: 24px;
            margin-bottom: 48px;
        }
        .testi-header h2 {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: clamp(36px, 5vw, 64px);
            font-weight: 900;
            font-style: italic;
            text-transform: uppercase;
            line-height: 1.0;
            color: #fff;
        }
        .testi-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 24px;
        }
        @media (min-width: 640px) { .testi-grid { grid-template-columns: repeat(3, 1fr); } }
        .testi-item {
            position: relative;
            cursor: pointer;
            display: block;
            background: var(--dark-3);
            border: 1px solid rgba(255,255,255,0.06);
            padding: 0;
            overflow: hidden;
            transition: border-color 0.3s;
        }
        .testi-item:hover { border-color: rgba(255,255,255,0.15); }
        .testi-item img {
            width: 100%;
            height: 280px;
            object-fit: contain;
            transition: transform 0.6s ease;
            display: block;
            background: var(--dark-3);
        }
        .testi-item:hover img { transform: scale(1.02); }
        .testi-overlay {
            position: absolute; inset: 0;
            background: rgba(0,0,0,0.15);
            transition: background 0.3s;
            pointer-events: none;
        }
        .testi-item:hover .testi-overlay { background: rgba(0,0,0,0.05); }

        .testi-cta {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 16px;
            margin-top: 48px;
        }
        .testi-cta-link {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            background: transparent;
            color: #fff;
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 13px;
            font-weight: 800;
            font-style: italic;
            letter-spacing: 2.5px;
            text-transform: uppercase;
            padding: 15px 34px;
            text-decoration: none;
            border: 2px solid rgba(255,255,255,0.4);
            transition: border-color 0.25s, background 0.25s, transform 0.2s;
        }
        .testi-cta-link:hover {
            border-color: #fff;
            background: rgba(255,255,255,0.05);
            transform: translateY(-2px);
        }
        .testi-cta-link svg {
            width: 18px;
            height: 18px;
            flex-shrink: 0;
        }
        .testi-cta-link .testi-cta-arrow {
            width: 0;
            overflow: hidden;
            transition: width 0.3s;
        }
        .testi-cta-link:hover .testi-cta-arrow { width: 18px; }

        /* ===== KONTAK / CTA ===== */
        #kontak {
            padding: 110px 0;
            background: var(--dark-3);
        }
        .kontak-layout {
            display: grid;
            grid-template-columns: 1fr;
            gap: 60px;
        }
        @media (min-width: 1024px) {
            .kontak-layout { grid-template-columns: 1fr 1fr; align-items: center; }
        }
        .kontak-left h2 {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: clamp(36px, 5vw, 62px);
            font-weight: 900;
            font-style: italic;
            text-transform: uppercase;
            line-height: 1.0;
            color: #fff;
            margin-bottom: 18px;
        }
        .kontak-left p {
            font-size: 14px;
            line-height: 1.8;
            color: var(--gray);
            margin-bottom: 32px;
            max-width: 420px;
        }
        .kontak-socials {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }
        .kontak-right { display: flex; flex-direction: column; gap: 2px; }
        .kontak-card {
            background: var(--dark-4);
            padding: 28px 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            text-decoration: none;
            border: 1px solid var(--border);
            transition: background 0.25s, border-color 0.25s;
        }
        .kontak-card:hover { background: #222; border-color: var(--red); }
        .kontak-card-label {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--gray);
            margin-bottom: 6px;
            display: block;
        }
        .kontak-card-number {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 26px;
            font-weight: 800;
            font-style: italic;
            color: #fff;
            letter-spacing: 1px;
        }
        .kontak-card-arrow {
            width: 36px;
            height: 36px;
            border: 1px solid rgba(255,255,255,0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: border-color 0.25s, background 0.25s;
        }
        .kontak-card-arrow svg { width: 16px; height: 16px; color: rgba(255,255,255,0.4); transition: color 0.25s; }
        .kontak-card:hover .kontak-card-arrow { border-color: var(--red); background: var(--red); }
        .kontak-card:hover .kontak-card-arrow svg { color: #fff; }

        /* ===== FOOTER ===== */
        footer {
            background: #070707;
            border-top: 1px solid var(--border);
        }
        .footer-inner {
            padding: 64px 0 48px;
            display: grid;
            grid-template-columns: 1fr;
            gap: 40px;
        }
        @media (min-width: 640px) { .footer-inner { grid-template-columns: repeat(2, 1fr); } }
        @media (min-width: 1024px) { .footer-inner { grid-template-columns: 2fr 1fr 1fr 1fr; } }
        .footer-brand-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 18px;
            text-decoration: none;
        }
        .footer-brand-icon {
            width: 32px; height: 32px;
            background: var(--red);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
        }
        .footer-brand-icon svg { width: 16px; height: 16px; color: #fff; }
        .footer-brand-name {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 20px;
            font-weight: 800;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: #fff;
        }
        .footer-brand-name span { color: var(--red); }
        .footer-desc {
            font-size: 13px;
            line-height: 1.8;
            color: var(--gray);
            max-width: 280px;
        }
        .footer-col-title {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 2.5px;
            text-transform: uppercase;
            color: var(--gray);
            margin-bottom: 20px;
        }
        .footer-col ul { list-style: none; }
        .footer-col ul li { margin-bottom: 12px; }
        .footer-col ul a {
            font-size: 13px;
            color: #aaa;
            text-decoration: none;
            transition: color 0.2s;
        }
        .footer-col ul a:hover { color: #fff; }
        .footer-col ul li span { font-size: 13px; color: #aaa; }
        .footer-bottom {
            border-top: 1px solid var(--border);
            padding: 20px 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            text-align: center;
        }
        @media (min-width: 640px) {
            .footer-bottom { flex-direction: row; justify-content: space-between; text-align: left; }
        }
        .footer-bottom p { font-size: 12px; color: #555; }

        /* ===== LIGHTBOX ===== */
        .lightbox-overlay {
            position: fixed; inset: 0;
            z-index: 200;
            background: rgba(0,0,0,0.96);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 16px;
        }
        .lightbox-close {
            position: absolute;
            top: 20px; right: 24px;
            background: none;
            border: none;
            color: rgba(255,255,255,0.6);
            font-size: 36px;
            cursor: pointer;
            line-height: 1;
            transition: color 0.2s;
        }
        .lightbox-close:hover { color: #fff; }
        .lightbox-content {
            max-width: 900px;
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 16px;
        }
        .lightbox-content img {
            max-width: 100%;
            max-height: 80vh;
            object-fit: contain;
            display: block;
        }
        .lightbox-title {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 20px;
            font-weight: 700;
            font-style: italic;
            text-transform: uppercase;
            color: #fff;
            letter-spacing: 1px;
        }

        /* ===== ANIMATIONS ===== */
        @keyframes heroRise {
            from { opacity: 0; transform: translateY(40px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .hero-anim-1 { animation: heroRise 1s cubic-bezier(0.22, 1, 0.36, 1) 0.05s both; }
        .hero-anim-2 { animation: heroRise 1s cubic-bezier(0.22, 1, 0.36, 1) 0.15s both; }
        .hero-anim-3 { animation: heroRise 1s cubic-bezier(0.22, 1, 0.36, 1) 0.28s both; }
        .hero-anim-4 { animation: heroRise 1s cubic-bezier(0.22, 1, 0.36, 1) 0.42s both; }

        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        @media (prefers-reduced-motion: reduce) {
            * { animation: none !important; transition: none !important; }
        }
        [x-cloak] { display: none !important; }

        /* ============================================================
           MOBILE RESPONSIVE OVERRIDES — max-width: 767px
        ============================================================ */
        @media (max-width: 767px) {

            /* --- Hamburger button --- */
            .nav-hamburger {
                display: flex;
                flex-direction: column;
                justify-content: center;
                gap: 5px;
                width: 40px;
                height: 40px;
                background: none;
                border: 1px solid rgba(255,255,255,0.15);
                cursor: pointer;
                padding: 8px 9px;
                flex-shrink: 0;
            }
            .nav-hamburger span {
                display: block;
                width: 100%;
                height: 2px;
                background: #fff;
                transition: transform 0.25s, opacity 0.2s;
                transform-origin: center;
            }
            .nav-hamburger.open span:nth-child(1) { transform: translateY(7px) rotate(45deg); }
            .nav-hamburger.open span:nth-child(2) { opacity: 0; }
            .nav-hamburger.open span:nth-child(3) { transform: translateY(-7px) rotate(-45deg); }

            /* --- Mobile menu drawer --- */
            .mobile-menu {
                position: fixed;
                top: 72px;
                left: 0; right: 0;
                background: rgba(10,10,10,0.98);
                backdrop-filter: blur(24px);
                border-top: 1px solid rgba(255,255,255,0.06);
                z-index: 99;
                padding: 24px 24px 32px;
                display: flex;
                flex-direction: column;
                gap: 0;
                transform: translateY(-10px);
                opacity: 0;
                pointer-events: none;
                transition: transform 0.25s cubic-bezier(0.22,1,0.36,1), opacity 0.2s;
            }
            .mobile-menu.open {
                transform: translateY(0);
                opacity: 1;
                pointer-events: all;
            }
            .mobile-menu a {
                display: block;
                color: rgba(255,255,255,0.75);
                font-size: 15px;
                font-weight: 700;
                letter-spacing: 1.5px;
                text-transform: uppercase;
                text-decoration: none;
                padding: 14px 0;
                border-bottom: 1px solid rgba(255,255,255,0.06);
                transition: color 0.2s;
            }
            .mobile-menu a:last-child { border-bottom: none; }
            .mobile-menu a:hover { color: #fff; }
            .mobile-menu-cta {
                margin-top: 20px;
                display: flex;
                flex-direction: column;
                gap: 10px;
            }
            .mobile-menu-cta a {
                text-align: center;
                border-bottom: none !important;
                padding: 14px !important;
            }

            /* --- Section spacing tighter on mobile --- */
            #keunggulan, #layanan, #galeri, #cerita, #lacak, #testimoni, #kontak { padding: 72px 0; }
            #lokasi { padding: 72px 0; }
            #quote-band .quote-band-content { padding: 72px 0; }
            #quote-band .quote-band-eyebrow { justify-content: center; }
            #quote-band .quote-text { text-align: center; margin-left: auto; margin-right: auto; }
            #quote-band .btn-red { margin: 0 auto; display: flex; width: fit-content; }

            /* --- Hero --- */
            #top > .container-xl {
                padding-top: 80px !important;
                padding-bottom: 24px !important;
            }
            #top h1 { font-size: clamp(42px, 11vw, 72px) !important; margin-bottom: 16px !important; }
            #top .hero-anim-3 { font-size: 14px !important; margin-bottom: 24px !important; }

            /* --- Stats --- */
            .stats-wrap { padding: 40px 0; }

            /* --- Keunggulan Why Us image --- */
            .keunggulan-img-wrap {
                min-height: 300px !important;
                padding-bottom: 0;
                padding-left: 0;
            }
            .keunggulan-img-main {
                left: 0 !important;
                width: 100% !important;
            }
            .keunggulan-img-accent {
                width: 70% !important;
                height: 32% !important;
                padding: 10px 16px !important;
            }
            .keunggulan-accent-text {
                font-size: clamp(10px, 3.5vw, 13px) !important;
                letter-spacing: 0 !important;
            }

            /* --- Layanan cards 1 col on very small screens --- */
            .layanan-cards { grid-template-columns: 1fr; }
            .layanan-card { aspect-ratio: unset; min-height: 320px; }

            /* --- Galeri grid --- */

            /* --- Lokasi cards --- */
            .lokasi-cards { grid-template-columns: 1fr; }
            .lokasi-card-body { padding: 20px; }
            .lokasi-card-meta { flex-direction: column; gap: 14px; }

            /* --- Track form: full width stacked --- */
            .track-form { max-width: 100%; flex-direction: column; }
            .track-input { border-right: 2px solid #ddd !important; border-bottom: none !important; }
            .track-btn { width: 100%; text-align: center; justify-content: center; }
            .track-error { max-width: 100%; }

            /* --- Lacak layout: hide placeholder on mobile, stack vertically --- */
            .lacak-right [x-show*="!orderData"] { display: none !important; }

            /* --- Testimoni grid 1 col --- */
            .testi-grid { grid-template-columns: 1fr; }
            .testi-cta { flex-direction: column; align-items: stretch; }
            .testi-cta-link { text-align: center; justify-content: center; }

            /* --- Kontak layout 1 col --- */
            .kontak-layout { grid-template-columns: 1fr !important; gap: 40px !important; }
            .kontak-card-number { font-size: 20px !important; }
            .kontak-socials { flex-direction: column; }
            .kontak-socials a { text-align: center; justify-content: center; }

            /* --- Footer 1 col --- */
            .footer-inner { grid-template-columns: 1fr !important; gap: 32px; }

            /* --- Hide nav-links on mobile (replaced by hamburger) --- */
            .nav-links { display: none !important; }
        }

        /* Show hamburger and mobile menu only on mobile */
        .nav-hamburger, .mobile-menu { display: none; }
        @media (max-width: 767px) {
            .nav-hamburger { display: flex; }
            .mobile-menu { display: flex; }
            .nav-cta-main { display: none !important; } /* hidden on mobile, CTA in drawer instead */
        }

        /* ===== VIDEO PROSES SECTION ===== */
        .video-container {
            position: relative;
            padding-bottom: 56.25%; /* 16:9 */
            height: 0;
            overflow: hidden;
            border-radius: 4px;
        }
        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
        }
        @media (max-width: 640px) {
            #video-proses {
                padding: 60px 0 !important;
            }
        }
    </style>
</head>
<body x-data="suryaSite()">

    <!-- ===== HEADER ===== -->
    <header id="main-header" :class="scrolled ? 'scrolled' : ''">
        <nav class="nav-inner">
            <a href="#top" class="nav-logo">
                <img src="/assets/01-logo-suryapainting18.png" alt="SuryaPainting18" style="height:36px;width:auto;">
            </a>

            <div class="nav-links">
                <a href="#keunggulan">Keunggulan</a>
                <a href="#layanan">Layanan</a>
                <a href="#galeri">Galeri</a>
                <a href="#cerita">Cerita</a>
                <a href="#lokasi">Lokasi</a>
                <a href="#lacak">Lacak Pesanan</a>
            </div>

            <div class="nav-actions">
                @auth
                    <a href="{{ route('admin.dashboard') }}" style="color:rgba(255,255,255,0.6);font-size:12px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;text-decoration:none;">Dashboard</a>
                @endauth
                <!-- Hamburger (mobile only) -->
                <button class="nav-hamburger" :class="mobileMenuOpen ? 'open' : ''"
                        @click="mobileMenuOpen = !mobileMenuOpen"
                        aria-label="Menu">
                    <span></span><span></span><span></span>
                </button>
                <!-- CTA button (desktop only) -->
                <a href="#kontak" class="btn-red nav-cta-main">
                    Pesan Sekarang
                </a>
            </div>
        </nav>

        <!-- Mobile Menu Drawer -->
        <div class="mobile-menu" :class="mobileMenuOpen ? 'open' : ''">
            <a href="#keunggulan" @click="mobileMenuOpen=false">Keunggulan</a>
            <a href="#layanan" @click="mobileMenuOpen=false">Layanan</a>
            <a href="#galeri" @click="mobileMenuOpen=false">Galeri</a>
            <a href="#cerita" @click="mobileMenuOpen=false">Cerita</a>
            <a href="#lokasi" @click="mobileMenuOpen=false">Lokasi</a>
            <a href="#lacak" @click="mobileMenuOpen=false">Lacak Pesanan</a>
            <div class="mobile-menu-cta">
                <a href="#kontak" class="btn-red" @click="mobileMenuOpen=false">Pesan Sekarang</a>
            </div>
        </div>
    </header>

    <!-- ===== HERO + STATS ===== -->
    <div class="hero-stats-block">
        <div class="hero-stats-bg" aria-hidden="true"></div>

        <section id="top">
            <!-- Decorative bottom-left diagonal -->
            {{-- <div style="position:absolute;bottom:0;left:0;width:0;height:0;border-style:solid;border-width:0 0 72px 120px;border-color:transparent transparent rgba(238,20,177,0.5) transparent;z-index:2;"></div> --}}

            <!-- Content -->
            <div class="container-xl">
            <div style="max-width:960px;margin:0 auto;text-align:center;">
                <div class="hero-eyebrow hero-anim-1" style="justify-content:center;">
                    <span>Cat Kendaraan — Sejak 2014 · Bekasi &amp; Cikarang</span>
                </div>

                <h1 style="font-family:'Barlow Condensed',sans-serif;font-size:clamp(53px,8.8vw,106px);font-weight:900;font-style:italic;line-height:0.85;text-transform:uppercase;color:#fff;margin-bottom:20px;letter-spacing:-0.5px;" class="hero-anim-2">
                    Cat Velg &amp; Body Motor
                    <span style="display:block;font-style:italic;color:var(--red);">Jadi Istimewa.</span>
                </h1>

                <p style="font-size:17px;line-height:1.65;color:rgba(255,255,255,0.6);max-width:600px;margin:0 auto 36px;" class="hero-anim-3">
                    Spesialis repaint velg, body, fairing &amp; tangki dengan standar SOP pabrik.
                    Hasil rapi, presisi, mengkilap, dan tahan lama — warna standar maupun custom sesuai keinginanmu.
                </p>

                <div style="display:flex;flex-wrap:wrap;gap:14px;align-items:center;justify-content:center;" class="hero-anim-4">
                    <a href="#kontak" class="btn-red">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                        Konsultasi Gratis
                    </a>
                    <a href="#lacak" class="btn-outline">Lacak Pesanan</a>
                </div>
            </div>
        </div>
        </section>

        <!-- ===== STATS STRIP — white trapezoid, hero continues on right ===== -->
        <section id="stats">
            <div class="stats-white-panel">
                <div class="container-xl stats-wrap">
                    <div class="stats-inner">
                        <div class="stat-item">
                            <div class="stat-number">10<span class="stat-suffix">+</span></div>
                            <div class="stat-label">Tahun Pengalaman</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">5.000<span class="stat-suffix">+</span></div>
                            <div class="stat-label">Pelanggan Puas</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">99<span class="stat-suffix">%</span></div>
                            <div class="stat-label">Kepuasan Pelanggan</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- ===== KEUNGGULAN / WHY US ===== -->
    <section id="keunggulan">
        <div class="why-bg-text">WHY US</div>
        <div class="container-xl">
            <div class="keunggulan-layout">
                <!-- Image side — slideshow -->
                <div class="keunggulan-img-wrap">
                    <img :src="keunggulanSlides[keunggulanSlide].src" alt="Hasil pengecatan SuryaPainting18" class="keunggulan-img-main" loading="lazy">
                    <div class="keunggulan-img-accent"><span class="keunggulan-accent-text" x-text="keunggulanSlides[keunggulanSlide].desc"></span></div>
                    <div class="keunggulan-slide-dots">
                        <template x-for="(s, i) in keunggulanSlides" :key="i">
                            <button type="button" class="keunggulan-dot" :class="{ active: keunggulanSlide === i }" @click="keunggulanSlide = i" :aria-label="'Slide ' + (i+1)"></button>
                        </template>
                    </div>
                </div>

                <!-- Text side -->
                <div class="keunggulan-right">
                    <div class="section-eyebrow">
                        <div class="section-eyebrow-line"></div>
                        <span class="label-tag">Keunggulan Kami</span>
                    </div>
                    <h2>Kenapa<span style="color:var(--red);"> SuryaPainting18?</span></h2>
                    <p>Tiga prinsip yang kami pegang di setiap pengerjaan — tanpa jalan pintas, tanpa kompromi pada kualitas.</p>

                    <div class="keunggulan-items">
                        <div class="keunggulan-item">
                            <div class="keunggulan-item-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 11 12 14 22 4"/><path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"/></svg>
                            </div>
                            <div>
                                <div class="keunggulan-item-title">SOP Standar Pabrik</div>
                                <p>Setiap tahap mengikuti prosedur layaknya lini produksi pabrik. Tidak ada langkah yang dilewati.</p>
                            </div>
                        </div>
                        <div class="keunggulan-item">
                            <div class="keunggulan-item-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                            </div>
                            <div>
                                <div class="keunggulan-item-title">Bahan Berkualitas</div>
                                <p>Kami hanya memakai cat dan material kelas atas. Pigmen pekat, daya rekat kuat, dan clear coat yang menjaga kilap bertahan lama.</p>
                            </div>
                        </div>
                        <div class="keunggulan-item">
                            <div class="keunggulan-item-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M8 14s1.5 2 4 2 4-2 4-2"/><line x1="9" y1="9" x2="9.01" y2="9"/><line x1="15" y1="9" x2="15.01" y2="9"/></svg>
                            </div>
                            <div>
                                <div class="keunggulan-item-title">Rapi &amp; Tahan Lama</div>
                                <p>Hasil akhir presisi di setiap sudut, permukaan rata mengkilap, dan warna yang awet. Motor tampil lebih fresh, bersih, dan menarik.</p>
                            </div>
                        </div>
                    </div>

                    <a href="#kontak" class="btn-red">Konsultasi Sekarang</a>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== LAYANAN / SERVICES ===== -->
    <section id="layanan">
        <div class="layanan-bg-text">SERVICES</div>
        <div class="container-xl" style="position:relative;">
            <!-- Header -->
            <div class="layanan-header">
                <div>
                    <div class="section-eyebrow">
                        <div class="section-eyebrow-line" style="background:var(--red);"></div>
                        <span class="label-tag">Layanan Kami</span>
                    </div>
                    <h2>Dari Velg Sampai<br><span style="color:var(--red);">Fairing.</span></h2>
                </div>
                <p style="font-size:14px;line-height:1.8;color:#666;max-width:360px;align-self:flex-end;">Kami mengerjakan semua kebutuhan pengecatan kendaraan motor Anda dengan presisi tinggi dan bahan terbaik.</p>
            </div>

            <!-- Cards -->
            <div class="layanan-cards">
                <a href="#kontak" class="layanan-card" x-data="layananSlider(['/assets/velg.jpeg', '/assets/velg2.jpeg', '/assets/velg3.jpeg'])" style="text-decoration:none;color:inherit;display:block;">
                    <div class="layanan-card-img">
                        <img :src="images[current]" alt="Velg Motor" loading="lazy">
                    </div>
                    <div class="layanan-card-dots">
                        <template x-for="(img, i) in images" :key="i">
                            <span class="layanan-dot" :class="{ 'layanan-dot--active': current === i }"></span>
                        </template>
                    </div>
                    <div class="layanan-card-scrim"></div>
                    <div class="layanan-card-body">
                        <h3>Velg Motor</h3>
                        <p>Repaint velg dengan pilihan warna standar, candy, atau custom sesuai konsep motormu.</p>
                        <span class="layanan-card-learn">Tanya Harga</span>
                    </div>
                </a>
                <a href="#kontak" class="layanan-card" x-data="layananSlider(['/assets/body.jpeg', '/assets/produk1.jpeg'])" style="text-decoration:none;color:inherit;display:block;">
                    <div class="layanan-card-img">
                        <img :src="images[current]" alt="Body Motor" loading="lazy">
                    </div>
                    <div class="layanan-card-dots">
                        <template x-for="(img, i) in images" :key="i">
                            <span class="layanan-dot" :class="{ 'layanan-dot--active': current === i }"></span>
                        </template>
                    </div>
                    <div class="layanan-card-scrim"></div>
                    <div class="layanan-card-body">
                        <h3>Body Motor</h3>
                        <p>Pengecatan full body atau part tertentu dengan finishing rapi dan warna tahan lama.</p>
                        <span class="layanan-card-learn">Tanya Harga</span>
                    </div>
                </a>
                <a href="#kontak" class="layanan-card" x-data="layananSlider(['/assets/fairing.jpeg', '/assets/produk3.jpeg'])" style="text-decoration:none;color:inherit;display:block;">
                    <div class="layanan-card-img">
                        <img :src="images[current]" alt="Fairing" loading="lazy">
                    </div>
                    <div class="layanan-card-dots">
                        <template x-for="(img, i) in images" :key="i">
                            <span class="layanan-dot" :class="{ 'layanan-dot--active': current === i }"></span>
                        </template>
                    </div>
                    <div class="layanan-card-scrim"></div>
                    <div class="layanan-card-body">
                        <h3>Fairing</h3>
                        <p>Cat fairing dengan presisi tinggi, warna konsisten, dan permukaan mulus tanpa noda.</p>
                        <span class="layanan-card-learn">Tanya Harga</span>
                    </div>
                </a>
                <a href="#kontak" class="layanan-card" x-data="layananSlider(['/assets/carbon1.jpeg', '/assets/carbon2.jpeg', '/assets/carbon3.jpeg', '/assets/carbon4.jpeg'])" style="text-decoration:none;color:inherit;display:block;">
                    <div class="layanan-card-img">
                        <img :src="images[current]" alt="Carbon WTP" loading="lazy">
                    </div>
                    <div class="layanan-card-dots">
                        <template x-for="(img, i) in images" :key="i">
                            <span class="layanan-dot" :class="{ 'layanan-dot--active': current === i }"></span>
                        </template>
                    </div>
                    <div class="layanan-card-scrim"></div>
                    <div class="layanan-card-body">
                        <h3>Carbon WTP</h3>
                        <p>Finishing carbon WTP premium dengan tampilan serat karbon yang tajam, mengkilap, dan elegan untuk motor kesayanganmu.</p>
                        <span class="layanan-card-learn">Tanya Harga</span>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <!-- ===== GALERI ===== -->
    <section id="galeri">
        <div class="container-xl">
            <div class="galeri-header">
                <div>
                    <div class="section-eyebrow">
                        <div class="section-eyebrow-line"></div>
                        <span class="label-tag">Galeri Hasil</span>
                    </div>
                    <h2 style="font-family:'Barlow Condensed',sans-serif;font-size:clamp(36px,5vw,64px);font-weight:900;font-style:italic;text-transform:uppercase;line-height:1.0;color:#fff;">
                        Hasil Nyata,<br><span style="color:var(--red);">Bukan</span> Sekadar Janji.
                    </h2>
                </div>
                <p style="font-size:14px;line-height:1.8;color:var(--gray);max-width:380px;align-self:flex-end;">Beberapa hasil repaint velg dan body motor yang telah kami kerjakan. Setiap detail dikerjakan dengan presisi dan finishing mengkilap.</p>
            </div>

            <div class="galeri-carousel-wrap" x-data="{}">
                <button type="button" class="galeri-arrow galeri-arrow-left" x-ref="prevBtn" @click="$refs.track.scrollBy({left: -$refs.track.querySelector('.galeri-item').offsetWidth - 4, behavior:'smooth'})" aria-label="Sebelumnya">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><polyline points="15 18 9 12 15 6"/></svg>
                </button>
                <div class="galeri-track" x-ref="track">
                    <button type="button" class="galeri-item"
                            @click="openLightbox('/assets/velg.jpeg', 'Hasil Repaint — Velg Motor')">
                        <img src="/assets/velg.jpeg" alt="Hasil repaint velg motor SuryaPainting18" loading="lazy">
                        <div class="galeri-overlay"></div>
                        <div class="galeri-caption">
                            <span class="label-tag">Velg</span>
                            <h3>Repaint Velg Custom</h3>
                        </div>
                    </button>
                    <button type="button" class="galeri-item"
                            @click="openLightbox('/assets/carbon2.jpeg', 'Carbon WTP — Hasil 2')">
                        <img src="/assets/carbon2.jpeg" alt="Hasil Carbon WTP SuryaPainting18" loading="lazy">
                        <div class="galeri-overlay"></div>
                        <div class="galeri-caption">
                            <span class="label-tag">Carbon WTP</span>
                            <h3>Carbon WTP 2</h3>
                        </div>
                    </button>
                    <button type="button" class="galeri-item"
                            @click="openLightbox('/assets/body.jpeg', 'Hasil Repaint — Body Motor')">
                        <img src="/assets/body.jpeg" alt="Hasil repaint body motor SuryaPainting18" loading="lazy">
                        <div class="galeri-overlay"></div>
                        <div class="galeri-caption">
                            <span class="label-tag">Body</span>
                            <h3>Repaint Body Motor</h3>
                        </div>
                    </button>
                    <button type="button" class="galeri-item"
                            @click="openLightbox('/assets/produk1.jpeg', 'Hasil Repaint — Body Motor')">
                        <img src="/assets/produk1.jpeg" alt="Hasil repaint body motor SuryaPainting18" loading="lazy">
                        <div class="galeri-overlay"></div>
                        <div class="galeri-caption">
                            <span class="label-tag">Body</span>
                            <h3>Repaint Body Motor</h3>
                        </div>
                    </button>
                    <button type="button" class="galeri-item"
                            @click="openLightbox('/assets/fairing.jpeg', 'Hasil Repaint — Fairing Motor')">
                        <img src="/assets/fairing.jpeg" alt="Hasil repaint fairing motor SuryaPainting18" loading="lazy">
                        <div class="galeri-overlay"></div>
                        <div class="galeri-caption">
                            <span class="label-tag">Fairing</span>
                            <h3>Repaint Fairing Motor</h3>
                        </div>
                    </button>
                    <button type="button" class="galeri-item"
                            @click="openLightbox('/assets/carbon4.jpeg', 'Carbon WTP — Hasil 4')">
                        <img src="/assets/carbon4.jpeg" alt="Hasil Carbon WTP SuryaPainting18" loading="lazy">
                        <div class="galeri-overlay"></div>
                        <div class="galeri-caption">
                            <span class="label-tag">Carbon WTP</span>
                            <h3>Carbon WTP 4</h3>
                        </div>
                    </button>
                    <button type="button" class="galeri-item"
                            @click="openLightbox('/assets/velg2.jpeg', 'Hasil Repaint — Velg Motor')">
                        <img src="/assets/velg2.jpeg" alt="Hasil repaint velg motor SuryaPainting18" loading="lazy">
                        <div class="galeri-overlay"></div>
                        <div class="galeri-caption">
                            <span class="label-tag">Velg</span>
                            <h3>Repaint Velg Custom 2</h3>
                        </div>
                    </button>
                    <button type="button" class="galeri-item"
                            @click="openLightbox('/assets/produk3.jpeg', 'Hasil Repaint — Fairing')">
                        <img src="/assets/produk3.jpeg" alt="Hasil repaint fairing SuryaPainting18" loading="lazy">
                        <div class="galeri-overlay"></div>
                        <div class="galeri-caption">
                            <span class="label-tag">Fairing</span>
                            <h3>Repaint Fairing</h3>
                        </div>
                    </button>
                    <button type="button" class="galeri-item"
                            @click="openLightbox('/assets/carbon1.jpeg', 'Carbon WTP — Hasil 1')">
                        <img src="/assets/carbon1.jpeg" alt="Hasil Carbon WTP SuryaPainting18" loading="lazy">
                        <div class="galeri-overlay"></div>
                        <div class="galeri-caption">
                            <span class="label-tag">Carbon WTP</span>
                            <h3>Carbon WTP 1</h3>
                        </div>
                    </button>
                    <button type="button" class="galeri-item"
                            @click="openLightbox('/assets/velg3.jpeg', 'Hasil Repaint — Velg Motor')">
                        <img src="/assets/velg3.jpeg" alt="Hasil repaint velg motor SuryaPainting18" loading="lazy">
                        <div class="galeri-overlay"></div>
                        <div class="galeri-caption">
                            <span class="label-tag">Velg</span>
                            <h3>Repaint Velg Custom 3</h3>
                        </div>
                    </button>
                    <button type="button" class="galeri-item"
                            @click="openLightbox('/assets/produk2.jpeg', 'Hasil Repaint — Box CVT')">
                        <img src="/assets/produk2.jpeg" alt="Hasil repaint box CVT SuryaPainting18" loading="lazy">
                        <div class="galeri-overlay"></div>
                        <div class="galeri-caption">
                            <span class="label-tag">Body</span>
                            <h3>Repaint Box CVT</h3>
                        </div>
                    </button>
                    <button type="button" class="galeri-item"
                            @click="openLightbox('/assets/carbon3.jpeg', 'Carbon WTP — Hasil 3')">
                        <img src="/assets/carbon3.jpeg" alt="Hasil Carbon WTP SuryaPainting18" loading="lazy">
                        <div class="galeri-overlay"></div>
                        <div class="galeri-caption">
                            <span class="label-tag">Carbon WTP</span>
                            <h3>Carbon WTP 3</h3>
                        </div>
                    </button>
                    <button type="button" class="galeri-item"
                            @click="openLightbox('/assets/velg4.jpeg', 'Hasil Repaint — Velg Motor')">
                        <img src="/assets/velg4.jpeg" alt="Hasil repaint velg motor SuryaPainting18" loading="lazy">
                        <div class="galeri-overlay"></div>
                        <div class="galeri-caption">
                            <span class="label-tag">Velg</span>
                            <h3>Repaint Velg Custom 4</h3>
                        </div>
                    </button>
                </div>
                <button type="button" class="galeri-arrow galeri-arrow-right" x-ref="nextBtn" @click="$refs.track.scrollBy({left: $refs.track.querySelector('.galeri-item').offsetWidth + 4, behavior:'smooth'})" aria-label="Selanjutnya">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><polyline points="9 18 15 12 9 6"/></svg>
                </button>
            </div>
        </div>
    </section>

    <!-- ===== VIDEO PROSES ===== -->
    <section id="video-proses" style="padding: 100px 0; background-color: var(--dark-2); border-top: 1px solid var(--border); border-bottom: 1px solid var(--border);">
        <div class="container-xl">
            <div class="video-header" style="text-align: center; margin-bottom: 50px;">
                <div class="section-eyebrow" style="justify-content: center;">
                    <div class="section-eyebrow-line"></div>
                    <span class="label-tag">Proses Kerja</span>
                    <div class="section-eyebrow-line"></div>
                </div>
                <h2 style="font-family:'Barlow Condensed',sans-serif; font-size:clamp(32px, 5vw, 56px); font-weight:900; font-style:italic; text-transform:uppercase; line-height:1.1; margin-bottom:16px;">
                    Lihat Proses Kerja <span style="color:var(--red);">Premium Kami</span>
                </h2>
                <p style="font-size:15px; color:var(--gray); max-width:600px; margin:0 auto; line-height:1.8;">
                    Tonton detail proses pengerjaan repaint velg dan body motor di bengkel kami. Setiap tahapan dilakukan secara profesional dengan standar SOP pabrik demi hasil yang maksimal.
                </p>
            </div>
            
            <div class="video-wrapper" style="max-width: 960px; margin: 0 auto; border: 1px solid var(--border); background: #000; box-shadow: 0 20px 40px rgba(0,0,0,0.5), 0 0 50px rgba(238,20,177,0.05); padding: 6px; border-radius: 8px;">
                <div class="video-container">
                    <iframe 
                        src="https://www.youtube.com/embed/SSRnUflCQAo" 
                        title="SuryaPainting18 YouTube Video"
                        frameborder="0" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                        referrerpolicy="strict-origin-when-cross-origin"
                        allowfullscreen>
                    </iframe>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== CERITA / TIMELINE ===== -->
    <section id="cerita">
        <div class="container-xl">
            <div class="cerita-layout">
                <div class="cerita-left">
                    <div class="section-eyebrow">
                        <div class="section-eyebrow-line"></div>
                        <span class="label-tag">Sejak 2014</span>
                    </div>
                    <h2>Cerita<br><span style="color:var(--red);">SuryaPainting18.</span></h2>
                    <p>
                        Didirikan September 2014 oleh <strong style="color:#fff;">Martin Surya</strong>, berbekal pengalaman bertahun-tahun
                        di industri otomotif bidang pengecatan. Berawal dari skala kecil, kami tumbuh berkat kepercayaan pelanggan
                        dan dukungan komunitas otomotif.
                    </p>
                    <p>
                        Kini SuryaPainting18 dikenal sebagai spesialis cat velg yang mengutamakan kualitas, kecepatan, dan hasil rapi —
                        melayani ratusan pelanggan di wilayah <strong style="color:#fff;">Bekasi &amp; Cikarang</strong>.
                    </p>
                </div>

                <div>
                    <div class="timeline">
                        <div class="timeline-item">
                            <div class="timeline-dot"></div>
                            <span class="label-tag">2014 — Awal Mula</span>
                            <h3>Memulai dari skala kecil</h3>
                            <p>Martin Surya memulai usaha pengecatan dengan visi kualitas standar pabrik berharga terjangkau.</p>
                        </div>
                        <div class="timeline-item inactive">
                            <div class="timeline-dot"></div>
                            <span class="label-tag">Berkembang</span>
                            <h3>Dikenal sebagai spesialis</h3>
                            <p>Reputasi tumbuh sebagai spesialis cat velg yang rapi dan cepat, didukung peralatan modern dan tenaga berpengalaman.</p>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-dot"></div>
                            <span class="label-tag">Sekarang</span>
                            <h3>2 cabang &amp; ratusan pelanggan</h3>
                            <p>Berkomitmen memberikan hasil terbaik untuk velg, body, fairing, dan tangki dengan kualitas, inovasi, dan kepuasan pelanggan.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== QUOTE / CTA BAND ===== -->
    <section id="quote-band" style="position:relative;overflow:hidden;">
        <!-- Simulated photo bg via gradient -->
        <div style="position:absolute;inset:0;background:linear-gradient(to right,rgba(5,5,5,0.82) 0%,rgba(5,5,5,0.5) 55%,rgba(5,5,5,0.25) 100%),linear-gradient(to top,rgba(5,5,5,0.6) 0%,transparent 50%),radial-gradient(ellipse 80% 60% at 70% 30%,rgba(238,20,177,0.18),transparent 55%),#100808;"></div>
        <div class="container-xl" style="position:relative;z-index:1;padding:100px 0;">
            <div class="quote-band-eyebrow">
                <div class="quote-band-eyebrow-line"></div>
                <span class="label-tag">Moto Kami</span>
            </div>
            <p class="quote-text">"Mengubah tampilan motor menjadi lebih istimewa dengan kualitas terbaik."</p>
            <a href="#kontak" class="btn-red">Konsultasi Gratis</a>
        </div>
    </section>


    <!-- ===== LACAK PESANAN ===== -->
    <section id="lacak">
        <div class="container-xl">
            <div class="lacak-layout">
                <!-- LEFT: heading + form -->
                <div class="lacak-left">
                    <div class="section-eyebrow">
                        <div class="section-eyebrow-line" style="background:var(--red);"></div>
                        <span class="lacak-label label-tag">Fitur Pelanggan</span>
                    </div>
                    <h2 class="lacak-title">Lacak Progres<br><span style="color:var(--red);">Pesananmu.</span></h2>
                    <p class="lacak-desc">
                        Sudah menitipkan motormu? Pantau setiap tahap pengerjaan secara real-time lengkap dengan foto dokumentasi.
                        Masukkan nomor surat atau nomor HP yang terdaftar.
                    </p>

                    <form @submit.prevent="trackOrder" style="display:contents;">
                        <div class="track-form">
                            <input type="text"
                                   x-model="orderCode"
                                   placeholder="Nomor Surat atau No. HP"
                                   class="track-input"
                                   required>
                            <button type="submit" class="track-btn" :disabled="loading">
                                <template x-if="!loading"><span>Lacak Status</span></template>
                                <template x-if="loading">
                                    <span style="display:flex;align-items:center;gap:8px;">
                                        <svg style="animation:spin 1s linear infinite;width:18px;height:18px;" fill="none" viewBox="0 0 24 24">
                                            <circle style="opacity:.25;" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                                            <path style="opacity:.75;" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/>
                                        </svg>
                                        Mencari...
                                    </span>
                                </template>
                            </button>
                        </div>
                    </form>

                    <!-- Error (shown below form on left) -->
                    <div x-cloak>
                        <div x-show="error" x-transition.duration.300ms class="track-error" style="margin-top:24px;">
                            <div class="track-error-icon">!</div>
                            <div>
                                <h4>Pencarian Gagal</h4>
                                <p x-text="errorMessage"></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- RIGHT: result panel -->
                <div class="lacak-right" x-cloak>
                    <!-- Placeholder when no result yet -->
                    <div x-show="!orderData && !error"
                         style="border:2px dashed #ddd;padding:52px 32px;text-align:center;color:#bbb;">
                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="margin:0 auto 14px;display:block;color:#ccc;"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                        <p style="font-family:'Barlow Condensed',sans-serif;font-size:16px;font-weight:700;font-style:italic;text-transform:uppercase;letter-spacing:1px;color:#bbb;">Hasil Pencarian<br>Muncul di Sini</p>
                         <p style="font-size:12px;color:#ccc;margin-top:8px;">Masukkan nomor surat atau no. HP dan klik Lacak Status</p>
                    </div>

                    <!-- Found -->
                    <div x-show="orderData" x-transition.duration.400ms class="track-result">
                        <div class="track-result-header">
                            <div>
                                <div class="track-result-code-label">Nomor Surat</div>
                                <div class="track-result-code" x-text="orderData?.nomor_surat"></div>
                            </div>
                            <span class="track-status-badge"
                                  :style="`color: var(--color-status-${orderData?.status?.toLowerCase()}); border-color: var(--color-status-${orderData?.status?.toLowerCase()});`"
                                  x-text="translateStatus(orderData?.status)"></span>
                        </div>
                        <div class="track-info">
                            <div>
                                <span class="track-info-label">Nama Pelanggan</span>
                                <span class="track-info-val" x-text="orderData?.customer_name"></span>
                            </div>
                            <div x-show="orderData?.cabang">
                                <span class="track-info-label">Cabang</span>
                                <span class="track-info-val" x-text="orderData?.cabang"></span>
                            </div>
                            <div>
                                <span class="track-info-label">Produk / Jasa</span>
                                <span class="track-info-val" x-text="orderData?.product_name"></span>
                            </div>
                            <div x-show="orderData?.tipe_motor">
                                <span class="track-info-label">Tipe Motor</span>
                                <span class="track-info-val" x-text="orderData?.tipe_motor"></span>
                            </div>
                            <div x-show="orderData?.detail_motor">
                                <span class="track-info-label">Detail Motor</span>
                                <span class="track-info-val" x-text="orderData?.detail_motor"></span>
                            </div>
                        </div>
                        <div class="track-timeline-wrap">
                            <div class="track-timeline-title">Riwayat Progres Pengerjaan</div>
                            <div class="track-timeline">
                                <template x-for="(step, index) in orderData?.timeline" :key="step.id">
                                    <div class="track-timeline-item">
                                        <div class="track-timeline-dot" :class="index === 0 ? 'active' : 'inactive'"></div>
                                        <div style="display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:8px;margin-bottom:4px;">
                                            <h4 x-text="step.title"></h4>
                                            <span class="track-timeline-date" x-text="formatDate(step.created_at)"></span>
                                        </div>
                                        <p x-text="step.description || 'Tidak ada keterangan tambahan.'"></p>
                                        <template x-if="step.image_url">
                                            <div class="track-timeline-img" @click="openLightbox(step.image_url, step.title)">
                                                <img :src="step.image_url" :alt="step.title">
                                            </div>
                                        </template>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== TESTIMONI ===== -->
    <section id="testimoni">
        <div class="container-xl">
            <div class="testi-header">
                <div>
                    <div class="section-eyebrow">
                        <div class="section-eyebrow-line"></div>
                        <span class="label-tag">Testimoni</span>
                    </div>
                    <h2>Dipercaya<br><span style="color:var(--red);">Ratusan</span> Pelanggan.</h2>
                </div>
                <p style="font-size:14px;line-height:1.8;color:var(--gray);max-width:380px;align-self:flex-end;">Kepuasan pelanggan dan kualitas hasil kerja adalah prioritas utama kami. Berikut sebagian tanggapan dari mereka.</p>
            </div>

            <div class="testi-carousel-container" style="position: relative; padding: 0 40px;">
                <button type="button" aria-label="Previous Testimonial" @click="$refs.testiScroll.scrollBy({left: -300, behavior: 'smooth'})" style="position: absolute; left: 0; top: 50%; transform: translateY(-50%); width: 40px; height: 40px; background: transparent; border: 2px solid var(--red); border-radius: 50%; color: var(--red); display: flex; align-items: center; justify-content: center; cursor: pointer; z-index: 10; transition: background 0.3s, color 0.3s;" onmouseover="this.style.background='var(--red)'; this.style.color='#fff';" onmouseout="this.style.background='transparent'; this.style.color='var(--red)';">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
                </button>

                <div x-ref="testiScroll" class="testi-carousel-track" style="display: flex; gap: 24px; overflow-x: auto; scroll-snap-type: x mandatory; scrollbar-width: none; -ms-overflow-style: none;">
                    <style>
                        .testi-carousel-track::-webkit-scrollbar { display: none; }
                        .testi-carousel-item {
                            flex: 0 0 100%;
                            scroll-snap-align: start;
                        }
                        @media (min-width: 640px) { .testi-carousel-item { flex: 0 0 calc(50% - 12px); } }
                        @media (min-width: 1024px) { .testi-carousel-item { flex: 0 0 calc(33.333% - 16px); } }
                    </style>

                    <button type="button" class="testi-item testi-carousel-item" @click="openLightbox('/assets/testimoni1.jpeg', 'Testimoni Pelanggan')">
                        <img src="/assets/testimoni1.jpeg" alt="Testimoni pelanggan SuryaPainting18" loading="lazy">
                        <div class="testi-overlay"></div>
                    </button>
                    <button type="button" class="testi-item testi-carousel-item" @click="openLightbox('/assets/testimoni2.jpeg', 'Testimoni Pelanggan')">
                        <img src="/assets/testimoni2.jpeg" alt="Testimoni pelanggan SuryaPainting18" loading="lazy">
                        <div class="testi-overlay"></div>
                    </button>
                    <button type="button" class="testi-item testi-carousel-item" @click="openLightbox('/assets/testimoni3.jpeg', 'Testimoni Pelanggan')">
                        <img src="/assets/testimoni3.jpeg" alt="Testimoni pelanggan SuryaPainting18" loading="lazy">
                        <div class="testi-overlay"></div>
                    </button>
                    <button type="button" class="testi-item testi-carousel-item" @click="openLightbox('/assets/testimoni4.jpeg', 'Testimoni Pelanggan')">
                        <img src="/assets/testimoni4.jpeg" alt="Testimoni pelanggan SuryaPainting18" loading="lazy">
                        <div class="testi-overlay"></div>
                    </button>
                    <button type="button" class="testi-item testi-carousel-item" @click="openLightbox('/assets/testimoni5.jpeg', 'Testimoni Pelanggan')">
                        <img src="/assets/testimoni5.jpeg" alt="Testimoni pelanggan SuryaPainting18" loading="lazy">
                        <div class="testi-overlay"></div>
                    </button>
                    <button type="button" class="testi-item testi-carousel-item" @click="openLightbox('/assets/testimoni6.jpeg', 'Testimoni Pelanggan')">
                        <img src="/assets/testimoni6.jpeg" alt="Testimoni pelanggan SuryaPainting18" loading="lazy">
                        <div class="testi-overlay"></div>
                    </button>
                </div>

                <button type="button" aria-label="Next Testimonial" @click="$refs.testiScroll.scrollBy({left: 300, behavior: 'smooth'})" style="position: absolute; right: 0; top: 50%; transform: translateY(-50%); width: 40px; height: 40px; background: transparent; border: 2px solid var(--red); border-radius: 50%; color: var(--red); display: flex; align-items: center; justify-content: center; cursor: pointer; z-index: 10; transition: background 0.3s, color 0.3s;" onmouseover="this.style.background='var(--red)'; this.style.color='#fff';" onmouseout="this.style.background='transparent'; this.style.color='var(--red)';">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </button>
            </div>

            <div class="testi-cta">
                <a href="https://maps.app.goo.gl/xxs9gpktvTEdSh5YA?g_st=iw" target="_blank" rel="noopener" class="testi-cta-link">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    Lihat Review Bekasi di Google Maps
                    <span class="testi-cta-arrow"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></span>
                </a>
                <a href="https://maps.app.goo.gl/tckCRwdqc7rpJoKR6?g_st=iw" target="_blank" rel="noopener" class="testi-cta-link">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    Lihat Review Cikarang di Google Maps
                    <span class="testi-cta-arrow"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></span>
                </a>
            </div>
        </div>
    </section>

    <!-- ===== LOKASI ===== -->
    <section id="lokasi">
        <div class="lokasi-bg-text">LOCATIONS</div>
        <div class="container-xl" style="position:relative;">
            <!-- Header -->
            <div class="lokasi-header">
                <div class="section-eyebrow">
                    <div class="section-eyebrow-line" style="background:var(--red);"></div>
                    <span class="label-tag">Lokasi Kami</span>
                    <div class="section-eyebrow-line" style="background:var(--red);"></div>
                </div>
                <h2>Bengkel Kami<br>Dekat dari Kamu</h2>
                <p>Kami hadir di dua lokasi strategis di wilayah Bekasi dan Cikarang — siap melayani kebutuhan pengecatan kendaraanmu kapan pun diperlukan.</p>
            </div>

            <!-- Cards -->
            <div class="lokasi-cards">
                <!-- Cabang Bekasi -->
                <div class="lokasi-card">
                    <div class="lokasi-card-map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.080646394418!2d107.0618252!3d-6.2531048!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e698fd1ffa6ee6d%3A0x464ddb4313a039c6!2sSuryapainting18%20Bekasi!5e0!3m2!1sen!2sid!4v1781770137889!5m2!1sen!2sid" style="border:0;width:100%;height:100%;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    <div class="lokasi-card-body">
                        <div class="lokasi-card-name">Bekasi, Jawa Barat</div>
                        <p class="lokasi-card-desc">Bengkel utama kami yang melayani pengecatan velg dan body motor dengan standar SOP pabrik, hasil rapi dan mengkilap.</p>
                        <div class="lokasi-card-meta">
                            <div class="lokasi-meta-item">
                                <div class="lokasi-meta-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                </div>
                                <div class="lokasi-meta-text">
                                    <strong>Cabang Bekasi</strong>
                                    Bekasi, Jawa Barat
                                </div>
                            </div>
                            <div class="lokasi-meta-item">
                                <div class="lokasi-meta-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 1.18h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.91a16 16 0 0 0 5.09 5.09l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 21 15z"/></svg>
                                </div>
                                <div class="lokasi-meta-text">
                                    <strong>+62 896-5484-9261</strong>
                                    Admin Bekasi
                                </div>
                            </div>
                        </div>
                        <a href="https://maps.app.goo.gl/xxs9gpktvTEdSh5YA?g_st=iw" target="_blank" rel="noopener" class="lokasi-card-btn">Buka di Google Maps</a>
                    </div>
                </div>

                <!-- Cabang Cikarang -->
                <div class="lokasi-card">
                    <div class="lokasi-card-map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.947241602964!2d107.17881997475098!3d-6.270668793718042!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69850024b0e0fb%3A0x3fe4edf021a32090!2sSuryapainting18%20Cikarang!5e0!3m2!1sen!2sid!4v1781770231352!5m2!1sen!2sid" style="border:0;width:100%;height:100%;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    <div class="lokasi-card-body">
                        <div class="lokasi-card-name">Cikarang, Bekasi</div>
                        <p class="lokasi-card-desc">Cabang Cikarang kami hadir untuk melayani pelanggan di kawasan industri dan sekitarnya dengan kualitas pengerjaan yang sama.</p>
                        <div class="lokasi-card-meta">
                            <div class="lokasi-meta-item">
                                <div class="lokasi-meta-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                </div>
                                <div class="lokasi-meta-text">
                                    <strong>Cabang Cikarang</strong>
                                    Cikarang, Bekasi, Jawa Barat
                                </div>
                            </div>
                            <div class="lokasi-meta-item">
                                <div class="lokasi-meta-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 1.18h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.91a16 16 0 0 0 5.09 5.09l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 21 15z"/></svg>
                                </div>
                                <div class="lokasi-meta-text">
                                    <strong>+62 813-3003-8804</strong>
                                    Admin Cikarang
                                </div>
                            </div>
                        </div>
                        <a href="https://maps.app.goo.gl/tckCRwdqc7rpJoKR6?g_st=iw" target="_blank" rel="noopener" class="lokasi-card-btn">Buka di Google Maps</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== KONTAK / CTA ===== -->
    <section id="kontak">
        <div class="container-xl">
            <div class="kontak-layout">
                <div class="kontak-left">
                    <div class="section-eyebrow">
                        <div class="section-eyebrow-line"></div>
                        <span class="label-tag">Hubungi Kami</span>
                    </div>
                    <h2>Siap Bikin<br><span style="color:var(--red);">Motormu</span><br>Lebih Istimewa?</h2>
                    <p>Konsultasikan warna impianmu sekarang. Tim kami di Bekasi &amp; Cikarang siap membantu — gratis tanpa biaya konsultasi.</p>
                    <div class="kontak-socials">
                        <a href="https://instagram.com/suryapainting18" target="_blank" rel="noopener" class="btn-outline" style="font-size:11px;padding:12px 24px;">
                            Instagram
                        </a>
                        <a href="https://www.tiktok.com/@suryapainting18" target="_blank" rel="noopener" class="btn-outline" style="font-size:11px;padding:12px 24px;">
                            TikTok
                        </a>
                    </div>
                </div>

                <div class="kontak-right">
                    <a href="https://wa.me/6289654849261" target="_blank" rel="noopener" class="kontak-card">
                        <div>
                            <span class="kontak-card-label">Admin 1 — Cabang Bekasi</span>
                            <div class="kontak-card-number">+62 896-5484-9261</div>
                        </div>
                        <div class="kontak-card-arrow">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                        </div>
                    </a>
                    <a href="https://wa.me/6281330038804" target="_blank" rel="noopener" class="kontak-card">
                        <div>
                            <span class="kontak-card-label">Admin 2 — Cabang Cikarang</span>
                            <div class="kontak-card-number">+62 813-3003-8804</div>
                        </div>
                        <div class="kontak-card-arrow">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== FOOTER ===== -->
    <footer>
        <div class="container-xl">
            <div class="footer-inner">
                <div>
                    <a href="#top" class="footer-brand-logo" style="margin-bottom:20px;display:inline-block;">
                        <img src="/assets/01-logo-suryapainting18.png" alt="SuryaPainting18" style="height:48px;width:auto;">
                    </a>
                    <p class="footer-desc">Bengkel spesialis pengecatan velg &amp; body motor sejak 2014. Hasil rapi, mengkilap, dan tahan lama dengan standar SOP pabrik.</p>
                </div>

                <div class="footer-col">
                    <div class="footer-col-title">Navigasi</div>
                    <ul>
                        <li><a href="#keunggulan">Keunggulan</a></li>
                        <li><a href="#layanan">Layanan</a></li>
                        <li><a href="#cerita">Cerita</a></li>
                        <li><a href="#lacak">Lacak Pesanan</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <div class="footer-col-title">Terhubung</div>
                    <ul>
                        <li><a href="https://instagram.com/suryapainting18" target="_blank" rel="noopener">Instagram</a></li>
                        <li><a href="https://www.tiktok.com/@suryapainting18" target="_blank" rel="noopener">TikTok</a></li>
                        <li><a href="https://wa.me/6289654849261" target="_blank" rel="noopener">WA Bekasi</a></li>
                        <li><a href="https://wa.me/6281330038804" target="_blank" rel="noopener">WA Cikarang</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <div class="footer-col-title">Lokasi</div>
                    <ul>
                        <li><span>Bekasi</span></li>
                        <li><span>Cikarang</span></li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} SuryaPainting18. Seluruh hak cipta dilindungi.</p>
                <p style="font-size:11px;font-weight:700;letter-spacing:2px;text-transform:uppercase;color:#444;">Bekasi · Cikarang · Indonesia</p>
                <p style="font-size:10px;color:#555;letter-spacing:0.5px;">Developed by <a href="https://www.kalanalabs.com" target="_blank" rel="noopener" style="color:var(--red);text-decoration:none;font-weight:600;">Kalana Labs</a></p>
            </div>
        </div>
    </footer>

    <!-- ===== LIGHTBOX ===== -->
    <div x-show="lightboxOpen" x-transition.opacity.duration.300ms x-cloak
         class="lightbox-overlay"
         @click="lightboxOpen = false"
         @keydown.escape.window="lightboxOpen = false">
        <button class="lightbox-close" @click="lightboxOpen = false">&times;</button>
        <div class="lightbox-content" @click.stop>
            <img :src="lightboxImg" :alt="lightboxTitle">
            <h4 class="lightbox-title" x-text="lightboxTitle"></h4>
        </div>
    </div>

    <!-- ===== APP SCRIPT ===== -->
    <script>
        function suryaSite() {
            return {
                scrolled: false,
                mobileMenuOpen: false,
                orderCode: '',
                loading: false,
                error: false,
                errorMessage: '',
                orderData: null,
                lightboxOpen: false,
                lightboxImg: '',
                lightboxTitle: '',
                keunggulanSlide: 0,
                keunggulanSlides: [
                    { src: '/assets/produk1.jpeg', desc: 'Mempunyai hasil yang lebih rapih, mengkilap pada umumnya.' },
                    { src: '/assets/produk2.jpeg', desc: 'Menggunakan bahan berkualitas untuk kepuasan konsumen' },
                    { src: '/assets/produk3.jpeg', desc: 'Mempunyai daya tarik mata yang kuat terhadap kualitas bahan yang digunakan.' }
                ],

                init() {
                    this.scrolled = window.scrollY > 20;
                    window.addEventListener('scroll', () => { this.scrolled = window.scrollY > 20; }, { passive: true });
                    setInterval(() => {
                        this.keunggulanSlide = (this.keunggulanSlide + 1) % this.keunggulanSlides.length;
                    }, 4000);
                },

                async trackOrder() {
                    if (!this.orderCode) return;
                    this.loading = true;
                    this.error = false;
                    this.orderData = null;
                    try {
                        const response = await fetch('{{ route("track.search") }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({ order_code: this.orderCode })
                        });
                        const data = await response.json();
                        if (response.ok && data.success) {
                            this.orderData = data.order;
                        } else {
                            this.error = true;
                            this.errorMessage = data.message || 'Terjadi kesalahan saat mencari pesanan.';
                        }
                    } catch (err) {
                        this.error = true;
                        this.errorMessage = 'Gagal terhubung ke server. Periksa koneksi internet Anda.';
                    } finally {
                        this.loading = false;
                    }
                },

                translateStatus(status) {
                    const trans = { 'Pending': 'Menunggu', 'Processing': 'Diproses', 'Completed': 'Selesai', 'Cancelled': 'Dibatalkan' };
                    return trans[status] || status;
                },

                formatDate(dateString) {
                    if (!dateString) return '';
                    return new Date(dateString).toLocaleString('id-ID', {
                        timeZone: 'Asia/Jakarta',
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit',
                        hour12: false
                    }) + ' WIB';
                },

                openLightbox(imgUrl, title) {
                    this.lightboxImg = imgUrl;
                    this.lightboxTitle = title;
                    this.lightboxOpen = true;
                }
            }
        }

        function layananSlider(images) {
            return {
                current: 0,
                images: images,
                init() {
                    setInterval(() => {
                        this.current = (this.current + 1) % this.images.length;
                    }, 3000);
                }
            }
        }
    </script>

    <style>
        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
    </style>

</body>
</html>
