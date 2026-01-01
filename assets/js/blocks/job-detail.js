/* global wp */
(function () {
  const { registerBlockType } = wp.blocks;
  const { __ } = wp.i18n;
  const { useBlockProps } = wp.blockEditor;
  const { PanelBody, TextControl, SelectControl, ToggleControl } = wp.components;
  const { InspectorControls } = wp.blockEditor;
  const { useSelect, useDispatch } = wp.data;
  const el = wp.element.createElement;

  const EMP_OPTIONS = [
    { label: 'Remote', value: 'remote' },
    { label: 'Hybrid', value: 'hybrid' },
    { label: 'Onsite', value: 'onsite' },
  ];

  registerBlockType('jose-portfolio/job-detail', {
    title: __('Job Detail', 'jose-portfolio'),
    icon: 'id',
    category: 'widgets',
    description: __('Edits/prints job meta fields for this post. Company is the post title; skills are tags; description is post content.', 'jose-portfolio'),
    supports: { html: false },

    // No block attributes — we bind to POST META instead (single source of truth)
    edit: function () {
      const blockProps = useBlockProps({
        className: 'rounded-2xl border border-slate-700/60 bg-slate-900/40 p-5',
      });

      const meta = useSelect((select) => {
        return select('core/editor').getEditedPostAttribute('meta') || {};
      }, []);

      const title = useSelect((select) => {
        return select('core/editor').getEditedPostAttribute('title') || '';
      }, []);

      const { editPost } = useDispatch('core/editor');

      function setMeta(key, value) {
        editPost({ meta: { ...meta, [key]: value } });
      }

      const positionTitle  = meta.jp_position_title || '';
      const employmentType = meta.jp_employment_type || 'remote';
      const location       = meta.jp_location || '';
      const dateStart      = meta.jp_date_start || '';
      const isCurrent      = !!meta.jp_is_current;
      const dateEnd        = meta.jp_date_end || '';

      // Simple inline preview string for dates
      const dateLabel =
        dateStart
          ? (dateStart + ' → ' + (isCurrent ? 'Present' : (dateEnd || '')))
          : '';

      return el(
        wp.element.Fragment,
        null,

        el(
          InspectorControls,
          null,
          el(
            PanelBody,
            { title: __('Job Fields', 'jose-portfolio'), initialOpen: true },
            el(TextControl, {
              label: __('Position Title', 'jose-portfolio'),
              value: positionTitle,
              onChange: (v) => setMeta('jp_position_title', v),
            }),
            el(SelectControl, {
              label: __('Employment Type', 'jose-portfolio'),
              value: employmentType,
              options: EMP_OPTIONS,
              onChange: (v) => setMeta('jp_employment_type', v),
            }),
            el(TextControl, {
              label: __('Location', 'jose-portfolio'),
              value: location,
              onChange: (v) => setMeta('jp_location', v),
            })
          ),
          el(
            PanelBody,
            { title: __('Dates', 'jose-portfolio'), initialOpen: false },
            el(TextControl, {
              label: __('Start Date (YYYY-MM-DD)', 'jose-portfolio'),
              help: __('Example: 2025-01-01', 'jose-portfolio'),
              value: dateStart,
              onChange: (v) => setMeta('jp_date_start', v),
            }),
            el(ToggleControl, {
              label: __('Current Role?', 'jose-portfolio'),
              checked: isCurrent,
              onChange: (v) => setMeta('jp_is_current', !!v),
            }),
            !isCurrent
              ? el(TextControl, {
                  label: __('End Date (YYYY-MM-DD)', 'jose-portfolio'),
                  help: __('Example: 2025-12-01', 'jose-portfolio'),
                  value: dateEnd,
                  onChange: (v) => setMeta('jp_date_end', v),
                })
              : null
          )
        ),

        // Block preview (minimal)
        el(
          'section',
          blockProps,
          el('div', { className: 'text-xs uppercase tracking-wide text-slate-400' }, __('Job Detail', 'jose-portfolio')),
          el('h3', { className: 'mt-2 text-lg font-semibold text-slate-100' }, title || __('(Post Title = Company)', 'jose-portfolio')),
          el('p', { className: 'mt-1 text-sm text-slate-300' },
            positionTitle || __('Position Title', 'jose-portfolio'),
            (location || employmentType) ? el('span', { className: 'text-slate-500' }, ' • ') : null,
            location || __('Location', 'jose-portfolio'),
            el('span', { className: 'text-slate-500' }, ' • '),
            (employmentType === 'remote' ? 'Remote' : employmentType === 'hybrid' ? 'Hybrid' : 'Onsite')
          ),
          dateLabel ? el('p', { className: 'mt-2 text-xs text-slate-400' }, dateLabel) : null,
          el('p', { className: 'mt-4 text-xs text-slate-500' },
            __('Skills come from post tags. Description comes from post content.', 'jose-portfolio')
          )
        )
      );
    },

    // Dynamic block (render_callback). Save returns null.
    save: function () {
      return null;
    },
  });
})();
