/* global wp */
(function () {
  const { registerBlockType } = wp.blocks;
  const { __ } = wp.i18n;
  const { useBlockProps, InspectorControls } = wp.blockEditor;
  const { PanelBody, TextControl, SelectControl } = wp.components;
  const { useSelect, useDispatch } = wp.data;
  const el = wp.element.createElement;

  registerBlockType('jose-portfolio/achievement-detail', {
    title: __('Achievement Detail', 'jose-portfolio'),
    icon: 'awards',
    category: 'widgets',
    supports: { html: false },
    description: __('Education/Certificate details stored in post meta. Title = achievement name; content = description; tags optional.', 'jose-portfolio'),

    edit: function () {
      const blockProps = useBlockProps({
        className: 'rounded-2xl border border-slate-700/60 bg-slate-900/40 p-5',
      });

      const meta = useSelect((select) => select('core/editor').getEditedPostAttribute('meta') || {}, []);
      const title = useSelect((select) => select('core/editor').getEditedPostAttribute('title') || '', []);
      const { editPost } = useDispatch('core/editor');

      function setMeta(key, value) {
        editPost({ meta: { ...meta, [key]: value } });
      }

      const type = meta.jp_ach_type || 'education';
      const issuer = meta.jp_ach_issuer || '';
      const location = meta.jp_ach_location || '';
      const dateStart = meta.jp_ach_date_start || '';
      const dateEnd = meta.jp_ach_date_end || '';
      const verifyUrl = meta.jp_ach_verify_url || '';

      const badge = type === 'certificate' ? 'Certificate' : 'Education';

      return el(
        wp.element.Fragment,
        null,

        el(
          InspectorControls,
          null,
          el(
            PanelBody,
            { title: __('Achievement Fields', 'jose-portfolio'), initialOpen: true },
            el(SelectControl, {
              label: __('Type', 'jose-portfolio'),
              value: type,
              options: [
                { label: 'Education', value: 'education' },
                { label: 'Certificate', value: 'certificate' },
              ],
              onChange: (v) => setMeta('jp_ach_type', v),
            }),
            el(TextControl, {
              label: __('School / Issuer', 'jose-portfolio'),
              value: issuer,
              onChange: (v) => setMeta('jp_ach_issuer', v),
            }),
            el(TextControl, {
              label: __('Location', 'jose-portfolio'),
              value: location,
              onChange: (v) => setMeta('jp_ach_location', v),
            })
          ),
          el(
            PanelBody,
            { title: __('Dates + Verification', 'jose-portfolio'), initialOpen: false },
            el(TextControl, {
              label: __('Start Date (YYYY-MM-DD) (optional)', 'jose-portfolio'),
              value: dateStart,
              onChange: (v) => setMeta('jp_ach_date_start', v),
            }),
            el(TextControl, {
              label: __('End Date (YYYY-MM-DD) (optional)', 'jose-portfolio'),
              value: dateEnd,
              onChange: (v) => setMeta('jp_ach_date_end', v),
            }),
            el(TextControl, {
              label: __('Verification URL (optional)', 'jose-portfolio'),
              value: verifyUrl,
              onChange: (v) => setMeta('jp_ach_verify_url', v),
            })
          )
        ),

        el(
          'section',
          blockProps,
          el('div', { className: 'flex items-center gap-2' },
            type === 'certificate'
              ? el('span', { className: 'inline-flex h-5 w-5 items-center justify-center rounded-full bg-orange-400/20 text-orange-300 border border-orange-400/30' }, '✓')
              : el('span', { className: 'inline-flex h-5 w-5 items-center justify-center rounded-full bg-blue-400/20 text-blue-200 border border-blue-400/30' }, '🎓'),
            el('h3', { className: 'text-lg font-semibold text-slate-100' }, title || __('(Post Title = achievement name)', 'jose-portfolio')),
            el('span', { className: 'ml-auto rounded-full border border-slate-700/60 bg-slate-800 px-2.5 py-1 text-[11px] text-slate-200' }, badge)
          ),
          (issuer || location)
            ? el('p', { className: 'mt-1 text-sm text-slate-300' }, issuer || __('Issuer', 'jose-portfolio'), ' • ', location || __('Location', 'jose-portfolio'))
            : null,
          (dateStart || dateEnd)
            ? el('p', { className: 'mt-2 text-xs text-slate-400' }, (dateStart || ''), ' → ', (dateEnd || ''))
            : null,
          verifyUrl
            ? el('p', { className: 'mt-3 text-xs text-slate-400' }, __('Verification URL set ✓', 'jose-portfolio'))
            : el('p', { className: 'mt-3 text-xs text-slate-500' }, __('Optional: add a verification URL in sidebar.', 'jose-portfolio'))
        )
      );
    },

    save: function () {
      return null; // dynamic render
    },
  });
})();
