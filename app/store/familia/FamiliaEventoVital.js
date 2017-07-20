Ext.define('sisscsj.store.familia.FamiliaEventoVital', {
    extend: 'sisscsj.store.Base',
    alias: 'store.familia.familiaeventovital',
    requires: [
        'sisscsj.model.familia.FamiliaEventoVital'
    ],
    restPath: 'EventoVitalFamilia',
    storeId: 'FamiliaEventoVital',
    model: 'sisscsj.model.familia.FamiliaEventoVital'
});