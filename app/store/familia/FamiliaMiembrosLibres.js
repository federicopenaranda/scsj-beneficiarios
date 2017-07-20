Ext.define('sisscsj.store.familia.FamiliaMiembrosLibres', {
    extend: 'sisscsj.store.Base',
    alias: 'store.familia.familiamiembroslibres',
    requires: [
        'sisscsj.model.familia.FamiliaMiembrosLibres'
    ],
    restPath: 'familia/familiaMiembros',
    storeId: 'FamiliaMiembrosLibres',
    model: 'sisscsj.model.familia.FamiliaMiembrosLibres'
});