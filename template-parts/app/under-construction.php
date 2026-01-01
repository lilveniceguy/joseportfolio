<?php if (!defined('ABSPATH')) exit; ?>

<div class="fixed inset-0 bg-surface-950 text-text-strong overflow-hidden">
  <div x-data="{ section: 'home' }" class="h-screen w-screen flex flex-col">

    <!-- HEADER / NAV -->
    <header class="flex items-center justify-between px-6 py-4 border-b border-border bg-surface-900/40 backdrop-blur-sm">
      <h1 class="text-lg font-semibold tracking-wide text-text-strong">
        Jose Lopez
      </h1>

      <nav class="space-x-4 text-sm">
        <button
          @click="section = 'home'"
          class="transition-colors"
          :class="section === 'home' ? 'text-brand-blue' : 'text-text-muted hover:text-text-strong'"
          type="button"
        >Home</button>

        <button
          @click="section = 'projects'"
          class="transition-colors"
          :class="section === 'projects' ? 'text-brand-blue' : 'text-text-muted hover:text-text-strong'"
          type="button"
        >Projects</button>

        <button
          @click="section = 'about'"
          class="transition-colors"
          :class="section === 'about' ? 'text-brand-blue' : 'text-text-muted hover:text-text-strong'"
          type="button"
        >About</button>

        <button
          @click="section = 'contact'"
          class="transition-colors"
          :class="section === 'contact' ? 'text-brand-blue' : 'text-text-muted hover:text-text-strong'"
          type="button"
        >Contact</button>
      </nav>
    </header>

    <!-- CONTENT -->
    <main class="flex-1 relative">

      <!-- HOME -->
      <section
        x-show="section === 'home'"
        x-transition
        class="absolute inset-0 flex items-center justify-center text-center px-6"
        style="display:none;"
      >
        <div class="max-w-2xl">
          <p class="text-text-faint uppercase tracking-[0.25em] text-xs mb-4">Site under construction</p>
          <h2 class="text-4xl md:text-5xl font-bold mb-6 text-text-strong">
            Senior Software Engineer
          </h2>

          <p class="text-text-muted text-lg leading-relaxed">
            PHP · WordPress · Laravel · Node · React · Alpine · Tailwind
            <br>
            Systems-minded developer building fast, scalable platforms.
          </p>
        </div>
      </section>

      <!-- PROJECTS -->
      <section
        x-show="section === 'projects'"
        x-transition
        class="absolute inset-0 overflow-y-auto px-6 py-10"
        style="display:none;"
      >
        <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-6">
          <?php
          $projects = [
            [
              'title' => 'Prep Network Platform',
              'desc'  => 'Large-scale WordPress multisite with custom tables and APIs.'
            ],
            [
              'title' => 'Events Management App',
              'desc'  => 'Laravel + React microservice for event logistics.'
            ],
          ];

          foreach ($projects as $project): ?>
            <div class="bg-surface-800 rounded-2xl p-6 hover:bg-surface-700 transition">
              <h3 class="text-xl font-semibold mb-2 text-text-strong">
                <?php echo esc_html($project['title']); ?>
              </h3>
              <p class="text-text-muted text-sm">
                <?php echo esc_html($project['desc']); ?>
              </p>
            </div>
          <?php endforeach; ?>
        </div>
      </section>

      <!-- ABOUT -->
      <section
        x-show="section === 'about'"
        x-transition
        class="absolute inset-0 flex items-center justify-center px-6"
        style="display:none;"
      >
        <div class="max-w-3xl text-center">
          <h2 class="text-3xl font-semibold mb-4 text-text-strong">About Me</h2>
          <p class="text-text-muted leading-relaxed">
            Full-stack developer with 12+ years of experience building
            platforms, automations, and internal tools.
            Strong focus on architecture, performance, and maintainability.
          </p>
        </div>
      </section>

      <!-- CONTACT -->
      <section
        x-show="section === 'contact'"
        x-transition
        class="absolute inset-0 flex items-center justify-center px-6"
        style="display:none;"
      >
        <div class="text-center">
          <h2 class="text-3xl font-semibold mb-4 text-text-strong">Contact</h2>

          <p class="text-text-muted mb-6">
            Let’s build something solid.
          </p>

          <a
            href="mailto:youremail@example.com"
            class="inline-flex items-center justify-center px-6 py-3 rounded-xl bg-brand-blue hover:bg-brand-orange transition text-text-strong"
          >
            Email Me
          </a>
        </div>
      </section>

    </main>

  </div>
</div>
