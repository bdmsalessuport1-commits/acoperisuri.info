<?php

namespace App\Helpers;

class AssetHelper
{
    private static ?string $criticalCssCache = null;

    /**
     * Returns minified critical CSS for above-the-fold rendering.
     * Includes: CSS variables, reset, typography, buttons, layout,
     * header/top-bar, hero section basics.
     */
    public static function criticalCss(): string
    {
        if (self::$criticalCssCache !== null) {
            return self::$criticalCssCache;
        }

        $css = <<<'CSS'
:root{--color-primary:#00204A;--color-secondary:#2D2B48;--color-accent-green:#12A757;--color-accent-blue:#14A4D4;--color-text:#54595F;--color-text-light:#7A7A7A;--color-bg-header:#F5FAFF;--color-bg-light:#F0F4F8;--color-bg-white:#FFFFFF;--color-red:#E00808;--color-border:#D0D5DD;--color-border-light:#E5E7EB;--font-heading:'Public Sans',sans-serif;--font-body:'Roboto',sans-serif;--text-xs:0.75rem;--text-sm:0.875rem;--text-base:1rem;--text-lg:1.125rem;--text-xl:1.25rem;--text-2xl:1.5rem;--text-3xl:1.875rem;--text-4xl:2.25rem;--spacing-xs:0.25rem;--spacing-sm:0.5rem;--spacing-md:1rem;--spacing-lg:1.5rem;--spacing-xl:2rem;--spacing-2xl:3rem;--spacing-3xl:4rem;--radius-sm:4px;--radius-md:8px;--radius-lg:12px;--radius-xl:16px;--shadow-sm:0 1px 2px rgba(0,32,74,0.05);--shadow-md:0 4px 6px rgba(0,32,74,0.07);--shadow-lg:0 10px 15px rgba(0,32,74,0.1);--shadow-xl:0 20px 25px rgba(0,32,74,0.1);--transition-fast:150ms ease;--transition-normal:250ms ease;--transition-slow:350ms ease;--max-width:1440px;--content-width:1200px;--sidebar-width:300px}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
html{font-size:16px;-webkit-text-size-adjust:100%}
body{font-family:var(--font-body);font-size:var(--text-base);font-weight:400;line-height:1.6;color:var(--color-text);background-color:var(--color-bg-white);-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}
img,picture,video,canvas,svg{display:block;max-width:100%;height:auto}
input,button,textarea,select{font:inherit;color:inherit}
ul,ol{list-style:none}
h1,h2,h3,h4,h5,h6{font-family:var(--font-heading);font-weight:700;line-height:1.2;color:var(--color-primary)}
h1{font-size:var(--text-4xl);margin-bottom:var(--spacing-lg)}
h2{font-size:var(--text-3xl);margin-bottom:var(--spacing-md)}
h3{font-size:var(--text-2xl);margin-bottom:var(--spacing-md)}
p{margin-bottom:var(--spacing-md)}
a{color:var(--color-accent-blue);text-decoration:none;transition:color var(--transition-fast)}
a:hover{color:var(--color-primary)}
.btn{display:inline-flex;align-items:center;justify-content:center;gap:var(--spacing-sm);padding:0.75rem 1.5rem;font-family:var(--font-heading);font-size:var(--text-base);font-weight:600;line-height:1;border:2px solid transparent;border-radius:var(--radius-md);cursor:pointer;transition:all var(--transition-normal);text-decoration:none}
.btn:hover{text-decoration:none}
.btn-primary{background-color:var(--color-accent-green);color:var(--color-bg-white);border-color:var(--color-accent-green)}
.btn-primary:hover{background-color:#0e8c48;border-color:#0e8c48;color:var(--color-bg-white)}
.btn-lg{padding:1rem 2rem;font-size:var(--text-lg)}
.container{width:100%;max-width:var(--content-width);margin:0 auto;padding:0 var(--spacing-xl)}
.section{padding:var(--spacing-3xl) 0}
.bg-light{background-color:var(--color-bg-light)}
.text-center{text-align:center}
.top-bar{background-color:var(--color-primary);color:rgba(255,255,255,0.85);font-size:var(--text-xs);padding:6px 0;transition:transform var(--transition-normal),opacity var(--transition-normal)}
.top-bar.hidden{transform:translateY(-100%);opacity:0;position:absolute;width:100%;pointer-events:none}
.top-bar .container{display:flex;justify-content:space-between;align-items:center}
.top-bar a{color:rgba(255,255,255,0.85);transition:color var(--transition-fast)}
.top-bar a:hover{color:#fff;text-decoration:none}
.top-bar-left,.top-bar-right{display:flex;align-items:center;gap:var(--spacing-md)}
.top-bar-separator{opacity:0.4}
.site-header{background-color:var(--color-bg-white);padding:0;border-bottom:1px solid var(--color-border-light);position:sticky;top:0;z-index:1000;transition:box-shadow var(--transition-normal)}
.site-header.scrolled{box-shadow:var(--shadow-lg)}
.header-main{display:flex;align-items:center;justify-content:space-between;padding:var(--spacing-sm) 0;min-height:70px}
.site-logo{flex-shrink:0}
.site-logo:hover{text-decoration:none;opacity:0.9}
.site-logo img{height:55px;width:auto}
.header-cta .btn{white-space:nowrap;gap:6px}
.site-nav{flex:1;display:flex;justify-content:center}
.nav-list{display:flex;align-items:center;gap:0}
.nav-item{position:relative}
.nav-link{display:flex;align-items:center;gap:4px;padding:var(--spacing-md);font-family:var(--font-heading);font-size:var(--text-sm);font-weight:600;color:var(--color-primary);transition:color var(--transition-fast);white-space:nowrap}
.nav-link:hover,.nav-item:hover>.nav-link,.nav-link.active{color:var(--color-accent-green);text-decoration:none}
.nav-link-produse{background:var(--color-bg-light);border-radius:var(--radius-md);padding:10px var(--spacing-lg)}
.hamburger{display:none;flex-direction:column;justify-content:center;gap:5px;width:32px;height:32px;cursor:pointer;background:none;border:none;padding:4px;z-index:1100}
.hamburger span{display:block;width:100%;height:2px;background-color:var(--color-primary);border-radius:2px;transition:all var(--transition-normal)}
.mobile-nav-overlay{display:none}
.site-main{min-height:calc(100vh - 200px)}
.hero-slider{position:relative;min-height:600px;overflow:hidden}
.hero-slides{position:relative;width:100%;min-height:600px}
.hero-slide{position:absolute;top:0;left:0;width:100%;min-height:600px;display:flex;align-items:center;background-color:var(--color-primary);background-size:cover;background-position:center;opacity:0;transition:opacity 0.8s ease;z-index:1}
.hero-slide.active{opacity:1;z-index:2;position:relative}
.hero-slide-overlay{position:absolute;top:0;left:0;width:100%;height:100%;background:linear-gradient(135deg,rgba(0,32,74,0.85) 0%,rgba(45,43,72,0.6) 60%,rgba(18,167,87,0.3) 100%);z-index:1}
.hero{position:relative;min-height:600px;display:flex;align-items:center;background:linear-gradient(135deg,rgba(0,32,74,0.85) 0%,rgba(45,43,72,0.6) 60%,rgba(18,167,87,0.3) 100%);background-color:var(--color-primary);overflow:hidden}
.hero-content{position:relative;z-index:2;max-width:650px}
.hero-slide h1,.hero-title,.hero h1{color:#fff;font-size:2.8rem;font-weight:700;line-height:1.15;margin-bottom:var(--spacing-md)}
.hero-subtitle{color:rgba(255,255,255,0.85);font-size:var(--text-lg);line-height:1.6;margin-bottom:var(--spacing-xl)}
.hero-buttons{display:flex;gap:var(--spacing-md);flex-wrap:wrap;margin-bottom:var(--spacing-xl)}
.btn-outline-white{background:transparent;color:#fff;border:2px solid rgba(255,255,255,0.6)}
.btn-outline-white:hover{background:#fff;color:var(--color-primary);border-color:#fff}
@media(max-width:1024px){.site-nav{display:none}.header-cta .btn-text{display:none}.header-cta .btn{padding:10px;min-width:auto}.hamburger{display:flex}.mobile-nav-overlay{display:block}.site-logo img{height:45px}}
@media(max-width:768px){.hero-slider,.hero-slides,.hero-slide{min-height:450px}.hero{min-height:400px}.hero-slide h1,.hero-title,.hero h1{font-size:2rem}}
@media(max-width:480px){.container{padding:0 var(--spacing-md)}h1{font-size:var(--text-2xl)}h2{font-size:var(--text-xl)}h3{font-size:var(--text-lg)}.top-bar-left{font-size:0.65rem}.top-bar-right .delivery-text{display:none}.site-logo img{height:38px}.hero h1{font-size:1.6rem}.hero-buttons{flex-direction:column}.hero-buttons .btn{width:100%}}
CSS;

        self::$criticalCssCache = $css;
        return $css;
    }
}
