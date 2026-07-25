import app from 'flarum/admin/app';

const t = (key: string) => app.translator.trans('gradba-blueprint.admin.settings.' + key);

app.initializers.add('gradba-blueprint', () => {
  app.extensionData
    .for('gradba-blueprint')

    // --- Colour ------------------------------------------------------------
    .registerSetting({
      label: t('primaryColor'),
      help: t('primaryColor-Help'),
      setting: 'gradba-blueprint.primaryColor',
      type: 'color-preview',
      placeholder: '#FBB03B',
    })
    .registerSetting({
      label: t('accentColor'),
      help: t('accentColor-Help'),
      setting: 'gradba-blueprint.accentColor',
      type: 'color-preview',
      placeholder: '#3A5952',
    })
    .registerSetting({
      label: t('bodyBg'),
      help: t('bodyBg-Help'),
      setting: 'gradba-blueprint.bodyBg',
      type: 'color-preview',
      placeholder: '#fbfaf8',
    })

    // --- The grid ----------------------------------------------------------
    .registerSetting({
      label: t('showGrid'),
      help: t('showGrid-Help'),
      setting: 'gradba-blueprint.showGrid',
      type: 'boolean',
    })
    .registerSetting({
      label: t('gridSize'),
      help: t('gridSize-Help'),
      setting: 'gradba-blueprint.gridSize',
      type: 'number',
      placeholder: '56',
    });
});
